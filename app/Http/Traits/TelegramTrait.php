<?php

namespace App\Http\Traits;

use App\Models\UserModel;
use Telegram;

trait TelegramTrait
{


    public function kirim_notif_telegram($kepada, $isi, $id_user = false)
    {
        // Tentukan jenis Notifikasi
        if ($kepada == NOTIF_KEPADA_INTERNAL) {
            //
            // Kirim ke Super Admin, Admin, Kabid, dan Operator
            // Ambil data alamat email, id_chat telegram, dan nama Penerima
            $user = UserModel::select('nama', 'tg')
                ->where('status_user', 1)
                ->where('user_group', USER_SUPER_ADMIN)
                ->orWhere('user_group', USER_ADMIN)
                ->orWhere('user_group', USER_OPERATOR)
                ->orWhere('user_group', USER_KABID)
                ->get();
        } elseif ($kepada == NOTIF_KEPADA_OPERATOR) {
            $user = UserModel::select('nama', 'tg')
                ->where('status_user', 1)
                ->where('user_group', USER_SUPER_ADMIN)
                ->orWhere('user_group', USER_ADMIN)
                ->orWhere('user_group', USER_OPERATOR)
                ->get();
        } elseif ($kepada == NOTIF_KEPADA_PPAT) {
            # code...
            $user = UserModel::select('nama', 'tg')
                ->where('status_user', 1)
                ->where('user_group', USER_SUPER_ADMIN)
                ->orWhere('user_group', USER_ADMIN)
                ->orWhere('user_group', USER_OPERATOR)
                ->orWhere('user_group', USER_KABID)
                ->get();
        } elseif ($kepada == NOTIF_KEPADA_WP) {
            # code...
            $user = UserModel::select('nama', 'tg')
                // ->where('status_user', 1)
                ->where('user_group', USER_SUPER_ADMIN)
                ->orWhere('id', $id_user)
                ->get();
        } else {
            # code...
            $user = UserModel::select('nama', 'tg')
                ->where('status_user', 1)
                ->where('user_group', USER_SUPER_ADMIN)
                ->get();
        }

        if (!empty($user)) {
            // Kirim telegram
            foreach ($user as $key => $value) {
                if ($value->tg > 999999) {

                    // Tentukan Nama Penerima
                    $namaPenerima = $value->nama;

                    // Isi Telegram
                    $text = "Notifikasi BPHTB Online! \n"
                        .  "Yth. <b>" . $namaPenerima . "</b> \n"
                        . $isi . "\n \n"
                        . "<i>Ini merupakan Notifikasi otomatis yang dikirimkan dari portal </i>"
                        . '<a href="https://bphtb.acehsingkilkab.go.id/">BPHTB Online</a>';

                    \Telegram::sendMessage([
                        'chat_id'       => $value->tg,
                        'parse_mode'    => 'HTML',
                        'text'          => $text
                    ]);
                }
            }
        }
    }






    public function kirim_notif_layanan(Request $request)
    {
        $request->validate([
            // 'email'     => 'required|email',
            'message'   => 'required',
            'file'      => 'file|mimes:jpeg,png,gif'
        ]);
        $email_user = Auth::user()->email;
        $nama_user  = Auth::user()->nama;
        $wa_user    = Auth::user()->wa;

        $text = "Pelaporan terkait permasalahan / error aplikasi Online Monitoring SP2D : \n\n"
            . "<b>Pelapor: </b> \n"
            . "$nama_user ($wa_user) \n"
            . "$email_user \n"
            . "<b>Pesan: </b>\n"
            . $request->message;

        $user = UserModel::where('user_group', USER_SUPER_ADMIN)
            ->orwhere('user_group', USER_ADMIN)
            ->get();
        if ($user != '') {
            foreach ($user as $key => $value) {
                if ($value->tg) {
                    if ($request->hasFile('file')) {
                        $photo = $request->file('file');
                        Telegram::sendMessage([
                            'chat_id' => $value->tg,
                            'parse_mode' => 'HTML',
                            'text' => $text
                        ]);
                        Telegram::sendPhoto([
                            'chat_id' => $value->tg,
                            'photo' => InputFile::createFromContents(file_get_contents($photo->getRealPath()), Str::random(10) . '.' . $photo->getClientOriginalExtension())
                        ]);
                    } else {
                        Telegram::sendMessage([
                            'chat_id'       => $value->tg,
                            'parse_mode'    => 'HTML',
                            'text'          => $text
                        ]);
                    }
                    return redirect()->back()->with('success', 'Pesan berhasil dikirimkan.');
                }
            }
        } else {
            return redirect()->back()->with('error', 'Pesan gagal dikirim');
        }
    }




    public function kirim_notif_group($user_group, $isi)
    {
        foreach ($user_group as $user) {
            if ($user->tg != "") {
                // Tambah nama user kedalam isi pesan
                $isi_pesan  = "Yth *" . $user->nama . "* \n" . $isi;
                $id_chat    = $user->tg;
                $token      = "1874441295:AAEjeLcQS5b3gQBBggBOqe6sxdGv-czIik0"; //"1566721346:AAGjdajIw2TdDo0hVhJ3nldMfN9QY8AR4Wo";
                $url        = "https://api.telegram.org/bot" . $token . "/sendMessage?parse_mode=markdown&chat_id=" . $id_chat;
                $url        = $url . "&text=" . urlencode($isi_pesan);
                $ch         = curl_init();
                $optArray   = array(
                    CURLOPT_URL             => $url,
                    CURLOPT_RETURNTRANSFER  => true
                );

                curl_setopt_array($ch, $optArray);
                $result = curl_exec($ch);
                curl_close($ch);
            }
        }
    }

    public function kirim_notif_password($user, $isi)
    {
        if ($user->tg) {
            $id_chat    = $user->tg;
            $token      = "1874441295:AAEjeLcQS5b3gQBBggBOqe6sxdGv-czIik0"; // "1566721346:AAGjdajIw2TdDo0hVhJ3nldMfN9QY8AR4Wo";
            $url        = "https://api.telegram.org/bot" . $token . "/sendMessage?parse_mode=markdown&chat_id=" . $id_chat;
            $url        = $url . "&text=" . urlencode($isi);
            $ch         = curl_init();
            $optArray   = array(
                CURLOPT_URL             => $url,
                CURLOPT_RETURNTRANSFER  => true
            );

            curl_setopt_array($ch, $optArray);
            $result = curl_exec($ch);
            curl_close($ch);
        }
    }


    //
}
