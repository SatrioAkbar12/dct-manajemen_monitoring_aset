<?php

namespace App\Helpers;

use App\Models\Aset;
use App\Models\KepemilikanAset;
use Carbon\Carbon;

class AsetHelper {
    public static function createKodeAset(Int $id_kepemilikan_aset) {
        $today = Carbon::now();
        $kepemilikan_aset = KepemilikanAset::find($id_kepemilikan_aset);

        $aset = Aset::withTrashed()->where('kode_aset', 'like', '%'.$kepemilikan_aset->prefix."%")->whereMonth('created_at', Carbon::now('m'))->count();
        $urutan = 1;

        if($aset != 0) {
            $urutan = $aset + 1;
        }

        $kodeAset = 'ASET-' . $kepemilikan_aset->prefix . '-' . $today->format('y') . '-' . str_pad($today->month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($urutan, 3, '0', STR_PAD_LEFT);

        return $kodeAset;
    }
}
