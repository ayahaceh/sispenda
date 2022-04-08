<?php

namespace App\Http\Controllers\Profil;

use App\Exports\ProfilExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilVal;
use App\Http\Requests\ProfilAdminVal;
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

class ProfilUserCont extends Controller
{
    use LogsTrait;

    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = ProfilModel::where('nik', 'LIKE',  '%' . $keyword . '%')
                ->orWhere('kk', 'LIKE',  '%' . $keyword . '%')
                ->orWhere('nama', 'LIKE', '%' . $keyword . '%')
                ->orderBy('id', 'DESC')
                ->paginate(20);
        } else {
            $data       = ProfilModel::orderBy('id', 'DESC')->paginate(20);
        }
        // Ambil data lainya
        $bread          = 'Home | Profil';
        $tittle         = 'Daftar Profil Wajib Pajak';
        $menu_profil    = true;
        $menu_bphtb_group = true;

        return view('profil.profil_l', compact(
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
        $tittle         = 'Buat Profil Wajib Pajak Baru';
        $menu_profil    = true;
        $menu_bphtb_group = true;
        return view('profil.profil_a', compact(
            'dataProv',

            'bread',
            'tittle',
            'menu_profil',
            'menu_bphtb_group',
        ));
    }

    public function store(ProfilAdminVal $request)
    {
        // $validated = $request->validated();
        // dd($request);
        try {
            $DATA           = new ProfilModel;
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
            $DATA->status_profil    = STATUS_PROFIL_VALID;
            $DATA->created_by       = session()->get('datauser')->nama; // Ambil Id User dari Session
            $DATA->created_at       = now();

            if ($request->hasFile('berkas_foto')) {
                $berkas_foto    = $request->file('berkas_foto'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('berkas_foto')->getClientOriginalExtension();
                $nama_berkas    = str_replace(" ", "_", $request->nama);
                $nama_berkas    = $tgl . '_' . substr($nama_berkas, 0, 10) . '.' . $ekstensi;

                // Compress dan pindah ke sub folder comp
                // $image          = $request->file('berkas_foto');
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
            $keg = '#Menambahkan Profil Wajib Pajak atas nama : ' . $request->nama
                . ' #NIK : ' . $request->nik . ' #Alamat : ' . $request->alamat
                . ' #Desa : ' .  $request->kode_desa;
            $this->simpanLogs(LOGS_PROFIL, 99, $keg);
            // .Logs
            return redirect()->route('profil.user')->with('success', 'Profil telah disimpan!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function edit($id)
    {
        $data    = ProfilModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }
        // ambil data prov, kab, kota
        $dataProv = ProvModel::all();
        // Ambil data lainya
        $bread  = 'Home | Profil | Edit';
        $tittle = 'Edit Profil Wajib Pajak';
        $menu_profil = true;
        $menu_bphtb_group = true;

        return view('profil.profil_e', compact(
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
        $data    = ProfilModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }

        try {
            $DATA           = ProfilModel::find($id);
            $DATA->nik      = $request->nik;  // Ambil dari UrutSpmTrait
            $DATA->kk       = $request->kk;
            $DATA->nama     = $request->nama;
            $DATA->jk       = $request->jk;
            $DATA->alamat   = $request->alamat;
            $DATA->kode_prov   = $request->kode_prov;
            $DATA->kode_kab   = $request->kode_kab;
            $DATA->kode_kec   = $request->kode_kec;
            $DATA->kode_desa  = $request->kode_desa;
            $DATA->rtrw     = $request->rtrw;
            $DATA->kode_pos = $request->kode_pos;
            $DATA->hp       = $request->hp;
            $DATA->wa       = $request->wa;
            $DATA->tg       = $request->tg;
            $DATA->email    = $request->email;

            // $DATA->jenis_profil_id  = $request->jenis_profil_id;
            $DATA->status_profil    = $request->status_profil;
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
                . ' #NIK : ' . $DATA->nik . ' #Menjadi : ' .  $request->nama
                . ' #NIK : ' . $request->nik;
            $this->simpanLogs(LOGS_PROFIL, $id, $keg);
            // .Logs
            return redirect()->route('profil.user')->with('success', 'Profil telah diperbaharui!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function show($id)
    {
        $data    = ProfilModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('gagal', 'Profil tidak ditemukan!');
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

        return view('profil.profil_v', compact(
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
        $data    = ProfilModel::find($id);
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
            if (Auth::user()->user_group  > USER_OPERATOR) {
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
        $data    = ProfilModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }

        try {
            $data->alamat           = $request->alamat;
            $data->kode_prov        = $request->kode_prov;
            $data->kode_kab         = $request->kode_kab;
            $data->kode_kec         = $request->kode_kec;
            $data->kode_desa        = $request->kode_desa;
            $data->kode_pos         = $request->kode_pos;
            $data->rtrw             = $request->rtrw;
            $data->updated_by       = session()->get('datauser')->nama; // Ambil Id User dari Session
            $data->updated_at       = now();
            if (Auth::user()->user_group > USER_OPERATOR) {
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
        $data    = ProfilModel::find($id);
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
            if (Auth::user()->user_group > USER_OPERATOR) {
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
        $data    = ProfilModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }

        try {
            if ($request->hasFile('berkas_foto')) {
                if ($data->berkas_foto != 'default.jpg' || $data->berkas_foto != 'default.png') {
                    // remove last users photo
                    $filename = public_path() . '/upload/users/comp/' . $data->berkas_foto;
                    File::delete($filename);
                    $filename = public_path() . '/upload/users/' . $data->berkas_foto;
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

            $data->updated_by       = session()->get('datauser')->nama; // Ambil Id User dari Session
            $data->updated_at       = now();
            if (Auth::user()->user_group > USER_OPERATOR) {
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
        $data    = ProfilModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }

        try {
            $data->status_profil    = $request->status_profil;
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
        $data    = ProfilModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('gagal', 'Profil tidak ditemukan!');
        } else {
            ProfilModel::find($id)
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
        return redirect()->route('profil.user')->with('sukses', 'Profil telah dihapus!');
    }

    public function pilih_profil($nik)
    {
        $jumlah_nop = NopPbbModel::join('profil AS p', 'p.nik', '=', 'nop_pbb.nik')->where('p.nik', $nik)->get();
        $jumlah_nop = $jumlah_nop->count();

        $pilih = ProfilModel::select('profil.*', 'nama_desa', 'nama_kec', 'nama_kab', 'nama_prov')
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
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = ProfilModel::select('id', 'nik', 'nama')
                ->where('status_profil', STATUS_PROFIL_VALID)
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
        return Excel::download(new ProfilExport, $file_name);
    }

    public function baru(Request $request)
    {
        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = ProfilTempModel::where('nik', 'LIKE',  '%' . $keyword . '%')
                ->where('kk', 'LIKE',  '%' . $keyword . '%')
                ->orWhere('nama', 'LIKE', '%' . $keyword . '%')
                ->paginate(20);
        } else {
            $data       = ProfilTempModel::paginate(20);
        }

        $bread          = 'Home | Profil | Baru';
        $tittle         = 'Daftar Profil WP Baru';
        $menu_profil    = true;
        $menu_bphtb_group = true;

        return view('profil.profil_baru_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_profil',
            'menu_bphtb_group',
        ));
    }

    public function verifikasi($id)
    {
        $data       = ProfilTempModel::find($id);

        $bread          = 'Home | Profil | Baru | Verifikasi';
        $tittle         = 'Verifikasi Profil WP';
        $menu_profil    = true;
        $menu_bphtb_group = true;

        return view('profil.profil_baru_v', compact(
            'data',
            'bread',
            'tittle',
            'menu_profil',
            'menu_bphtb_group',
        ));
    }

    public function verifikasi_store(Request $request)
    {
        $profil = ProfilModel::whereNik($request->nik);

        try {

            $profil_temp = ProfilTempModel::whereNik($request->nik)->first();
            $user = UserModel::whereNik($request->nik)->first();

            if ($profil->count() == 0) {
                $DATA = new ProfilModel;
                if ($profil_temp->kode_ppat == NULL) {
                    $DATA->user_id = $user->id;
                }
                $DATA->nik          = $profil_temp->nik;
                $DATA->kk           = $profil_temp->kk;
                $DATA->nama         = $profil_temp->nama;
                $DATA->jk           = $profil_temp->jk;
                $DATA->alamat       = $profil_temp->alamat;
                $DATA->kode_prov    = $profil_temp->kode_prov;
                $DATA->kode_kab     = $profil_temp->kode_kab;
                $DATA->kode_kec     = $profil_temp->kode_kec;
                $DATA->kode_desa    = $profil_temp->kode_desa;
                $DATA->rtrw         = $profil_temp->rtrw;
                $DATA->kode_pos     = $profil_temp->kode_pos;
                $DATA->hp           = $profil_temp->hp;
                $DATA->wa           = $profil_temp->wa !== '0' ? $profil_temp->wa : NULL;
                $DATA->tg           = $profil_temp->tg !== '0' ? $profil_temp->tg : NULL;
                $DATA->email        = $profil_temp->email;
                $DATA->berkas_foto  = $profil_temp->berkas_foto;
                $DATA->berkas_ktp   = $profil_temp->berkas_ktp;
                $DATA->berkas_kk    = $profil_temp->berkas_kk;
                $DATA->status_profil    = $request->status;
                $DATA->kode_ppat        = $profil_temp->kode_ppat;
                $DATA->created_by       = Auth::user()->nama;
                $DATA->created_at       = now();

                $DATA->save();
                // Logs 
                $keg = '#Menambahan Profil Wajib Pajak atas nama : ' . $DATA->nama
                    . ' #NIK :' . $DATA->nik;
                $this->simpanLogs(LOGS_PROFIL, 99, $keg);
                // .Logs
            } else if ($profil->count() == 1) { // jika sudah ada? UPDATE
                $updates = [
                    'nik'   => $profil_temp->nik,
                    'kk'    => $profil_temp->kk,
                    'nama'  => $profil_temp->nama,
                    'email' => $profil_temp->email,
                    'jk'    => $profil_temp->jk,
                    'alamat'    => $profil_temp->alamat,
                    'hp'        => $profil_temp->hp,
                    'wa'        => $profil_temp->wa ? $profil_temp->wa : NULL,
                    'tg'        => $profil_temp->tg ? $profil_temp->tg : NULL,
                    'kode_prov'     => $profil_temp->kode_prov,
                    'kode_kab'      => $profil_temp->kode_kab,
                    'kode_kec'      => $profil_temp->kode_kec,
                    'kode_desa'     => $profil_temp->kode_desa,
                    'rtrw'          => $profil_temp->rtrw,
                    'kode_pos'      => $profil_temp->kode_pos,
                    'status_profil' => $request->status,
                    'berkas_foto'   => $profil_temp->berkas_foto,
                    'berkas_ktp'    => $profil_temp->berkas_ktp,
                    'berkas_kk'     => $profil_temp->berkas_kk,
                    'kode_ppat'     => $profil_temp->kode_ppat,
                    'updated_by'    => Auth::user()->nama,
                ];

                if ($profil_temp->kode_ppat == NULL) {
                    $updates['user_id'] = $user->id;
                }

                $profil->update($updates);
                // Logs 
                $keg = '#Mengubah Profil Wajib Pajak atas nama : ' . $profil->nama
                    . ' #NIK :' . $profil->nik . ' #Menadi : ' . $profil_temp->nama . ' #NIK : ' . $profil_temp->nik;
                $this->simpanLogs(LOGS_PROFIL, $profil_temp->id, $keg);
                // .Logs
            }

            $profil_temp->delete();

            return redirect()->route('profil.user.baru')->with('success', 'Profil telah di verifikasi!');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    // ---
}
