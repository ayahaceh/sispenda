<?php

namespace App\Exports;

use App\Models\PeralihanNopModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PeralihanNopExport implements FromView, WithColumnFormatting
{
    protected $start_date;
    protected $end_date;

    function __construct($start_date, $end_date) {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
       $datas = PeralihanNopModel::with([
            'joinProfilDari',
            'joinProfilKepada',
            'joinJenisPerolehan'
        ])
            ->whereDate('tgl_setor', '>=', $this->start_date)
            ->whereDate('tgl_setor', '<=', $this->end_date)
            ->whereStatusTransaksi(STATUS_TRANSAKSI_LUNAS)
            ->get();

        return view('export.peralihan_nop', compact(
            'datas'
        ));
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_NUMBER,
            'C' => NumberFormat::FORMAT_NUMBER,
            'E' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_NUMBER,
            'I' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
            'K' => NumberFormat::FORMAT_NUMBER,
            'R' => NumberFormat::FORMAT_NUMBER,
            'S' => NumberFormat::FORMAT_NUMBER,
            'U' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
