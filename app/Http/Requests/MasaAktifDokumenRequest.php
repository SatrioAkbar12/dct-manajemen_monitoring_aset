<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

class MasaAktifDokumenRequest extends FormRequest
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
            'tipe_dokumen' => [
                Rule::excludeIf(Route::currentRouteName() == 'masaAktifDokumen.update'),
                'required',
                'exists:App\Models\TipeDokumenKendaraan,id',
            ],
            'masa_aktif' => 'required|date',
        ];
    }
}
