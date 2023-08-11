<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class KendaraanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nopol' => 'required|string',
            'merk' => 'required|string',
            'warna' => 'required|string',
            'jenis_kendaraan' => 'required|integer|exists:\App\Models\JenisKendaraan,id',
            'tipe' => 'required|string',
            'km_saat_ini' => 'required|integer',
            'tanggal_servis_terakhir' => [
                Rule::excludeIf(Route::currentRouteName() == 'kendaraan.update'),
                'required',
                'date',
            ],
            'km_target_servis' => [
                Rule::excludeIf(Route::currentRouteName() == 'kendaraan.update'),
                'required',
                'integer',
            ],
        ];
    }
}
