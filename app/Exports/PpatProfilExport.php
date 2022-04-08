<?php

namespace App\Exports;

use App\Models\ProfilModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PpatProfilExport implements FromView, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $kodePPAT   = session()->get('datauser')->kode_ppat;
        $datas      = ProfilModel::with([
            'joinProv',
            'joinKab',
            'joinKec',
            'joinDesa'
        ])->where('kode_ppat', $kodePPAT)->get();
        // dd($datas);
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
