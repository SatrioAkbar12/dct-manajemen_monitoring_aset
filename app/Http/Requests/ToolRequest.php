<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class ToolRequest extends FormRequest
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
            'nama' => 'required|string',
            'merk' => 'required|string',
            'model' => 'string',
            'deskripsi' => 'string',
            'tools_group' => 'required|integer|exists:\App\Models\ToolsGroup,id',
            'gudang' => 'required|integer|exists:\App\Models\Gudang,id',
            'kepemilikan_aset' => [
                Rule::excludeIf((Route::currentRouteName() == 'tools.storeExist') || (Route::currentRouteName() == 'tools.update')),
                'required',
                'integer',
                'exists:\App\Models\KepemilikanAset,id'
            ],
            'kode_aset' => [
                Rule::excludeIf(Route::currentRouteName() == 'tools.store'),
                'required',
                'string',
                'unique:\App\Models\Aset,kode_aset',
            ],
            'jumlah' => [
                Rule::excludeIf((Route::currentRouteName() == 'tools.storeExist') || (Route::currentRouteName() == 'tools.update')),
                'required',
                'integer',
                'min:1',
            ],
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
