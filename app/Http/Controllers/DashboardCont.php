<?php

namespace App\Http\Controllers;
// Illuminate
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// Model
use App\Models\Temp\ProfilTempModel;
use App\Models\PeralihanNopModel;
use App\Models\Alamat\ProvModel;
use App\Models\ProfilModel;
use App\Models\BphtbModel;
use App\Models\UserModel;

// Telegram
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\FileUpload\InputFile;

// Http
use App\Http\Requests\ValidateBuktiPembayaran;
use App\Http\Traits\TelegramTrait;
use App\Http\Traits\LogsTrait;

// Lainnya
use File;

// Tidak Pakai
// use App\Models\Temp\NopPbbTempModel;
// use App\Models\Alamat\DesaModel;
// use App\Models\Alamat\KabModel;
// use App\Models\Alamat\KecModel;
// use App\Models\NopPbbModel;
// use App\Models\Referensi\JenisPerolehanModel;
// use App\Models\Setting\SettingDefaultModel;
// use Carbon\Carbon;
// use Illuminate\Support\Arr;
// use Illuminate\Support\Facades\Validator;
// use Throwable;

class DashboardCont extends Controller
{
    use LogsTrait;
    use TelegramTrait;

    public function index()
    {

        // Ambil informasi role user yang aktif untuk penentuan panel dashboard
        $userNow    = Auth::user()->id;
        $roleNow    = Auth::user()->user_group;
        // Update terakhir aktif user
        UserModel::where('id', $userNow)->update(['terakhir' => now()]);

        // Set Jumlah Notif baru
        if ($roleNow <= USER_KABAN) {

            // lAMA PUNYA (SEBELUM REVISI)
            // $jumlahUserBaru         = UserModel::where('status_user', STATUS_USER_BARU_DAFTAR)->count();
            // $jumlahProfilBaru       = ProfilTempModel::where('status_profil', STATUS_PROFIL_BELUM_VERIFIKASI)->count();
            // $jumlahNopBaru          = NopPbbTempModel::where('status_nop_pbb', STATUS_NOP_DIAJUKAN)->count();
            // $jumlahPelunasanPPAT    = PeralihanNopModel::where('status_verifikasi', STATUS_PEMBAYARAN_BELUM_VERIFIKASI)->count();
            // $jumlahBaru             = $jumlahUserBaru + $jumlahProfilBaru + $jumlahNopBaru + $jumlahPelunasanPPAT;
            // session(['sesiBaru' => [
            //     'jumlahBaru'            => $jumlahBaru,
            //     'jumlahUserBaru'        => $jumlahUserBaru,
            //     'jumlahProfilBaru'      => $jumlahProfilBaru,
            //     'jumlahNopBaru'         => $jumlahNopBaru,
            //     'jumlahPelunasanPPAT'   => $jumlahPelunasanPPAT,
            // ]]);


            // SETELAH REVISI 
            $jumlahUserBaru         = UserModel::where('status_user', STATUS_USER_BARU_DAFTAR)->count();
            $jumlahTransaksiBaru    = BphtbModel::where('status_bphtb', STATUS_BPHTB_BELUM_VERIFIKASI)->count();
            $jumlahPelunasanBaru    = BphtbModel::where('status_pembayaran', STATUS_PEMBAYARAN_SEDANG_VERIFIKASI)->count();
            $jumlahProfilBaru       = ProfilTempModel::where('status_profil', STATUS_PROFIL_BELUM_VERIFIKASI)->count();
            $jumlahBaru             = $jumlahUserBaru + $jumlahTransaksiBaru + $jumlahPelunasanBaru + $jumlahProfilBaru;
            $jumlahPendapatan       = BphtbModel::where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
                ->where('status_pembayaran', STATUS_TRANSAKSI_LUNAS)
                ->whereYear('tgl_setor', NOW())
                ->sum('jumlah_setor');
            $formatJumlahPendapatan = number_format($jumlahPendapatan, 0, ",", ".");
            // dd($jumlahPendapatan);
            // Set BPHTB yang belum Disetujui
            $jumlahBelumSetujui     = 0;
            if ($roleNow == USER_KABID || $roleNow == USER_KABAN) {
                $jumlahBelumSetujui   = BphtbModel::where('status_bphtb', STATUS_BPHTB_BELUM_DISETUJUI)
                    ->where('status_pembayaran', STATUS_PEMBAYARAN_LUNAS)
                    ->count();
                $jumlahBaru             = $jumlahBaru + $jumlahBelumSetujui;
            }
            session(['sesiBaru' => [
                'jumlahBaru'            => $jumlahBaru,
                'jumlahUserBaru'        => $jumlahUserBaru,
                'jumlahTransaksiBaru'   => $jumlahTransaksiBaru,
                'jumlahPelunasanBaru'   => $jumlahPelunasanBaru,
                'jumlahProfilBaru'      => $jumlahProfilBaru,
                'jumlahPendapatan'      => $jumlahPendapatan,
                'formatJumlahPendapatan' => $formatJumlahPendapatan,
            ]]);
        }



        if ($roleNow == USER_SUPER_ADMIN) {
            return redirect()->route('dash.superadmin');
        } elseif ($roleNow == USER_ADMIN) {
            return redirect()->route('dash.admin');
        } elseif ($roleNow == USER_OPERATOR) {
            return redirect()->route('dash.operator');
        } elseif ($roleNow == USER_KABID || $roleNow == USER_KABAN) {
            return redirect()->route('dash.monitoring');
        } elseif ($roleNow == USER_PPAT) {
            return redirect()->route('dash.ppat');
        } elseif ($roleNow == USER_WAJIB_PAJAK) {
            return redirect()->route('dash.wp');
        } elseif ($roleNow == USER_BPN) {
            return redirect()->route('dash.bpn');
        } elseif ($roleNow == USER_PUBLIK) {
            return redirect()->route('dash.publik');
        } else {
            return redirect()->route('forbiden');
        }
        // Inisasi data 
        // $hari_ini   = date('Y-m-d');
        // $date       = Carbon::parse($hari_ini);
        // $weekNumber = $date->weekNumberInMonth; // Menghasilkan minggu keberapa 1-4
        // $start      = $date->startOfWeek()->toDateString(); // menghasilkan Tgl Mulai minggu ini (senin)
        // $end        = $date->endOfWeek()->toDateString();   // Menghasilkan Tgl akhir minggu ini (minggu)
    }

    public function superadmin()
    {
        // Menu
        $bread      = 'Home';
        $tittle     = 'Dashboard';
        $menu_home  = true;
        $view       = 'dashboard.dashboard_v';

        return view($view, compact(

            'bread',
            'tittle',
            'menu_home'
        ));
    }
    public function admin()
    {
        // Menu
        $bread      = 'Home';
        $tittle     = 'Dashboard';
        $menu_home  = true;
        $view       = 'dashboard.dashboard_v';

        return view($view, compact(

            'bread',
            'tittle',
            'menu_home'
        ));
    }
    public function operator()
    {
        // Menu
        $bread      = 'Home';
        $tittle     = 'Dashboard';
        $menu_home  = true;
        $view       = 'dashboard.dashboard_v';

        return view($view, compact(

            'bread',
            'tittle',
            'menu_home'
        ));
    }
    public function monitoring()
    {
        // Menu
        $bread      = 'Home';
        $tittle     = 'Dashboard';
        $menu_home  = true;
        $view       = 'dashboard.dashboard_v';

        return view($view, compact(

            'bread',
            'tittle',
            'menu_home'
        ));
    }
    public function ppat()
    {
        // Menu
        $bread      = 'Home';
        $tittle     = 'Dashboard';
        $menu_home  = true;
        $view       = 'dashboard.dashboard_v';

        return view($view, compact(

            'bread',
            'tittle',
            'menu_home'
        ));
    }
    public function wp()
    {
        // Menu
        $bread      = 'Home';
        $tittle     = 'Dashboard';
        $menu_home  = true;
        $view       = 'dashboard.dashboard_v';

        return view($view, compact(

            'bread',
            'tittle',
            'menu_home'
        ));
    }
    public function bpn()
    {
        // Menu
        $bread      = 'Home';
        $tittle     = 'BPKK Kabupaten Aceh Singkil';
        $menu_home  = true;
        $view       = 'dashboard.dashboard_v';

        return view($view, compact(
            'bread',
            'tittle',
            'menu_home'
        ));
    }

    public function publik(Request $request)
    {
        // Menu
        // $keyword    = 'Masukkan NIK KTP atau NOP Secara Lengkap!';
        $bread      = 'Home';
        $tittle     = 'Pencarian Status Pelunasan BPHTB';
        $menu_home  = true;
        $view       = 'dashboard.dashboard_v';

        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = BphtbModel::where('status_pembayaran', STATUS_PEMBAYARAN_LUNAS)
                ->where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
                ->where('nik', $keyword)
                ->orWhere('nop', $keyword)
                ->orderByDesc('id', 'DESC')
                ->paginate(20);

            $clearButton    = true;
            return view($view, compact(
                'data',
                'clearButton',
                'keyword',

                'bread',
                'tittle',
                'menu_home'
            ));
        }

        return view($view, compact(
            'bread',
            'tittle',
            'menu_home'
        ));
    }

    public function contactAdmin()
    {
        $bread      = 'Hubungi Admin';
        $tittle     = 'Hubungi Admin';
        return view(
            'dashboard.contactAdmin',
            [
                'bread' => $bread,
                'tittle' => $tittle
            ]
        );
    }

    public function storeContactAdmin(Request $request)
    {
        $request->validate([
            // 'email'     => 'required|email',
            'message'   => 'required',
            'file'      => 'file|mimes:jpg,jpeg,png,gif'
        ]);
        $email_user = Auth::user()->email;
        $nama_user  = Auth::user()->nama;
        $wa_user    = Auth::user()->wa;

        $text = "Pelaporan terkait permasalahan / error aplikasi BPHTB Online : \n\n"
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

    public function profilSaya()
    {
        $dataTemp = ProfilTempModel::whereNik(Auth::user()->nik);
        $data = ProfilModel::whereNik(Auth::user()->nik);

        if ($dataTemp->count() > 0) {
            $data = $dataTemp;
        }

        if ($data->count() > 0) {
            // Warna Status
            $status_profil = $data->first()->status_profil;
            switch ($status_profil) {
                case STATUS_PROFIL_TIDAK_AKTIF:
                    $warna = 'danger';
                    break;
                case STATUS_PROFIL_BELUM_VERIFIKASI:
                    $warna = 'warning';
                    break;
                case STATUS_PROFIL_VALID:
                    $warna = 'success';
                    break;
                case STATUS_PROFIL_TIDAK_VALID:
                    $warna = 'danger';
                    break;
                default:
                    $warna = 'secondary';
            }
        } else {
            $warna = 'secondary';
        }

        $data = $data->first();

        $dataProv = ProvModel::all();
        // $dataKab = KabModel::all();
        // $dataKec = KecModel::all();
        // $dataDesa = DesaModel::all();

        $bread      = 'Profil Saya';
        $tittle     = 'Profil Saya';
        $menu_home  = true;

        return view('dashboard.wp.profil_v', compact(
            'data',
            'dataProv',
            // 'dataKab',
            // 'dataKec',
            // 'dataDesa',
            'warna',
            'bread',
            'tittle',
            'menu_home'
        ));
    }

    public function pengajuanBPHTB()
    {
        if (request()->has('search_temps')) {
            $search = request()->search_temps;
            $datas = PeralihanNopModel::whereKepadaNik(Auth::user()->nik)
                ->where('no_formulir', 'like', "{$search}%")
                ->orWhere('nop', 'like', "%{$search}%")
                ->orWhere('dari_nik', 'like', "%{$search}%")
                ->orWhere('kepada_nik', 'like', "%{$search}%")
                ->orWhere('tgl_peralihan', 'like', "%{$search}%")
                ->orWhereHas('joinProfilDari', function ($query) use ($search) {
                    return $query->where('nama', 'like', "%{$search}%");
                })
                ->orWhereHas('joinProfilKepada', function ($query) use ($search) {
                    return $query->where('nama', 'like', "%{$search}%");
                })
                ->orderByDesc('id')
                ->get();
        } else {
            $datas = PeralihanNopModel::whereKepadaNik(Auth::user()->nik)
                ->orderByDesc('id')
                ->get();
        }

        $bread      = 'Pengajuan BPHTB';
        $tittle     = 'Pengajuan BPHTB';
        $menu_home  = true;

        return view('dashboard.wp.pengajuan_bphtb_l', compact(
            'datas',
            'bread',
            'tittle',
            'menu_home'
        ));
    }

    public function bphtbLihat($id)
    {
        $data       = PeralihanNopModel::where('id', $id)->first();

        // print_r($data);
        if (empty($data)) {
            // return redirect()->route('home');
            return back()->with('error', 'Data tidak ditemukan!');
        }

        $bread          = 'WP | BPHTB | Lihat';
        $tittle         = 'Lihat data BPHTB';
        return view('transaksi.wp.wp_trans_peralihan_v', compact(
            'bread',
            'tittle',
            'data',
            'id',
        ));
    }

    public function upload_pembayaran(ValidateBuktiPembayaran $request, $id)
    {
        $kodePPAT   = Auth::user()->kode_ppat;
        $namaPPAT   = Auth::user()->nama;
        // dd($request);
        try {
            $peralihan = PeralihanNopModel::where('id', $id)->first();
            // dd($peralihan);
            $peralihan->no_rekening_bank    = $request->get_rekening_update;
            $peralihan->nama_penyetor       = $namaPPAT;
            $peralihan->status_verifikasi   = STATUS_PEMBAYARAN_BELUM_VERIFIKASI;
            // $nama_berkas = NULL;
            if ($request->hasFile('berkas_bukti')) {
                if ($peralihan->berkas_bukti_pembayaran != 'NULL') {
                    // remove last image
                    $filename = public_path() . '/upload/berkas_bukti_pembayaran/' . $peralihan->berkas_bukti_pembayaran;
                    File::delete($filename);
                }
                $berkas_bukti   = $request->file('berkas_bukti'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('berkas_bukti')->getClientOriginalExtension();
                // $replace    = str_replace(" ", "_", $request->berkas_bukti);
                // $nama_berkas    = $tgl . '_' . substr($replace, 0, 10) . '.' . $ekstensi;
                $nama_asli      = pathinfo($berkas_bukti, PATHINFO_FILENAME); // Ambil nama file tanpa ekstensi
                $nama_asli      = str_replace(" ", "_", $nama_asli);
                $nama_asli      = substr($nama_asli, 0, 10);
                $nama_berkas    = $tgl . '_' . $nama_asli . '.' . $ekstensi;

                // File Asli Pindahin kedalam folder upload
                $berkas_bukti->move('upload/berkas_bukti_pembayaran/', $nama_berkas);
                // dd($nama_berkas);
            } else {
                $nama_berkas = NULL;
            }
            $peralihan->berkas_bukti_pembayaran = $nama_berkas;
            $peralihan->save();
            // Logs 
            $keg = '#Mengupload Bukti Pelunasan BPHTB Formulir Nomor : ' . $peralihan->no_formulir
                . ' #NPOP : ' . $peralihan->nop . ' #kepada WP NIK : ' . $peralihan->kepada_nik . ' #Jumlah Rp. : ' . $peralihan->format_jumlah_setor;
            $this->simpanLogs(LOGS_PERALIHAN, $id, $keg);
            // .Logs

            // Kirim Notifikasi Telegram
            $dataBPHTB  = PeralihanNopModel::where('id', $id)->first();
            // Ambil data BPHTB
            $kepada = NOTIF_KEPADA_OPERATOR;
            // dd($kepada);
            $isi = "PPAT atas nama : " . $namaPPAT . " (" . $kodePPAT . ") \n"
                . "Telah melakukan upload berkas bukti setor BPHTB kedalam Portal BPHTB, "
                . "untuk pelunasan BPHTB atas :  \n"
                .  "NOP <b>" . $dataBPHTB->nop . "</b>\n"
                .  "Nama WP " . $dataBPHTB->joinProfilKepada->nama . "\n"
                .  "NIK " . $dataBPHTB->kepada_nik . "\n"
                .  "Jumlah Rp. : " . $dataBPHTB->format_jumlah_setor . "\n"
                .  "Silahkan lakukan verifikasi atas pembayaran tersebut! \n";
            $this->kirim_notif_telegram($kepada, $isi);
            // .Kirim Notifikasi Telegram
            return back()->with('success', 'Berkas bukti pelunasan telah di upload!');
        } catch (\Throwable $th) {
            dd("error", $th);
            return back()->with('error', 'Berkas Gagal di upload!');
        }
    }


    // ---
}
