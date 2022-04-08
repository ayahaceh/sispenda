<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiPeralihan extends FormRequest
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
        $formValidation = [
            'profil_id'     => 'required',
            'nop'           => 'required',
            'npop'          => 'required',
            'npoptkp'       => 'required',
            'npopkp'        => 'required',
            'jumlah'        => 'required',
            'customRadio'   => 'required',
            'tgl_setor'     => 'required',
            'jumlah_setor'  => 'required',
            'nama_penyetor' => 'required',
            'status_transaksi' => 'required',
            'tgl_peralihan' => 'required',
            'no_rekening_bank' => 'required'
        ];

        if ($this->customRadio == 'opsi_a') {
            $formOpsi = [];
        } else if ($this->customRadio == 'opsi_b') {
            $formOpsi = ['tgl_b' => 'required'];
        } else if ($this->customRadio == 'opsi_c') {
            $formOpsi = ['persen_c' => 'required', 'uraian_c' => 'required'];
        } else if ($this->customRadio == 'opsi_d') {
            $formOpsi = ['uraian_d' => 'required'];
        }

        $formValidation = array_merge($formValidation, $formOpsi);

        return $formValidation;
    }

    public function messages()
    {
        return [
            'profil_id.required'    => 'Wajib Pajak Belum di pilih',
            'nop.required'          => 'NOP Belum di Isi',
            'npop.required'         => 'Npop Belum di Isi',
            'npoptkp.required'      => 'Npoptkp Belum di Isi',
            'npopkp.required'       => 'Npopkp Belum di Isi',
            'jumlah.required'       => 'Jumlah Belum di Isi',
            'no_b.required'         => 'Nomor Wajib di Isi',
            'tgl_b.required'        => 'Tanggal Wajib di Isi',
            'persen_c.required'     => 'Persen Wajib di Isi',
            'uraian_c.required'     => 'Wajib di Isi',
            'uraian_d.required'     => 'Wajib di Isi',
            'customRadio.required'  => 'Opsi Wajib di Pilih',
            'tgl_setor.required'    => 'Tanggal Setor Wajib di isi',
            'jumlah_setor.required' => 'Jumlah Setor Wajib di isi',
            'nama_penyetor.required' => 'Nama Penyetor Wajib di isi',
            'status_transaksi'      => 'Status Transaksi Wajib di isi',
            'tgl_peralihan'         => 'Tanggal Peralihan Wajib di isi',
            'no_rekening_bank.required' => 'No Rekening Setor Wajib di pilih'
        ];
    }
}
