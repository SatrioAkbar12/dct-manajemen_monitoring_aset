<?php

namespace App\Console\Commands;

use App\Models\ListToolsTransaksiPeminjaman;
use App\Models\StatistikPeminjamanToolsUser;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Console\Command;

class StatistikPeminjamanToolsUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reporting:statistik-peminjaman-tools-user
                            {--user= : Id user yang akan diproses}
                            {--tools= : Id tools yang akan diproses}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Melakukan perhitungan statistik tools yang pernah dipinjam oleh user';

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
            $tools = Tool::all();
            if($this->option('tools')) {
                $tools = Tool::where('id', $this->option('tools'))->get();
            }

            foreach($tools as $tools) {
                $jumlah = ListToolsTransaksiPeminjaman::join('transaksi_peminjaman_tool', 'transaksi_peminjaman_tool.id', '=', 'list_tools_transaksi_peminjaman.id_peminjaman_tool')->where('list_tools_transaksi_peminjaman.id_aset', $tools->id_aset)->where('transaksi_peminjaman_tool.id_user', $user->id)->count();
                StatistikPeminjamanToolsUser::updateOrCreate([
                    'id_user' => $user->id,
                    'id_tools' => $tools->id,
                ], [
                    'jumlah' => $jumlah,
                ]);
            }
        }

        return Command::SUCCESS;
    }
}
