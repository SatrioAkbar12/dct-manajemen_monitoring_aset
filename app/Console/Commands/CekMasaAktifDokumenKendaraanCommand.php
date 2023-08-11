<?php

namespace App\Console\Commands;

use App\Models\Kendaraan;
use App\Models\MasaAktifDokumenKendaraan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CekMasaAktifDokumenKendaraanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dokumen:cek-masa-aktif';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengecek masa aktif dokumen tiap kendaraan';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $kendaraan = Kendaraan::all();

        foreach($kendaraan as $k) {
            $dokumen = MasaAktifDokumenKendaraan::where('id_kendaraan', $k->id)->orderBy('tanggal_masa_berlaku', 'asc')->first();

            if($dokumen != null) {
                if(Carbon::parse($dokumen->tanggal_masa_berlaku, 'Asia/Jakarta')->diffInDays(Carbon::now('Asia/Jakarta'), false) >= -7) {
                    $k->update([
                        'tanggal_perbarui_dokumen' => $dokumen->tanggal_masa_berlaku,
                    ]);
                }
            }
        }

        return Command::SUCCESS;
    }
}
