<?php

namespace App\Console\Commands;

use App\Models\Aset;
use App\Models\ListToolsTransaksiPeminjaman;
use App\Models\StatistikPenggunaanAset;
use App\Models\TransaksiPeminjamanKendaraan;
use App\Models\User;
use Illuminate\Console\Command;

class StatistikPenggunaanAsetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reporting:statistik-penggunaan-aset
                            {--aset= : Id Aset yang akan diproses}
                            {--user= : Id User yang akan diproses}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Melakukan perhitungan statistik penggunaan aset';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::all();
        if($this->option('user')) {
            $user = User::where('id', $this->option('user'))->get();
        }

        foreach($user as $user) {
            $aset = Aset::with(['kendaraan, tool'])->get();
            if($this->option('aset')) {
                $aset = Aset::with(['kendaraan, tool'])->where('id', $this->option('aset'))->get();
            }

            foreach($aset as $aset) {
                $jumlah = 0;
                if($aset->tipe_aset == 'kendaraan') {
                    $jumlah = TransaksiPeminjamanKendaraan::where('id_user', $user->id)
                        ->where('id_kendaraan', $aset->kendaraan->id)
                        ->count();
                }
                elseif($aset->tipe_aset == 'tool') {
                    $jumlah = ListToolsTransaksiPeminjaman::join('transaksi_peminjaman_tool', 'transaksi_peminjaman_tool.id', '=', 'list_tools_transaksi_peminjaman.id_peminjaman_tool')
                        ->where('list_tools_transaksi_peminjaman.id_aset', $aset->id)
                        ->where('transaksi_peminjaman_tool.id_user', $user->id
                        )->count();
                }

                StatistikPenggunaanAset::updateOrCreate([
                    'id_aset' => $aset->id,
                    'id_user' => $user->id,
                ], [
                    'jumlah' => $jumlah
                ]);
            }
        }

        $this->info('Berhasil melakukan perhitungan statistik penggunaan aset!');

        return Command::SUCCESS;
    }
}
