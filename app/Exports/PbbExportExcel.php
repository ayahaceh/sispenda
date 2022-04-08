<?php

namespace App\Exports;

use App\Models\Pbb;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PbbExportExcel implements FromView, WithColumnFormatting
{
    public function view(): View
    {
        $pbbs = Pbb::whereYear("tgl_pbb", date("Y"))->with("desaWp", "desaNop", "kecamatanWp", "kecamatanNop", "kabupatenWp", "jenisPerolehan", "KabupatenNop")->latest()->get();

        return view('pbb/admin/export-excel', compact(
            'pbbs'
        ));
    }
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'D' => NumberFormat::FORMAT_NUMBER,
            'O' => NumberFormat::FORMAT_NUMBER,
            'P' => NumberFormat::FORMAT_NUMBER,
            'Q' => NumberFormat::FORMAT_NUMBER,
            'R' => NumberFormat::FORMAT_NUMBER,
            'S' => NumberFormat::FORMAT_NUMBER,
            'T' => NumberFormat::FORMAT_NUMBER,
            'U' => NumberFormat::FORMAT_NUMBER,
            'V' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
