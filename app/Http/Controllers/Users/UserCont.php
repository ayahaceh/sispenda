<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateUser;
use App\Http\Requests\ValidateUserEdit;
use App\Models\UserModel;
use App\Models\ProfilModel;
use App\Models\Alamat\ProvModel;
use App\Models\UserGroup\UserGroupModel;
// use App\Rules\MatchOldPassword;
// use App\Models\Logs\LogsModel;
use App\Http\Traits\TelegramTrait; // Mesin Telegram ada di trait
use App\Http\Traits\UploadBerkasTrait; // Upload berkas
use App\Http\Traits\LogsTrait;

// use App\Models\User;
use File;
use Illuminate\Support\Facades\Auth;
use Image;
// use Auth;
// use Validator;

class UserCont extends Controller
{

    use TelegramTrait; // Gunakan trait
    use UploadBerkasTrait; // Gunakan trait
    use LogsTrait;

    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $manaj_user = UserModel::where('user_group', '<=', USER_SUPER_ADMIN)
                ->where('nama', 'LIKE', '%' . $request->cari . '%')
                ->orwhere('username', 'LIKE', '%' . $request->cari . '%')
                ->orwhere('email', 'LIKE', '%' . $request->cari . '%')
                ->orwhere('user_group', 'LIKE', '%' . $request->cari . '%')
                ->orderBy('user_group', 'ASC')
                ->paginate(20);
        } else {
            $manaj_user = UserModel::where('user_group', '>', USER_SUPER_ADMIN)
                ->where('username', '!=', 'alidata')
                ->orderBy('user_group', 'ASC')
                ->paginate(20);
        }

        $bread              = 'Home | Setting | User';
        $tittle             = 'Daftar User';
        $menu_setting       = true;
        $menu_setting_user  = true;

        return view('users.user_l', compact(
            'manaj_user',
            'bread',
            'tittle',
            'menu_setting',
            'menu_setting_user',
        ));
    }

    public function create()
    {
        $bread              = 'Home | Setting | User | Tambah User';
        $tittle             = 'Tambah User';
        $menu_setting       = true;
        $menu_setting_user  = true;

        $userGroup          = UserGroupModel::where('nama_group', '!=', 'Super Admin')->get();
        $dataProv           = ProvModel::all();
        return view('users.user_a', compact(
            'userGroup',
            'dataProv',

            'bread',
            'tittle',
            'menu_setting',
            'menu_setting_user',
        ));
    }

    public function store(ValidateUser $request)
    {

        $namaUser   = session()->get('datauser')->nama;
        // Password Lihat user group 
        $pass       = bcrypt('rahasia');
        if ($request->user_group > USER_KABAN) {
            $pass = bcrypt('garuda');
        }

        // Tentukan Kode PPAT (jika role yang dipilih adalah PPAT)
        $kodePPAT   = null; // Urutan kode
        if ($request->user_group == USER_PPAT) {
            $kodePPAT = UserModel::select('kode_ppat')
                ->where('kode_ppat', '<>', '')
                ->orwhereNotNull('kode_ppat')
                ->latest()
                ->first();
            if (empty($kodePPAT)) {
                $kodePPAT = 1;
            } else {
                $kodePPAT = $kodePPAT->kode_ppat + 1;
            }
        }
        // .Tentukan kode PPAT


        try {

            $MUC                = new UserModel;
            $MUC->email         = $request->email;
            $MUC->username      = $request->username;
            $MUC->password      = $pass;
            $MUC->nik           = $request->nik;
            // $MUC->kk            = $request->kk;
            $MUC->nama          = $request->nama;
            $MUC->user_group    = $request->user_group;
            $MUC->kode_ppat     = $kodePPAT;  // ambil kode PPAT yang ditentukan diatas.
            $MUC->hp            = $request->hp;
            $MUC->wa            = $request->wa;
            $MUC->tg            = $request->tg;
            $MUC->status_user   = STATUS_USER_BARU_DAFTAR; // Baru daftar, perlu aktivasi oleh admin
            $MUC->terakhir      = now();
            $MUC->token         = Str::random(10);
            $MUC->deskripsi     = $request->deskripsi;
            $MUC->email_verified_at     = now();

            $MUC->created_by    = $namaUser;
            $MUC->updated_by    = null;
            $MUC->deleted_by    = null;
            $MUC->created_at    = now();

            if ($request->hasFile('foto')) {
                $file_foto      = $request->file('foto'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('foto')->getClientOriginalExtension();
                $nama_asli      = str_replace(" ", "_", $request->nama);
                $nama_asli      = substr($nama_asli, 0, 30);
                $nama_berkas    = $tgl . '_' . $nama_asli . '.' . $ekstensi;

                // Compress dan pindah ke sub folder comp
                $img            = Image::make($file_foto->getRealPath());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('upload/users/comp/' . $nama_berkas);

                // Pindahin kedalam folder upload
                $file_foto->move('upload/users/', $nama_berkas);
                $MUC->foto      = $nama_berkas; // Return dari traits
            } else {
                $MUC->foto      = 'default.jpg';
            }

            $MUC->save();
            // Logs 
            $keg        = '#Menambahkan User untuk : ' . $request->nama
                . ' #Username : ' . $request->username . ' #Email : ' . $request->email . ' #NIK : ' . $request->nik;
            $this->simpanLogs(LOGS_USERS, 99, $keg);
            // .Logs
            // --------------------------------------------
            // --------- SIMPAN KE TABEL PROFIL -----------
            // 1. Ambil id dari tabel user yang baru di simpan
            $user_id = UserModel::latest()->first();
            $user_id = $user_id->id;

            try {
                $PR             = new ProfilModel;
                $PR->user_id    = $user_id;
                $PR->nik        = $request->nik;
                $PR->nama       = $request->nama;
                $PR->hp         = $request->hp;
                $PR->wa         = $request->wa;
                $PR->tg         = $request->tg;
                $PR->email      = $request->email;
                $PR->berkas_foto    = $nama_berkas; // Ambil dari tabel user
                $PR->status_profil  = STATUS_PROFIL_VALID;
                $PR->kode_ppat      = $kodePPAT;
                $PR->created_by     = $namaUser;
                $PR->updated_by     = null;
                $PR->deleted_by     = null;
                $PR->created_at     = now();
                $PR->save();
                //
            } catch (\Throwable $th) {
                dd("error", $th);
            }
            // --------- .SIMPAN KE TABEL PROFIL -----------
            // Logs 
            $keg        = '#Menambahkan Profil untuk : ' . $request->nama
                . ' #Username : ' . $request->username . ' #Email : ' . $request->email . ' #NIK : ' . $request->nik;
            $this->simpanLogs(LOGS_PROFIL, 99, $keg);
            // .Logs

            // Kirim Notifikasi Telegram
            $namaSesiUser = Auth()->user()->nama;
            $dataUserbaru  = UserModel::latest()->first();

            // Ambil data BPHTB
            $kepada = NOTIF_KEPADA_SUPERADMIN;
            // dd($kepada);
            $isi =  $namaSesiUser . "Baru saja menambahkan akun pengguna untuk : \n"
                .  "Nama : <b>" . $dataUserbaru->nama . "</b>\n"
                .  "Email : " . $dataUserbaru->email . "\n"
                .  "Username : " . $dataUserbaru->username . "\n"
                .  "Group : " . $dataUserbaru->user_group . "\n";
            $this->kirim_notif_telegram($kepada, $isi);
            // .Kirim Notifikasi Telegram
            return redirect()->route('user')->with('success', 'Pengguna Baru telah Ditambahkan, Silahkan cek email untuk aktivasi akun');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function edit($id)
    {
        $bread              = 'Home | Setting | User | Edit user';
        $tittle             = 'Edit Users';
        $menu_setting       = true;
        $menu_setting_user  = true;

        $users          = UserModel::find($id);
        $userGroup      = UserGroupModel::where('nama_group', '!=', 'Super Admin')->get();

        return view('users/user_e', compact(
            'users',
            'userGroup',

            'bread',
            'tittle',
            'menu_setting',
            'menu_setting_user',
        ));
    }


    public function update(ValidateUserEdit $request, $id)
    {

        $namaUser   = session()->get('datauser')->nama;

        // Tentukan Kode PPAT (jika role yang dipilih adalah PPAT)
        $kodePPAT   = null; // Urutan kode
        if ($request->user_group == USER_PPAT) {
            $kodePPAT = UserModel::select('kode_ppat')
                ->where('kode_ppat', '<>', '')
                ->orwhereNotNull('kode_ppat')
                ->latest()
                ->first();
            if (empty($kodePPAT)) {
                $kodePPAT = 1;
            } else {
                $kodePPAT = $kodePPAT->kode_ppat + 1;
            }
        }
        // .Tentukan kode PPAT


        try {
            $MUC                = UserModel::find($id);
            $MUC->email         = $request->email;
            $MUC->username      = $request->username;
            $MUC->nama          = $request->nama;
            $MUC->user_group    = $request->user_group;
            $MUC->kode_ppat     = $kodePPAT;  // ambil kode PPAT yang ditentukan diatas.
            $MUC->hp            = $request->hp;
            $MUC->wa            = $request->wa;
            $MUC->tg            = $request->tg;
            $MUC->deskripsi     = $request->deskripsi;
            $MUC->updated_by    = $namaUser;

            if ($request->hasFile('foto')) {
                if ($MUC->foto != 'default.jpg' || $MUC->foto != 'default.png') {
                    // remove last users photo
                    $filename = public_path() . '/upload/users/comp/' . $MUC->foto;
                    File::delete($filename);
                    $filename = public_path() . '/upload/users/' . $MUC->foto;
                    File::delete($filename);
                }

                $file_foto      = $request->file('foto'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('foto')->getClientOriginalExtension();
                $nama_asli      = str_replace(" ", "_", $request->nama);
                $nama_asli      = substr($nama_asli, 0, 30);
                $nama_berkas    = $tgl . '_' . $nama_asli . '.' . $ekstensi;

                // Compress dan pindah ke sub folder comp
                $img            = Image::make($file_foto->getRealPath());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('upload/users/comp/' . $nama_berkas);

                // Pindahin kedalam folder upload
                $file_foto->move('upload/users/', $nama_berkas);
                $MUC->foto      = $nama_berkas; // Return dari traits
            }

            $MUC->save();
            // Logs 
            $keg        = '#Mengubah (edit) User untuk : ' . $request->nama
                . ' #Username : ' . $request->username . ' #Email : ' . $request->email;
            $this->simpanLogs(LOGS_USERS, $id, $keg);
            // .Logs
            // Kirim Notifikasi Telegram
            $namaSesiUser = Auth()->user()->nama;
            $dataUser  = UserModel::find($id);

            // Ambil data BPHTB
            $kepada = NOTIF_KEPADA_SUPERADMIN;
            // dd($kepada);
            $isi =  $namaSesiUser . " Baru saja mengubah (edit) akun pengguna untuk : \n"
                .  "Nama : <b>" . $dataUser->nama . "</b>\n"
                .  "Email : " . $dataUser->email . "\n"
                .  "Username : " . $dataUser->username . "\n"
                .  "Group : " . $dataUser->user_group . "\n";
            $this->kirim_notif_telegram($kepada, $isi);
            // .Kirim Notifikasi Telegram

            return redirect()->route('user')->with('success', 'Data Pengguna telah di ubah!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function hapus($id)
    {
        $user       = UserModel::find($id);
        $nama_user  = $user->nama;
        if (!empty($user)) {
            // Logs 
            $keg        = '#Menghapus User untuk : ' . $user->nama
                . ' #Username : ' . $user->username . ' #Email : ' . $user->email;
            $this->simpanLogs(LOGS_USERS, $id, $keg);
            // .Logs
        }
        UserModel::where('id', $id)
            ->update([
                'deleted_at'     => date('Y-m-d H:i:s'),
            ]);

        return back()->with('warning', 'User "' . $nama_user . '" Telah Dihapus');
    }

    public function aktivasi($id)
    {
        $user       = UserModel::find($id);
        if (!empty($user)) {
            // Logs 
            $keg = '#Mengaktifkan User untuk : ' . $user->nama
                . ' #Username : ' . $user->username . ' #Email : ' . $user->email;
            $this->simpanLogs(LOGS_USERS, $id, $keg);
            // .Logs
        }
        $nama_user  = $user->nama;
        UserModel::where('id', $id)
            ->update([
                'status_user'     => STATUS_USER_AKTIF,
            ]);
        return back()->with('success', 'User "' . $nama_user . '" Telah diaktifkan! User tersebut sudah dapat melakukan Login kedalam Portal BPHTB');
    }


    public function freezeuser($id)  // Bekukan Akses dgn Set Password Sembarangan dan status_user = 2
    {
        //
        // Reset Passwordnya dengan gabungan kata dan angka random
        $user       = UserModel::find($id);
        if (!empty($user)) {
            // Logs 
            $keg = '#Membekukan Akses Kedalam BPHTB untuk : ' . $user->nama
                . ' #Username : ' . $user->username . ' #Email : ' . $user->email;
            $this->simpanLogs(LOGS_USERS, $id, $keg);
            // .Logs
        }

        $kata       = COPYRIGHT_WEB;
        $angka      = mt_rand(10000, 99999999);
        $password   = $kata . $angka;

        // Kembalikan Password ke Default : rahasia
        UserModel::where('id', $id)
            ->update([
                'password'      => bcrypt($password),
                'status_user'   => STATUS_USER_DIBLOKIR,  // User Dibekukan
            ]);

        return back()->with('warning', 'Akses User atas nama "' . $user->nama . '" Telah dibekukan. ' .
            ' dari Portal Aplikasi. User ini tidak akan dapat login lagi kedalam aplikasi.');
    }

    public function resetpassword($id)
    {
        // Reset Password
        $user       = UserModel::find($id);
        if (!empty($user)) {
            // Logs 
            $keg = '#Melakukan Reset Password untuk : ' . $user->nama
                . ' #Username : ' . $user->username . ' #Email : ' . $user->email;
            $this->simpanLogs(LOGS_USERS, $id, $keg);
            // .Logs
        }
        // Atur password default utk masing-masing user_group
        $password   = 'rahasia';

        // Kembalikan Password ke Default : rahasia
        UserModel::where('id', $id)
            ->update([
                'password'      => bcrypt($password),
                'status_user'   => STATUS_USER_AKTIF,
            ]);
        // dd($id);
        return back()->with('success', 'Password untuk "' . $user->nama . '" Telah di Reset. ' .
            'Password Defaultnya adalah : ' . $password);
    }



    //--
}
