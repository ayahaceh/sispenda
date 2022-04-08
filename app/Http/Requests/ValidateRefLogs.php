<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRefLogs extends FormRequest
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
            'nama_log'      => 'required',
            'deskripsi_log' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_log.required'         => 'Masukkan Referensi Nama Logs.',
            'deskripsi_log.required'    => 'Masukkan Deskripsi Logs.',
        ];
    }
}
