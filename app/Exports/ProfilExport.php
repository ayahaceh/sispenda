<?php

namespace App\Exports;

use App\Models\ProfilModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ProfilExport implements FromView, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $datas = ProfilModel::with([
            'joinProv',
            'joinKab',
            'joinKec',
            'joinDesa'
        ])->get();

        return view('export.profil', compact(
            'datas'
        ));
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_NUMBER,
            'L' => NumberFormat::FORMAT_NUMBER,
            'N' => NumberFormat::FORMAT_NUMBER,
            'O' => NumberFormat::FORMAT_NUMBER,
            'P' => NumberFormat::FORMAT_NUMBER,
            'R' => NumberFormat::FORMAT_NUMBER,
            'S' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
