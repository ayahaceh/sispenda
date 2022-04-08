<?php

namespace App\Exports;

use App\Models\BphtbModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BphtbExport implements FromView, WithColumnFormatting
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
        $datas = BphtbModel::whereDate('tgl_setor', '>=', $this->start_date)
            ->whereDate('tgl_setor', '<=', $this->end_date)
            ->whereStatusPembayaran(STATUS_PEMBAYARAN_LUNAS)
            ->whereStatusBphtb(STATUS_BPHTB_SUDAH_DISETUJUI)
            ->get();

        return view('export.bphtb', compact(
            'datas'
        ));
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
            'B' => NumberFormat::FORMAT_NUMBER,
            'D' => NumberFormat::FORMAT_NUMBER,
            'F' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_NUMBER,
            'H' => NumberFormat::FORMAT_NUMBER,
            'L' => NumberFormat::FORMAT_NUMBER,
            'R' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
