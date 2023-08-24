<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PeminjamanAktifKendaraanRequest extends FormRequest
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
        if(Route::currentRouteName() == 'peminjamanAktifKendaraan.store') {
            return [
                'user' => 'required|exists:App\Models\User,id',
                'kendaraan' => 'required|exists:App\Models\Kendaraan,id',
                'target_tanggal_waktu_kembali' => 'required|date',
                'tanggal_waktu_pinjam' => 'required|date|after_or_equal:now',
                'foto_speedometer' => 'required|image',
                'keperluan' => 'required|string',
                'lokasi_tujuan' => 'required|string',
                'geo_latitude' => 'required|string',
                'geo_longitude' => 'required|string',
            ];
        }
        elseif(Route::currentRouteName() == 'peminjamanAktifKendaraan.update') {
            return [
                'status_kondisi' => 'required|in:Aman,Ada kerusakan',
                'deskripsi' => 'required|string',
                'km_sebelumnya' => 'required|integer',
                'km_terakhir' => 'required|integer|min:' . $this->km_sebelumnya,
                'foto_depan' => 'required|image',
                'foto_belakang' => 'required|image',
                'foto_kanan' => 'required|image',
                'foto_kiri' => 'required|image',
                'foto_speedometer' => 'required|image',
                'geo_latitude' => 'required|string',
                'geo_longitude' => 'required|string',
            ];
        }
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

    public function withValidator(Validator $validator): void
    {
        $validator->after(function () {
            Alert::error('Gagal tersimpan!', 'Gagal menyimpan data karena input salah');
        });
    }


}
