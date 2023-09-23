<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

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
        return [
            'gudang' => 'required|exists:\App\Models\Gudang,id',
            'id_list_tools' => 'required|array',
            'id_list_tools.*' => 'required|exists:\App\Models\ListToolsTransaksiPeminjaman,id',
            'status_kondisi' => 'required|array',
            'status_kondisi.*' => 'required|in:Tidak ada kerusakan,Ada kerusakan',
            'deskripsi' => 'required|array',
            'deskripsi.*' => 'required',
            'foto_tool' => 'required|array',
            'foto_tool.*' => 'required|image',
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
