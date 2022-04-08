<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateBuktiPembayaran extends FormRequest
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
            'berkas_bukti' => 'required|mimes:jpeg,png,jpg,pdf|max:3100'
            // 'gambar_qris'       => 'image|mimes:jpeg,png,jpg|max:1024',
            // 'gambar_logo_bank'  => 'image|mimes:jpeg,png,jpg|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'berkas_bukti.required'  => 'Berkas bukti pelunasan belum di pilih!',
            'berkas_bukti.mimes'     => 'Berkas bukti pelunasan maksimal 3 MB',
        ];
    }
}
