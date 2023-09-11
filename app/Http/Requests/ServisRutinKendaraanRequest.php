<?php

namespace App\Http\Requests;

use App\Models\ServisRutinKendaraan;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class ServisRutinKendaraanRequest extends FormRequest
{
    protected $last_servis;

    public function __construct()
    {
        $this->last_servis = ServisRutinKendaraan::where('id_kendaraan', Route::getCurrentRoute()->id_kendaraan)->orderBy('created_at', 'desc')->first();
    }

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
        if($this->last_servis == null) {
            return [
                'tanggal_servis' => 'required|date',
                'detail_servis' => 'required',
                'km_target' => 'required|numeric',
            ];
        }
        else {
            return [
                'tanggal_servis' => 'required|date|after:' . $this->last_servis->tanggal_servis,
                'detail_servis' => 'required',
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
