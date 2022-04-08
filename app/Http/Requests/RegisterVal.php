<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterVal extends FormRequest
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
            // tabel User 
            'username' => 'required',
            'password' => 'required',

            // tabel Profil
            'nik'       => 'required',
            'kk'        => 'required',
            'nama'      => 'required',
            'jk'        => 'required',
            'alamat'    => 'required',
            'kode_prov' => 'required',
            'kode_kab'  => 'required',
            'kode_kec'  => 'required',
            'kode_desa' => 'required',
            'hp'        => 'required',
            'email'     => 'required|unique:profil',
            'foto'      => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ];
    }

    public function messages()
    {
        return [

            'username.required'     => 'Username tidak valid!',
            'password.required'     => 'password belum diisi!',

            'nik.required'       => 'NIK belum diisi!',
            'kk.required'        => 'No KK belum diisi!',
            'nama.required'      => 'Nama belum diisi!',
            'jk.required'        => 'Jenis Kelamin belum diisi!',
            'alamat.required'    => 'Alamat belum diisi',
            'kode_prov.required'    => 'Provinsi belum dipilih!',
            'kode_kab.required'     => 'Kabupaten belum dipilih!',
            'kode_kec.required'     => 'Kecamatan belum dipilih!',
            'kode_desa.required'    => 'Desa belum dipilih!',
            'hp.required'        => 'Nomor Handphone belum diisi!',
            'email.required'     => 'Email belum diisi!',
            'email.unique'       => 'Email ini telah terdaftar sebelumnya!',
            'foto.required'      => 'Foto belum diupload!',
            'foto.image'        => 'Foto harus berupa gambar format JPG, JPEG, PNG (Maks. 1 MB)',
            'foto.mimes'        => 'Foto harus berupa gambar format JPG, JPEG, PNG (Maks. 1 MB)',
            'foto.max'          => 'Foto harus berupa gambar format JPG, JPEG, PNG (Maks. 1 MB)',
        ];
    }
}
