<?php

namespace App\Http\Controllers\Profil;

use App\Exports\PpatProfilExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PpatProfilVal;
use App\Http\Requests\ProfilUpdateVal;
use App\Models\Alamat\ProvModel;
use App\Models\ProfilModel;
use App\Models\NopPbbModel;
use App\Models\Temp\ProfilTempModel;
use App\Models\UserModel;
use File;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\LogsTrait;

// use Validator;

class PpatProfilUserCont extends Controller
{
    use LogsTrait;
    public function index(Request $request)
    {
        // Ambil kode PPAT yang aktif
        $kode_ppat = Auth::user()->kode_ppat;

        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = ProfilTempModel::where('kode_ppat', $kode_ppat)
                ->where('nik', 'LIKE',  '%' . $keyword . '%')
                ->orWhere('kk', 'LIKE',  '%' . $keyword . '%')
                ->orWhere('nama', 'LIKE', '%' . $keyword . '%')
                ->paginate(20);
        } else {
            $data  = ProfilTempModel::where('kode_ppat', $kode_ppat)->paginate(20);
        }
        // Ambil data lainya
        $bread          = 'Home | Profil';
        $tittle         = 'Daftar Profil';
        $menu_profil    = true;
        $menu_bphtb_group = true;

        return view('profil.profil_ppat.profil_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_profil',
            'menu_bphtb_group',
        ));
    }

    public function create()
    {
        // ambil data prov, kab, kota
        $dataProv = ProvModel::all();

        // Ambil data lainya
        $bread          = 'Home | Profil | Tambah';
        $tittle         = 'Buat Profil Baru';
        $menu_profil    = true;
        $menu_bphtb_group = true;
        return view('profil.profil_ppat.profil_a', compact(
            'dataProv',

            'bread',
            'tittle',
            'menu_profil',
            'menu_bphtb_group',
        ));
    }

    public function store(PpatProfilVal $request)
    {
        // dd($request);
        $kode_ppat = Auth::user()->kode_ppat;
        // dd($request);
        try {
            $DATA           = new ProfilTempModel;
            $DATA->nik      = $request->nik;  // Ambil dari UrutSpmTrait
            $DATA->kk       = $request->kk;
            $DATA->nama     = $request->nama;
            $DATA->jk       = $request->jk;
            $DATA->alamat   = $request->alamat;
            $DATA->kode_prov  = $request->kode_prov;
            $DATA->kode_kab   = $request->kode_kab;
            $DATA->kode_kec   = $request->kode_kec;
            $DATA->kode_desa  = $request->kode_desa;
            $DATA->rtrw     = $request->rtrw;
            $DATA->kode_pos = $request->kode_pos;
            $DATA->hp       = $request->hp;
            $DATA->wa       = $request->wa;
            $DATA->tg       = $request->tg;
            $DATA->email    = $request->email;

            // $DATA->jenis_profil_id  = Auth()->user()->user_group;
            $DATA->status_profil    = STATUS_PROFIL_BELUM_VERIFIKASI;
            $DATA->kode_ppat        = $kode_ppat;

            $DATA->created_by       = session()->get('datauser')->nama; // Ambil Id User dari Session
            $DATA->created_at       = now();

            if ($request->hasFile('berkas_foto')) {
                $berkas_foto    = $request->file('berkas_foto'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('berkas_foto')->getClientOriginalExtension();
                $nama_berkas    = str_replace(" ", "_", $request->nama);
                $nama_berkas    = $tgl . '_' . substr($nama_berkas, 0, 10) . '.' . $ekstensi;

                // Compress dan pindah ke sub folder comp
                $image          = $request->file('berkas_foto');
                $img            = Image::make($berkas_foto->getRealPath());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('upload/users/comp/' . $nama_berkas);

                // File Asli Pindahin kedalam folder upload
                $berkas_foto->move('upload/users/', $nama_berkas);
                $DATA->berkas_foto    = $nama_berkas;
            } else {
                $nama_berkas    = 'default.JPG';
                $DATA->berkas_foto     = $nama_berkas;
            }

            // Berkas KTP
            if ($request->hasFile('berkas_ktp')) {
                $berkas_ktp    = $request->file('berkas_ktp'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('berkas_ktp')->getClientOriginalExtension();
                $nama_berkas    = str_replace(" ", "_", $request->nama);
                $nama_berkas    = $tgl . '_' . substr($nama_berkas, 0, 10) . '.' . $ekstensi;
                // File Asli Pindahin kedalam folder upload
                $berkas_ktp->move('upload/berkas_ktp/', $nama_berkas);
                $DATA->berkas_ktp   = $nama_berkas;
            } else {
                $nama_berkas        = 'default.pdf';
                $DATA->berkas_ktp   = $nama_berkas;
            }
            // Berkas KK
            if ($request->hasFile('berkas_kk')) {
                $berkas_kk      = $request->file('berkas_kk'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('berkas_kk')->getClientOriginalExtension();
                $nama_berkas    = str_replace(" ", "_", $request->nama);
                $nama_berkas    = $tgl . '_' . substr($nama_berkas, 0, 10) . '.' . $ekstensi;
                // File Asli Pindahin kedalam folder upload
                $berkas_kk->move('upload/berkas_kk/', $nama_berkas);
                $DATA->berkas_kk    = $nama_berkas;
            } else {
                $nama_berkas        = 'default.pdf';
                $DATA->berkas_kk    = $nama_berkas;
            }

            $DATA->save();
            // Logs 
            $keg = '#Mendaftarkan Profil Wajib Pajak atas nama : ' . $DATA->nama
                . ' #NIK :' . $DATA->nik;
            $this->simpanLogs(LOGS_PROFIL, 99, $keg);
            // .Logs
            return redirect()->route('ppat.profil.user')->with('success', 'Profil telah disimpan!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function edit($id)
    {
        $kode_ppat = Auth::user()->kode_ppat;
        $data    = ProfilTempModel::find($id);

        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        } elseif ($data->kode_ppat != $kode_ppat) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }

        // ambil data prov, kab, kota
        $dataProv = ProvModel::all();

        // Ambil data lainya
        $bread      = 'Home | Profil | Edit';
        $tittle     = 'Edit Profil';
        $menu_profil        = true;
        $menu_bphtb_group   = true;

        return view('profil.profil_ppat.profil_e', compact(
            'data',
            'dataProv',
            'bread',
            'tittle',
            'menu_profil',
            'menu_bphtb_group',
        ));
    }

    public function update(ProfilUpdateVal $request, $id)
    {
        $kode_ppat  = Auth::user()->kode_ppat;
        $data       = ProfilTempModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        } elseif ($data->kode_ppat != $kode_ppat) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }

        try {
            $DATA           = ProfilTempModel::find($id);
            $DATA->nik      = $request->nik;  // Ambil dari UrutSpmTrait
            $DATA->kk       = $request->kk;
            $DATA->nama     = $request->nama;
            $DATA->jk       = $request->jk;
            $DATA->alamat   = $request->alamat;
            $DATA->kode_prov    = $request->kode_prov;
            $DATA->kode_kab     = $request->kode_kab;
            $DATA->kode_kec     = $request->kode_kec;
            $DATA->kode_desa    = $request->kode_desa;
            $DATA->rtrw     = $request->rtrw;
            $DATA->kode_pos = $request->kode_pos;
            $DATA->hp       = $request->hp;
            $DATA->wa       = $request->wa;
            $DATA->tg       = $request->tg;
            $DATA->email    = $request->email;

            // $DATA->jenis_profil_id  = $request->jenis_profil_id;
            // $DATA->status_profil    = $request->status_profil;
            $DATA->kode_ppat        = $kode_ppat;
            // $DATA->status_profil    = $request->status_profil;
            $DATA->updated_by       = session()->get('datauser')->nama; // Ambil Id User dari Session
            $DATA->updated_at       = now();

            if ($request->hasFile('berkas_foto')) {
                if ($DATA->berkas_foto != 'default.JPG' || $DATA->berkas_foto != 'default.PNG') {
                    // remove last users photo
                    $filename = public_path() . '/upload/users/comp/' . $DATA->berkas_foto;
                    File::delete($filename);
                    $filename = public_path() . '/upload/users/' . $DATA->berkas_foto;
                    File::delete($filename);
                }

                $berkas_foto    = $request->file('berkas_foto'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('berkas_foto')->getClientOriginalExtension();
                $nama_berkas    = str_replace(" ", "_", $request->nama);
                $nama_berkas    = $tgl . '_' . substr($nama_berkas, 0, 10) . '.' . $ekstensi;

                // Compress dan pindah ke sub folder comp
                $image          = $request->file('berkas_foto');
                $img            = Image::make($berkas_foto->getRealPath());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('upload/users/comp/' . $nama_berkas);

                // File Asli Pindahin kedalam folder upload
                $berkas_foto->move('upload/users/', $nama_berkas);
                $DATA->berkas_foto    = $nama_berkas;
            } else {
                $nama_berkas        = 'default.jpg';
                $DATA->berkas_foto  = $nama_berkas;
            }

            // Berkas KTP
            if ($request->hasFile('berkas_ktp')) {
                if ($DATA->berkas_ktp != 'default.pdf' || $DATA->berkas_ktp != 'default.PDF') {
                    // remove last users photo
                    $filename = public_path() . '/upload/berkas_ktp/' . $DATA->berkas_ktp;
                    File::delete($filename);
                }

                $berkas_ktp     = $request->file('berkas_ktp'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('berkas_ktp')->getClientOriginalExtension();
                $nama_berkas    = str_replace(" ", "_", $request->nama);
                $nama_berkas    = $tgl . '_' . substr($nama_berkas, 0, 10) . '.' . $ekstensi;
                // File Asli Pindahin kedalam folder upload
                $berkas_ktp->move('upload/berkas_ktp/', $nama_berkas);
                $DATA->berkas_ktp   = $nama_berkas;
            } else {
                $nama_berkas        = 'default.pdf';
                $DATA->berkas_ktp   = $nama_berkas;
            }
            // Berkas KK
            if ($request->hasFile('berkas_kk')) {
                if ($DATA->berkas_kk != 'default.pdf' || $DATA->berkas_kk != 'default.PDF') {
                    // remove last users photo
                    $filename = public_path() . '/upload/berkas_kk/' . $DATA->berkas_kk;
                    File::delete($filename);
                }
                $berkas_kk      = $request->file('berkas_kk'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('berkas_kk')->getClientOriginalExtension();
                $nama_berkas    = str_replace(" ", "_", $request->nama);
                $nama_berkas    = $tgl . '_' . substr($nama_berkas, 0, 10) . '.' . $ekstensi;
                // File Asli Pindahin kedalam folder upload
                $berkas_kk->move('upload/berkas_kk/', $nama_berkas);
                $DATA->berkas_kk    = $nama_berkas;
            } else {
                $nama_berkas        = 'default.pdf';
                $DATA->berkas_kk    = $nama_berkas;
            }
            $DATA->save();
            // Logs 
            $keg = '#Mengubah Profil Wajib Pajak atas nama : ' . $DATA->nama
                . ' #NIK :' . $DATA->nik . ' #Menadi : ' . $DATA->nama . ' #NIK : ' . $DATA->nik;
            $this->simpanLogs(LOGS_PROFIL, $id, $keg);
            // .Logs

            return redirect()->route('ppat.profil.user')->with('success', 'Profil telah diperbaharui!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function show($id)
    {
        $kode_ppat  = Auth::user()->kode_ppat;
        $data       = ProfilTempModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('gagal', 'Profil tidak ditemukan!');
        } elseif ($data->kode_ppat != $kode_ppat) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }
        // Warna Status
        $status_profil = $data->status_profil;
        switch ($status_profil) {
            case 'Tidak Aktif':
                $warna = 'danger';
                break;
            case 'Belum Diverifikasi':
                $warna = 'warning';
                break;
            case 'Valid':
                $warna = 'success';
                break;
            case 'Tidak Valid':
                $warna = 'success';
                break;
            default:
                $warna = 'secondary';
        }

        // ambil data prov, kab, kota
        $dataProv       = ProvModel::all();
        // Ambil data lainya
        $bread  = 'Home | Profil';
        $tittle = 'Lihat Profil';
        $menu_profil = true;
        $menu_bphtb_group = true;

        return view('profil.profil_ppat.profil_v', compact(
            'data',
            'dataProv',
            'warna',
            'bread',
            'tittle',
            'menu_profil',
            'menu_bphtb_group',
        ));
    }

    public function updateDataDiri(Request $request, $id)
    {
        $data    = ProfilTempModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }

        try {
            $data->nik              = $request->nik;
            $data->kk               = $request->kk;
            $data->nama             = $request->nama;
            $data->jk               = $request->jk;
            $data->updated_by       = session()->get('datauser')->nama; // Ambil Id User dari Session
            $data->updated_at       = now();
            if (Auth::user()->user_group >= USER_OPERATOR) {
                $data->status_profil = STATUS_PROFIL_BELUM_VERIFIKASI;
            }
            $data->save();
            // Logs 
            $keg = '#Mengubah Profil (Data Diri) Wajib Pajak atas nama : ' . $data->nama
                . ' #NIK : ' . $data->nik . ' #Menjadi : ' . $request->nama . ' #NIK : ' . $request->nik;
            $this->simpanLogs(LOGS_PROFIL, $id, $keg);
            // .Logs
            return back()->with('success', 'Profil telah diperbaharui!');
        } catch (\Throwable $th) {
            return back()->with('success', 'Profil gagal diperbaharui!');
        }
    }

    public function updateTempatTinggal(Request $request, $id)
    {
        $data    = ProfilTempModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }

        try {
            $data->alamat           = $request->alamat;
            $data->kode_kab         = $request->kode_kab;
            $data->kode_kec         = $request->kode_kec;
            $data->kode_desa        = $request->kode_desa;
            $data->kode_pos         = $request->kode_pos;
            $data->rtrw             = $request->rtrw;
            $data->updated_by       = session()->get('datauser')->nama; // Ambil Id User dari Session
            $data->updated_at       = now();
            if (Auth::user()->user_group  >= USER_OPERATOR) {
                $data->status_profil = STATUS_PROFIL_BELUM_VERIFIKASI;
            }
            $data->save();
            // Logs 
            $keg = '#Mengubah Profil (Data Tempat Tinggal) Wajib Pajak atas nama : ' . $data->nama
                . ' #NIK : ' . $data->nik;
            $this->simpanLogs(LOGS_PROFIL, $id, $keg);
            // .Logs
            return back()->with('success', 'Profil telah diperbaharui!');
        } catch (\Throwable $th) {
            return back()->with('success', 'Profil gagal diperbaharui!');
        }
    }

    public function updateKontak(Request $request, $id)
    {
        $data    = ProfilTempModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }

        try {
            $data->hp               = $request->hp;
            $data->wa               = $request->wa;
            $data->tg               = $request->tg;
            $data->email            = $request->email;
            $data->updated_by       = session()->get('datauser')->nama; // Ambil Id User dari Session
            $data->updated_at       = now();
            if (Auth::user()->user_group  >= USER_OPERATOR) {
                $data->status_profil = STATUS_PROFIL_BELUM_VERIFIKASI;
            }
            $data->save();
            // Logs 
            $keg = '#Mengubah Profil (Kontak) Wajib Pajak atas nama : ' . $data->nama
                . ' #NIK : ' . $data->nik;
            $this->simpanLogs(LOGS_PROFIL, $id, $keg);
            // .Logs
            return back()->with('success', 'Profil telah diperbaharui!');
        } catch (\Throwable $th) {
            return back()->with('success', 'Profil gagal diperbaharui!');
        }
    }

    public function updateBerkasIdentitas(Request $request, $id)
    {
        $kode_ppat  = Auth::user()->kode_ppat;
        $data       = ProfilTempModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }

        try {
            if ($request->hasFile('berkas_foto')) {
                // if ($data->berkas_foto != 'default.jpg' || $data->berkas_foto != 'default.png') {
                //     // remove last users photo
                //     $filename = public_path() . '/upload/users/comp/' . $data->berkas_foto;
                //     File::delete($filename);
                //     $filename = public_path() . '/upload/users/' . $data->berkas_foto;
                //     File::delete($filename);
                // }

                $berkas_foto    = $request->file('berkas_foto'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('berkas_foto')->getClientOriginalExtension();
                $nama_berkas    = str_replace(" ", "_", $request->nama);
                $nama_berkas    = $tgl . '_' . substr($nama_berkas, 0, 10) . '.' . $ekstensi;

                // Compress dan pindah ke sub folder comp
                $image          = $request->file('berkas_foto');
                $img            = Image::make($berkas_foto->getRealPath());
                $img->resize(200, 200, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('upload/users/comp/' . $nama_berkas);

                // File Asli Pindahin kedalam folder upload
                $berkas_foto->move('upload/users/', $nama_berkas);
                $data->berkas_foto    = $nama_berkas;
            }
            // Berkas KTP
            if ($request->hasFile('berkas_ktp')) {
                if ($data->berkas_ktp != 'default.pdf' || $data->berkas_ktp != 'default.PDF') {
                    $filename = public_path() . '/upload/berkas_ktp/' . $data->berkas_ktp;
                    File::delete($filename);
                }
                $berkas_ktp    = $request->file('berkas_ktp'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('berkas_ktp')->getClientOriginalExtension();
                $nama_berkas    = str_replace(" ", "_", $request->nama);
                $nama_berkas    = $tgl . '_' . substr($nama_berkas, 0, 10) . '.' . $ekstensi;
                // File Asli Pindahin kedalam folder upload
                $berkas_ktp->move('upload/berkas_ktp/', $nama_berkas);
                $data->berkas_ktp   = $nama_berkas;
            }
            // Berkas KK
            if ($request->hasFile('berkas_kk')) {
                if ($data->berkas_kk != 'default.pdf' || $data->berkas_kk != 'default.PDF') {
                    $filename = public_path() . '/upload/berkas_kk/' . $data->berkas_kk;
                    File::delete($filename);
                }
                $berkas_kk      = $request->file('berkas_kk'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('berkas_kk')->getClientOriginalExtension();
                $nama_berkas    = str_replace(" ", "_", $request->nama);
                $nama_berkas    = $tgl . '_' . substr($nama_berkas, 0, 10) . '.' . $ekstensi;
                // File Asli Pindahin kedalam folder upload
                $berkas_kk->move('upload/berkas_kk/', $nama_berkas);
                $data->berkas_kk    = $nama_berkas;
            }

            $data->kode_ppat        = $kode_ppat;
            $data->updated_by       = session()->get('datauser')->nama; // Ambil Id User dari Session
            $data->updated_at       = now();
            if (Auth::user()->user_group  >= USER_OPERATOR) {
                $data->status_profil = STATUS_PROFIL_BELUM_VERIFIKASI;
            }
            $data->save();
            // Logs 
            $keg = '#Mengubah Profil (Berkas Identitas) Wajib Pajak atas nama : ' . $data->nama
                . ' #NIK : ' . $data->nik;
            $this->simpanLogs(LOGS_PROFIL, $id, $keg);
            // .Logs
            return back()->with('success', 'Profil telah diperbaharui!');
        } catch (\Throwable $th) {
            return back()->with('success', 'Profil gagal diperbaharui!');
        }
    }

    public function updateStatusProfil(Request $request, $id)
    {
        $kode_ppat  = Auth::user()->kode_ppat;
        $data       = ProfilTempModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        } elseif ($data->kode_ppat != $kode_ppat) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }
        try {
            $data->status_profil    = $request->status_profil;
            $data->kode_ppat        = $kode_ppat;
            $data->updated_by       = session()->get('datauser')->nama; // Ambil Id User dari Session
            $data->updated_at       = now();
            $data->save();
            // Logs 
            $keg = '#Mengubah Profil (Status Profil) Wajib Pajak atas nama : ' . $data->nama
                . ' #NIK :' . $data->nik . ' #Status menadi : ' . $request->status_profil;
            $this->simpanLogs(LOGS_PROFIL, $id, $keg);
            // .Logs
            return back()->with('success', 'Profil telah diperbaharui!');
        } catch (\Throwable $th) {
            return back()->with('success', 'Profil gagal diperbaharui!');
        }
    }

    public function hapus($id)
    {
        $kode_ppat  = Auth::user()->kode_ppat;
        $data       = ProfilTempModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('gagal', 'Profil tidak ditemukan!');
        } elseif ($data->kode_ppat != $kode_ppat) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        } else {

            ProfilTempModel::find($id)
                ->update([
                    'deleted_by'     => session()->get('datauser')->nama,
                    'deleted_at'     => now(),

                ]);
            // Logs
            $keg = '#Menghapus Profil Wajib Pajak atas nama : ' . $data->nama
                . ' #NIK :' . $data->nik;
            $this->simpanLogs(LOGS_PROFIL, $id, $keg);
            // .Logs
        }
        return redirect()->route('ppat.profil.user')->with('sukses', 'Profil telah dihapus!');
    }

    public function pilih_profil($nik)
    {
        $kode_ppat  = Auth::user()->kode_ppat;
        $jumlah_nop = NopPbbModel::join('profil AS p', 'p.nik', '=', 'nop_pbb.nik')->where('p.nik', $nik)->get();
        $jumlah_nop = $jumlah_nop->count();

        $pilih = ProfilTempModel::select('profil.*', 'nama_desa', 'nama_kec', 'nama_kab', 'nama_prov')
            ->join('desa', 'desa.kode_desa', 'profil.kode_desa')
            ->join('kec', 'kec.kode_kec', 'profil.kode_kec')
            ->join('kab', 'kab.kode_kab', 'profil.kode_kab')
            ->join('prov', 'prov.kode_prov', 'profil.kode_prov')
            ->where('status_profil', STATUS_PROFIL_VALID)
            ->where('profil.nik', $nik)
            ->first();

        $pilih->jumlah_nop = $jumlah_nop;

        return response()->json($pilih);
    }

    public function getProfilAutoComplete(Request $request)
    {
        $kode_ppat  = Auth::user()->kode_ppat;
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = ProfilModel::select('id', 'nik', 'nama')
                ->where('status_profil', STATUS_PROFIL_VALID)
                ->where('kode_ppat', $kode_ppat)
                ->where(function ($query) use ($search) {
                    $query->where('nama', 'LIKE', "%$search%")
                        ->orwhere('nik', 'LIKE', "%$search%");
                })->get();
        }
        return response()->json($data);
    }

    public function export()
    {
        $file_name = 'Data Profil Wajib Pajak ' . date('Ymd_His') . ' - Export by ' . env('APP_NAME') . '.xlsx';
        return Excel::download(new PpatProfilExport, $file_name);
    }

    public function profil_valid(Request $request)
    {
        // Ambil kode PPAT yang aktif
        $kode_ppat = Auth::user()->kode_ppat;

        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = ProfilModel::where('kode_ppat', $kode_ppat)
                ->where('nik', 'LIKE',  '%' . $keyword . '%')
                ->orWhere('kk', 'LIKE',  '%' . $keyword . '%')
                ->orWhere('nama', 'LIKE', '%' . $keyword . '%')
                ->paginate(20);
        } else {
            $data  = ProfilModel::where('kode_ppat', $kode_ppat)->paginate(20);
        }
        // Ambil data lainya
        $bread          = 'Home | Profil';
        $tittle         = 'Daftar Profil';
        $menu_profil    = true;
        $menu_bphtb_group = true;

        return view('profil.profil_ppat.profil_valid_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_profil',
            'menu_bphtb_group',
        ));
    }
    public function profil_valid_lihat($id)
    {
        $kode_ppat  = Auth::user()->kode_ppat;
        $data       = ProfilModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('gagal', 'Profil tidak ditemukan!');
        } elseif ($data->kode_ppat != $kode_ppat) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }
        // Warna Status
        $status_profil = $data->status_profil;
        switch ($status_profil) {
            case 'Tidak Aktif':
                $warna = 'danger';
                break;
            case 'Belum Diverifikasi':
                $warna = 'warning';
                break;
            case 'Valid':
                $warna = 'success';
                break;
            case 'Tidak Valid':
                $warna = 'success';
                break;
            default:
                $warna = 'secondary';
        }

        // ambil data prov, kab, kota
        $dataProv       = ProvModel::all();
        // Ambil data lainya
        $bread  = 'Home | Profil';
        $tittle = 'Lihat Profil';
        $menu_profil = true;
        $menu_bphtb_group = true;

        return view('profil.profil_ppat.profil_valid_v', compact(
            'data',
            'dataProv',
            'warna',
            'bread',
            'tittle',
            'menu_profil',
            'menu_bphtb_group',
        ));
    }

    // ---
}
