<?php

namespace App\Console\Commands;

use App\Models\Kendaraan;
use App\Models\ServisRutinKendaraan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CekServisRutinKendaraanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kendaraan:cek-servis-rutin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $kendaraan = Kendaraan::all();

        foreach($kendaraan as $k) {
            $servis_rutin = ServisRutinKendaraan::where('id_kendaraan', $k->id)->orderBy('id', 'desc')->first();

            if( Carbon::now()->greaterThanOrEqualTo(Carbon::createFromFormat('Y-m-d', $servis_rutin->tanggal_target, 'Asia/Jakarta')) ) {
                Kendaraan::where('id', $k->id)->update([
                    'perlu_servis' => 1,
                ]);
            }
        }

        return Command::SUCCESS;
    }
}
