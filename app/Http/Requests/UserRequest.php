<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class UserRequest extends FormRequest
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
        if(Route::currentRouteName() == 'user.updateRole') {
            return [
                'role' => 'required|string|exists:Spatie\Permission\Models\Role,name',
                'former_role' => 'string|exists:Spatie\Permission\Models\Role,name',
            ];
        }

        return [
            'nama' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string|email',
            'role' => [
                Rule::excludeIf(Route::currentRouteName() == 'user.update'),
                'required',
                'string',
                'exists:Spatie\Permission\Models\Role,name',
            ],
            'memiliki_sim' => 'required|boolean',
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
