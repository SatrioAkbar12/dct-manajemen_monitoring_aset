<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class PeminjamanAktifRequest extends FormRequest
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
        if(Route::currentRouteName() == 'peminjamanAktif.store') {
            return [
                'user' => 'required|exists:App\Models\User,id',
                'kendaraan' => 'required|exists:App\Models\Kendaraan,id',
                'target_tanggal_waktu_kembali' => 'required|date',
                'tanggal_pinjam' => 'required|date',
            ];
        }
        elseif(Route::currentRouteName() == 'peminjamanAktif.update') {
            return [
                'status_kondisi' => 'required|in:Aman,Ada kerusakan',
                'deskripsi' => 'required|string',
                'km_terakhir' => 'required|integer',
                'foto_depan' => 'required|image',
                'foto_belakang' => 'required|image',
                'foto_kanan' => 'required|image',
                'foto_kiri' => 'required|image',
            ];
        }
    }
}
