<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PeralihanNopModel;
use DB;

class RekapCont extends Controller
{

    public function index(Request $request)
    {
        $bread              = 'Laporan';
        $tittle             = 'Laporan Ringkasan BPHTB';
        // $menu_bphtb_group   = true;
        $menu_laporan_bphtb = true;

        return view('laporan.widged_rekap', compact(
            'bread',
            'tittle',
            'menu_laporan_bphtb',
        ));
    }

    public function getLaporanRingkasan()
    {
        // $data = PeralihanNopModel:: 
        $dataSatu = PeralihanNopModel::select(
            "id",
            DB::raw("(sum(jumlah_Setor)) as total_setor"),
            DB::raw("(DATE_FORMAT(tgl_setor, '%m')) as bulan"),
            DB::raw("(DATE_FORMAT(tgl_setor, '%m-%Y')) as bulan_tahun")
        )
            ->where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
            ->where('status_transaksi', STATUS_TRANSAKSI_LUNAS)
            ->whereYear('tgl_setor', now("Y"))
            ->orderBy(DB::raw("DATE_FORMAT(tgl_setor, '%m')"))
            ->groupBy(DB::raw("DATE_FORMAT(tgl_setor, '%m-%Y')"))
            ->get();

        $dataDua = PeralihanNopModel::select(
            "id",
            DB::raw("(sum(jumlah)) as total_setor"),
            DB::raw("(DATE_FORMAT(tgl_setor, '%m')) as bulan"),
            DB::raw("(DATE_FORMAT(tgl_setor, '%m-%Y')) as bulan_tahun")
        )
            ->whereYear('tgl_peralihan', now("Y"))
            ->orderBy(DB::raw("DATE_FORMAT(tgl_setor, '%m')"))
            ->groupBy(DB::raw("DATE_FORMAT(tgl_peralihan, '%m-%Y')"))
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

        $countPengajuan   = PeralihanNopModel::select('id')
            ->whereYear('tgl_peralihan', now("Y"))
            ->count();

        $countPenerimaan   = PeralihanNopModel::select('id')
            ->where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
            ->where('status_transaksi', STATUS_TRANSAKSI_LUNAS)
            ->whereYear('tgl_setor', now("Y"))
            ->count();

        $sumPengajuan   = PeralihanNopModel::select('jumlah_setor')
            ->whereYear('tgl_peralihan', now("Y"))
            ->sum('jumlah');

        $sumPenerimaan   = PeralihanNopModel::select('jumlah_setor')
            ->where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
            ->where('status_transaksi', STATUS_TRANSAKSI_LUNAS)
            ->whereYear('tgl_peralihan', now("Y"))
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



    //--
}
