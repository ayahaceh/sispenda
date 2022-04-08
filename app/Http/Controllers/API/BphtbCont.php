<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BphtbModel;
use DateTime;
use Illuminate\Http\Request;

class BphtbCont extends Controller
{
    public function getBPHTBService(Request $request)
    {
        if ($request->has('NOP') && $request->has('NTPD')) {
            $nop = $request->NOP;
            $ntpd = $request->NTPD;

            $nop_exist = BphtbModel::whereNop($nop)
                ->whereStatusPembayaran(STATUS_PEMBAYARAN_LUNAS)
                ->whereStatusBphtb(STATUS_BPHTB_SUDAH_DISETUJUI)
                ->count();

            $ntpd_exist = BphtbModel::whereNoB($ntpd)
                ->whereStatusPembayaran(STATUS_PEMBAYARAN_LUNAS)
                ->whereStatusBphtb(STATUS_BPHTB_SUDAH_DISETUJUI)
                ->count();

            if ($nop_exist == 0 && $ntpd_exist == 0) {
                return response()->json([
                    'respon_code' => 'Data tidak ditemukan'
                ], 404);
            }

            if ($nop_exist == 0) {
                return response()->json([
                    'respon_code' => 'NOP tidak ditemukan'
                ], 404);
            }

            if ($ntpd_exist == 0) {
                return response()->json([
                    'respon_code' => 'NTPD tidak ditemukan'
                ], 404);
            }

            $data = BphtbModel::whereNop($nop)
                ->whereNoB($ntpd)
                ->whereStatusPembayaran(STATUS_PEMBAYARAN_LUNAS)
                ->whereStatusBphtb(STATUS_BPHTB_SUDAH_DISETUJUI)
                ->first();

            if ($data->count() > 0) {
                $tgl_setor = new DateTime($data->tgl_setor);

                return response()->json([
                    'result' => [
                        'NOP' => $data->nop,
                        'NIK' => $data->nik,
                        'NAMA' => strtoupper($data->nama_wp),
                        'ALAMAT' => strtoupper('Kec. ' . $data->joinKecWp->nama_kec . ' Desa ' . $data->joinDesaWp->nama_desa . ' ' . $data->rtrw_wp . ' ' . $data->kode_pos_wp),
                        'KELURAHAN_OP' => strtoupper($data->joinDesaNop->nama_desa),
                        'KECAMATAN_OP' => strtoupper($data->joinkecNop->nama_kec),
                        'KOTA_OP' => strtoupper($data->joinKabNop->nama_kab),
                        'LUASTANAH' => $data->luas_tanah,
                        'LUASBANGUNAN' => $data->luas_bangunan,
                        'PEMBAYARAN' => strval($data->jumlah_setor),
                        'STATUS' => 'Y',
                        'TANGGAL_PEMBAYARAN' => $tgl_setor->format('d/m/Y'),
                        'NTPD' => $data->no_b,
                        'JENISBAYAR' => 'L'
                    ],
                    'respon_code' => 'OK',
                ], 200);
            }

            return response()->json([
                'respon_code' => 'Data tidak ditemukan'
            ], 404);
        } else {
            return response()->json([
                'respon_code' => 'Parameter tidak lengkap'
            ], 422);
        }
    }
}
