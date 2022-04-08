<?php

namespace App\Http\Controllers\Bphtb;

use App\Http\Controllers\Controller;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\KecModel;
use App\Models\BphtbModel;
use App\Models\ProfilModel;
use App\Models\Referensi\JenisPerolehanModel;
use App\Models\Setting\SettingDefaultModel;
use App\Models\Temp\ProfilTempModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\Validator;
use Throwable;

class WpBphtbCont extends Controller
{
    public function index(Request $request)
    {

        if ($request->has('search_temps')) {
            $keyword = $request->search_temps;
            $data_temps = BphtbModel::where('nik', Auth::user()->nik)
                ->where('status_bphtb', STATUS_BPHTB_BELUM_VERIFIKASI)
                ->where(function ($query) use ($keyword) {
                    $query->where('tgl_bphtb', 'like', "%{$keyword}%")
                        ->orWhere('nop', 'like', "%{$keyword}%")
                        ->orWhere('no_sertifikat', 'like', "%{$keyword}%")
                        ->orWhere('letak_nop', 'like', "%{$keyword}%")
                        ->orWhereHas('joinKecNop', function ($query) use ($keyword) {
                            return $query->where('nama_kec', 'like', "%{$keyword}%");
                        })
                        ->orWhereHas('joinDesaNop', function ($query) use ($keyword) {
                            return $query->where('nama_desa', 'like', "%{$keyword}%");
                        });
                })
                ->get();
        } else {
            $data_temps = BphtbModel::whereNik(Auth::user()->nik)
                ->where('status_bphtb', STATUS_BPHTB_BELUM_VERIFIKASI)
                ->get();
        }

        if ($request->has('search')) {
            $keyword = $request->search;
            $datas = BphtbModel::where('nik', Auth::user()->nik)
                ->where('status_bphtb', '!=', STATUS_BPHTB_BELUM_VERIFIKASI)
                ->where(function ($query) use ($keyword) {
                    $query->where('tgl_bphtb', 'like', "%{$keyword}%")
                        ->orWhere('nop', 'like', "%{$keyword}%")
                        ->orWhere('letak_nop', 'like', "%{$keyword}%")
                        ->orWhereHas('joinKecNop', function ($query) use ($keyword) {
                            return $query->where('nama_kec', 'like', "%{$keyword}%");
                        })
                        ->orWhereHas('joinDesaNop', function ($query) use ($keyword) {
                            return $query->where('nama_desa', 'like', "%{$keyword}%");
                        });
                });
        } else {
            $datas = BphtbModel::whereNik(Auth::user()->nik)
                ->where('status_bphtb', '!=', STATUS_BPHTB_BELUM_VERIFIKASI);
        }

        $datas = $datas->orderByDesc('id')->get();

        $bread      = 'BPHTB';
        $tittle     = 'BPHTB';
        $menu_home  = true;

        return view('bphtb.wp.bphtb_l', compact(
            'data_temps',
            'datas',
            'bread',
            'tittle',
            'menu_home'
        ));
    }

    public function show_temp($id)
    {
        $data = BphtbModel::whereId($id)->first();
        $bread = 'BPHTB | Lihat';
        $tittle     = 'Lihat BPHTB';
        $menu_home  = true;
        $temp  = true;

        return view('bphtb.wp.bphtb_v', compact(
            'temp',
            'data',
            'bread',
            'tittle',
            'menu_home'
        ));
    }

    public function show($id)
    {
        $data = BphtbModel::whereId($id)->first();
        $bread = 'BPHTB | Lihat';
        $tittle     = 'Lihat BPHTB';
        $menu_home  = true;
        $temp  = false;

        return view('bphtb.wp.bphtb_v', compact(
            'temp',
            'data',
            'bread',
            'tittle',
            'menu_home'
        ));
    }

    public function edit($id)
    {
        $defaultKab = SettingDefaultModel::where('nama_setting_default', 'default_kabupaten')->first();
        $dataKab = KabModel::where('kode_kab', $defaultKab->kode_setting_default)->first();
        $dataKec = KecModel::where('kode_kec', 'LIKE', $defaultKab->kode_setting_default . '.' . '%')->get();
        $dataJenisPerolehan = JenisPerolehanModel::all();

        $settingDefKab  = SettingDefaultModel::where('nama_setting_default', 'default_kabupaten')->first();
        $dataKabDefault = KabModel::where('kode_kab', $settingDefKab->kode_setting_default)->first();

        $data = BphtbModel::whereId($id)->first();

        $nik = ProfilModel::select('nik')->whereUserId(Auth::id())->first()->nik;

        $bread = 'BPHTB | Edit';
        $tittle     = 'Edit BPHTB';
        $menu_home  = true;

        return view('bphtb.wp.bphtb_e', compact(
            'dataKabDefault',
            'dataKec',
            'dataKab',
            'dataJenisPerolehan',
            'data',
            'nik',
            'bread',
            'tittle',
            'menu_home'
        ));
    }

    public function create()
    {

        $dataProfil = ProfilModel::whereNik(Auth::user()->nik);
        $dataProfilTemp = ProfilTempModel::whereNik(Auth::user()->nik);

        $status_user_profil = STATUS_PROFIL_TIDAK_AKTIF;

        $defaultKab = SettingDefaultModel::where('nama_setting_default', 'default_kabupaten')->first();
        $dataKab = KabModel::where('kode_kab', $defaultKab->kode_setting_default)->first();
        $dataKec = KecModel::where('kode_kec', 'LIKE', $defaultKab->kode_setting_default . '.' . '%')->get();
        $dataJenisPerolehan = JenisPerolehanModel::all();

        $settingDefKab  = SettingDefaultModel::where('nama_setting_default', 'default_kabupaten')->first();
        $dataKabDefault = KabModel::where('kode_kab', $settingDefKab->kode_setting_default)->first();

        if ($dataProfilTemp->count() > 0) {
            $user_profil = true;
            if ($dataProfilTemp->first()->status_profil !== STATUS_PROFIL_VALID) {
                $status_user_profil = $dataProfilTemp->first()->status_profil;
            } else {
                $status_user_profil = STATUS_PROFIL_VALID;
            }
        } else {
            if ($dataProfil->count() > 0) {
                $user_profil = true;
                if ($dataProfil->first()->status_profil !== STATUS_PROFIL_VALID) {
                    $status_user_profil = $dataProfil->first()->status_profil;
                } else {
                    $status_user_profil = STATUS_PROFIL_VALID;
                }
            } else {
                $user_profil = false;
            }
        }

        $nik = null;
        if ($status_user_profil == STATUS_PROFIL_VALID) {
            $nik = ProfilModel::select('nik')->whereUserId(Auth::id())->first()->nik;
        }

        $cek_status_bphtb = BphtbModel::whereNik(Auth::user()->nik)
            ->where(function ($query) {
                $query->where('status_pembayaran', '!=', STATUS_PEMBAYARAN_LUNAS)
                    ->orWhere('status_bphtb', '!=', STATUS_BPHTB_SUDAH_DISETUJUI);
            })
            ->count();

        $status_bphtb = true;
        if ($cek_status_bphtb > 0) {
            $status_bphtb = false;
        }

        $bread      = 'BPHTB| Ajukan BPHTB';
        $tittle     = 'Ajukan BPHTB';
        $menu_home  = true;

        return view('bphtb.wp.bphtb_a', compact(
            'dataKabDefault',
            'dataKec',
            'dataKab',
            'dataProfil',
            'dataJenisPerolehan',
            'user_profil',
            'status_user_profil',
            'nik',
            'bread',
            'tittle',
            'menu_home',
            'status_bphtb',
        ));
    }

    public function store(Request $request)
    {
        $rules = [
            'nop'           => 'required',
            'letak_nop'     => 'required',
            'kode_kab_nop'  => 'required',
            'kode_kec_nop'  => 'required',
            'kode_desa_nop' => 'required',
            'kode_jenis_perolehan'  => 'required',
            'no_sertifikat' => 'required',
            'luas_tanah'    => 'required',
            'luas_bangunan' => 'required',
            'hak_nilai_pasar'   => 'required',
            'berkas_sertifikat'   => 'required|file|mimes:jpg,png,jpeg|max:1024',
            'berkas_ajb'   => 'required|file|mimes:jpg,png,jpeg|max:1024',
        ];

        $request->validate($rules);

        $profil = ProfilModel::whereUserId(Auth::id())->first();

        if ($profil == null) {
            return back()->with('error', 'Profil tidak ditemukan!');
        }

        // validasi 1
        // validasi jika nik dan nop sudah terdaftar (milik sendiri)
        $cek_milik_sendiri = BphtbModel::whereNik((string)$profil->nik)
            ->whereNop((int)$request->nop)
            ->orderByDesc('id')
            ->distinct('nop')
            ->count();

        if ($cek_milik_sendiri > 0) {
            return back()->with('error', 'NIK ' . $profil->nik . ' dan NOP ' . $request->nop . ' sudah terdaftar milik Wajib Pajak sendiri!')
                ->withInput();
        }

        // validasi 2
        // validasi apakah ada data tanah wp sendiri yg status nya belum oke
        $cek_status_bphtb = BphtbModel::whereNik((string)$profil->nik)
            ->where(function ($query) {
                $query->where('status_pembayaran', '!=', STATUS_PEMBAYARAN_LUNAS)
                    ->orWhere('status_bphtb', '!=', STATUS_BPHTB_SUDAH_DISETUJUI);
            })
            ->count();

        if ($cek_status_bphtb > 0) {
            return back()->with('error', 'Data dengan Wajib Pajak terdapat status BPHTB yang belum ditinjau. Harap menunggu status ditinjau untuk melakukan transaksi ini!')
                ->withInput();
        }

        // validasi 3
        // validasi nop jika sudah terdaftar (milik orang) namun status masih belum oke
        $cek_status_nop = BphtbModel::whereNop((int)$request->nop)
            ->where(function ($query) {
                $query->where('status_pembayaran', '!=', STATUS_PEMBAYARAN_LUNAS)
                    ->orWhere('status_bphtb', '!=', STATUS_BPHTB_SUDAH_DISETUJUI);
            })
            ->count();

        if ($cek_status_nop > 0) {
            return back()->with('error', 'Anda memasukkan data NOP yang sudah terdaftar namun status tersebut belum ditinjau. Harap menunggu status ditinjau untuk melakukan transaksi ini!')
                ->withInput();
        }

        $tgl_bphtb = now();
        $kode_desa_nop = $request->kode_desa_nop;

        $dev_prov = SettingDefaultModel::whereNamaSettingDefault('default_provinsi')->first()->kode_setting_default;

        $data = [
            'tgl_bphtb'     => $tgl_bphtb,
            'nik'           => $profil->nik,
            'nama_wp'       => $profil->nama,
            'alamat_wp'     => $profil->alamat,
            'kode_prov_wp'  => $profil->kode_prov,
            'kode_kab_wp'   => $profil->kode_kab,
            'kode_kec_wp'   => $profil->kode_kec,
            'kode_desa_wp'  => $profil->kode_desa,
            'rtrw_wp'       => $profil->rtrw,
            'kode_pos_wp'   => $profil->kode_pos,
            'nop'           => $request->nop,
            'letak_nop'     => $request->letak_nop,
            'kode_prov_nop' => $dev_prov,
            'kode_kab_nop'  => $request->kode_kab_nop,
            'kode_kec_nop'  => $request->kode_kec_nop,
            'letak_nop'     => $request->letak_nop,
            'kode_desa_nop' => $kode_desa_nop,
            'rtrw_nop'      => $request->rtrw_nop,
            'luas_tanah'    => $request->luas_tanah,
            'njop_tanah'    => 0,
            'luas_bangunan' => $request->luas_bangunan,
            'njop_bangunan' => 0,
            'hak_nilai_pasar'       => str_replace('.', '', $request->hak_nilai_pasar),
            'kode_jenis_perolehan'  => $request->kode_jenis_perolehan,
            'no_sertifikat'         => $request->no_sertifikat,
            'npop'          => 0,
            'npoptkp'       => 0,
            'npopkp'        => 0,
            'jumlah_bphtb'        => 0,
            'status_pembayaran' => STATUS_PEMBAYARAN_BELUM_BAYAR,
            'status_bphtb'      => STATUS_BPHTB_BELUM_VERIFIKASI,
            'created_by'        => Auth::user()->nama,
        ];

        $tgl = date('ymd_His');

        // copy ktp from user to bphtb
        $from = public_path() . '/upload/berkas_ktp/' . $profil->berkas_ktp;
        $file_name_new = 'bphtb_' . $tgl . '_copy_' . $profil->berkas_ktp;
        $to = public_path() . '/upload/berkas_ktp/' . $file_name_new;
        File::copy($from, $to);
        $data['berkas_ktp'] = $file_name_new;

        if ($request->has('berkas_sertifikat')) {
            $berkas_sertifikat    = $request->file('berkas_sertifikat');
            $ekstensi       = $request->file('berkas_sertifikat')->getClientOriginalExtension();
            $file_name_ori = $request->file('berkas_sertifikat')->getClientOriginalName();
            $file_name_ori = explode('.', $file_name_ori)[0];
            $nama_berkas_sertifikat    = str_replace(" ", "_", $file_name_ori);
            $nama_berkas_sertifikat    = $tgl . '_' . substr($nama_berkas_sertifikat, 0, 10) . '.' . $ekstensi;
            $berkas_sertifikat->move('upload/berkas_sertifikat/', $nama_berkas_sertifikat);
            $data['berkas_sertifikat'] = $nama_berkas_sertifikat;
        }

        if ($request->has('berkas_ajb')) {
            $berkas_ajb    = $request->file('berkas_ajb');
            $ekstensi       = $request->file('berkas_ajb')->getClientOriginalExtension();
            $file_name_ori = $request->file('berkas_ajb')->getClientOriginalName();
            $file_name_ori = explode('.', $file_name_ori)[0];
            $nama_berkas_ajb    = str_replace(" ", "_", $file_name_ori);
            $nama_berkas_ajb    = $tgl . '_' . substr($nama_berkas_ajb, 0, 10) . '.' . $ekstensi;
            $berkas_ajb->move('upload/berkas_ajb/', $nama_berkas_ajb);
            $data['berkas_ajb'] = $nama_berkas_ajb;
        }

        $insert = BphtbModel::create($data);

        // 
        // DB::transaction(function () use ($data, $nop, $dari_nik, $kepada_nik) {

        //     $update = NopPbbModel::where('nop', $nop)->where('nik', $dari_nik)->update(['nik' => $kepada_nik]);
        // });
        // Logs 
        // $peralihan  = PeralihanNopModel::latest()->first();
        // $keg        = '#Membuat BPHTB Nomor : ' . $peralihan->no_formulir
        //     . ' #NPOP : ' . $peralihan->nop . ' #kepada WP NIK : ' . $peralihan->kepada_nik . ' #Jumlah : ' . $peralihan->jumlah_setor;
        // $this->simpanLogs(LOGS_PERALIHAN, 99, $keg);
        // .Logs


        return back()->with('success', 'Pengajuan BPHTB Anda akan ditinjau oleh pihak yang terkait! Mohon menunggu admin memverifikasi data Anda!');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'letak_nop'     => 'required',
            'kode_kab_nop'  => 'required',
            'kode_kec_nop'  => 'required',
            'kode_desa_nop' => 'required',
            'kode_jenis_perolehan'  => 'required',
            'no_sertifikat' => 'required',
            'luas_tanah'    => 'required',
            'luas_bangunan' => 'required',
            'hak_nilai_pasar'   => 'required',
        ];

        if ($request->has('berkas_sertifikat')) {
            $rules['berkas_sertifikat'] = 'required|file|mimes:jpg,png,jpeg|max:1024';
        }

        if ($request->has('berkas_ajb')) {
            $rules['berkas_ajb'] = 'required|file|mimes:jpg,png,jpeg|max:1024';
        }

        $request->validate($rules);

        $kode_desa_nop = $request->kode_desa_nop;

        $dev_prov = SettingDefaultModel::whereNamaSettingDefault('default_provinsi')->first()->kode_setting_default;

        $data = [
            'letak_nop'     => $request->letak_nop,
            'kode_prov_nop' => $dev_prov,
            'kode_kab_nop'  => $request->kode_kab_nop,
            'kode_kec_nop'  => $request->kode_kec_nop,
            'letak_nop'     => $request->letak_nop,
            'kode_desa_nop' => $kode_desa_nop,
            'rtrw_nop'      => $request->rtrw_nop,
            'luas_tanah'    => $request->luas_tanah,
            'luas_bangunan' => $request->luas_bangunan,
            'hak_nilai_pasar'       => str_replace('.', '', $request->hak_nilai_pasar),
            'kode_jenis_perolehan'  => $request->kode_jenis_perolehan,
            'no_sertifikat'         => $request->no_sertifikat,
            'updated_by'        => Auth::user()->nama
        ];

        $tgl = date('ymd_His');
        $update = BphtbModel::whereId($id);

        if ($request->has('berkas_sertifikat')) {
            // hapus file lama
            $filename = public_path() . '/upload/berkas_sertifikat/' . $update->first()->berkas_sertifikat;
            File::delete($filename);

            $berkas_sertifikat    = $request->file('berkas_sertifikat');
            $ekstensi       = $request->file('berkas_sertifikat')->getClientOriginalExtension();
            $file_name_ori = $request->file('berkas_sertifikat')->getClientOriginalName();
            $file_name_ori = explode('.', $file_name_ori)[0];
            $nama_berkas_sertifikat    = str_replace(" ", "_", $file_name_ori);
            $nama_berkas_sertifikat    = $tgl . '_' . substr($nama_berkas_sertifikat, 0, 10) . '.' . $ekstensi;
            $berkas_sertifikat->move('upload/berkas_sertifikat/', $nama_berkas_sertifikat);
            $data['berkas_sertifikat'] = $nama_berkas_sertifikat;
        }

        if ($request->has('berkas_ajb')) {
            // hapus file lama
            $filename = public_path() . '/upload/berkas_ajb/' . $update->first()->berkas_ajb;
            File::delete($filename);

            $berkas_ajb    = $request->file('berkas_ajb');
            $ekstensi       = $request->file('berkas_ajb')->getClientOriginalExtension();
            $file_name_ori = $request->file('berkas_ajb')->getClientOriginalName();
            $file_name_ori = explode('.', $file_name_ori)[0];
            $nama_berkas_ajb    = str_replace(" ", "_", $file_name_ori);
            $nama_berkas_ajb    = $tgl . '_' . substr($nama_berkas_ajb, 0, 10) . '.' . $ekstensi;
            $berkas_ajb->move('upload/berkas_ajb/', $nama_berkas_ajb);
            $data['berkas_ajb'] = $nama_berkas_ajb;
        }

        $update->update($data);

        // 
        // DB::transaction(function () use ($data, $nop, $dari_nik, $kepada_nik) {

        //     $update = NopPbbModel::where('nop', $nop)->where('nik', $dari_nik)->update(['nik' => $kepada_nik]);
        // });
        // Logs 
        // $peralihan  = PeralihanNopModel::latest()->first();
        // $keg        = '#Membuat BPHTB Nomor : ' . $peralihan->no_formulir
        //     . ' #NPOP : ' . $peralihan->nop . ' #kepada WP NIK : ' . $peralihan->kepada_nik . ' #Jumlah : ' . $peralihan->jumlah_setor;
        // $this->simpanLogs(LOGS_PERALIHAN, 99, $keg);
        // .Logs


        return redirect()->route('wp.bphtb-temp.show', ['id' => $id])->with('success', 'Transaksi BPHTB telah disimpan');
    }

    public function delete($id)
    {
        $bphtb = BphtbModel::whereId($id)->whereNik(ProfilModel::select('nik')->whereUserId(Auth::id())->first()->nik);

        if ($bphtb->count() == 0) {
            return back()->with('error', 'Data gagal dihapus!');
        }

        try {
            $bphtb->update(['deleted_by' => Auth::user()->nama]);
            $bphtb->delete();

            return redirect()->route('wp.bphtb')->with('success', 'Data telah dihapus!');
        } catch (Throwable $th) {
            dd($th);
        }
    }

    public function upload_bukti_show($id)
    {
        $data = BphtbModel::whereId($id)->whereNik(Auth::user()->nik)->first();

        if ($data == null) {
            return redirect()->route('wp.bphtb')->with('error', 'Tidak dapat mengambil data!');
        }

        $bread = 'BPHTB | Pembayaran';
        $tittle     = 'Upload Pembayaran BPHTB';
        $menu_home  = true;

        return view('bphtb.wp.bphtb_pembayaran_s', compact(
            'data',
            'bread',
            'tittle',
            'menu_home',
        ));
    }

    public function upload_bukti_store(Request $request, $id)
    {
        $rules = [
            'berkas_bukti_pembayaran' => 'required|file|mimes:png,jpg,jpeg|max:1024'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->with('route', route('wp.bphtb.pembayaran.show', ['id' => $id]))->withErrors($validator);
        }

        try {
            if ($request->hasFile('berkas_bukti_pembayaran')) {

                $berkas = $request->file('berkas_bukti_pembayaran');
                $tgl            = date('ymd_His');
                $ext = $request->file('berkas_bukti_pembayaran')->getClientOriginalExtension();
                $file_name_ori = $request->file('berkas_bukti_pembayaran')->getClientOriginalName();
                $file_name_ori = explode('.', $file_name_ori)[0];
                $nama_asli      = str_replace(" ", "_", $file_name_ori);
                $nama_asli      = substr($nama_asli, 0, 80);
                $nama_berkas    = $tgl . '_' . $nama_asli . '.' . $ext;

                $berkas->move('upload/berkas_bukti_pembayaran', $nama_berkas); // Pindahin kedalam folder 

                BphtbModel::whereId($id)->update([
                    'berkas_bukti_pembayaran' => $nama_berkas
                ]);

                return redirect()->route('wp.bphtb')->with('success', 'Bukti pembayaran telah di upload, harap menunggu admin memverifikasinya!');
            }
        } catch (Throwable $th) {
            dd($th);
        }
    }
}
