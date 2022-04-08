<?php

namespace App\Http\Controllers\Bphtb;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use App\Http\Traits\LogsTrait;
use App\Models\BphtbModel;
use App\Models\UserModel;
use Illuminate\Contracts\Session\Session;
use Telegram;

class BatalBphtbCont extends Controller
{
    use LogsTrait;

    public function index(Request $request)
    {

        if ($request->has('nop')) {
            // dd($request);
            // $keyword = $request->cari;
            $nop    = $request->nop;
            $no_b   = $request->no_b;
            $data   = BphtbModel::where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
                ->where('status_pembayaran', STATUS_PEMBAYARAN_LUNAS)
                ->where('nop', $nop)
                ->where('no_b', $no_b)
                ->first();
            $placeholderNop = $request->nop;
            $placeholderNoB = $request->no_b;

            if ($data == "" || $data == NULL) {
                return back()->with('error', "Data BPHTB dengan NOP : $nop dan NTPD : $no_b tidak ditemukan!");
                // $data           = "KOSONG";
                // $placeholderNop = "Nomor Objek Pajak";
                // $placeholderNoB = "Nomor NTPD";
            }
        } else {
            $data           = "KOSONG";
            $placeholderNop = "Nomor Objek Pajak";
            $placeholderNoB = "Nomor NTPD";
        }

        $bread      = 'Home | Transaksi | BPHTB | Batal';
        $tittle     = 'Pembatalan Transaksi BPHTB';

        return view('bphtb.pembatalan.pembatalan_bphtb_v', compact(
            'data',
            'placeholderNop',
            'placeholderNoB',
            'bread',
            'tittle',
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
        ]);
        $id_bphtb   = $request->id_bphtb;
        try {
            $data   = BphtbModel::find($id_bphtb);
            $data->no_b = "";
            $data->status_bphtb = STATUS_BPHTB_BELUM_DISETUJUI;
            $data->updated_by = session()->get('datauser')->nama;
            $data->updated_at = NOW();
            $data->save();

            // Logs
            $keg = 'Membatalkan BPHTB untuk #NOP : ' . $data->nop . ' #Atas Nama : ' . $data->nama_wp .
                ' #NIK : ' . $data->nik . ' #Sejumlah Rp. ' . $data->format_jumlah;
            $this->simpanLogs(LOGS_PERALIHAN, $id, $keg);
            // .Logs

            //Telegram
            $AdminAktif = Auth::user()->nama;
            $user = UserModel::where('user_group', USER_SUPER_ADMIN)
                ->orwhere('user_group', USER_ADMIN)
                ->get();
            if ($user != '' || $user != NULL) {
                $text = "<b>$AdminAktif</b> " .
                    "Telah melakukan pembatalan Transaksi BPHTB BPKK Singkil sebagai berikut : \n"
                    . "Nama : <b>$data->nama_wp</b>\n"
                    . "NIK : <b>$data->nik</b>\n"
                    . "NOP : <b>$data->nop</b>\n"
                    . "Jumlah BPHTB : <b>Rp. $data->format_jumlah</b>\n"
                    . "Status : <b>Telah Dibatalkan!</b>";

                foreach ($user as $key => $value) {
                    if ($value->tg > 999999 || $value->tg > "999999") {
                        Telegram::sendMessage([
                            'chat_id'       => $value->tg,
                            'parse_mode'    => 'HTML',
                            'text'          => $text
                        ]);
                    }
                }
            }
            // .Sukses dibatalkan
            return redirect()->route('bphtb.pembatalan.index')->with('success', "Transaksi BPHTB telah dibatalkan!");
        } catch (\Throwable $th) {
            dd("error", $th);
            $pesan = "Tidak dapat membatalkan BPHTB ! BPHTB tidak Valid dengan Database!";
            return back()->with('error', $pesan);
        }
    }



    //--
}
