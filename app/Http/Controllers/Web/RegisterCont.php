<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterVal;
use App\Models\SatkersModel;
use App\Models\Alamat\ProvModel;
use App\Models\ProfilModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Http\Traits\TelegramTrait;
use App\Models\Temp\ProfilTempModel;

// use App\Models\Logs\LogsModel;

class RegisterCont extends Controller
{
    use TelegramTrait; // Untuk mengirim notifikasi

    public function index()
    {
        // Ambil info user yang login
        $datasatker = SatkersModel::first();
        // Set session data satker
        session(['datasatker' => $datasatker]);
        // Menu
        $bread      = 'Home';
        $tittle     = 'Dashboard';
        $menu_home  = true;
        $view       = 'web.register_index';

        return view($view, compact(
            'bread',
            'tittle',
            'menu_home'
        ));
    }

    public function create()
    {

        // Menu
        $dataProv = ProvModel::all();
        $bread      = 'Home';
        $tittle     = 'Dashboard';
        $menu_home  = true;
        $view       = 'web.register_a';

        return view($view, compact(
            'dataProv',
            'bread',
            'tittle',
            'menu_home'
        ));
    }

    public function validator(Request $request, $step)
    {
        if ($request->ajax()) {

            if ($step == 1) {

                $validator = Validator::make($request->all(), [
                    'email' => 'required|email:rfc,dns|unique:users|max:50',
                    'username' => 'required|unique:users|max:50',
                    'password' => 'required|min:8|confirmed'
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                return response()->json(['message' => 'success'], 200);
            } else if ($step == 2) {

                $validator = Validator::make($request->all(), [
                    'nama' => 'required|max:255',
                    'nik' => 'required|unique:users|numeric|digits_between:1,16',
                    'kk' => 'required|numeric|digits_between:1,16'
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                // $profil = ProfilModel::whereNik($request->nik)->whereKk($request->kk);
                $profil = ProfilModel::whereNik($request->nik);

                if ($profil->count() == 1) {
                    $profil = $profil->first();
                    return response()->json([
                        'message' => 'success',
                        'profil' => 1,
                        'withStep3' => [
                            'hp' => $profil->hp,
                            'wa' => $profil->wa,
                            'tg' => $profil->tg
                        ],
                        'withStep4' => [
                            'kode_prov' => $profil->kode_prov,
                            'kode_kab' => $profil->kode_kab,
                            'kode_kec' => $profil->kode_kec,
                            'kode_desa' => $profil->kode_desa,
                            'rtrw' => $profil->rtrw,
                            'alamat' => $profil->alamat,
                            'kode_pos' => $profil->kode_pos
                        ],
                        'withStep5' => [
                            'berkas_foto' => $profil->file_foto,
                            'berkas_ktp' => $profil->file_ktp,
                            'berkas_kk' => $profil->file_kk
                        ]
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'success',
                        'profil' => 0
                    ], 200);
                }
            } else if ($step == 3) {

                $validator = Validator::make($request->all(), [
                    'hp' => 'required|numeric|digits_between:1,16',
                    'wa' => 'numeric|digits_between:1,16',
                    'tg' => 'numeric|digits_between:1,16'
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                return response()->json(['message' => 'success'], 200);
            } else if ($step == 4) {

                $validator = Validator::make($request->all(), [
                    'kode_prov' => 'required',
                    'kode_kab' => 'required',
                    'kode_kec' => 'required',
                    'kode_desa' => 'required',
                    // 'rtrw' => 'required',
                    'alamat' => 'required',
                    // 'kode_pos' => 'required'
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                return response()->json(['message' => 'success'], 200);
            } else if ($step == 4) {

                $validator = Validator::make($request->all(), [
                    'kode_prov' => 'required',
                    'kode_kab' => 'required',
                    'kode_kec' => 'required',
                    'kode_desa' => 'required',
                    'rtrw' => 'required',
                    'alamat' => 'required',
                    'kode_pos' => 'required'
                ]);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
                }

                return response()->json(['message' => 'success'], 200);
            }
        }
    }

    public function store(Request $request)
    {
        // $profil = ProfilModel::whereNik($request->nik)->whereKk($request->kk);
        $profil = ProfilModel::whereNik($request->nik);

        $rules = [
            'email' => 'required|email:rfc,dns|unique:users|max:50',
            'username' => 'required|unique:users|max:50',
            'password' => 'required|min:8|confirmed',
            'nama' => 'required|max:255',
            'nik' => 'required|unique:users|numeric|digits_between:1,16',
            'kk' => 'required|numeric|digits_between:1,16',
            'hp' => 'required|numeric|digits_between:1,16',
            'wa' => 'numeric|digits_between:1,16',
            'tg' => 'numeric|digits_between:1,16',
            'kode_prov' => 'required',
            'kode_kab' => 'required',
            'kode_kec' => 'required',
            'kode_desa' => 'required',
            // 'rtrw' => 'required',
            'alamat' => 'required',
            // 'kode_pos' => 'required',
            'captcha' => 'required|captcha',
        ];

        if ($profil->count() == 0) {
            $rules['berkas_foto'] = 'required|file|mimes:png,jpg,jpeg|max:1024';
            $rules['berkas_ktp'] = 'required|file|mimes:png,jpg,jpeg|max:1024';
            $rules['berkas_kk'] = 'required|file|mimes:pdf|max:1024';
        } else if ($profil->count() == 1) {
            $rules['berkas_foto'] = 'file|mimes:png,jpg,jpeg|max:1024';
            $rules['berkas_ktp'] = 'file|mimes:png,jpg,jpeg|max:1024';
            $rules['berkas_kk'] = 'file|mimes:pdf|max:1024';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tgl = date('ymd_His');

        // SIMPAN KE TABEL USER UNTUK DATA LOGIN :
        try {
            if ($request->hasFile('berkas_foto')) {
                $berkas_foto    = $request->file('berkas_foto'); // Pindahin ke temporary folder
                $ekstensi       = $request->file('berkas_foto')->getClientOriginalExtension();
                $nama_berkas_foto    = str_replace(" ", "_", $request->nama);
                $nama_berkas_foto    = $tgl . '_' . substr($nama_berkas_foto, 0, 10) . '.' . $ekstensi;

                // Compress dan pindah ke sub folder comp
                $img            = Image::make($berkas_foto->getRealPath());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('upload/users/comp/' . $nama_berkas_foto);

                // File Asli Pindahin kedalam folder upload
                $berkas_foto->move('upload/users/', $nama_berkas_foto);
            } else {
                $nama_berkas_foto    = 'default.JPG';
            }

            $USER           = new UserModel;
            $USER->email    = $request->email;
            // $USER->username = $request->username;
            $USER->username = strtolower(explode("@", $request->email)[0]);
            $USER->password = bcrypt($request->password);
            $USER->nik      = $request->nik;
            $USER->kk       = $request->kk;
            $USER->nama     = $request->nama;
            $USER->foto     = $nama_berkas_foto;
            $USER->user_group    = USER_WAJIB_PAJAK;
            $USER->hp       = $request->hp;
            $USER->wa       = $request->wa;
            $USER->tg       = $request->tg;
            $USER->status_user  = STATUS_USER_BARU_DAFTAR;
            $USER->terakhir     = now();
            $USER->token        = Str::random(10);
            $USER->deskripsi    = 'Mendaftar sendiri lewat online.';

            $USER->save();
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }

        try {
            // jika ditabel profil belum ada? INSERT
            // if ($profil->count() == 0) {
            $DATA               = new ProfilTempModel;
            // $DATA->user_id      = $USER->id;
            $DATA->nik          = $request->nik;
            $DATA->kk           = $request->kk;
            $DATA->nama         = $request->nama;
            $DATA->jk           = $request->jk;
            $DATA->alamat       = $request->alamat;
            $DATA->kode_prov    = $request->kode_prov;
            $DATA->kode_kab     = $request->kode_kab;
            $DATA->kode_kec     = $request->kode_kec;
            $DATA->kode_desa    = $request->kode_desa;
            $DATA->rtrw         = $request->rtrw;
            $DATA->kode_pos     = $request->kode_pos;
            $DATA->hp           = $request->hp;
            $DATA->wa           = $request->wa !== '0' ? $request->wa : NULL;
            $DATA->tg           = $request->tg !== '0' ? $request->tg : NULL;
            $DATA->email        = $request->email;

            // $DATA->jenis_profil_id  = 7;
            $DATA->status_profil    = STATUS_PROFIL_BELUM_VERIFIKASI; // Register publik harus verifikasi Admin dulu utk Valid
            $DATA->created_at       = now();
            $DATA->berkas_foto      = $nama_berkas_foto;

            // // Berkas KTP
            if ($request->hasFile('berkas_ktp')) {
                $berkas_ktp    = $request->file('berkas_ktp'); // Pindahin ke temporary folder
                $ekstensi       = $request->file('berkas_ktp')->getClientOriginalExtension();
                $nama_berkas_ktp    = str_replace(" ", "_", $request->nama);
                $nama_berkas_ktp    = $tgl . '_' . substr($nama_berkas_ktp, 0, 10) . '.' . $ekstensi;
                // File Asli Pindahin kedalam folder upload
                $berkas_ktp->move('upload/berkas_ktp/', $nama_berkas_ktp);
                $DATA->berkas_ktp   = $nama_berkas_ktp;
            } else {
                $nama_berkas_ktp    = 'default.pdf';
                $DATA->berkas_ktp   = $nama_berkas_ktp;
            }
            // // Berkas KK
            if ($request->hasFile('berkas_kk')) {
                $berkas_kk      = $request->file('berkas_kk'); // Pindahin ke temporary folder
                $ekstensi       = $request->file('berkas_kk')->getClientOriginalExtension();
                $nama_berkas_kk    = str_replace(" ", "_", $request->nama);
                $nama_berkas_kk    = $tgl . '_' . substr($nama_berkas_kk, 0, 10) . '.' . $ekstensi;
                // File Asli Pindahin kedalam folder upload
                $berkas_kk->move('upload/berkas_kk/', $nama_berkas_kk);
                $DATA->berkas_kk    = $nama_berkas_kk;
            } else {
                $nama_berkas_kk     = 'default.pdf';
                $DATA->berkas_kk    = $nama_berkas_kk;
            }

            $DATA->save();
            // } else if ($profil->count() == 1) { // jika sudah ada? UPDATE
            //     $updates = [
            //         'user_id' => $USER->id,
            //         'email' => $request->email,
            //         'nama' => $request->nama,
            //         'nik' => $request->nik,
            //         'kk' => $request->kk,
            //         'jk' => $request->jk,
            //         'alamat' => $request->alamat,
            //         'hp' => $request->hp,
            //         'wa' => $request->wa ? $request->wa : NULL,
            //         'tg' => $request->tg ? $request->tg : NULL,
            //         'kode_prov' => $request->kode_prov,
            //         'kode_kab' => $request->kode_kab,
            //         'kode_kec' => $request->kode_kec,
            //         'kode_desa' => $request->kode_desa,
            //         'rtrw' => $request->rtrw,
            //         'kode_pos' => $request->kode_pos,
            //         'status_profil' => STATUS_PROFIL_BELUM_VERIFIKASI,
            //     ];

            //     if ($request->hasFile('berkas_foto')) {
            //         $updates['berkas_foto'] = $nama_berkas_foto;
            //     }

            //     // Berkas KTP
            //     if ($request->hasFile('berkas_ktp')) {
            //         $berkas_ktp    = $request->file('berkas_ktp'); // Pindahin ke temporary folder
            //         $ekstensi       = $request->file('berkas_ktp')->getClientOriginalExtension();
            //         $nama_berkas_ktp    = str_replace(" ", "_", $request->nama);
            //         $nama_berkas_ktp    = $tgl . '_' . substr($nama_berkas_ktp, 0, 10) . '.' . $ekstensi;
            //         // File Asli Pindahin kedalam folder upload
            //         $berkas_ktp->move('upload/berkas_ktp/', $nama_berkas_ktp);
            //         $updates['berkas_ktp'] = $nama_berkas_ktp;
            //     }

            //     // Berkas KK
            //     if ($request->hasFile('berkas_kk')) {
            //         $berkas_kk      = $request->file('berkas_kk'); // Pindahin ke temporary folder
            //         $ekstensi       = $request->file('berkas_kk')->getClientOriginalExtension();
            //         $nama_berkas_kk    = str_replace(" ", "_", $request->nama);
            //         $nama_berkas_kk    = $tgl . '_' . substr($nama_berkas_kk, 0, 10) . '.' . $ekstensi;
            //         // File Asli Pindahin kedalam folder upload
            //         $berkas_kk->move('upload/berkas_kk/', $nama_berkas_kk);
            //         $updates['berkas_kk'] = $nama_berkas_kk;
            //     }

            //     $profil->update($updates);
            // }

            // Kirim Notifikasi Telegram
            $kepada = NOTIF_KEPADA_INTERNAL;
            $isi = "Portal BPHTB telah menerima pendaftaran Wajib Pajak baru atas nama \n"
                .  "<b>" . $request->nama . "</b>\n"
                .  "NIK " . $request->nik . "\n"
                .  "Email " . $request->email . "\n"
                .  "HP/WA" . $request->hp . " - " . $request->wa . "\n"
                .  "Alamat " . $request->alamat . "\n";
            $this->kirim_notif_telegram($kepada, $isi);
            // .Kirim Notifikasi Telegram

            return response()->json([
                'message' => 'success',
                'status_message' => 'Status akun Anda akan ditinjau oleh pihak yang terkait! Mohon menunggu admin memverifikasi berkas Anda!'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }
}
