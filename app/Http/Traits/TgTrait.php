<?php

namespace App\Http\Traits;

use App\Models\UserModel;
use App\Models\TandaTerimaModel;
use App\Models\SpmModel;
// use App\Models\PengantarModel;

trait TgTrait
{
    public function kirim_notif_spm_masuk($id)
    {
        // $id adalah id tanda terima
        // Yang dikirim adalah jumlah SPM dan Total SPM
        // Dikirim hanya kepada user_group SKPD, Pimpinan BPKK, dan Super Admin
        // Yang hanya mengaktifkan Notif Telegram saja

        $TT         = TandaTerimaModel::find($id);

        $jumlah     = SpmModel::where('id_tt', $id)->count();
        $total      = SpmModel::where('id_tt', $id)->sum('jl_spm');
        $total      = number_format($total, 0, ".", ".") . ",-";
        // $link       = route('home');

        $user_group = UserModel::select('nama', 'tg')
            ->where('id_status', 1)
            ->where('id_skpd', $TT->id_skpd) // Diterima oleh user SKPD terkait
            ->orwhere('user_group', USER_PIMPINAN) // Diterima sama Pimpinan Kaban
            ->orwhere('user_group', USER_SUPER_ADMIN) // Diterima Super Admin
            ->orwhere('user_group', USER_PENGUJI) // Diterima Penguji SPM
            ->where('notif_tg', NOTIFIKASI_USER_DITERIMA) // Yang aktifkan Notifikasi saja
            ->get();

        $isi    =
            "Telah diterima SPM dari : \n<b>" .
            $TT->skpd->nama_skpd_singkat . "</b>\n" .
            "sebanyak <b>" . $jumlah . "</b> buah SPM \n" .
            "dengan total nilai SPM sebesar :\n" .
            "<b>Rp. " . $total . "</b>\n" .
            "yang diserahkan oleh : \n<b>" .
            $TT->nama_penyerah . "</b> \n" .
            "dan diterima oleh : \n<b>" .
            $TT->nama_penerima . "</b> \n\n\n" .
            "Silahkan kunjungi Portal " .
            '<a href="https://oms.acehsingkilkab.go.id/">OM-SP2D</a> untuk melihat.';

        foreach ($user_group as $key => $value) {
            if ($value->tg >= 99999) {
                \Telegram::sendMessage([
                    'chat_id'       => $value->tg,
                    'parse_mode'    => 'HTML',
                    'text'          => "Yth <b>" . $value->nama . "</b>\n" . $isi,
                ]);
            }
        }
    }

    public function kirim_notif_sp2d_bank($id)
    {
        // Ambil data SPM
        $SPM = SpmModel::where('id_pengantar', $id)->get();
        foreach ($SPM as $s) {

            $jumlah_sp2d = number_format($s->jl_sp2d, 0, ".", ".") . ",-";
            $isi    =
                "SPM Nomor : <b>" . $s->no_spm . "</b>\n" .
                "Penerima dana : <b>" . $s->penerima_dana . "</b>\n" .
                "Telah diterbitkan SP2D dengan Nomor <b>" . $s->no_sp2d . "</b>\n" .
                "Sejumlah <b>Rp. " . $jumlah_sp2d . "</b>\n" .
                "Status SP2D : <b>TELAH DIKIRIM KE BANK</b>\n\n\n" .
                "Silahkan kunjungi Portal " .
                '<a href="https://oms.acehsingkilkab.go.id/">OM-SP2D</a> untuk melihat.';

            // Ambil user SKPD terkait
            $user_group = UserModel::select('nama', 'tg')
                ->where('id_skpd', $s->id_skpd)
                ->where('id_status', 1)
                ->orwhere('user_group', USER_SUPER_ADMIN)
                ->where('notif_tg', NOTIFIKASI_USER_DITERIMA)
                ->get();

            // Pakai Try
            try {
                foreach ($user_group as $key => $value) {
                    if ($value->tg >= 99999) {
                        \Telegram::sendMessage([
                            'chat_id'       => $value->tg,
                            'parse_mode'    => 'HTML',
                            'text'          => "Yth <b>" . $value->nama . "</b>\n" . $isi,
                        ]);
                    }
                }
            } catch (\Throwable $th) {
                // dd("error", $th);
            }
        }
    }

    public function kirim_notif_kbud()
    {
        $jumlah_spm = SpmModel::where('id_status_spm', STATUS_SPM_KBUD_3)->count();
        if ($jumlah_spm >= 1) {
            // Kirim Notif telegram ke User Ybs
            $isi    =
                "Notifikasi! \n" .
                "Terdapat SPM sebanyak : <b>" . $jumlah_spm . " SPM</b>\n" .
                "Yang belum dilakukan Konfirmasi Penerbitan SP2D pada Aplikasi <b> OM-SP2D</b>\n\n" .
                "Silahkan kunjungi Portal " .
                '<a href="https://oms.acehsingkilkab.go.id/">OM-SP2D</a> untuk melihat.';

            // Ambil user SKPD terkait
            $user_group = UserModel::select('nama', 'tg')
                ->where('user_group', USER_KBUD)
                ->where('id_status', 1)
                ->orwhere('user_group', USER_SUPER_ADMIN)
                ->where('notif_tg', NOTIFIKASI_USER_DITERIMA)
                ->get();

            foreach ($user_group as $key => $value) {
                if ($value->tg >= 99999) {
                    \Telegram::sendMessage([
                        'chat_id'       => $value->tg,
                        'parse_mode'    => 'HTML',
                        'text'          => "Yth <b>" . $value->nama . "</b>\n" . $isi,
                    ]);
                }
            }
        }
    }

    public function kirim_notif_operator_sp2d()
    {
        $jumlah_spm = SpmModel::where('id_status_spm', STATUS_SPM_BUD_4)->count();
        if ($jumlah_spm >= 1) {
            // Kirim Notif telegram ke User Ybs
            $isi    =
                "Notifikasi! \n" .
                "Terdapat SP2D sebanyak : <b>" . $jumlah_spm . " SP2D</b>\n" .
                "Yang belum di upload kedalam Aplikasi <b> OM-SP2D</b>\n\n" .
                "Silahkan kunjungi Portal " .
                '<a href="https://oms.acehsingkilkab.go.id/">OM-SP2D</a> untuk melihat.';

            // Ambil user SKPD terkait
            $user_group = UserModel::select('nama', 'tg')
                ->where('id_status', 1)
                ->where('notif_tg', NOTIFIKASI_USER_DITERIMA)
                ->where('user_group', USER_BANK)
                ->orwhere('user_group', USER_SUPER_ADMIN)
                ->get();

            foreach ($user_group as $key => $value) {
                if ($value->tg >= 99999) {
                    \Telegram::sendMessage([
                        'chat_id'       => $value->tg,
                        'parse_mode'    => 'HTML',
                        'text'          => "Yth <b>" . $value->nama . "</b>\n" . $isi,
                    ]);
                }
            }
        }
    }

    //
}
