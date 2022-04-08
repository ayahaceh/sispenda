<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSp2dUpdate extends FormRequest
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
            'urut_sp2d'      => 'required|numeric',
            'no_sp2d'        => 'required',
            'tgl_sp2d'       => 'required',
            'jl_sp2d'        => 'required',
            'berkas_sp2d'    => 'nullable|mimes:pdf,jpg,jpeg,png|max:25500',
            'berkas_lainnya' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25500',
        ];
    }

    public function messages()
    {
        return [
            'urut_sp2d.required' => 'Nomor Urut SP2D tidak boleh kosong.',
            'urut_sp2d.numeric'  => 'Nomor Urut SP2D Hanya Angka.',
            'no_sp2d.required'   => 'Nomor SP2D lengkap tidak boleh kosong.',
            'tgl_sp2d.required'  => 'Tanggal SP2D belum diisi',
            'jl_sp2d.required'   => 'Jumlah SP2D belum diisi',
            'berkas_sp2d.mimes'         => 'Hanya dapat menerima file PDF, JPG, JPEG, dan PNG.',
            'berkas_sp2d.max'           => 'Maksimal File 25 MB.',
            'berkas_lainnya.mimes'      => 'Hanya dapat menerima file PDF, JPG, JPEG, dan PNG.',
            'berkas_lainnya.max'        => 'Maksimal File 25 MB.',
        ];
    }
}
