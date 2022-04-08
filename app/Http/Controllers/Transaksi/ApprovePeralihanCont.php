<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PeralihanNopModel;
use App\Http\Traits\LogsTrait;
use App\Models\BphtbModel;

// use App\Exports\PeralihanNopExport;
// use App\Http\Requests\TransaksiPeralihan;
// use App\Models\Referensi\JenisPerolehanModel;
// use App\Models\NopPbbModel;
// use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Models\Referensi\RekeningModel;

// use App\Models\Referensi\UrutStpdModel;
// use App\Models\Tarif\TarifNjopModel;
// use App\Models\Alamat\ProvModel;
// use App\Models\Alamat\KabModel;
// use App\Models\Alamat\KecModel;
// use App\Models\Alamat\DesaModel;
// use Illuminate\Support\Facades\Auth;

class ApprovePeralihanCont extends Controller
{
    use LogsTrait;
    public function belum_approve(Request $request)
    {

        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = BphtbModel::where('status_bphtb', STATUS_BPHTB_BELUM_DISETUJUI)
                ->where(function ($query) use ($keyword) {
                    $query->where('tgl_bphtb', 'like', "%{$keyword}%")
                        ->orWhere('nik', 'like', "%{$keyword}%")
                        ->orWhere('nama_wp', 'like', "%{$keyword}%")
                        ->orWhere('nop', 'like', "%{$keyword}%")
                        ->orWhere('letak_nop', 'like', "%{$keyword}%")
                        ->orWhereHas('joinKecNop', function ($query) use ($keyword) {
                            return $query->where('nama_kec', 'like', "%{$keyword}%");
                        })
                        ->orWhereHas('joinDesaNop', function ($query) use ($keyword) {
                            return $query->where('nama_desa', 'like', "%{$keyword}%");
                        });
                })
                ->orderByDesc('id')
                ->paginate(20);

            $clearButton    = true;
        } else {
            $data = BphtbModel::where('status_bphtb', STATUS_BPHTB_BELUM_DISETUJUI)
                ->orderByDesc('id')
                ->paginate(20);
            $clearButton    = false;
            $keyword        = '';
        }

        $bread          = 'Home | Transaksi | BPHTB';
        $tittle         = 'Daftar Transaksi BPHTB Belum Disetujui';
        $menu_persetujuan_bphtb_group   = true;
        $menu_bphtb_belum   = true;

        return view('transaksi.pejabat.pjb_trans_peralihan_l', compact(
            // 'aktif',
            'data',
            'clearButton',
            'keyword',

            'bread',
            'tittle',
            'menu_persetujuan_bphtb_group',
            'menu_bphtb_belum',
        ));
    }

    public function sudah_approve(Request $request)
    {

        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = BphtbModel::where('status_pembayaran', STATUS_PEMBAYARAN_LUNAS)
                ->where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
                ->where(function ($query) use ($keyword) {
                    $query->where('tgl_bphtb', 'like', "%{$keyword}%")
                        ->orWhere('nik', 'like', "%{$keyword}%")
                        ->orWhere('nama_wp', 'like', "%{$keyword}%")
                        ->orWhere('nop', 'like', "%{$keyword}%")
                        ->orWhere('letak_nop', 'like', "%{$keyword}%")
                        ->orWhereHas('joinKecNop', function ($query) use ($keyword) {
                            return $query->where('nama_kec', 'like', "%{$keyword}%");
                        })
                        ->orWhereHas('joinDesaNop', function ($query) use ($keyword) {
                            return $query->where('nama_desa', 'like', "%{$keyword}%");
                        });
                })
                ->orderByDesc('id')
                ->paginate(20);

            $clearButton    = true;
        } else {
            $data = BphtbModel::where('status_pembayaran', STATUS_PEMBAYARAN_LUNAS)
                ->where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
                ->orderByDesc('id')
                ->paginate(20);
            $clearButton    = false;
            $keyword        = '';
        }

        $bread          = 'Home | Transaksi | BPHTB';
        $tittle         = 'Daftar Transaksi BPHTB Telah Disetujui';
        $menu_persetujuan_bphtb_group   = true;
        $menu_bphtb_sudah   = true;

        return view('transaksi.pejabat.pjb_trans_peralihan_l', compact(
            // 'aktif',
            'data',
            'clearButton',
            'keyword',
            'bread',
            'tittle',
            'menu_persetujuan_bphtb_group',
            'menu_bphtb_sudah',
        ));
    }
    public function semua(Request $request)
    {

        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = BphtbModel::where(function ($query) use ($keyword) {
                $query->where('tgl_bphtb', 'like', "%{$keyword}%")
                    ->orWhere('nik', 'like', "%{$keyword}%")
                    ->orWhere('nama_wp', 'like', "%{$keyword}%")
                    ->orWhere('nop', 'like', "%{$keyword}%")
                    ->orWhere('letak_nop', 'like', "%{$keyword}%")
                    ->orWhereHas('joinKecNop', function ($query) use ($keyword) {
                        return $query->where('nama_kec', 'like', "%{$keyword}%");
                    })
                    ->orWhereHas('joinDesaNop', function ($query) use ($keyword) {
                        return $query->where('nama_desa', 'like', "%{$keyword}%");
                    });
            })
                ->orderByDesc('id')
                ->paginate(20);

            $clearButton    = true;
        } else {
            $data = BphtbModel::orderByDesc('id')
                ->paginate(20);
            $clearButton    = false;
            $keyword        = '';
        }

        $bread          = 'Home | Transaksi | BPHTB';
        $tittle         = 'Daftar Transaksi BPHTB';
        $menu_persetujuan_bphtb_group   = true;
        $menu_bphtb_semua   = true;

        return view('transaksi.pejabat.pjb_trans_peralihan_l', compact(
            // 'aktif',
            'data',
            'clearButton',
            'keyword',

            'bread',
            'tittle',
            'menu_persetujuan_bphtb_group',
            'menu_bphtb_semua',
        ));
    }

    public function approve($id)
    {
        try {
            $data = BphtbModel::find($id);
            if (empty($data)) {
                return back()->with('error', 'Tidak dapat melakukan Approve pada data!');
            }
            $data->tgl_persetujuan   = now();
            $data->status_bphtb     = STATUS_BPHTB_SUDAH_DISETUJUI;
            $data->user_persetujuan = Auth()->user()->nama . ' (' . Auth()->user()->email . ')';
            $data->updated_by       = Auth()->user()->nama . ' (' . Auth()->user()->email . ')';
            $data->updated_at       = now();

            $data->save();
            // Logs 
            $keg = '#Menyetujui BPHTB NOP : ' . $data->nop
                . ' #kepada WP NIK : ' . $data->nik . ' #Jumlah : ' . $data->jumlah_setor;
            $this->simpanLogs(LOGS_PERALIHAN, $id, $keg);
            // .Logs
            return back()->with('success', 'BPHTB telah disetujui!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function show($id)
    {
        $data = BphtbModel::find($id);
        $bread          = 'Home | Transaksi | BPHTB | Detail';
        $tittle         = 'Detail Transaksi BPHTB Belum Disetujui';
        $menu_persetujuan_bphtb_group   = true;
        $menu_bphtb_sudah   = true;

        return view('transaksi.pejabat.pjb_trans_peralihan_v', compact(
            'data',
            'bread',
            'tittle',
            'menu_persetujuan_bphtb_group',
            'menu_bphtb_sudah',
        ));
    }

    //--
}
