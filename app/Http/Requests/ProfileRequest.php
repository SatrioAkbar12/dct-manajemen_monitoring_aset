<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPassword;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileRequest extends FormRequest
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
        if(Route::currentRouteName() == 'profile.update') {
            return [
                'nama' => 'required|string',
                'username' => 'required|string',
                'email' => 'required|email',
                'memiliki_sim' => 'required|boolean',
            ];
        }
        elseif(Route::currentRouteName() == 'profile.updatePassword') {
            return [
                'password_lama' => 'required|current_password',
                'password_baru' => 'required|confirmed',
                'password_baru_confirmation' => 'required',
            ];
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
