<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;

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
        return [
            'nama' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string|email',
            'password' => [
                'required',
                'string',
                Rule::excludeIf(Route::currentRouteName() == 'user.update'),
            ],
            'memiliki_sim' => 'required|boolean',
        ];
    }
}
