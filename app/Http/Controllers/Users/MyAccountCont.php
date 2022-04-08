<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Http\Requests\AccountEditVal;
use App\Http\Requests\ChangePhotoVal;
use File;
use Image;
use App\Rules\MatchOldPassword;
use Validator;
use App\Http\Traits\TelegramTrait; // Mesin Telegram ada di trait
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\LogsTrait;

class MyAccountCont extends Controller
{
    use LogsTrait;
    use TelegramTrait; // Gunakan trait
    // use UploadFotoUserTrait; // Gunakan trait

    public function index()
    {
        $users  = UserModel::find(Auth::user()->id);
        return view(
            'users/my_account/my_account',
            [
                'tittle'    => 'Informasi Akun',
                'bread'     => 'My Account',
                'users'     => $users,
            ]
        );
    }

    public function account_update(AccountEditVal $request)
    {
        $id = Auth()->user()->id;
        try {
            $MUC                = UserModel::find($id);

            $MUC->nama          = $request->nama;
            $MUC->hp            = $request->hp;
            $MUC->wa            = $request->wa;
            $MUC->tg            = $request->tg;
            $MUC->updated_at    = now();
            $MUC->updated_by    = Auth()->user()->username;
            $MUC->save();
            // Logs
            $keg = $MUC->nama . ' #Username : ' . $MUC->username . ' #Email : ' . $MUC->email . ' #Mengubah Informasi Akunnya';
            $this->simpanLogs(LOGS_WEB, 99, $keg);
            // .Logs
            return redirect()->route('home')->with('success', 'Akun telah di Update!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function change_photo()
    {
        $users      = UserModel::find(Auth::user()->id);
        $bread      = 'My Account | My Photo';
        $tittle     = 'Informasi Akun Pengguna';
        $view       = 'users/my_account/my_photo';
        return view(
            $view,
            compact(
                'tittle',
                'bread',
                'users',
            )
        );
    }

    public function change_photo_update(ChangePhotoVal $request)
    {
        $id = Auth()->user()->id;
        try {
            $MUC = UserModel::find($id);
            if ($request->hasFile('foto')) {

                if ($MUC->foto != 'default.jpg' || $MUC->foto != 'default.png' || $MUC->foto != 'default.JPG' || $MUC->foto != 'default.PNG') {
                    // remove last users photo
                    $filename = public_path() . '/upload/users/comp/' . $MUC->foto;
                    File::delete($filename);
                    // ini berkas user profile
                    // $filename = public_path() . '/upload/users/' . $MUC->foto;
                    // File::delete($filename);
                }
                $file_foto      = $request->file('foto'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('foto')->getClientOriginalExtension();
                // $nama_asli      = $request->file('foto')->getClientOriginalName();
                $nama_asli      = pathinfo($file_foto, PATHINFO_FILENAME); // Ambil nama file tanpa ekstensi
                $nama_asli      = str_replace(" ", "_", $nama_asli);
                $nama_asli      = substr($nama_asli, 0, 30);
                $nama_berkas    = $tgl . '_' . $nama_asli . '.' . $ekstensi;

                // Compress dan pindah ke sub folder comp
                $image          = $request->file('foto');
                $img            = Image::make($image->getRealPath());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('upload/users/comp/' . $nama_berkas);

                // $file_foto->move('upload/users/', $nama_berkas); // Pindahin kedalam folder upload

                $MUC->foto      = $nama_berkas;
                $MUC->save();
                // Logs
                $keg = $MUC->nama . ' #Username : ' . $MUC->username . ' #Email : ' . $MUC->email . ' #Mengubah Foto Akunnya';
                $this->simpanLogs(LOGS_WEB, 99, $keg);
                // .Logs
            }

            return redirect()->route('home')->with('success', 'Foto Profil anda telah diganti!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function change_pass()
    {
        $id_user    = session()->get('datauser')->id;
        $users      = UserModel::find($id_user);
        $bread      = 'User | Change Password';
        $tittle     = 'Change Password';
        $view       = 'users/my_account/my_pass';
        return view(
            $view,
            compact(
                'tittle',
                'bread',
                'users',
            )
        );
    }

    public function change_pass_update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        try {
            $MUC = UserModel::find(Auth::user()->id);
            $MUC->password = bcrypt($request->new_password);
            $MUC->terakhir = now();

            $MUC->save();
            // Logs
            $keg = $MUC->nama . ' #Username : ' . $MUC->username . ' #Email : ' . $MUC->email . ' #Mengubah Password Akunnya';
            $this->simpanLogs(LOGS_WEB, 99, $keg);
            // .Logs
            return back()->with('success', 'Password Anda Berhasil Diperbarui, Silahkan login ulang untuk melihat perubahan');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }



    //--
}
