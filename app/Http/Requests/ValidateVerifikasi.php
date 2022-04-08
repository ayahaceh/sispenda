<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateVerifikasi extends FormRequest
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
            'get_status_pelunasan_update'   => 'required',
            'get_bendahara_update'          => 'required',
            'get_tgl_diterima_update'       => 'required',
            'get_status_bphtb_update'       => 'required',
            'get_verifikator_update'        => 'required',
            'get_tgl_verifikasi_update'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'get_status_pelunasan_update.required'  => 'Pilih status pelunasan!',
            'get_bendahara_update.required'         => 'Pilih nama penerima!',
            'get_tgl_diterima_update.required'      => 'Pilih tanggal diterima!',
            'get_status_bphtb_update.required'      => 'Pilih Status BPHTB!',
            'get_verifikator_update.required'       => 'Pilih Pejabat Verifikator!',
            'get_tgl_verifikasi_update.required'    => 'Pilih Tgl Verifikasi',
        ];
    }
}
