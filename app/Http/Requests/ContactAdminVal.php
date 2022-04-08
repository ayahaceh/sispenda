<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactAdminVal extends FormRequest
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
            'nama'      => 'required',
            'hp'        => 'required',
            'email'     => 'required',
            'message'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            // 'captcha.captcha'   => 'Kode Capcha salah!',

            'nama.required'     => 'Masukkan nama anda!',
            'hp.required'       => 'Masukkan No Hp / WA anda!',
            'email.required'    => 'Masukkan alamat email valid anda!',
            'message.required'  => 'Masukkan Pesan !',

        ];
    }
}
