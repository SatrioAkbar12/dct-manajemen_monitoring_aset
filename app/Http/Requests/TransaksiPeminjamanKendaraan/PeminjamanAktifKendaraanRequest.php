<?php

namespace App\Http\Requests\TransaksiPeminjamanKendaraan;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
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
        return [
            'status_kondisi' => 'required|in:Tidak ada kerusakan,Ada kerusakan',
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

    protected function failedValidation(Validator $validator)
    {
        Alert::error('Gagal tersimpan!', 'Gagal menyimpan data');
        throw (new ValidationException($validator))
                    ->errorBag($this->errorBag)
                    ->redirectTo($this->getRedirectUrl());
    }
}
