<?php

namespace App\Http\Requests\TransaksiPeminjamanKendaraan;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanBaruKendaraanRequest extends FormRequest
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
        if(Route::currentRouteName() == 'peminjamanBaruKendaraan.create') {
            return [
                'user' => 'required|exists:App\Models\User,id',
                'kendaraan' => 'required|exists:App\Models\Kendaraan,id',
                'target_tanggal_waktu_kembali' => 'required|date|after_or_equal:' . $this->tanggal_waktu_pinjam,
                'tanggal_waktu_pinjam' => 'required|date|after_or_equal:now',
                'keperluan' => 'required|string',
                'lokasi_tujuan' => 'required|string',
                'geo_latitude' => 'required|string',
                'geo_longitude' => 'required|string',
            ];
        }
        elseif(Route::currentRouteName() == 'peminjamanBaruKendaraan.approval') {
            return [
                'approved' => 'required|boolean',
                'keterangan' => 'nullable|string',
            ];
        }

        return [
            'user' => 'required|exists:App\Models\User,id',
            'kendaraan' => 'required|exists:App\Models\Kendaraan,id',
            'target_tanggal_waktu_kembali' => 'required|date|after_or_equal:' . $this->tanggal_waktu_pinjam,
            'tanggal_waktu_pinjam' => 'required|date',
            'foto_speedometer' => 'required|image',
            'keperluan' => 'required|string',
            'lokasi_tujuan' => 'required|string',
            'geo_latitude' => 'required|string',
            'geo_longitude' => 'required|string',
            'foto_depan_sebelum' => 'required|image',
            'foto_belakang_sebelum' => 'required|image',
            'foto_kanan_sebelum' => 'required|image',
            'foto_kiri_sebelum' => 'required|image',
        ];
    }

    protected function prepareForValidation()
    {
        $user = Auth::user();
        if( !($user->hasRole('admin')) ) {
            $this->merge([
                'user' => $user->id,
            ]);
        }
    }

    protected function failedValidation(Validator $validator)
    {
        Alert::error('Gagal tersimpan!', 'Gagal menyimpan data');
        throw (new ValidationException($validator))
                    ->errorBag($this->errorBag)
                    ->redirectTo($this->getRedirectUrl());
    }
}
