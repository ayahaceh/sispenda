<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PeralihanNopModel;
use Illuminate\Http\Request;
use App\Exports\BpnExport;

// use App\Http\Requests\TransaksiPeralihan;
// use App\Models\Referensi\JenisPerolehanModel;
// use App\Models\NopPbbModel;
// use Illuminate\Support\Facades\DB;
// use App\Models\Referensi\RekeningModel;



class BpnCont extends Controller
{

    public function index()
    {
        // DISINI TAMPILKAN GRAFIK

        $bread          = 'Home | Transaksi | BPHTB';
        $tittle         = 'Lihat Transaksi BPHTB';
        $menu_bphtb_group   = true;
        $menu_bphtb_semua   = true;

        return view('transaksi.bpn.bpn_trans_peralihan_v', compact(
            // 'data',
            'bread',
            'tittle',
        ));
    }

    public function semua(Request $request)
    {

        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = PeralihanNopModel::select('peralihan_nop.*')
                ->join('profil AS baru', 'baru.nik', 'peralihan_nop.kepada_nik')
                ->leftJoin('profil AS lama', 'lama.nik', 'peralihan_nop.dari_nik')
                ->leftJoin('nop_pbb', 'nop_pbb.nop', 'peralihan_nop.nop')
                ->leftJoin('kec', 'kec.kode_kec', 'nop_pbb.kode_kec')
                ->leftJoin('desa', 'desa.kode_desa', 'nop_pbb.kode_desa')
                ->where(function ($query) use ($keyword) {
                    $query->where('desa.nama_desa', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('kec.nama_kec', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('peralihan_nop.nop', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('baru.nama', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('lama.nama', 'LIKE',  '%' . $keyword . '%')
                        // ->orWhere('peralihan_nop.dari_nik', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('peralihan_nop.kepada_nik', 'LIKE',  '%' . $keyword . '%');
                })
                ->where('peralihan_nop.status_transaksi', STATUS_TRANSAKSI_LUNAS)
                ->where('peralihan_nop.approved_status', STATUS_BPHTB_APPROVED)
                ->where('peralihan_nop.status_verifikasi', STATUS_PEMBAYARAN_SUDAH_VERIFIKASI)
                ->whereYear('peralihan_nop.tgl_setor', now())
                ->orderByDesc('peralihan_nop.id')
                ->paginate(20);

            $clearButton    = true;
        } else {
            $data = PeralihanNopModel::select('peralihan_nop.*')
                ->join('profil AS p', 'p.nik', 'peralihan_nop.kepada_nik')
                ->where('peralihan_nop.status_transaksi', STATUS_TRANSAKSI_LUNAS)
                ->where('peralihan_nop.approved_status', STATUS_BPHTB_APPROVED)
                ->where('peralihan_nop.status_verifikasi', STATUS_PEMBAYARAN_SUDAH_VERIFIKASI)
                ->whereYear('peralihan_nop.tgl_setor', now())
                ->orderByDesc('peralihan_nop.id')
                ->paginate(20);
            $clearButton    = false;
            $keyword        = '';
        }

        $bread          = 'Home | Transaksi | BPHTB';
        $tittle         = 'Daftar Transaksi BPHTB';
        $menu_bphtb_group   = true;
        $menu_bphtb_belum   = true;

        return view('transaksi.bpn.bpn_trans_peralihan_semua_l', compact(
            // 'aktif',
            'data',
            'clearButton',
            'keyword',

            'bread',
            'tittle',
            'menu_bphtb_group',
            'menu_bphtb_belum',
        ));
    }

    public function bulan_ini(Request $request)
    {

        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = PeralihanNopModel::select('peralihan_nop.*')
                ->join('profil AS baru', 'baru.nik', 'peralihan_nop.kepada_nik')
                ->leftJoin('profil AS lama', 'lama.nik', 'peralihan_nop.dari_nik')
                ->leftJoin('nop_pbb', 'nop_pbb.nop', 'peralihan_nop.nop')
                ->leftJoin('kec', 'kec.kode_kec', 'nop_pbb.kode_kec')
                ->leftJoin('desa', 'desa.kode_desa', 'nop_pbb.kode_desa')
                ->where('peralihan_nop.status_transaksi', STATUS_TRANSAKSI_LUNAS)
                ->where('peralihan_nop.approved_status', STATUS_BPHTB_APPROVED)
                ->whereMonth('peralihan_nop.tgl_setor', now())
                ->where(function ($query) use ($keyword) {
                    $query->where('desa.nama_desa', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('kec.nama_kec', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('peralihan_nop.nop', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('baru.nama', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('lama.nama', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('peralihan_nop.dari_nik', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('peralihan_nop.kepada_nik', 'LIKE',  '%' . $keyword . '%');
                })
                ->orderByDesc('peralihan_nop.id')
                ->paginate(20);

            $clearButton    = true;
        } else {
            $data = PeralihanNopModel::select('peralihan_nop.*')
                ->join('profil AS p', 'p.nik', 'peralihan_nop.kepada_nik')
                ->where('peralihan_nop.status_transaksi', STATUS_TRANSAKSI_LUNAS)
                ->where('peralihan_nop.approved_status', STATUS_BPHTB_APPROVED)
                ->whereMonth('peralihan_nop.tgl_setor', now())
                ->orderByDesc('peralihan_nop.id')
                ->paginate(20);
            $clearButton    = false;
            $keyword        = '';
        }

        $bread          = 'Home | Transaksi | BPHTB';
        $tittle         = 'Daftar Transaksi BPHTB';
        $menu_bphtb_group   = true;
        $menu_bphtb_belum   = true;

        return view('transaksi.bpn.bpn_trans_peralihan_bulan_l', compact(
            // 'aktif',
            'data',
            'clearButton',
            'keyword',

            'bread',
            'tittle',
            'menu_bphtb_group',
            'menu_bphtb_belum',
        ));
    }

    public function filter(Request $request)
    {
        $data = PeralihanNopModel::select('peralihan_nop.*')
            ->join('profil AS p', 'p.nik', 'peralihan_nop.kepada_nik')
            ->where('peralihan_nop.status_transaksi', STATUS_TRANSAKSI_LUNAS)
            ->where('peralihan_nop.approved_status', STATUS_BPHTB_APPROVED)
            ->where('peralihan_nop.status_verifikasi', STATUS_PEMBAYARAN_SUDAH_VERIFIKASI)
            ->whereDate('peralihan_nop.tgl_setor', '>=', $request->start_date)
            ->whereDate('peralihan_nop.tgl_setor', '<=', $request->end_date)
            ->orderByDesc('peralihan_nop.id')
            ->paginate(20);

        $clearButton    = false;
        $keyword        = '';
        $bread          = 'Home | Transaksi | BPHTB';
        $tittle         = 'Daftar Transaksi BPHTB';
        $menu_bphtb_group   = true;
        $menu_bphtb_belum   = true;
        $view               = 'transaksi.bpn.bpn_trans_peralihan_semua_l';
        return view($view, compact(
            // 'aktif',
            'data',
            'clearButton',
            'keyword',

            'bread',
            'tittle',
            'menu_bphtb_group',
            'menu_bphtb_belum',
        ));
    }

    public function show($id)
    {
        $data = PeralihanNopModel::find($id);
        if (empty($data) || $data == '') {
            // Agar tidak error pada tampilan View saat datanya kosong!
            return back()->with('error', 'Data tidak ditemukan !');
            // Tidak dapat melihat selain transaksi yang telah di Approve dan Telah Lunas!
        } elseif ($data->approved_status != STATUS_BPHTB_APPROVED || $data->status_transaksi != STATUS_TRANSAKSI_LUNAS) {
            return back()->with('error', 'Data tidak ditemukan !');
        }

        $bread          = 'Home | Transaksi | BPHTB';
        $tittle         = 'Lihat Transaksi BPHTB';
        $menu_bphtb_group   = true;
        $menu_bphtb_semua   = true;

        return view('transaksi.bpn.bpn_trans_peralihan_v', compact(
            'data',
            'bread',
            'tittle',
        ));
    }

    public function export(Request $request)
    {
        $start_date     = $request->start_date;
        $end_date       = $request->end_date;
        $file_name      = 'Data Transaksi BPHTB dari ' . $start_date . ' sampai ' . $end_date . ' - Export by ' . env('APP_NAME') . '.xlsx';
        return Excel::download(new BpnExport($start_date, $end_date), $file_name);
    }

    //--
}
