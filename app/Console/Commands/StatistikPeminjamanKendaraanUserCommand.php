<?php

namespace App\Console\Commands;

use App\Models\Kendaraan;
use App\Models\StatistikPeminjamanKendaraanUser;
use App\Models\TransaksiPeminjamanKendaraan;
use App\Models\User;
use Illuminate\Console\Command;

class StatistikPeminjamanKendaraanUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reporting:statistik-peminjaman-kendaraan-user
                            {--user= : ID user yang akan diproses}
                            {--kendaraan= : ID kendaraan yang akan diproses}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Melakukan perhitungan statistik kendaraan yang pernah dipinjam oleh user';

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
            $kendaraan = Kendaraan::all();
            if($this->option('kendaraan')) {
                $kendaraan = Kendaraan::where('id', $this->option('kendaraan'))->get();
            }

            foreach($kendaraan as $kendaraan) {
                $jumlah = TransaksiPeminjamanKendaraan::where('id_user', $user->id)->where('id_kendaraan', $kendaraan->id)->count();
                StatistikPeminjamanKendaraanUser::updateOrCreate([
                    'id_user' => $user->id,
                    'id_kendaraan' => $kendaraan->id,
                ], [
                    'jumlah' => $jumlah,
                ]);
            }
        }

        return Command::SUCCESS;
    }
}
