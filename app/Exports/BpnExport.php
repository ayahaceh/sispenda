<?php

namespace App\Exports;

use App\Models\PeralihanNopModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BpnExport implements FromView, WithColumnFormatting
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
        $datas = PeralihanNopModel::with([
            'joinProfilDari',
            'joinProfilKepada',
            'joinJenisPerolehan'
        ])
            ->whereDate('tgl_setor', '>=', $this->start_date)
            ->whereDate('tgl_setor', '<=', $this->end_date)
            ->where('peralihan_nop.status_transaksi', '=', STATUS_TRANSAKSI_LUNAS)
            ->where('peralihan_nop.status_verifikasi', '=', STATUS_PEMBAYARAN_SUDAH_VERIFIKASI)
            ->where('peralihan_nop.approved_status', '=', STATUS_BPHTB_APPROVED)
            // ->whereStatusTransaksi(STATUS_TRANSAKSI_LUNAS)
            // ->whereStatusVerifikasi(STATUS_PEMBAYARAN_SUDAH_VERIFIKASI)
            // ->whereApprovedStatus(STATUS_BPHTB_APPROVED)
            ->get();
        // dd($datas);
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
