<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountEditVal extends FormRequest
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
            'hp'    => 'required',
            'wa'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'hp.required'   => 'No HP tidak boleh dikosongkan!',
            'wa.required'   => 'No Whatapps tidak boleh dikosongkan!',
        ];
    }
}
