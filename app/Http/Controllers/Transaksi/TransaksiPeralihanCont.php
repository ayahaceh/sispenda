<?php

namespace App\Http\Controllers\Transaksi;

use App\Exports\PeralihanNopExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransaksiPeralihan;
use App\Models\PeralihanNopModel;
use App\Models\Referensi\JenisPerolehanModel;
use App\Models\NopPbbModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Referensi\RekeningModel;
use App\Http\Traits\LogsTrait;

// use App\Models\Referensi\UrutStpdModel;
// use App\Models\Tarif\TarifNjopModel;
// use App\Models\Alamat\ProvModel;
// use App\Models\Alamat\KabModel;
// use App\Models\Alamat\KecModel;
// use App\Models\Alamat\DesaModel;

class TransaksiPeralihanCont extends Controller
{
    use LogsTrait;
    public function index(Request $request)
    {
        if ($request->has('aktif')) {
            $aktif = $request->aktif == 'Y' ? true : false;
        } else {
            $aktif = true;
        }

        if ($request->has('cari')) {

            $keyword    = $request->cari;
            $data       = PeralihanNopModel::select('peralihan_nop.*')
                ->join('profil AS baru', 'baru.nik', 'peralihan_nop.kepada_nik')
                ->leftJoin('profil AS lama', 'lama.nik', 'peralihan_nop.dari_nik')
                ->leftJoin('nop_pbb', 'nop_pbb.nop', 'peralihan_nop.nop')
                ->leftJoin('kec', 'kec.kode_kec', 'nop_pbb.kode_kec')
                ->leftJoin('desa', 'desa.kode_desa', 'nop_pbb.kode_desa')
                ->where(function ($query) use ($keyword) {
                    $query->where('desa.nama_desa', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('kec.nama_kec', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('peralihan_nop.nop', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('baru.nama', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('lama.nama', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('peralihan_nop.dari_nik', 'LIKE',  '%' . $keyword . '%')
                        ->orWhere('peralihan_nop.kepada_nik', 'LIKE',  '%' . $keyword . '%');
                });

            if (!$aktif) {
                $data = $data->onlyTrashed();
            }

            $data = $data->orderByDesc('peralihan_nop.id')->paginate(20);

            $clearButton    = true;
        } else {
            $data           = PeralihanNopModel::select('peralihan_nop.*')->join('profil AS p', 'p.nik', 'peralihan_nop.kepada_nik')->orderByDesc('peralihan_nop.id');

            if (!$aktif) {
                $data = $data->onlyTrashed();
            }

            $data = $data->orderByDesc('peralihan_nop.id')->paginate(20);

            $clearButton    = false;
            $keyword        = '';
        }

        $bread          = 'Home | Transaksi | BPHTB';
        $tittle         = 'Daftar Transaksi BPHTB';
        $menu_bphtb_group     = true;
        $menu_trans_bphtb = true;
        $aktif = $aktif ? 'Y' : 'N';

        return view('transaksi.trans_peralihan_l', compact(
            'data',
            'clearButton',
            'keyword',
            'bread',
            'tittle',
            'aktif',
            'menu_bphtb_group',
            'menu_trans_bphtb',
        ));
    }

    public function create()
    {
        $ref_rekening = RekeningModel::all();
        $dataJenisPerolehan    = JenisPerolehanModel::all();
        // Ambil data lainya
        $bread          = 'Home | Transaksi | BPHTB';
        $tittle         = 'Daftar Transaksi BPHTB';
        $menu_bphtb_group     = true;
        $menu_trans_bphtb = true;


        return view('transaksi.trans_peralihan_a', compact(
            'dataJenisPerolehan',
            'ref_rekening',
            'bread',
            'tittle',
            'menu_bphtb_group',
            'menu_trans_bphtb',
        ));
    }

    public function find($id)
    {
        $result = PeralihanNopModel::where('id', $id)->first();
        $nama_dari_nik = $result->joinProfilDari->nama;
        $nama_kepada_nik = $result->joinProfilKepada->nama;
        $alamat_kepada_nik = $result->joinProfilKepada->alamat;
        $desa_kepada_nik = $result->joinProfilKepada->joinDesa->nama_desa;
        $desa_kepada_nik = $result->joinProfilKepada->joinDesa->nama_desa;
        $kec_kepada_nik = $result->joinProfilKepada->joinKec->nama_kec;
        $kab_kepada_nik = $result->joinProfilKepada->joinKab->nama_kab;

        $result->nama_dari_nik = $nama_dari_nik;
        $result->nama_kepada_nik = $nama_kepada_nik;
        $result->alamat_kepada_nik = $alamat_kepada_nik;
        $result->desa_kepada_nik = $desa_kepada_nik;
        $result->kec_kepada_nik = $kec_kepada_nik;
        $result->kab_kepada_nik = $kab_kepada_nik;

        return response()->json($result);
    }

    public function edit($id)
    {
        $ref_rekening = RekeningModel::all();
        $bread          = 'Home | Lihat | BPHTB';
        $tittle         = 'Lihat BPHTB';
        $menu_bphtb_group     = true;
        $menu_trans_bphtb = true;

        $cek = PeralihanNopModel::where('id', $id)->onlyTrashed()->get();
        if (count($cek) > 0) {
            $is_deleted = true;
        } else {
            $is_deleted = false;
        }
        return view('transaksi.trans_peralihan_e', compact(
            'id',
            'bread',
            'tittle',
            'ref_rekening',
            'is_deleted',
            'menu_bphtb_group',
            'menu_trans_bphtb',
        ));
    }

    public function update(TransaksiPeralihan $request, $id)
    {
        $validated      = $request->validated();
        $result         = PeralihanNopModel::find($id);
        $opsi_b_lama    = $result->opsi_b;
        $dari_nik_lama  = $result->dari_nik;

        $form = ['nop', 'npop', 'npoptkp', 'npopkp', 'jumlah', 'jumlah_setor', 'tgl_setor', 'nama_penyetor', 'status_transaksi', 'tgl_peralihan', 'no_rekening_bank'];
        $opsi_selected = $request->input('customRadio');

        if ($opsi_selected == 'opsi_a') {
            $form_opsi = [];
        } else if ($opsi_selected == 'opsi_b') {
            $form_opsi = ['no_b', 'tgl_b'];
        } else if ($opsi_selected == 'opsi_c') {
            $form_opsi = ['persen_c', 'uraian_c'];
        } else if ($opsi_selected == 'opsi_d') {
            $form_opsi = ['uraian_d'];
        }

        $form = array_merge($form, $form_opsi);
        $data = $request->only($form);

        $data['npop']           = str_replace('.', '', $data['npop']);
        $data['npoptkp']        = str_replace('.', '', $data['npoptkp']);
        $data['npopkp']         = str_replace('.', '', $data['npopkp']);
        $data['jumlah']         = str_replace('.', '', $data['jumlah']);
        $data['jumlah_setor']   = str_replace('.', '', $data['jumlah_setor']);

        $nop = $data['nop'];

        $result_nop = NopPbbModel::where('nop', $nop);

        if ($result_nop->count() > 0) {

            $result_nop     = $result_nop->first();
            $dari_nik       = $result_nop->nik;
            $kepada_nik     = $request->input('profil_id');
            $data = array_merge($data, [
                'dari_nik' => $dari_nik,
                'kepada_nik' => $kepada_nik
            ]);

            $data['kode_jenis_perolehan'] = $result_nop->kode_jenis_perolehan;
            $kode_desa = $result_nop->kode_desa;


            if ($opsi_selected == 'opsi_a') {
                $data['opsi_a'] = 'Y';
                $data['opsi_b'] = 'T';
                $data['opsi_c'] = 'T';
                $data['opsi_d'] = 'T';

                $data['no_b'] = '';
                $data['tgl_b'] = '';
                $data['persen_c'] = '';
                $data['uraian_c'] = '';
                $data['uraian_d'] = '';
            } else if ($opsi_selected == 'opsi_b') {
                $data['opsi_a'] = 'T';
                $data['opsi_b'] = 'Y';
                $data['opsi_c'] = 'T';
                $data['opsi_d'] = 'T';

                if ($opsi_b_lama == 'Y') {
                } else {
                    $data['no_b'] = $this->getNoUrut($kode_desa);
                }

                $data['persen_c'] = '';
                $data['uraian_c'] = '';
                $data['uraian_d'] = '';
            } else if ($opsi_selected == 'opsi_c') {
                $data['opsi_a'] = 'T';
                $data['opsi_b'] = 'T';
                $data['opsi_c'] = 'Y';
                $data['opsi_d'] = 'T';

                $data['no_b'] = '';
                $data['tgl_b'] = '';
                $data['uraian_d'] = '';
            } else if ($opsi_selected == 'opsi_d') {
                $data['opsi_a'] = 'T';
                $data['opsi_b'] = 'T';
                $data['opsi_c'] = 'T';
                $data['opsi_d'] = 'Y';

                $data['no_b'] = '';
                $data['tgl_b'] = '';
                $data['persen_c'] = '';
                $data['uraian_c'] = '';
            }

            // $data['no_rekening_bank']   = RekeningModel::where('status_rekening', 'Default')->first()->no_rekening;
            $data['approved_status']    = STATUS_BPHTB_BELUM_APPROVE;

            DB::transaction(function () use ($data, $nop, $dari_nik, $kepada_nik, $id) {

                PeralihanNopModel::where('id', $id)->update($data);
                NopPbbModel::where('nop', $nop)->where('nik', $dari_nik)->update(['nik' => $kepada_nik]);
                // Logs 
                $peralihan  = PeralihanNopModel::find($id);
                $keg        = '#Mengubah (edit) BPHTB Nomor : ' . $peralihan->no_formulir
                    . ' #NPOP : ' . $peralihan->nop . ' #kepada WP NIK : ' . $peralihan->kepada_nik . ' #Jumlah : ' . $peralihan->jumlah_setor;
                $this->simpanLogs(LOGS_PERALIHAN, $id, $keg);
                // .Logs
            });

            return redirect()->route('transaksi.peralihan')->with('success', 'Transaksi Peralihan di Update');
        } else {
            return redirect()->route('transaksi.peralihan')->with('failur', 'Nomer NOP tidak ditemukan');
        }
    }

    public function store(TransaksiPeralihan $request)
    {

        $validated = $request->validated();

        $form = ['nop', 'npop', 'npoptkp', 'npopkp', 'jumlah', 'jumlah_setor', 'tgl_setor', 'nama_penyetor', 'status_transaksi', 'tgl_peralihan', 'no_rekening_bank'];
        $opsi_selected = $request->input('customRadio');

        if ($opsi_selected == 'opsi_a') {
            $form_opsi = [];
        } else if ($opsi_selected == 'opsi_b') {
            $form_opsi = ['no_b', 'tgl_b'];
        } else if ($opsi_selected == 'opsi_c') {
            $form_opsi = ['persen_c', 'uraian_c'];
        } else if ($opsi_selected == 'opsi_d') {
            $form_opsi = ['uraian_d'];
        }
        $form = array_merge($form, $form_opsi);
        $data = $request->only($form);

        $data['npop']           = str_replace('.', '', $data['npop']);
        $data['npoptkp']        = str_replace('.', '', $data['npoptkp']);
        $data['npopkp']         = str_replace('.', '', $data['npopkp']);
        $data['jumlah']         = str_replace('.', '', $data['jumlah']);
        $data['jumlah_setor']   = str_replace('.', '', $data['jumlah_setor']);

        $nop        = $data['nop'];
        $result_nop = NopPbbModel::where('nop', $nop);

        if ($result_nop->count() > 0) {
            $result_nop = $result_nop->first();
            $dari_nik   = $result_nop->nik;
            $kodePPAT   = $result_nop->kode_ppat;
            $kepada_nik = $request->input('profil_id');

            $data = array_merge($data, [
                'dari_nik'      => $dari_nik,
                'kepada_nik'    => $kepada_nik
            ]);

            $data['kode_jenis_perolehan']   = $result_nop->kode_jenis_perolehan;
            $kode_desa                      = $result_nop->kode_desa;


            if ($opsi_selected == 'opsi_a') {
                $data['opsi_a'] = 'Y';
                $data['opsi_b'] = 'T';
                $data['opsi_c'] = 'T';
                $data['opsi_d'] = 'T';
            } else if ($opsi_selected == 'opsi_b') {
                $data['opsi_a'] = 'T';
                $data['opsi_b'] = 'Y';
                $data['opsi_c'] = 'T';
                $data['opsi_d'] = 'T';

                // $data['no_b'] = $this->getNoUrut($kode_desa);
                $data['no_b'] = $request->no_b;
            } else if ($opsi_selected == 'opsi_c') {
                $data['opsi_a'] = 'T';
                $data['opsi_b'] = 'T';
                $data['opsi_c'] = 'Y';
                $data['opsi_d'] = 'T';
            } else if ($opsi_selected == 'opsi_d') {
                $data['opsi_a'] = 'T';
                $data['opsi_b'] = 'T';
                $data['opsi_c'] = 'T';
                $data['opsi_d'] = 'Y';
            }

            $data['no_formulir'] = $this->getNoFormulir();
            // $data['tgl_peralihan'] = now();
            // $data['status_transaksi'] = STATUS_TRANSAKSI_LUNAS;
            // $data['no_rekening_bank']   = RekeningModel::where('status_rekening', 'Default')->first()->no_rekening;
            $data['approved_status']    = STATUS_BPHTB_BELUM_APPROVE;
            $data['status_verifikasi']  = STATUS_PEMBAYARAN_SUDAH_VERIFIKASI;
            $data['kode_ppat']          = $kodePPAT;

            // 
            DB::transaction(function () use ($data, $nop, $dari_nik, $kepada_nik) {

                $insert = PeralihanNopModel::create($data);
                $update = NopPbbModel::where('nop', $nop)->where('nik', $dari_nik)->update(['nik' => $kepada_nik]);
            });
            // Logs 
            $peralihan  = PeralihanNopModel::latest()->first();
            $keg        = '#Membuat BPHTB Nomor : ' . $peralihan->no_formulir
                . ' #NPOP : ' . $peralihan->nop . ' #kepada WP NIK : ' . $peralihan->kepada_nik . ' #Jumlah : ' . $peralihan->jumlah_setor;
            $this->simpanLogs(LOGS_PERALIHAN, 99, $keg);
            // .Logs
            return redirect()->route('transaksi.peralihan')->with('success', 'Transaksi Peralihan disimpan');
        } else {
            return redirect()->route('transaksi.peralihan')->with('failur', 'Nomer NOP tidak ditemukan');
        }
    }

    private function getNoFormulir()
    {
        $peralihan = PeralihanNopModel::orderByDesc('no_formulir')->first(['no_formulir']);
        if ($peralihan != null) {

            $no_formulir = (int) $peralihan->no_formulir + 1;

            $length = strlen($no_formulir);


            for ($i = $length + 1; $i <= 5; $i++) {
                $no_formulir = '0' . $no_formulir;
            }

            return $no_formulir;
        } else {
            return '00001';
        }
    }

    private function getNoUrut($kode_desa)
    {

        $peralihan = PeralihanNopModel::whereRaw('SUBSTRING(no_b,5,14)=?', [$kode_desa])
            ->orderByDesc(DB::raw('SUBSTRING(no_b,19,5)'))->first();

        if ($peralihan != null) {
            $temp_no_b  = explode('.', $peralihan->no_b);
            $no_b       = $temp_no_b[count($temp_no_b) - 1];
            $no_b       = (int) $no_b + 1;
            $length     = strlen($no_b);

            for ($i     = $length + 1; $i <= 5; $i++) {
                $no_b   = '0' . $no_b;
            }
        } else {
            $no_b = '00001';
        }

        return '109.' . $kode_desa . '.' . $no_b;
    }

    public function export(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $file_name = 'Data Transaksi BPHTB dari ' . $start_date . ' sampai ' . $end_date . ' - Export by ' . env('APP_NAME') . '.xlsx';
        return Excel::download(new PeralihanNopExport($start_date, $end_date), $file_name);
    }

    public function hapus($id)
    {
        // Logs 
        $peralihan  = PeralihanNopModel::where('id', $id)->get();
        if (!empty($peralihan)) {
            $keg        = '#Menghapus BPHTB Nomor : ' . $peralihan->no_formulir
                . ' #NPOP : ' . $peralihan->nop . ' #kepada WP NIK : ' . $peralihan->kepada_nik . ' #Jumlah : ' . $peralihan->jumlah_setor;
            $this->simpanLogs(LOGS_PERALIHAN, $id, $keg);
        }
        // .Logs
        $delete = PeralihanNopModel::where('id', $id)->delete();

        if ($delete) {
            $response = ['result' => true, 'keterangan' => 'Data Peralihan berhasil di hapus'];
        } else {
            $response = ['result' => false, 'keterangan' => 'Data Peralihan gagal di hapus'];
        }
        session()->flash('success', 'Data Peralihan berhasil di hapus');
        return response()->json($response);
    }

    public function restore($id)
    {
        $restore = PeralihanNopModel::where('id', $id)->restore();
        // Logs 
        $peralihan  = PeralihanNopModel::where('id', $id)->get();
        if (!empty($peralihan)) {
            $keg        = '#Mengembalikan (Restore) data BPHTB Nomor : ' . $peralihan->no_formulir
                . ' #NPOP : ' . $peralihan->nop . ' #kepada WP NIK : ' . $peralihan->kepada_nik . ' #Jumlah : ' . $peralihan->jumlah_setor;
            $this->simpanLogs(LOGS_PERALIHAN, $id, $keg);
        }
        // .Logs
        if ($restore) {
            $response = ['result' => true, 'keterangan' => 'Data berhasil di restore'];
        } else {
            $response = ['result' => false, 'keterangan' => 'Data gagal di restore'];
        }

        session()->flash('success', 'Data Peralihan berhasil di hapus');
        return response()->json($response);
    }

    public function destroy_permanent($id)
    {
        // Logs 
        $peralihan  = PeralihanNopModel::where('id', $id)->get();
        if (!empty($peralihan)) {
            $keg        = '#Menghapus Permanen BPHTB Nomor : ' . $peralihan->no_formulir
                . ' #NPOP : ' . $peralihan->nop . ' #kepada WP NIK : ' . $peralihan->kepada_nik . ' #Jumlah : ' . $peralihan->jumlah_setor;
            $this->simpanLogs(LOGS_PERALIHAN, $id, $keg);
        }
        // .Logs
        $delete = PeralihanNopModel::where('id', $id)->forceDelete();
        if ($delete) {
            $response = ['result' => true, 'keterangan' => 'Data berhasil di hapus permanent'];
        } else {
            $response = ['result' => false, 'keterangan' => 'Data gagal di hapus permanent'];
        }

        return response()->json($response);
    }



    //--
}
