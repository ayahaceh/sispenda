<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePhotoVal extends FormRequest
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
            'foto'    => 'required|mimes:jpg,jpeg,png|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'foto.required' => 'Foto belum di Upload.',
            'foto.mimes'    => 'Hanya dapat menerima file JPG, JPEG, dan PNG.',
            'foto.max'      => 'Maksimal Foto 1 MB.',
        ];
    }
}
