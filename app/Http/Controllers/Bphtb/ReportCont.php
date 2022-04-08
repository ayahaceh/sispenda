<?php

namespace App\Http\Controllers\Bphtb;

use App\Http\Controllers\Controller;
use App\Models\Alamat\DesaModel;
use App\Models\Alamat\KecModel;
use Illuminate\Http\Request;
use App\Models\BphtbModel;
use DB;

class ReportCont extends Controller
{

    public function index(Request $request)
    {
        $bread              = 'Laporan';
        $tittle             = 'Laporan Ringkasan BPHTB';
        // $menu_bphtb_group   = true;
        $menu_laporan_group = true;
        $menu_laporan_bphtb = true;

        return view('laporan.ringkasan', compact(
            'bread',
            'tittle',
            'menu_laporan_group',
            'menu_laporan_bphtb',
        ));
    }

    public function getLaporanRingkasan()
    {
        // $data = BphtbModel:: 
        $dataSatu = BphtbModel::select(
            "id",
            DB::raw("(sum(jumlah_Setor)) as total_setor"),
            DB::raw("(DATE_FORMAT(tgl_setor, '%m')) as bulan"),
            DB::raw("(DATE_FORMAT(tgl_setor, '%m-%Y')) as bulan_tahun")
        )
            ->where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
            ->where('status_pembayaran', STATUS_PEMBAYARAN_LUNAS)
            ->whereYear('tgl_setor', now("Y"))
            ->orderBy(DB::raw("DATE_FORMAT(tgl_setor, '%m')"))
            ->groupBy(DB::raw("DATE_FORMAT(tgl_setor, '%m-%Y')"))
            ->get();

        $dataDua = BphtbModel::select(
            "id",
            DB::raw("(sum(jumlah_bphtb)) as total_setor"),
            DB::raw("(DATE_FORMAT(tgl_setor, '%m')) as bulan"),
            DB::raw("(DATE_FORMAT(tgl_setor, '%m-%Y')) as bulan_tahun")
        )
            ->whereYear('tgl_bphtb', now("Y"))
            ->orderBy(DB::raw("DATE_FORMAT(tgl_setor, '%m')"))
            ->groupBy(DB::raw("DATE_FORMAT(tgl_bphtb, '%m-%Y')"))
            ->get();


        $labels = [];
        $data1 = [];
        $data2 = [];

        for ($i = 1; $i <= (int) date('m'); $i++) {

            $is_exists = false;

            if ($i < 10) {
                $bulan = '0' . $i;
            } else {
                $bulan = '' . $i;
            }

            foreach ($dataDua as $key => $value) {
                if ($bulan == $value->bulan) {
                    $labels[] = formatMonthIndo($bulan);
                    $data2[] = ['bulan' => $bulan, 'total_setor' => $value->total_setor];

                    $is_exists = true;
                }
            }

            if ($is_exists == false) {
                $labels[] = formatMonthIndo($bulan);
                $data2[] = ['bulan' => $bulan, 'total_setor' => 0];
            }
        }

        foreach ($data2 as $key => $value) {
            $is_exists = false;
            foreach ($dataSatu as $key2 => $value2) {

                if ($value['bulan'] == $value2->bulan) {
                    $data1[] = ['bulan' => $value['bulan'], 'total_setor' => $value2->total_setor];
                    $is_exists = true;
                }
            }

            if ($is_exists == false) {
                $data1[] = ['bulan' => $value['bulan'], 'total_setor' => 0];
            }
        }

        $countPengajuan   = BphtbModel::select('id')
            ->whereYear('tgl_bphtb', now("Y"))
            ->count();

        $countPenerimaan   = BphtbModel::select('id')
            ->where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
            ->where('status_pembayaran', STATUS_PEMBAYARAN_LUNAS)
            ->whereYear('tgl_setor', now("Y"))
            ->count();

        $sumPengajuan   = BphtbModel::select('jumlah_bphtb')
            ->whereYear('tgl_bphtb', now("Y"))
            ->sum('jumlah_bphtb');

        $sumPenerimaan   = BphtbModel::select('jumlah_setor')
            ->where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
            ->where('status_pembayaran', STATUS_PEMBAYARAN_LUNAS)
            ->whereYear('tgl_bphtb', now("Y"))
            ->sum('jumlah_setor');

        $response = [
            'labels' => $labels,
            'data1' => $data1,
            'data2' => $data2,
            'countPengajuan' => $countPengajuan,
            'countPenerimaan' => $countPenerimaan,
            'sumPengajuan' => formatRupiah($sumPengajuan),
            'sumPenerimaan' => formatRupiah($sumPenerimaan)
        ];

        return response()->json($response);
    }

    public function rekap_kas(Request $request)
    {
        // dd($request);
        $tgl_awal           = date($request->tgl_awal);
        $tgl_akhir          = date($request->tgl_akhir);
        $kode_desa_nop      = $request->kode_desa_nop;
        $kode_kec_nop       = $request->kode_kec_nop;
        $namaKec            = null;
        $namaDesa            = null;
        // $from            = date('2018-01-01');
        // $to              = date('2018-05-02');

        if ($request->has('filter')) {
            if ($request->has('kode_desa_nop')) {
                if ($kode_desa_nop == 'semua') {
                    $data = BphtbModel::where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
                        ->where('status_pembayaran', STATUS_TRANSAKSI_LUNAS)
                        ->whereBetween('tgl_setor', [$tgl_awal, $tgl_akhir])
                        ->orderBy('tgl_setor', 'ASC')
                        ->get();
                    $namaDesa   = "Semua Desa";
                } else {
                    $data = BphtbModel::where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
                        ->where('status_pembayaran', STATUS_TRANSAKSI_LUNAS)
                        ->whereBetween('tgl_setor', [$tgl_awal, $tgl_akhir])
                        ->where('kode_desa_nop', $kode_desa_nop)
                        ->orderBy('tgl_setor', 'ASC')
                        ->get();
                    $namaDesa   = DesaModel::where('kode_desa', $kode_desa_nop)->first();
                }
            }

            if ($request->has('kode_kec_nop')) {
                if ($kode_kec_nop == 'semua') {
                    $data = BphtbModel::where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
                        ->where('status_pembayaran', STATUS_TRANSAKSI_LUNAS)
                        ->whereBetween('tgl_setor', [$tgl_awal, $tgl_akhir])
                        ->orderBy('tgl_setor', 'ASC')
                        ->get();
                    $namaKec   = "Semua Kecamatan";
                } else {
                    $data = BphtbModel::where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
                        ->where('status_pembayaran', STATUS_TRANSAKSI_LUNAS)
                        ->whereBetween('tgl_setor', [$tgl_awal, $tgl_akhir])
                        ->where('kode_kec_nop', $kode_kec_nop)
                        ->orderBy('tgl_setor', 'ASC')
                        ->get();
                    $namaKec   = KecModel::where('kode_kec', $kode_kec_nop)->first();
                }
            }

            $tglAwal    = $tgl_awal;
            $tglAkhir   = $tgl_akhir;
            $isFilter   = "YES";
        } else {
            $data = BphtbModel::where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
                ->where('status_pembayaran', STATUS_TRANSAKSI_LUNAS)
                ->whereYear('tgl_setor', NOW())
                ->orderBy('tgl_setor', 'ASC')
                ->get();
            $namaDesa   = "Semua Desa";
            $tglAwal    = NOW();
            $tglAkhir   = NOW();
            $isFilter   = "NO";
        }
        // $kode_kab           = '11.10';
        // $dataDesa           = DesaModel::where('kode_desa', 'like', '11.10' . '.' . '%')->orderBy('nama_desa', 'ASC')->get();
        $bread              = 'Laporan';
        $tittle             = 'Rekapitulasi Penerimaan dari BPHTB';
        $menu_laporan_group = true;
        $menu_laporan_rekap = true;

        return view('laporan.bphtb_rekap_l', compact(
            'bread',
            'tittle',
            'menu_laporan_group',
            'menu_laporan_rekap',

            'data',
            // 'dataDesa',
            'namaDesa',
            'namaKec',
            'tglAwal',
            'tglAkhir',
            'isFilter',
        ));
    }
    //--
}
