<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

// use App\Models\SatkersModel;
use App\Models\Web\WebAssetsModel;
use App\Models\Web\WebProfilPejabatModel;
use App\Models\Web\WebKanalPembayaranModel;
use App\Models\Web\WebRegulasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Http\Traits\LogsTrait;

class PengaturanWebCont extends Controller
{
    use LogsTrait;
    public function index()
    {
        // Belum ada 
    }

    public function assets()
    {

        // Ambil data untuk tampilan web
        $dataAssets     = WebAssetsModel::first();
        // Menu
        $bread              = 'Pengaturan | Web | Assets';
        $tittle             = 'Ubah Video dan Gambar latar halaman web';
        $menu_setting_web   = true;
        $menu_web_assets    = true;
        $view               = 'web.assets';

        // dd($dataAssets);
        return view($view, compact(
            'dataAssets',

            'bread',
            'tittle',
            'menu_setting_web',
            'menu_web_assets',
        ));
    }

    public function update_assets(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'berkas_video'  => 'file|max:5120‬|mimes:mp4',
            'berkas_gambar' => 'file|max:1024|mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        try {
            $path = 'web/images/';
            if ($request->hasFile('berkas_video')) {
                if (!file_exists($path)) {
                    mkdir($path);
                }

                $file_name = "video-bg.mp4";
                $video = $request->file('berkas_video');
                $video->move($path, $file_name);
                // Logs
                $keg = '#Mengubah Tampilan Assets (video) Web Publik BPHTB Online dengan file : ' . $file_name;
                $this->simpanLogs(LOGS_WEB, 99, $keg);
                // .Logs
            }

            $db = WebAssetsModel::first();

            if ($request->hasFile('berkas_gambar')) {
                $image_old = $db->berkas_gambar;
                // Hapus
                if (file_exists($path . $image_old)) {
                    unlink($path . $image_old);
                }

                if (!file_exists($path)) {
                    mkdir($path);
                }

                $file_name  = "bg7-2";
                $gambar     = $request->file('berkas_gambar');
                $ext        = $gambar->getClientOriginalExtension();
                $gambar->move($path, $file_name . '.' . $ext);

                $db->berkas_gambar = $file_name . '.' . $ext;
                // Logs
                $keg = '#Mengubah Tampilan Assets (gambar) Web Publik BPHTB Online dengan file : ' . $file_name . '.' . $ext;
                $this->simpanLogs(LOGS_WEB, 99, $keg);
                // .Logs
            }

            $db->updated_by = Auth::user()->nama;
            $db->save();

            return redirect()->route('web.public.assets')->with('success', 'Data telah disimpan');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function profil_pejabat()
    {
        // CRUD Profil Pejabat
        $dataProfil         = WebProfilPejabatModel::all();
        $menu_setting_web   = true;
        $menu_web_profil    = true;
        $bread              = 'Pengaturan | Web | Ucapan Pejabat';
        $tittle             = 'Profil dan ucapan pejabat';
        $view               = 'web.profil_pejabat';

        return view($view, compact(
            'dataProfil',
            'menu_setting_web',
            'menu_web_profil',
            'bread',
            'tittle',
        ));
    }

    public function tambah_profil_pejabat()
    {
        $menu_setting_web = true;
        $menu_web_profil = true;
        $bread = 'Pengaturan | Web | Ucapan Pejabat | Tambah';
        $tittle = 'Tambah Profil dan ucapan pejabat';
        $view = 'web.profil_pejabat_tambah';

        return view($view, compact(
            'menu_setting_web',
            'menu_web_profil',
            'bread',
            'tittle',
        ));
    }

    public function store_profil_pejabat(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pejabat' => 'required|max:255',
            'jabatan_pejabat' => 'required|max:255',
            'uraian_pejabat' => 'required|max:255',
            'berkas_foto' => 'required|file|max:1024|mimes:png,jpg,jpeg|mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $db = new WebProfilPejabatModel;
            $db->nama_pejabat       = $request->nama_pejabat;
            $db->jabatan_pejabat    = $request->jabatan_pejabat;
            $db->uraian_pejabat     = $request->uraian_pejabat;

            if ($request->hasFile('berkas_foto')) {
                $path = 'web/images/';

                if (!file_exists($path)) {
                    mkdir($path);
                }

                $random     = Str::random(16);
                $image      = $request->file('berkas_foto');
                $ext        = $image->getClientOriginalExtension();
                $file_name  = $random . '.' . $ext;
                $image->move($path, $file_name);
                $db->berkas_foto = $file_name;
            }

            $db->created_by = Auth::user()->nama;
            $db->save();
            // Logs
            $keg = '#Menambahkan Profil Pejabat kedalam Web Publik BPHTB Online atas nama : ' . $request->nama_pejabat
                . ' #Jabatan : ' . $request->jabatan_pejabat;
            $this->simpanLogs(LOGS_WEB, 99, $keg);
            // .Logs
            return redirect()->route('web.public.profil-pejabat')->with('success', 'Data telah disimpan');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    // Edit Web Profil Pejabat
    public function edit_profil_pejabat($id)
    {
        $data = WebProfilPejabatModel::whereId($id)->first();
        $menu_setting_web = true;
        $menu_web_profil = true;
        $bread = 'Pengaturan | Web | Ucapan Pejabat | Edit';
        $tittle = 'Edit Profil dan ucapan pejabat';
        $view = 'web.profil_pejabat_edit';

        return view($view, compact(
            'data',
            'menu_setting_web',
            'menu_web_profil',
            'bread',
            'tittle',
        ));
    }

    public function update_profil_pejabat(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_pejabat' => 'required|max:255',
            'jabatan_pejabat' => 'required|max:255',
            'uraian_pejabat' => 'required|max:255',
            'berkas_foto' => 'file|max:1024|mimes:png,jpg,jpeg|mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $db = WebProfilPejabatModel::find($id);
            $db->nama_pejabat       = $request->nama_pejabat;
            $db->jabatan_pejabat    = $request->jabatan_pejabat;
            $db->uraian_pejabat     = $request->uraian_pejabat;

            if ($request->hasFile('berkas_foto')) {
                $path = 'web/images/';

                // hapus file
                $image_old = $db->berkas_foto;

                if (file_exists($path . $image_old)) {
                    unlink($path . $image_old);
                }

                if (!file_exists($path)) {
                    mkdir($path);
                }

                $random = Str::random(16);
                $image = $request->file('berkas_foto');
                $ext = $image->getClientOriginalExtension();
                $file_name = $random . '.' . $ext;
                $image->move($path, $file_name);
                $db->berkas_foto = $file_name;
            }

            $db->updated_by = Auth::user()->nama;
            $db->save();
            // Logs
            $keg = '#Mengubah (edit) Profil Pejabat kedalam Web Publik BPHTB Online atas nama : ' . $db->nama_pejabat
                . ' #Jabatan : ' . $db->jabatan_pejabat;
            $this->simpanLogs(LOGS_WEB, $id, $keg);
            // .Logs
            return redirect()->route('web.public.profil-pejabat')->with('success', 'Data telah disimpan');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    // Hapus Web Profil Pejabat
    public function hapus_profil_pejabat($id)
    {
        try {
            $db = WebProfilPejabatModel::find($id);
            $db->deleted_by = Auth::user()->nama;
            $db->save();
            // Logs
            $keg = '#Menghapus Profil Pejabat kedalam Web Publik BPHTB Online atas nama : ' . $db->nama_pejabat
                . ' #Jabatan : ' . $db->jabatan_pejabat;
            $this->simpanLogs(LOGS_WEB, $id, $keg);
            // .Logs
            $db->delete();

            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    public function kanal_pembayaran()
    {
        // CRUD Kanal Pembayaran
        $dataKanal                  = WebKanalPembayaranModel::all();
        $menu_setting_web           = true;
        $menu_web_kanal_pembayaran  = true;
        $bread              = 'Pengaturan | Web | Kanal Pembayaran';
        $tittle             = 'Kanal Pembayaran';
        $view               = 'web.kanal_pembayaran';
        return view($view, compact(
            'dataKanal',

            'menu_setting_web',
            'menu_web_kanal_pembayaran',
            'bread',
            'tittle',
        ));
    }

    public function tambah_kanal_pembayaran()
    {
        $menu_setting_web           = true;
        $menu_web_kanal_pembayaran  = true;
        $bread              = 'Pengaturan | Web | Kanal Pembayaran | Tambah';
        $tittle             = 'Tambah Kanal Pembayaran';
        $view               = 'web.kanal_pembayaran_tambah';
        return view($view, compact(
            'menu_setting_web',
            'menu_web_kanal_pembayaran',
            'bread',
            'tittle',
        ));
    }

    public function store_kanal_pembayaran(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kanal' => 'required|unique:web_kanal_pembayaran|max:255',
            'uraian_kanal' => 'required|max:255',
            'berkas_kanal' => 'required|file|max:1024|mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $db = new WebKanalPembayaranModel;
            $db->nama_kanal     = $request->nama_kanal;
            $db->uraian_kanal   = $request->uraian_kanal;

            if ($request->hasFile('berkas_kanal')) {
                $path = 'web/images/';

                if (!file_exists($path)) {
                    mkdir($path);
                }

                $random     = Str::random(16);
                $image      = $request->file('berkas_kanal');
                $ext        = $image->getClientOriginalExtension();
                $file_name  = $random . '.' . $ext;
                $image->move($path, $file_name);
                $db->berkas_kanal = $file_name;
            }

            $db->created_by = Auth::user()->nama;
            $db->save();
            // Logs
            $keg = '#Menambah Kanal Pembayaran kedalam Web Publik BPHTB Online dengan nama : ' . $db->nama_kanal
                . ' #Uraian : ' . $db->uraian_kanal;
            $this->simpanLogs(LOGS_WEB, 99, $keg);
            // .Logs
            return redirect()->route('web.public.kanal-pembayaran')->with('success', 'Data telah disimpan');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function edit_kanal_pembayaran($id)
    {
        $data                       = WebKanalPembayaranModel::whereId($id)->first();
        $menu_setting_web           = true;
        $menu_web_kanal_pembayaran  = true;
        $bread              = 'Pengaturan | Web | Kanal Pembayaran | Edit';
        $tittle             = 'Edit Kanal Pembayaran';
        $view               = 'web.kanal_pembayaran_edit';
        return view($view, compact(
            'data',
            'menu_setting_web',
            'menu_web_kanal_pembayaran',
            'bread',
            'tittle',
        ));
    }

    public function update_kanal_pembayaran(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kanal' => 'required|max:255|' . Rule::unique('web_kanal_pembayaran')->ignore($id, 'id'),
            'uraian_kanal' => 'required|max:255',
            'berkas_kanal' => 'file|max:1024|mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $db = WebKanalPembayaranModel::find($id);
            $db->nama_kanal = $request->nama_kanal;
            $db->uraian_kanal = $request->uraian_kanal;

            if ($request->hasFile('berkas_kanal')) {
                $path = 'web/images/';
                // hapus file
                $image_old = $db->berkas_kanal;

                if (file_exists($path . $image_old)) {
                    unlink($path . $image_old);
                }

                if (!file_exists($path)) {
                    mkdir($path);
                }

                $random     = Str::random(16);
                $image      = $request->file('berkas_kanal');
                $ext        = $image->getClientOriginalExtension();
                $file_name  = $random . '.' . $ext;
                $image->move($path, $file_name);
                $db->berkas_kanal = $file_name;
            }

            $db->updated_by = Auth::user()->nama;
            $db->save();
            // Logs
            $keg = '#Mengubah (edit) Kanal Pembayaran kedalam Web Publik BPHTB Online dengan nama : ' . $db->nama_kanal
                . ' #Uraian : ' . $db->uraian_kanal;
            $this->simpanLogs(LOGS_WEB, $id, $keg);
            // .Logs
            return redirect()->route('web.public.kanal-pembayaran')->with('success', 'Data telah disimpan');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function hapus_kanal_pembayaran($id)
    {
        try {
            $db = WebKanalPembayaranModel::find($id);
            $db->deleted_by = Auth::user()->nama;
            $db->save();
            // Logs
            $keg = '#Menghapus Kanal Pembayaran kedalam Web Publik BPHTB Online dengan nama : ' . $db->nama_kanal
                . ' #Uraian : ' . $db->uraian_kanal;
            $this->simpanLogs(LOGS_WEB, $id, $keg);
            // .Logs
            $db->delete();

            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    // End Kanal

    public function regulasi()
    {
        // CRUD Regulasi BPHTB
        $dataRegulasi       = WebRegulasiModel::all();
        $menu_setting_web   = true;
        $menu_web_regulasi  = true;
        $bread              = 'Pengaturan | Web | Regulasi';
        $tittle             = 'Regulasi / Peraturan';
        $view               = 'web.regulasi';
        return view($view, compact(
            'dataRegulasi',
            'menu_setting_web',
            'menu_web_regulasi',
            'bread',
            'tittle',
        ));
    }

    public function tambah_regulasi()
    {
        // CRUD Regulasi BPHTB
        $menu_setting_web   = true;
        $menu_web_regulasi  = true;
        $bread              = 'Pengaturan | Web | Regulasi | Tambah';
        $tittle             = 'Tambah Regulasi / Peraturan';
        $view               = 'web.regulasi_tambah';
        return view($view, compact(
            'menu_setting_web',
            'menu_web_regulasi',
            'bread',
            'tittle',
        ));
    }

    public function store_regulasi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_regulasi' => 'required|max:255|unique:web_regulasi',
            'berkas_regulasi' => 'required|file|max:5120‬|mimes:pdf,zip'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $db = new WebRegulasiModel;
            $db->nama_regulasi = $request->nama_regulasi;

            if ($request->hasFile('berkas_regulasi')) {
                $file_name = Str::of($request->nama_regulasi)->lower();
                $pdf = $request->file('berkas_regulasi');
                $ext = $pdf->getClientOriginalExtension();

                $path = 'web/files/';

                if (!file_exists($path . $file_name . '.' . $ext)) {
                    $file_name = $file_name . '.' . $ext;
                } else {
                    $file_name = $file_name . '-' . Str::random(6) . '.' . $ext;
                }

                if (!file_exists($path)) {
                    mkdir($path);
                }

                $pdf->move($path, $file_name);
                $db->berkas_regulasi = $file_name;
            }

            $db->created_by = Auth::user()->nama;
            $db->save();
            // Logs
            $keg = '#Menambah Regulasi kedalam Web Publik BPHTB Online dengan nama : ' . $request->nama_regulasi;
            $this->simpanLogs(LOGS_WEB, 99, $keg);
            // .Logs
            return redirect()->route('web.public.regulasi')->with('success', 'Data telah disimpan');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function edit_regulasi($id)
    {
        $data               = WebRegulasiModel::find($id);
        $menu_setting_web   = true;
        $menu_web_regulasi  = true;
        $bread              = 'Pengaturan | Web | Regulasi | Edit';
        $tittle             = 'Edit Regulasi / Peraturan';
        $view               = 'web.regulasi_edit';
        return view($view, compact(
            'data',
            'menu_setting_web',
            'menu_web_regulasi',
            'bread',
            'tittle',
        ));
    }

    public function update_regulasi(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_regulasi' => 'required|max:255|' . Rule::unique('web_regulasi')->ignore($id, 'id'),
            'berkas_regulasi' => 'file|max:5120‬|mimes:pdf,zip'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $db = WebRegulasiModel::find($id);
            $db->nama_regulasi = $request->nama_regulasi;

            if ($request->hasFile('berkas_regulasi')) {
                $path = 'web/files/';

                // hapus file
                $pdf = $db->berkas_regulasi;
                if (file_exists($path . $pdf)) {
                    unlink($path . $pdf);
                }

                $file_name = Str::of($request->nama_regulasi)->lower();
                $pdf = $request->file('berkas_regulasi');
                $ext = $pdf->getClientOriginalExtension();


                if (!file_exists($path . $file_name . '.' . $ext)) {
                    $file_name = $file_name . '.' . $ext;
                } else {
                    $file_name = $file_name . '-' . Str::random(6) . '.' . $ext;
                }
                if (!file_exists($path)) {
                    mkdir($path);
                }
                $pdf->move($path, $file_name);
                $db->berkas_regulasi = $file_name;
            }

            $db->updated_by = Auth::user()->nama;
            $db->save();
            // Logs
            $keg = '#Mengubah (edit) Regulasi kedalam Web Publik BPHTB Online dengan nama : ' . $request->nama_regulasi;
            $this->simpanLogs(LOGS_WEB, $id, $keg);
            // .Logs
            return redirect()->route('web.public.regulasi')->with('success', 'Data telah disimpan');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function hapus_regulasi($id)
    {
        try {
            $db = WebRegulasiModel::find($id);
            $db->deleted_by = Auth::user()->nama;
            $db->save();
            // Logs
            $keg = '#Menghapus Regulasi kedalam Web Publik BPHTB Online dengan nama : ' . $db->nama_regulasi;
            $this->simpanLogs(LOGS_WEB, $id, $keg);
            // .Logs
            $db->delete();

            return response()->json(['message' => 'success'], 200);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }
    }

    // ---
}
