<?php

namespace App\Exports;

use \App\Models\SpmModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SpmExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return SpmModel::all();
        $data = SpmModel::join('ref_skpd', 'spm.id_skpd', 'ref_skpd.id')
            ->join('ref_jenis_spm', 'id_jenis_spm', 'ref_jenis_spm.id')
            ->join('ref_status_spm', 'id_status_spm', 'ref_status_spm.id')
            ->join('ref_valid_spm', 'id_valid_spm', 'ref_valid_spm.id')
            ->join('pengantar', 'id_pengantar', 'pengantar.id')
            ->join('ref_rekening', 'pengantar.id_rekening', 'ref_rekening.id')
            ->whereYear('tgl_spm', date('Y'))
            ->select(
                'spm.no_spm',
                'spm.tgl_spm',
                'ref_jenis_spm.jenis_spm',
                'ref_valid_spm.valid_spm',
                'ref_status_spm.nama_status',
                'ref_skpd.kode_skpd',
                'ref_skpd.nama_skpd',
                'spm.jl_spm',
                'spm.ket_spm',
                'spm.penerima_dana',
                'spm.no_sp2d',
                'spm.tgl_sp2d',
                'spm.jl_sp2d',
                'pengantar.urut_pengantar',
                'pengantar.tgl_pengantar',
                'ref_rekening.no_rekening',

            )
            ->get();

        return $data;
    }


    public function headings(): array
    {
        return [
            "No SPM", "Tgl SPM", "Jenis SPM", "Validitas", "Status SPM",
            "Kode SKPD", "Nama SKPD", "Jumlah SPM", "Keterangan", "Penerima Dana",
            "No SP2D", "Tgl SP2D", "Jumlah SP2D", "No Pengantar", "Tgl Pengantar", "No Rekening"
        ];
    }

    //--
}
