<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\SatkersModel;
use App\Models\Web\WebAssetsModel;

// use App\Models\Ref\RefSkpdModel;
// use App\Models\SpmModel;

use Illuminate\Support\Facades\Auth;
use App\Http\Traits\TelegramTrait;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    use TelegramTrait; // Untuk mengirim notifikasi

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Ambil info user yang login
        $datasatker = SatkersModel::first();
        // Set session data satker
        session(['datasatker' => $datasatker]);
        // Midleware logout
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $dataAssets     = WebAssetsModel::first();
        $bread  = '';
        $tittle = session()->get('datasatker')->nama_satker;
        $satkera = session()->get('datasatker')->nama_satkera;
        $satkerb = session()->get('datasatker')->nama_satkerb;

        // Ambil data SPM
        // $spm = SpmModel::orderBy('id', 'DESC')
        //     ->paginate(5);
        // Captcha

        return view('users.login_f', [
            'dataAssets' => WebAssetsModel::first(),
            'bread' => $bread,
            'tittle' => $tittle,
            'satkera' => $satkera,
            'satkerb' => $satkerb,
            // 'spm' => $spm,
        ]);
        // return view('auth.login');
    }

    public function username()
    {
        // return 'username';    // Ini saja sudah cukup jk hanya username saja atau email saja pilihan login
        // Ini agar user dapat login pakai username maupun email
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha',
        ], ['captcha.captcha' => 'Invalid captcha code.']);
    }

    protected function credentials(Request $request)
    {
        return ['username' => $request->{$this->username()}, 'password' => $request->password, 'status_user' => 1];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        $user = UserModel::where($this->username(), $request->{$this->username()})->first();

        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if ($user && \Hash::check($request->password, $user->password) && $user->id_status != 1) {
            $errors = [$this->username() => trans('auth.notactivated')];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    protected function sendLoginResponse(Request $request)
    {
        // Ambil info user yang login
        $id_user = Auth::id();
        // $id_satker = 1;
        // $id_skpd = Auth::user()->id_skpd;
        $datasatker = SatkersModel::where('id', 1)
            ->first();

        $datauser = UserModel::select(
            'id',
            'email',
            'username',
            'nik',
            'kk',
            'nama',
            'foto',
            'user_group',
            'kode_ppat',
            'hp',
            'wa',
            'tg',
            'terakhir'
        )
            ->Where('id', $id_user)
            ->first();

        // Generate session baru
        $request->session()->regenerate();
        // Hapus session percobaan login
        $this->clearLoginAttempts($request);
        // Set session data satker dan user
        session(['datasatker'   => $datasatker]);
        session(['datauser'     => $datauser]);

        // Notif Login 
        if ($datauser->user_group >= USER_KABID) {
            if ($datauser->user_group == USER_BPN) {
                $namaGroup = 'BPN';
            } elseif ($datauser->user_group >= USER_PUBLIK) {
                $namaGroup = 'Publik';
            } elseif ($datauser->user_group >= USER_KABID) {
                $namaGroup = 'Kabid';
            } elseif ($datauser->user_group >= USER_KABAN) {
                $namaGroup = 'Kaban';
            } elseif ($datauser->user_group >= USER_PPAT) {
                $namaGroup = 'PPAT';
            } elseif ($datauser->user_group >= USER_WAJIB_PAJAK) {
                $namaGroup = 'Wajib Pajak';
            } else {
                $namaGroup = "Lainnya";
            }
            // Kirim Notifikasi Telegram
            $kepada = NOTIF_KEPADA_SUPERADMIN;
            $isi    = "Informasi Akun Login kedalam BPHTB Online ! \n"
                .  "Nama : <b>" .  $datauser->nama . "</b>\n"
                .  "Username : " . $datauser->username . "\n"
                .  "Email : " . $datauser->email . "\n"
                .  "Group : " . $namaGroup . "\n";
            $this->kirim_notif_telegram($kepada, $isi);
            // .Kirim Notifikasi Telegram
        }
        // .Notif Login 

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }




    //-------------
}
