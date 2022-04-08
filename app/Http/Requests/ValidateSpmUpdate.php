<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateSpmUpdate extends FormRequest
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
            // 'urut_spm'      => 'required|numeric',
            'no_spm'        => 'required',
            'tgl_spm'       => 'required',
            'jl_spm'        => 'required',
            'berkas_spm'    => 'nullable|mimes:pdf,jpg,jpeg,png|max:25500',
            'id_skpd'       => 'required',
            'id_jenis_spm'  => 'required',
            'ket_spm'       => 'required',
            'penerima_dana' => 'required',
        ];
    }

    public function messages()
    {
        return [
            // 'urut_spm.required'         => 'Nomor Urut SPM tidak boleh kosong.',
            // 'urut_spm.numeric'          => 'Nomor Urut SPM Hanya Angka.',
            'no_spm.required'           => 'Nomor SPM lengkap tidak boleh kosong.',
            'tgl_spm.required'          => 'Tanggal SPM belum diisi',
            'jl_spm.required'           => 'Jumlah SPM belum diisi',
            'berkas_spm.mimes'          => 'Hanya dapat menerima file PDF, JPG, JPEG, dan PNG.',
            'berkas_spm.max'            => 'Maksimal File 25 MB.',
            'id_skpd.required'          => 'Harap Pilih SKPD.',
            'id_jenis_spm.required'     => 'Harap Pilih Jenis Belanja (SPM).',
            'ket_spm.required'          => 'Uraian SPM belum diisi.',
            'penerima_dana.required'    => 'Penerima dana belum diisi.',
        ];
    }
}
