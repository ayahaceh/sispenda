<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRekening extends FormRequest
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
            'no_rekening'       => 'required',
            'nama_rekening'     => 'required',
            // 'gambar_qris'       => 'image|mimes:jpeg,png,jpg|max:1024',
            // 'gambar_logo_bank'  => 'image|mimes:jpeg,png,jpg|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'no_rekening.required'      => 'Nomor Rekening tidak boleh kosong.',
            'nama_rekening.required'    => 'Nama Rekening tidak boleh kosong.',
        ];
    }
}
