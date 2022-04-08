<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\SatkersModel;
use App\Models\UserModel;
use App\Models\Web\WebAssetsModel;
use App\Models\Web\WebProfilPejabatModel;
use App\Models\Web\WebKanalPembayaranModel;
use App\Models\Web\WebRegulasiModel;
use App\Http\Requests\ContactAdminVal;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\FileUpload\InputFile;

class WebCont extends Controller
{

    public function index()
    {
        // Ambil info user yang login
        $datasatker = SatkersModel::first();
        // Set session data satker
        session(['datasatker' => $datasatker]);
        // Ambil data untuk tampilan web
        $dataAssets     = WebAssetsModel::first();
        $dataProfil     = WebProfilPejabatModel::all();
        $dataKanal      = WebKanalPembayaranModel::all();
        $dataRegulasi   = WebRegulasiModel::all();
        // Menu
        $bread      = 'Home';
        $tittle     = 'Dashboard';
        $menu_home  = true;
        $view       = 'web.index';
        $menu_web_publik = true;
        // dd($dataAssets);
        return view($view, compact(
            'dataAssets',
            'dataProfil',
            'dataKanal',
            'dataRegulasi',
            'menu_web_publik',

            'bread',
            'tittle',
            'menu_home'
        ));
    }


    public function kirim_pesan()
    {
        $bread      = 'Layanan BPHTB Online';
        $tittle     = 'Layanan BPHTB Online';
        return view(
            'web.contact_admin_public_a',
            [
                'bread' => $bread,
                'tittle' => $tittle
            ]
        );
    }

    public function kirim_pesan_action(ContactAdminVal $request)
    {

        $email_user = $request->email;
        $nama_user  = $request->nama;
        $hp_user    = $request->hp;

        $text = "Telah diterima pesan dari pengunjung Website BPHTB Online : \n\n"
            . "<b>Pelapor: </b> \n"
            . "$nama_user ($hp_user) \n"
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
                    return redirect()->route('web.public')->with('success', 'Pesan berhasil dikirimkan.');
                }
            }
        } else {
            return redirect()->route('web.public')->with('success', 'Pesan berhasil dikirimkan.');
        }
    }


    // ---
}
