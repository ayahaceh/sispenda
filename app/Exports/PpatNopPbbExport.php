<?php

namespace App\Exports;

use App\Models\NopPbbModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PpatNopPbbExport implements FromView, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $kode_ppat = session()->get('datauser')->kode_ppat;
        $datas = NopPbbModel::with([
            'joinProfil',
            'joinProv',
            'joinKab',
            'joinKec',
            'joinDesa',
            'joinJenisPerolehan'
        ])->where('kode_ppat', $kode_ppat)->get();

        return view('export.nop_pbb', compact(
            'datas'
        ));
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'D' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_NUMBER,
            'O' => NumberFormat::FORMAT_NUMBER,
            'Q' => NumberFormat::FORMAT_NUMBER,
            'R' => NumberFormat::FORMAT_NUMBER,
            'S' => NumberFormat::FORMAT_NUMBER,
            'T' => NumberFormat::FORMAT_NUMBER,
            'U' => NumberFormat::FORMAT_NUMBER,
            'V' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
