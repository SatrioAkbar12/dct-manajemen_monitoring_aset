<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class KepemilikanAsetRequest extends FormRequest
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
        if(Route::currentRouteName() == 'kepemilikanAset.store') {
            return [
                'nama' => 'required|string',
                'prefix' => 'required|string|unique:\App\Models\KepemilikanAset,prefix',
            ];
        }
        elseif(Route::currentRouteName() == 'kepemilikanAset.update') {
            return [
                'nama' => 'required|string',
                'prefix' => 'required|string',
            ];
        }
    }
}
