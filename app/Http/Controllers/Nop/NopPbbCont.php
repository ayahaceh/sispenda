<?php

namespace App\Http\Controllers\Nop;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\NopPbbExport;
use App\Http\Controllers\Controller;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\KecModel;
use App\Models\Setting\SettingDefaultModel;
use App\Models\NopPbbModel;
use App\Models\PeralihanNopModel;
use App\Models\ProfilModel;
use App\Models\Referensi\JenisPerolehanModel;
use App\Models\Tarif\NpopTkpModel;
use App\Models\Tarif\TarifBphtbModel;
use App\Models\Temp\NopPbbTempModel;
// use App\Http\Requests\ProfilVal;
// use App\Http\Requests\ProfilUpdateVal;
// use App\Models\Alamat\ProvModel;
// use App\Models\Alamat\DesaModel;
use File;
use Illuminate\Support\Facades\Auth;
use Image;
use Maatwebsite\Excel\Facades\Excel;

// use Validator;

class NopPbbCont extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = NopPbbModel::with(['joinKab', 'joinKec', 'joinDesa', 'joinProfil'])
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
                ->orderBy('id', 'DESC')
                ->paginate(20);
        } else {
            $data       = NopPbbModel::orderBy('id', 'DESC')->paginate(20);
        }

        // Ambil data lainya
        $bread          = 'Home | NOP PBB';
        $tittle         = 'Daftar NOP PBB';
        $menu_nop_pbb   = true;
        $menu_bphtb_group = true;

        return view('nop_pbb.nop_pbb_l', compact(
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
        return view('nop_pbb.nop_pbb_a', compact(
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
        try {
            $data                           = new NopPbbModel;
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
            $data->status_nop_pbb           = STATUS_NOP_AKTIF;
            if (session()->get('datauser')->user_group == USER_PPAT) {
                $data->kode_ppat            = session()->get('datauser')->kode_ppat;
            }
            $data->created_by               = session()->get('datauser')->nama;
            $data->created_at               = now();
            $data->save();

            return redirect()->route('nop.pbb')->with('success', 'Profil telah disimpan!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function edit($id)
    {
        $data    = NopPbbModel::find($id);
        if (empty($data)) {
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

        return view('nop_pbb.nop_pbb_e', compact(
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
        $data    = NopPbbModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('error', 'NOP PBB tidak ditemukan!');
        }
        // dd($request->nik_profile);
        try {
            $data                           = NopPbbModel::find($id);
            $data->nik                      = $request->nik_profile;
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
            $data->status_nop_pbb           = $request->status_nop_pbb;
            if (session()->get('datauser')->user_group == USER_PPAT) {
                $data->kode_ppat            = session()->get('datauser')->kode_ppat;
            }
            $data->updated_by               = session()->get('datauser')->nama;
            $data->updated_at               = now();
            $data->save();

            return redirect()->route('nop.pbb')->with('success', 'NOP PBB telah diperbaharui!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function show($id)
    {
        $data    = NopPbbModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('gagal', 'NOP PBB tidak ditemukan!');
        }
        // Ambil data lainya
        $bread  = 'Home | NOP PBB';
        $tittle = 'Lihat NOP PBB';
        $menu_profil = true;
        $menu_bphtb_group = true;

        return view('nop_pbb.nop_pbb_v', compact(
            'data',
            'bread',
            'tittle',
            'menu_profil',
            'menu_bphtb_group',
        ));
    }

    public function hapus($id)
    {
        $data    = NopPbbModel::find($id);
        if (empty($data)) {
            return redirect()->route('notfound')->with('gagal', 'Data NOP PBB tidak ditemukan!');
        } else {
            $data->deleted_by               = session()->get('datauser')->nama;
            $data->deleted_at               = now();
            $data->save();
        }
        return redirect()->route('nop.pbb')->with('Sukses', 'Data NOP PBB telah dihapus!');
    }


    public function getDataNopPbb($no_nik)
    {
        $join = NopPbbModel::where('nik', $no_nik)->get();
        return response()->json($join);
    }

    public function getTampilanNopPbb($no_nop, $nik = '')
    {
        // ambil data NOP PBB
        $nop_pbb = NopPbbModel::join('desa', 'desa.kode_desa', 'nop_pbb.kode_desa')
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

        $npopkp = ($npop - $npoptkp) >= 0 ? ($npop - $npoptkp) : 0;

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
        $join = NopPbbModel::join('desa', 'desa.kode_desa', 'nop_pbb.kode_desa')
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

        // $peralihan = PeralihanNopModel::whereRaw('SUBSTRING(no_b,6,12)=?', [$kode_desa])->first();
        $kode_desa_new = explode('.', $kode_desa)[2] . '.' . explode('.', $kode_desa)[3];

        $peralihan = PeralihanNopModel::whereRaw('SUBSTRING(no_b,6,7)=?', [$kode_desa_new])
            ->orderByDesc(DB::raw('SUBSTRING(no_b,14,5)'))
            ->whereYear('tgl_b', date('Y'))
            ->first();

        if ($peralihan != null) {

            $temp_no_b = explode('.', $peralihan->no_b);

            $no_b = $temp_no_b[count($temp_no_b) - 1];

            $no_b = (int) $no_b + 1;

            $length = strlen($no_b);


            for ($i = $length + 1; $i <= 5; $i++) {
                $no_b = '0' . $no_b;
            }
        } else {
            $no_b = '00001';
        }

        return '1.09.' . $kode_desa_new . '.' . $no_b;
        // return '109.' . $kode_desa . '.' . $no_b;
    }

    public function export()
    {
        $file_name = 'Data NOP PBB ' . date('Ymd_His') . ' - Export by ' . env('APP_NAME') . '.xlsx';
        return Excel::download(new NopPbbExport, $file_name);
    }

    public function verifikasi(Request $request)
    {
        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = NopPbbTempModel::with(['joinKab', 'joinKec', 'joinDesa', 'joinProfil'])
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
            $data       = NopPbbTempModel::paginate(20);
        }

        // Ambil data lainya
        $bread          = 'Home | NOP PBB | Baru';
        $tittle         = 'Daftar NOP PBB Baru';
        $menu_nop_pbb   = true;
        $menu_master_data = true;

        return view('nop_pbb.nop_pbb_verifikasi_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_nop_pbb',
            'menu_master_data',
        ));
    }

    public function verifikasiShow($id)
    {
        $data       = NopPbbTempModel::find($id);

        $bread          = 'Home | NOP PBB | Verifikasi';
        $tittle         = 'Verifikasi NOP PBB';
        $menu_profil    = true;
        $menu_master_data = true;

        return view('nop_pbb.nop_pbb_verifikasi_v', compact(
            'data',
            'bread',
            'tittle',
            'menu_profil',
            'menu_master_data',
        ));
    }

    public function verifikasiStore(Request $request)
    {
        $nop = NopPbbTempModel::whereNop($request->nop);

        if ($nop->count() == 1) {
            try {
                $nop = $nop->first();

                $data = new NopPbbModel;
                $data->nik = $nop->nik;
                $data->nop = $nop->nop;
                $data->letak = $nop->letak;
                $data->kode_prov = $nop->kode_prov;
                $data->kode_kec = $nop->kode_kec;
                $data->kode_kab = $nop->kode_kab;
                $data->kode_desa = $nop->kode_desa;
                $data->rtrw = $nop->rtrw;
                $data->luas_tanah = $nop->luas_tanah;
                $data->njop_tanah = $nop->njop_tanah;
                $data->luas_bangunan = $nop->luas_bangunan;
                $data->njop_bangunan = $nop->njop_bangunan;
                $data->kode_jenis_perolehan = $nop->kode_jenis_perolehan;
                $data->hak_nilai_pasar = $nop->hak_nilai_pasar;
                $data->no_sertifikat = $nop->no_sertifikat;
                $data->status_nop_pbb = $request->status;
                $data->kode_ppat = $nop->kode_ppat;
                $data->created_by = Auth::user()->nama;
                $data->save();

                $nop->delete();

                return redirect()->route('nop.pbb.verifikasi')->with('success', 'Data NOP PBB telah diverifikasi');
            } catch (\Throwable $th) {
                dd($th);
            }
        } else {
            return redirect()->back()->with('error', 'Data NOP PBB tidak ditemukan');
        }
    }
}
