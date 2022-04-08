<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSettingApp extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nama_setting'      => 'required',
            'nilai_setting'     => 'nummeric|required',
        ];
    }

    public function messages()
    {
        return [
            'nama_setting.required'     => 'Masukkan Nama setting dengan tepat!',
            'nilai_setting.required'    => 'Pilih Ya atau Tidak!',
            'nilai_setting.nummeric'    => 'Pilih Ya atau Tidak!',
        ];
    }
}
