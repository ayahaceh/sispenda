<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUser extends FormRequest
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
            'nik'           => 'required|unique:users',
            'nama'          => 'required',
            'username'      => 'required|unique:users',
            'email'         => 'required|unique:users',
            'foto'          => 'required|image|mimes:jpeg,png,jpg,gif|max:1024',
            'user_group'    => 'required',
            // 'password'      => 'required',


        ];
    }

    public function messages()
    {
        return [
            'nik.required'      => 'Harap Isi NIK KTP Pengguna.',
            'nik.unique'        => 'NIK ini telah terdaftar sebelumnya.',
            'nama.required'     => 'Harap Isi Nama Pengguna.',
            'username.required' => 'Harap Isi Username Pengguna, Maksimal 25 karakter, tanpa spasi.',
            'username.unique'   => 'Username ini telah terdaftar sebelumnya.',
            'email.required'    => 'Harap Isi Email Pengguna.',
            'email.unique'      => 'Email ini telah terdaftar sebelumnya.',
            // 'password.required' => 'Harap Isi Password Pengguna.',

            'foto.required'     => 'Harap Isi Foto Pengguna.',
            'foto.image'        => 'File yang di upload harus berupa Gambar / Foto.',
            'foto.mimes'        => 'File yang di upload harus berformat jpeg, png, jpg, atau gif.',
            'foto.max'          => 'File yang di upload maximal 1MB.',
            'user_group.required' => 'Harap pilih Role user.',

        ];
    }
}
