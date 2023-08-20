<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class PeminjamanAktifToolRequest extends FormRequest
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
        if(Route::currentRouteName() == 'peminjamanAktifTools.store') {
            return [
                'user' => 'required|integer|exists:\App\Models\User,id',
                'tools' => 'required|array',
                'tanggal_waktu_pinjam' => 'required|date',
                'target_tanggal_waktu_kembali' => 'required|date',
            ];
        }
        elseif(Route::currentRouteName() == 'peminjamanAktifTools.update') {
            return [
                'gudang' => 'required|exists:\App\Models\Gudang,id',
                'id_list_tools' => 'required|array',
                'id_list_tools.*' => 'required|exists:\App\Models\ListToolsTransaksiPeminjaman,id',
                'status_kondisi' => 'required|array',
                'status_kondisi.*' => 'required|in:Tidak ada kerusakan,Ada kerusakan',
                'deskripsi' => 'required|array',
                'deskripsi.*' => 'required',
            ];
        }

    }

    protected function prepareForValidation()
    {
        if(Route::currentRouteName() == 'peminjamanAktifTools.store') {
            $user = Auth::user();
            if( !($user->hasRole('admin')) ) {
                $this->merge([
                    'user' => $user->id,
                ]);
            }
        }
    }
}
