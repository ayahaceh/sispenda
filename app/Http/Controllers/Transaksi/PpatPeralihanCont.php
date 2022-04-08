<?php

namespace App\Http\Controllers\Transaksi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\PeralihanNopModel;
use App\Exports\PpatPeralihanNopExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\TelegramTrait;
use Validator;
use App\Http\Traits\LogsTrait;
use App\Http\Requests\ValidateBuktiPembayaran;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\KecModel;
use App\Models\Alamat\ProvModel;
use App\Models\BphtbModel;
use App\Models\PenandatanganModel;
use App\Models\Referensi\JenisPerolehanModel;
use App\Models\Referensi\RekeningModel;
use App\Models\Setting\SettingDefaultModel;
use File;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Throwable;

// use App\Http\Requests\TransaksiPeralihan;
// use App\Models\Referensi\JenisPerolehanModel;
// use App\Models\Referensi\UrutStpdModel;
// use App\Models\Tarif\TarifNjopModel;
// use App\Models\Alamat\ProvModel;
// use App\Models\Alamat\KabModel;
// use App\Models\Alamat\KecModel;
// use App\Models\Alamat\DesaModel;
// use App\Models\NopPbbModel;
// use App\Models\Referensi\RekeningModel;
// use Illuminate\Support\Facades\DB;

class PpatPeralihanCont extends Controller
{
    use LogsTrait;
    use TelegramTrait;
    public function index(Request $request)
    {
        $kodePPAT   = Auth::user()->kode_ppat;
        if ($request->has('cari')) {
            $keyword = $request->cari;
            $data = BphtbModel::where('kode_ppat', $kodePPAT)
                ->where(function ($query) use ($keyword) {
                    $query->where('tgl_bphtb', 'like', "%{$keyword}%")
                        ->orWhere('nik', 'like', "%{$keyword}%")
                        ->orWhere('nama_wp', 'like', "%{$keyword}%")
                        ->orWhere('nop', 'like', "%{$keyword}%")
                        ->orWhere('letak_nop', 'like', "%{$keyword}%")
                        ->orWhereHas('joinKecNop', function ($query) use ($keyword) {
                            return $query->where('nama_kec', 'like', "%{$keyword}%");
                        })
                        ->orWhereHas('joinDesaNop', function ($query) use ($keyword) {
                            return $query->where('nama_desa', 'like', "%{$keyword}%");
                        });
                })
                ->orderByDesc('id')
                ->paginate(20);
        } else {
            $data = BphtbModel::where('kode_ppat', $kodePPAT)->orderByDesc('id')->paginate(20);
        }

        $bread          = 'PPAT | BPHTB | List';
        $tittle         = 'Daftar BPHTB';
        $menu_bphtb_group   = true;
        $menu_trans_bphtb   = true;

        return view('transaksi.ppat.bphtb_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_bphtb_group',
            'menu_trans_bphtb',
        ));
    }

    public function find($id)
    {
        $result             = PeralihanNopModel::where('id', $id)->first();
        $nama_dari_nik      = $result->joinProfilDari->nama;
        $nama_kepada_nik    = $result->joinProfilKepada->nama;
        $alamat_kepada_nik  = $result->joinProfilKepada->alamat;
        $desa_kepada_nik    = $result->joinProfilKepada->joinDesa->nama_desa;
        $desa_kepada_nik    = $result->joinProfilKepada->joinDesa->nama_desa;
        $kec_kepada_nik     = $result->joinProfilKepada->joinKec->nama_kec;
        $kab_kepada_nik     = $result->joinProfilKepada->joinKab->nama_kab;

        $result->nama_dari_nik      = $nama_dari_nik;
        $result->nama_kepada_nik    = $nama_kepada_nik;
        $result->alamat_kepada_nik  = $alamat_kepada_nik;
        $result->desa_kepada_nik    = $desa_kepada_nik;
        $result->kec_kepada_nik     = $kec_kepada_nik;
        $result->kab_kepada_nik     = $kab_kepada_nik;

        return response()->json($result);
    }

    public function show($id)
    {
        $kodePPAT   = Auth::user()->kode_ppat;
        $data = BphtbModel::find($id);

        if (empty($data)) {
            return back()->with('error', 'Data tidak ditemukan!');
        } elseif ($data->kode_ppat != $kodePPAT) {
            return back()->with('error', 'Data tidak ditemukan!');
        }

        $bread          = 'Home | Transaksi | BPHTB | Detail';
        $tittle         = 'Detail Transaksi BPHTB';
        $menu_bphtb_group   = true;
        $menu_bphtb         = true;

        return view('transaksi.ppat.bphtb_v', compact(
            'data',
            'bread',
            'tittle',
            'menu_bphtb_group',
            'menu_bphtb',
        ));
    }

    public function edit($id)
    {
        $data = BphtbModel::find($id);

        if ($data->status_bphtb !== STATUS_BPHTB_BELUM_VERIFIKASI) {
            return back()->with('error', 'Tidak bisa mengedit data karena status bphtb ' . STATUS_BPHTB_SUDAH_VERIFIKASI . '!');
        }

        $settingDefProv     = SettingDefaultModel::where('nama_setting_default', 'default_provinsi')->first();
        $settingDefKab      = SettingDefaultModel::where('nama_setting_default', 'default_kabupaten')->first();
        $dataKabDefault     = KabModel::where('kode_kab', $settingDefKab->kode_setting_default)->first();
        $dataProv           = ProvModel::get();
        $dataKec            = KecModel::where('kode_kec', 'LIKE',  $settingDefKab->kode_setting_default . '.' . '%')->get();

        $dataJenisPerolehan = JenisPerolehanModel::all();

        $bread              = 'Home | Transaksi | BPHTB | Edit';
        $tittle             = 'Edit Transaksi BPHTB';
        $menu_bphtb_group   = true;
        $menu_bphtb         = true;

        return view('transaksi.ppat.bphtb_e', compact(
            'data',
            'dataKabDefault',
            'dataProv',
            'dataKec',
            'dataJenisPerolehan',
            'bread',
            'tittle',
            'menu_bphtb_group',
            'menu_bphtb',
        ));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nik'           => 'required',
            'nama_wp'       => 'required',
            'alamat_wp'     => 'required',
            'kode_prov_wp'   => 'required',
            'kode_kab_wp'   => 'required',
            'kode_kec_wp'   => 'required',
            'kode_desa_wp'  => 'required',
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
        ];

        if ($request->has('berkas_ktp')) {
            $rules['berkas_ktp'] = 'required|file|mimes:jpg,png,jpeg|max:1024';
        }

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
            'nik'       => $request->nik,
            'nama_wp'       => $request->nama_wp,
            'alamat_wp'     => $request->alamat_wp,
            'kode_prov_wp'  => $request->kode_prov_wp,
            'kode_kab_wp'   => $request->kode_kab_wp,
            'kode_kec_wp'   => $request->kode_kec_wp,
            'kode_desa_wp'  => $request->kode_desa_wp,
            'rtrw_wp'       => $request->rtrw_wp,
            'kode_pos_wp'   => $request->kode_pos_wp,
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

        if ($request->has('berkas_ktp')) {
            // hapus file lama
            $filename = public_path() . '/upload/berkas_ktp/' . $update->first()->berkas_ktp;
            File::delete($filename);

            $berkas_ktp    = $request->file('berkas_ktp');
            $ekstensi       = $request->file('berkas_ktp')->getClientOriginalExtension();
            $file_name_ori = $request->file('berkas_ktp')->getClientOriginalName();
            $file_name_ori = explode('.', $file_name_ori)[0];
            $nama_berkas_ktp    = str_replace(" ", "_", $file_name_ori);
            $nama_berkas_ktp    = $tgl . '_' . substr($nama_berkas_ktp, 0, 10) . '.' . $ekstensi;
            $berkas_ktp->move('upload/berkas_ktp/', $nama_berkas_ktp);
            $data['berkas_ktp'] = $nama_berkas_ktp;
        }

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


        return redirect()->route('ppat.bphtb.show', ['id' => $id])->with('success', 'Transaksi BPHTB telah disimpan');
    }

    public function update_bukti_pembayaran(Request $request, $id)
    {
        $data = $request->only(['berkas_bukti_pembayaran']);
        $validator = Validator::make($data, [
            'berkas_bukti_pembayaran' => 'required|image|document|mimes:jpeg,png,jpg,pdf|max:4024'
        ]);

        try {

            if ($validator->passes()) {
                if ($request->hasFile('berkas_bukti_pembayaran')) {

                    $kode_ppat   = Auth::user()->kode_ppat;

                    $berkas_bukti_pembayaran    = $request->file('berkas_bukti_pembayaran'); // Pindahin ke temporary folder
                    $tgl            = date('ymd_His');
                    $ekstensi       = $request->file('berkas_bukti_pembayaran')->getClientOriginalExtension();
                    $nama_berkas    = $tgl . '_' . $kode_ppat . '.' . $ekstensi;

                    // File Asli Pindahin kedalam folder upload
                    $berkas_bukti_pembayaran->move('upload/berkas_bukti_pembayaran/', $nama_berkas);

                    $peralihan = PeralihanNopModel::find($id);
                    $peralihan->no_rekening_bank        = $request->get_rekening_update;
                    $peralihan->berkas_bukti_pembayaran = $nama_berkas;
                    $peralihan->status_verifikasi       = STATUS_PEMBAYARAN_BELUM_VERIFIKASI;
                    $save = $peralihan->save();
                    // dd($request);
                    if ($save) {

                        // Logs 
                        $keg = '#Menyetuhui BPHTB Nomor : ' . $peralihan->no_formulir
                            . ' #NPOP : ' . $peralihan->nop . ' #kepada WP NIK : ' . $peralihan->kepada_nik . ' #Jumlah : ' . $peralihan->jumlah_setor;
                        $this->simpanLogs(LOGS_PERALIHAN, $id, $keg);
                        // .Logs

                        // Kirim Notifikasi Telegram
                        $namaPPAT   = Auth::user()->nama;
                        $dataBPHTB  = PeralihanNopModel::find($id)->get();
                        // Ambil data BPHTB
                        $kepada = NOTIF_KEPADA_OPERATOR;
                        // dd($kepada);
                        $isi = "PPAT atas nama : " . $namaPPAT . " (" . $kode_ppat . ") \n"
                            . "Telah melakukan upload berkas bukti setor BPHTB kedalam Portal BPHTB, "
                            . "untuk pelunasan BPHTB atas :  \n"
                            .  "NOP <b>" . $dataBPHTB->nop . "</b>\n"
                            .  "Nama WP " . $dataBPHTB->joinProfilKepada->nama . "\n"
                            .  "NIK " . $dataBPHTB->kepada_nik . "\n"
                            .  "Jumlah : " . $dataBPHTB->jumlah_setor . "\n"
                            .  "Silahkan lakukan verifikasi atas pembayaran tersebut! \n";
                        $this->kirim_notif_telegram($kepada, $isi);
                        // .Kirim Notifikasi Telegram

                        session()->flash('success', 'Berhasil Upload Bukti Pembayaran');
                        return response()->json(['result' => true]);
                    } else {
                        session()->flash('failur', 'Gagal Upload Bukti Pembayaran');
                        return response()->json(['result' => false]);
                    }
                }
            } else {
                return response()->json(['error' => $validator->errors(), 'data' => $data]);
            }
        } catch (\Throwable $th) {
            dd("error", $th);
        }
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

    public function create()
    {
        $settingDefProv = SettingDefaultModel::where('nama_setting_default', 'default_provinsi')->first();
        $settingDefKab  = SettingDefaultModel::where('nama_setting_default', 'default_kabupaten')->first();
        $dataKabDefault = KabModel::where('kode_kab', $settingDefKab->kode_setting_default)->first();
        $dataProv       = ProvModel::get();
        $dataKec        = KecModel::where('kode_kec', 'LIKE',  $settingDefKab->kode_setting_default . '.' . '%')->get();
        $ref_rekening           = RekeningModel::all();
        $dataJenisPerolehan     = JenisPerolehanModel::all();
        $penandatangan_diterima = PenandatanganModel::whereKodePenandatangan('diterima')->get();
        $penandatangan_diverifikasi = PenandatanganModel::whereKodePenandatangan('diverifikasi')->get();

        $bread              = 'Home | BPHTB | Tambah';
        $tittle             = 'Tambah BPHTB';
        $menu_bphtb_group   = true;
        $menu_bphtb         = true;

        return view('transaksi.ppat.bphtb_a', compact(
            'dataKabDefault',
            'dataProv',
            'dataKec',
            'ref_rekening',
            'dataJenisPerolehan',
            'penandatangan_diterima',
            'penandatangan_diverifikasi',
            'bread',
            'tittle',
            'menu_bphtb_group',
            'menu_bphtb',
        ));
    }

    public function store(Request $request)
    {
        $rules = [
            'nik'           => 'required',
            'nama_wp'       => 'required',
            'alamat_wp'     => 'required',
            'kode_prov_wp'   => 'required',
            'kode_kab_wp'   => 'required',
            'kode_kec_wp'   => 'required',
            'kode_desa_wp'  => 'required',
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
            'berkas_ktp'   => 'required|file|mimes:jpg,png,jpeg|max:1024',
            'berkas_sertifikat'   => 'required|file|mimes:jpg,png,jpeg|max:1024',
            'berkas_ajb'   => 'required|file|mimes:jpg,png,jpeg|max:1024',
        ];

        $request->validate($rules);

        // validasi 1
        // validasi jika nik dan nop sudah terdaftar (milik sendiri)
        $cek_milik_sendiri = BphtbModel::whereNik((string)$request->nik)
            ->whereNop((int)$request->nop)
            ->orderByDesc('id')
            ->distinct('nop')
            ->count();

        if ($cek_milik_sendiri > 0) {
            return back()->with('error', 'NIK ' . $request->nik . ' dan NOP ' . $request->nop . ' sudah terdaftar milik Wajib Pajak sendiri!')
                ->withInput();
        }

        // validasi 2
        // validasi apakah ada data tanah wp sendiri yg status nya belum oke
        $cek_status_bphtb = BphtbModel::whereNik((string)$request->nik)
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
            'nik'           => $request->nik,
            'nama_wp'       => $request->nama_wp,
            'alamat_wp'     => $request->alamat_wp,
            'kode_prov_wp'  => $request->kode_prov_wp,
            'kode_kab_wp'   => $request->kode_kab_wp,
            'kode_kec_wp'   => $request->kode_kec_wp,
            'kode_desa_wp'  => $request->kode_desa_wp,
            'rtrw_wp'       => $request->rtrw_wp,
            'kode_pos_wp'   => $request->kode_pos_wp,
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
            'kode_ppat'  => Auth::user()->kode_ppat,
            'status_pembayaran' => STATUS_PEMBAYARAN_BELUM_BAYAR,
            'status_bphtb'      => STATUS_BPHTB_BELUM_VERIFIKASI,
            'created_by'        => Auth::user()->nama
        ];

        $tgl = date('ymd_His');

        if ($request->has('berkas_ktp')) {
            $berkas_ktp    = $request->file('berkas_ktp');
            $ekstensi       = $request->file('berkas_ktp')->getClientOriginalExtension();
            $file_name_ori = $request->file('berkas_ktp')->getClientOriginalName();
            $file_name_ori = explode('.', $file_name_ori)[0];
            $nama_berkas_ktp    = str_replace(" ", "_", $file_name_ori);
            $nama_berkas_ktp    = $tgl . '_' . substr($nama_berkas_ktp, 0, 10) . '.' . $ekstensi;
            $berkas_ktp->move('upload/berkas_ktp/', $nama_berkas_ktp);
            $data['berkas_ktp'] = $nama_berkas_ktp;
        }

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


        return redirect()->route('ppat.bphtb')->with('success', 'Transaksi BPHTB telah disimpan');
    }

    public function delete($id)
    {
        $bphtb = BphtbModel::whereId($id);

        try {
            $bphtb->update(['deleted_by' => Auth::user()->nama]);
            $bphtb->delete();

            return redirect()->route('ppat.bphtb')->with('success', 'Data telah dihapus!');
        } catch (Throwable $th) {
            dd($th);
        }
    }

    public function upload_bukti_show($id)
    {
        $data = BphtbModel::whereId($id)->first();
        if ($data == null) {
            return redirect()->route('ppat.bphtb')->with('error', 'Tidak dapat mengambil data!');
        }

        $bread          = 'PPAT | BPHTB | Pembayaran';
        $tittle         = 'Pembayaran BPHTB';
        $menu_bphtb_group   = true;
        $menu_trans_bphtb   = true;

        return view('transaksi.ppat.bphtb_pembayaran_s', compact(
            'data',
            'bread',
            'tittle',
            'menu_bphtb_group',
            'menu_trans_bphtb'
        ));
    }

    public function upload_bukti_store(Request $request, $id)
    {
        $rules = [
            'berkas_bukti_pembayaran' => 'required|file|mimes:png,jpg,jpeg|max:1024'
        ];

        $validator = FacadesValidator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->with('route', route('ppat.bphtb.pembayaran.show', ['id' => $id]))->withErrors($validator);
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

                return redirect()->route('ppat.bphtb')->with('success', 'Bukti pembayaran telah di upload, harap menunggu admin memverifikasinya!');
            }
        } catch (Throwable $th) {
            dd($th);
        }
    }
    // --
}
