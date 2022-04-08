<?php

namespace App\Exports;

use App\Models\PeralihanNopModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PpatPeralihanNopExport implements FromView, WithColumnFormatting
{
    protected $start_date;
    protected $end_date;

    function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $kodePPAT = Auth()->user()->kode_ppat;
        $datas = PeralihanNopModel::with([
            'joinProfilDari',
            'joinProfilKepada',
            'joinJenisPerolehan'
        ])
            ->where('kode_ppat', $kodePPAT)
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
