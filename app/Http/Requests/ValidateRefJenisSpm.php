<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRefJenisSpm extends FormRequest
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
            'jenis_spm'       => 'required',
        ];
    }

    public function messages()
    {
        return [
            'jenis_spm.required'        => 'Masukkan Referensi Jenis SPM.',
        ];
    }
}
