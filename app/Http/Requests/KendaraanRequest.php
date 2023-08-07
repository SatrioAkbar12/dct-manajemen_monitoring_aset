<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'jenis_kendaraan' => 'required|in:Motor,Mobil,Van'
        ];
    }
}
