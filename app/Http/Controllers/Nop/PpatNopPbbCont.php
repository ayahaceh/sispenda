<?php

namespace App\Http\Controllers\Nop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Exports\PpatNopPbbExport;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\KecModel;
use App\Models\Setting\SettingDefaultModel;
use App\Models\ProfilModel;
use App\Models\Referensi\JenisPerolehanModel;
use App\Models\Temp\NopPbbTempModel;
use App\Models\NopPbbModel;

use App\Models\Tarif\NpopTkpModel;
use App\Models\Tarif\TarifBphtbModel;
use App\Models\PeralihanNopModel;
// use App\Http\Requests\ProfilVal;
// use App\Http\Requests\ProfilUpdateVal;
// use App\Models\Alamat\ProvModel;
// use App\Models\Alamat\DesaModel;
use File;
use Illuminate\Support\Facades\Auth;
use Image;
use Maatwebsite\Excel\Facades\Excel;

// use Validator;

class PpatNopPbbCont extends Controller
{

    public function index(Request $request)
    {
        $kode_ppat  = Auth::user()->kode_ppat;
        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = NopPbbTempModel::with(['joinKab', 'joinKec', 'joinDesa', 'joinProfilTemp'])
                ->where('kode_ppat', $kode_ppat)
                ->whereHas('joinProfilTemp', function ($query) use ($keyword) {
                    $query->where('nama', 'LIKE', '%' . $keyword . '%');
                    $query->orWhere('nik', 'LIKE', '%' . $keyword . '%');
                })
                ->whereHas('joinKab', function ($query) use ($keyword) {
                    $query->where('nama_kab', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhereHas('joinKec', function ($query) use ($keyword) {
                    $query->where('nama_kec', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhereHas('joinDesa', function ($query) use ($keyword) {
                    $query->where('nama_desa', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhereHas('joinProfilTemp', function ($query) use ($keyword) {
                    $query->where('nama', 'LIKE', '%' . $keyword . '%');
                    $query->orWhere('nik', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhere('nop_pbb_temp.nop', 'LIKE',  '%' . $keyword . '%')
                ->paginate(20);
        } else {
            $data = NopPbbTempModel::whereKodePpat($kode_ppat)
                ->with(['joinProfil'])
                ->paginate(20);
        }
        // Ambil data lainya
        $bread          = 'Home | NOP PBB';
        $tittle         = 'Daftar NOP PBB';
        $menu_nop_pbb   = true;
        $menu_bphtb_group = true;

        return view('nop_pbb.ppat.ppat_nop_pbb_belum_valid_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_nop_pbb',
            'menu_bphtb_group',
        ));
    }

    public function create()
    {
        // ambil data default prov, kab, kota
        $defaultKab     = SettingDefaultModel::where('nama_setting_default', 'default_kabupaten')->first();
        $dataKab        = KabModel::where('kode_kab', $defaultKab->kode_setting_default)->first();
        $dataKec        = KecModel::where('kode_kec', 'LIKE',  $defaultKab->kode_setting_default . '.' . '%')->get();
        $dataProfil     = ProfilModel::where('status_profil', STATUS_PROFIL_VALID)->get();
        $dataJenisPerolehan    = JenisPerolehanModel::all();
        // Ambil data lainya
        $bread          = 'Home | NOP PBB | Tambah';
        $tittle         = 'Buat NOP PBB Baru';
        $menu_nop_pbb   = true;
        $menu_bphtb_group = true;
        return view('nop_pbb.ppat.ppat_nop_pbb_a', compact(
            'dataKec',
            'dataKab',
            // 'dataProfil',
            'dataJenisPerolehan',

            'bread',
            'tittle',
            'menu_nop_pbb',
            'menu_bphtb_group',
        ));
    }

    public function store(Request $request)
    {
        // dd($request);
        $userGroup = Auth()->user()->user_group;
        $kodePPAT  = Auth()->user()->kode_ppat;
        try {
            $data                           = new NopPbbTempModel;
            $data->nik                      = $request->profil_id;
            $data->nop                      = $request->nop;
            $data->letak                    = $request->letak;
            $data->rtrw                     = $request->rtrw;
            $data->kode_prov                = '11';
            $data->kode_kab                 = $request->kode_kab;
            $data->kode_kec                 = $request->kode_kec;
            $data->kode_desa                = $request->kode_desa;
            $data->kode_jenis_perolehan     = $request->kode_jenis_perolehan;
            $data->no_sertifikat            = $request->no_sertifikat;
            $data->luas_tanah               = clear_numeric($request->luas_tanah);
            $data->njop_tanah               = clear_numeric($request->njop_tanah);
            $data->luas_bangunan            = clear_numeric($request->luas_bangunan);
            $data->njop_bangunan            = clear_numeric($request->njop_bangunan);
            $data->hak_nilai_pasar          = clear_numeric($request->hak_nilai_pasar);
            $data->status_nop_pbb           = STATUS_NOP_DIAJUKAN;
            if ($userGroup == USER_PPAT) {
                $data->kode_ppat            = $kodePPAT;
            }
            $data->created_by               = session()->get('datauser')->nama;
            $data->created_at               = now();
            $data->save();

            return redirect()->route('ppat.nop.pbb')->with('success', 'Profil telah disimpan!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function edit($id)
    {
        $kodePPAT   = Auth::user()->kode_ppat;
        $data       = NopPbbTempModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        } elseif ($data->kode_ppat != $kodePPAT) {
            return redirect()->route('notfound')->with('error', 'Profil tidak ditemukan!');
        }
        // ambil data default prov, kab, kota
        $defaultKab     = SettingDefaultModel::where('nama_setting_default', 'default_kabupaten')->first();
        $dataKab        = KabModel::where('kode_kab', $defaultKab->kode_setting_default)->first();
        $dataKec        = KecModel::where('kode_kec', 'LIKE',  $defaultKab->kode_setting_default . '.' . '%')->get();
        // ambil data prov, kab, kota
        $dataJenisPerolehan    = JenisPerolehanModel::all();
        // Ambil data lainya
        $bread  = 'Home | NOP PBB | Edit';
        $tittle = 'Edit NOP PBB';
        $menu_profil = true;
        $menu_bphtb_group = true;

        return view('nop_pbb.ppat.ppat_nop_pbb_e', compact(
            'id',
            'data',
            'dataKab',
            'dataKec',
            'dataJenisPerolehan',
            'bread',
            'tittle',
            'menu_profil',
            'menu_bphtb_group',
        ));
    }

    public function update(Request $request, $id)
    {
        // $data    = NopPbbTempModel::find($id);
        try {
            $data                           = NopPbbTempModel::find($id);
            if (empty($data)) {
                return redirect()->route('notfound')->with('error', 'NOP PBB tidak ditemukan!');
            }
            $data->nop                      = $request->nop;
            $data->letak                    = $request->letak;
            $data->rtrw                     = $request->rtrw;
            $data->kode_prov                = $request->kode_prov;
            $data->kode_kab                 = $request->kode_kab;
            $data->kode_kec                 = $request->kode_kec;
            $data->kode_desa                = $request->kode_desa;
            $data->kode_jenis_perolehan     = $request->kode_jenis_perolehan;
            $data->no_sertifikat            = $request->no_sertifikat;
            $data->luas_tanah               = clear_numeric($request->luas_tanah);
            $data->njop_tanah               = clear_numeric($request->njop_tanah);
            $data->luas_bangunan            = clear_numeric($request->luas_bangunan);
            $data->njop_bangunan            = clear_numeric($request->njop_bangunan);
            $data->hak_nilai_pasar          = clear_numeric($request->hak_nilai_pasar);
            $data->status_nop_pbb           = STATUS_NOP_DIAJUKAN;
            if (session()->get('datauser')->user_group == USER_PPAT) {
                $data->kode_ppat            = session()->get('datauser')->kode_ppat;
            }
            $data->updated_by               = session()->get('datauser')->nama;
            $data->updated_at               = now();
            $data->save();

            return redirect()->route('ppat.nop.pbb')->with('success', 'NOP PBB telah diperbaharui!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function show($id)
    {
        $kodePPAT   = Auth::user()->kode_ppat;
        $data       = NopPbbTempModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('gagal', 'NOP PBB tidak ditemukan!');
        } elseif ($data->kode_ppat != $kodePPAT) {
            return redirect()->route('notfound')->with('gagal', 'NOP PBB tidak ditemukan!');
        }
        // Ambil data lainya
        $bread  = 'Home | NOP PBB';
        $tittle = 'Lihat NOP PBB';
        $menu_profil = true;
        $menu_bphtb_group = true;

        return view('nop_pbb.ppat.ppat_nop_pbb_belum_valid_v', compact(
            'data',
            'bread',
            'tittle',
            'menu_profil',
            'menu_bphtb_group',
        ));
    }

    public function hapus($id)
    {
        $kodePPAT   = Auth::user()->kode_ppat;
        $data       = NopPbbTempModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('gagal', 'Data NOP PBB tidak ditemukan!');
        } elseif ($data->kode_ppat != $kodePPAT) {
            return redirect()->route('notfound')->with('gagal', 'NOP PBB tidak ditemukan!');
        } else {
            $data->deleted_by   = session()->get('datauser')->nama;
            $data->deleted_at   = now();
            $data->save();
        }
        return redirect()->route('ppat.nop.pbb')->with('Sukses', 'Data NOP PBB telah dihapus!');
    }

    public function getDataNopPbb($no_nik)
    {
        $join = NopPbbTempModel::where('nik', $no_nik)->get();
        return response()->json($join);
    }

    public function getTampilanNopPbb($no_nop, $nik = '')
    {
        // ambil data NOP PBB
        $nop_pbb = NopPbbTempModel::join('desa', 'desa.kode_desa', 'nop_pbb.kode_desa')
            ->join('kec', 'kec.kode_kec', 'nop_pbb.kode_kec')
            ->join('kab', 'kab.kode_kab', 'nop_pbb.kode_kab')
            ->join('prov', 'prov.kode_prov', 'nop_pbb.kode_prov')
            ->join('profil', 'profil.nik', 'nop_pbb.nik')
            ->where('nop_pbb.nop', $no_nop)
            ->first(['nop_pbb.*', 'nama_desa', 'nama_kec', 'nama_kab', 'nama_prov']);

        $jl_luas_tanah = (float) $nop_pbb->luas_tanah * (float) $nop_pbb->njop_tanah;
        $jl_luas_bangunan = (float) $nop_pbb->luas_bangunan * (float) $nop_pbb->njop_bangunan;

        $njop_pbb = $jl_luas_tanah + $jl_luas_bangunan;

        $nilai_transaksi = (float) $nop_pbb->hak_nilai_pasar;

        $npop = ($njop_pbb > $nilai_transaksi) ? $njop_pbb : $nilai_transaksi;

        // cek NPOPTK tahun ini

        $dataCek = PeralihanNopModel::where('kepada_nik', $nik)
            ->whereYear('tgl_peralihan', now())
            ->count();

        if ($dataCek >= 1) {
            // ambil data tarif NOPTKP
            $npoptkp = NpopTkpModel::where('default', '0')->first('tarif_npop_tkp');
            $npoptkp = $npoptkp->tarif_npop_tkp;
        } else {
            $npoptkp = NpopTkpModel::where('default', '1')->first('tarif_npop_tkp');
            $npoptkp = $npoptkp->tarif_npop_tkp;
        }

        $npopkp = $npop - $npoptkp;

        // ambil tarif persen pajak BPHTP
        $tarif_bphtb = TarifBphtbModel::first(['persen_tarif_bphtb']);
        $tarif_bphtb = $tarif_bphtb->persen_tarif_bphtb;

        $bea_perolehan = $tarif_bphtb * $npopkp;

        $response = $nop_pbb;
        $response->njop_pbb = $njop_pbb;
        $response->npop = $npop;
        $response->npoptkp = $npoptkp;
        $response->npopkp = $npopkp;
        $response->tarif_bphtb = $tarif_bphtb;
        $response->bea_perolehan = $bea_perolehan;
        $response->no_urut = $this->getNoUrut($response->kode_desa);
        // merge response

        return response()->json($response);
    }


    public function getTarifNopPbb($no_nop)
    {
        // ambil data NOP PBB
        $join = NopPbbTempModel::join('desa', 'desa.kode_desa', 'nop_pbb.kode_desa')
            ->join('kec', 'kec.kode_kec', 'nop_pbb.kode_kec')
            ->join('kab', 'kab.kode_kab', 'nop_pbb.kode_kab')
            ->join('prov', 'prov.kode_prov', 'nop_pbb.kode_prov')
            ->where('nop', $no_nop)
            ->get(['nop_pbb.*', 'nama_desa', 'nama_kec', 'nama_kab', 'nama_prov',]);

        // ambil tarif persen pajak BPHTP
        $dataTarif = TarifBphtbModel::get(['persen_tarif_pbb']);

        // cek NPOPTK tahun ini
        $nik = $join[0]->nik;
        $dataCek = PeralihanNopModel::where('kepada_nik', $nik)
            ->whereYear('tgl_peralihan', now())
            ->count();

        if ($dataCek >= 1) {
            // ambil data tarif NOPTKP
            $npoptkp = NpopTkpModel::where('default', '0')->get('tarif_npop_tkp');
        } else {
            $npoptkp = NpopTkpModel::where('default', '1')->get('tarif_npop_tkp');
        }

        return response()->json($join);
    }

    //ambil semua nop kecuali yang milik nik
    public function getNopAutoComplete(Request $request, $nik)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = NopPbbModel::select('nop_pbb.*', 'profil.nama')
                ->join('profil', 'profil.nik', 'nop_pbb.nik')
                ->where('profil.status_profil', STATUS_PROFIL_VALID)
                ->where('nop_pbb.nik', '<>', $nik)
                ->where('nop_pbb.kode_ppat', Auth::user()->kode_ppat)
                ->where(function ($query) use ($search) {
                    $query->where('nop_pbb.nop', 'LIKE', "%$search%")
                        ->orwhere('nop_pbb.nik', 'LIKE', "%$search%")
                        ->orwhere('profil.nama', 'LIKE', "%$search%");
                })->get();
        }
        return response()->json($data);
    }


    private function getNoUrut($kode_desa)
    {

        $peralihan = PeralihanNopModel::whereRaw('SUBSTRING(no_b,5,13)=?', [$kode_desa])
            ->orderByDesc(DB::raw('SUBSTRING(no_b,19,5)'))->first();

        if ($peralihan != null) {
            $temp_no_b  = explode('.', $peralihan->no_b);
            $no_b       = $temp_no_b[count($temp_no_b) - 1];
            $no_b       = (int) $no_b + 1;
            $length     = strlen($no_b);

            for ($i = $length + 1; $i <= 5; $i++) {
                $no_b = '0' . $no_b;
            }
        } else {
            $no_b = '00001';
        }
        return '109.' . $kode_desa . '.' . $no_b;
    }

    public function export()
    {
        $file_name = 'Data NOP PBB ' . date('Ymd_His') . ' - Export by ' . env('APP_NAME') . '.xlsx';
        return Excel::download(new PpatNopPbbExport, $file_name);
    }

    public function nop_valid(Request $request)
    {
        $kode_ppat  = Auth::user()->kode_ppat;
        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = NopPbbModel::with(['joinKab', 'joinKec', 'joinDesa', 'joinProfil'])
                ->where('kode_ppat', $kode_ppat)
                ->whereHas('joinProfil', function ($query) use ($keyword) {
                    $query->where('nama', 'LIKE', '%' . $keyword . '%');
                    $query->orWhere('nik', 'LIKE', '%' . $keyword . '%');
                })
                ->whereHas('joinKab', function ($query) use ($keyword) {
                    $query->where('nama_kab', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhereHas('joinKec', function ($query) use ($keyword) {
                    $query->where('nama_kec', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhereHas('joinDesa', function ($query) use ($keyword) {
                    $query->where('nama_desa', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhereHas('joinProfil', function ($query) use ($keyword) {
                    $query->where('nama', 'LIKE', '%' . $keyword . '%');
                    $query->orWhere('nik', 'LIKE', '%' . $keyword . '%');
                })
                ->orWhere('nop_pbb.nop', 'LIKE',  '%' . $keyword . '%')
                ->paginate(20);
        } else {
            $data = NopPbbModel::with(['joinProfil'])
                ->whereKodePpat($kode_ppat)
                ->paginate(20);
        }
        // Ambil data lainya
        $bread          = 'Home | NOP PBB';
        $tittle         = 'Daftar NOP PBB';
        $menu_nop_pbb   = true;
        $menu_bphtb_group = true;

        return view('nop_pbb.ppat.ppat_nop_pbb_valid_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_nop_pbb',
            'menu_bphtb_group',
        ));
    }

    public function nop_valid_lihat($id)
    {
        $kodePPAT   = Auth::user()->kode_ppat;
        $data       = NopPbbModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('gagal', 'NOP PBB tidak ditemukan!');
        } elseif ($data->kode_ppat != $kodePPAT) {
            return redirect()->route('notfound')->with('gagal', 'NOP PBB tidak ditemukan!');
        }
        // Ambil data lainya
        $bread      = 'Home | NOP PBB';
        $tittle     = 'Lihat NOP PBB';
        $menu_profil        = true;
        $menu_bphtb_group   = true;

        return view('nop_pbb.ppat.ppat_nop_pbb_valid_v', compact(
            'data',
            'bread',
            'tittle',
            'menu_profil',
            'menu_bphtb_group',
        ));
    }


    //--
}
