<?php

namespace App\Http\Controllers\Pbb;

use App\Http\Controllers\Controller;
use App\Models\NopPbbModel;
use App\Models\Pbb;
use DateTime;
use Illuminate\Http\Request;

class GeneratePbbController extends Controller
{
    public function index()
    {
        $nop_pbb =  NopPbbModel::get();
        $tgl  =
            $bulan = new DateTime((request("tahun") ?? date("Y")) . date("-m-d"));
        $nop_pbb->each(function ($nop) use ($bulan) {
            $pbb = Pbb::whereYear("tgl_pbb", $bulan->format("Y"))->whereNik($nop->nik)->whereNop($nop->nop)->first();
            if (!$pbb) {
                $tanah      = $nop->luas_tanah * $nop->njop_tanah;
                $bangunan   = $nop->luas_bangunan * $nop->njop_bangunan;
                $total      = $tanah + $bangunan;
                $njoptkp = 0;
                $jumlah_terhutang = ($total - $njoptkp) *  0.001;
                $nomor_formulir = Pbb::invoiceNumber($nop->joinProfil->kode_desa ?? '');
                Pbb::create([
                    "nomor_formulir" => $nomor_formulir,
                    "nik" => $nop->nik,
                    "tgl_pbb" => $bulan->format("Y-m-d"),
                    "nama_wp" => $nop->joinProfil->nama ?? '',
                    "alamat_wp" => $nop->joinProfil->alamat ?? '',
                    "kode_prov_wp" => $nop->joinProfil->kode_prov ?? '',
                    "kode_kab_wp" => $nop->joinProfil->kode_kab ?? '',
                    "kode_kec_wp" => $nop->joinProfil->kode_kec ?? '',
                    "kode_desa_wp" => $nop->joinProfil->kode_desa ?? '',
                    "rtrw_wp" => $nop->joinProfil->rtrw ?? '',
                    "kode_pos_wp" => $nop->joinProfil->kode_pos ?? '',

                    "nop" => $nop->nop,
                    "status_nop" => $nop->status_nop_pbb,
                    "letak_nop" => $nop->letak,
                    "kode_prov_nop" => $nop->kode_prov,
                    "kode_kab_nop" => $nop->kode_kab,
                    "kode_kec_nop" => $nop->kode_kec,
                    "kode_desa_nop" => $nop->kode_desa,
                    "rtrw_nop" => $nop->rtrw,
                    "luas_tanah" => $nop->luas_tanah,
                    "njop_tanah" => $nop->njop_tanah,
                    "luas_bangunan" => $nop->luas_bangunan,
                    "njop_bangunan" => $nop->njop_bangunan,
                    "kode_jenis_perolehan" => $nop->kode_jenis_perolehan,
                    "no_sertifikat" => $nop->no_sertifikat,
                    "jumlah_njop" => $total,
                    "jumlah_njop_pbb" => $total - $njoptkp,
                    "tgl_jatuh_tempo" =>  $bulan->format("Y-") .  ($bulan->format("m") + 1) .  $bulan->format("-d"),
                    "jumlah_terhutang" => $jumlah_terhutang,
                    "status_pembayaran" => STATUS_PEMBAYARAN_BELUM_VERIFIKASI,
                    "created_by" => auth()->user()->nama,
                ]);
            }
        });
        return back()->with("success", "Telah di generate");
    }
}
