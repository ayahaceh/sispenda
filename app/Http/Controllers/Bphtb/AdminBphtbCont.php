<?php

namespace App\Http\Controllers\Bphtb;

use App\Http\Controllers\Controller;
use App\Exports\BphtbExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Referensi\JenisPerolehanModel;
use App\Models\Setting\SettingDefaultModel;
use App\Models\Referensi\RekeningModel;
use App\Models\Tarif\TarifBphtbModel;
use App\Models\PenandatanganModel;
use App\Models\Alamat\ProvModel;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\KecModel;
use App\Models\BphtbModel;
use Throwable;

class AdminBphtbCont extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('aktif')) {
            $aktif = $request->aktif == 'Y' ? true : false;
        } else {
            $aktif = true;
        }

        if (!$aktif) {
            $data = BphtbModel::onlyTrashed();
        } else {
            if ($request->has('cari')) {
                $keyword = $request->cari;
                $data = BphtbModel::where('status_bphtb', STATUS_BPHTB_SUDAH_DISETUJUI)
                    ->where(function ($query) use ($keyword) {
                        $query->where('tgl_bphtb', 'like', "%{$keyword}%")
                            ->orWhere('nik', 'like', "%{$keyword}%")
                            ->orWhere('nama_wp', 'like', "%{$keyword}%")
                            ->orWhere('nop', 'like', "%{$keyword}%")
                            ->orWhere('letak_nop', 'like', "%{$keyword}%")
                            ->orWhere('no_b', 'like', "%{$keyword}%")
                            ->orWhereHas('joinKecNop', function ($query) use ($keyword) {
                                return $query->where('nama_kec', 'like', "%{$keyword}%");
                            })
                            ->orWhereHas('joinDesaNop', function ($query) use ($keyword) {
                                return $query->where('nama_desa', 'like', "%{$keyword}%");
                            });
                    })
                    ->orderByDesc('id');
            } else {
                $data = BphtbModel::orderByDesc('id');
            }
        }

        $data = $data->paginate(20);

        $bread          = 'Home | Transaksi | BPHTB';
        $tittle         = 'Daftar Transaksi BPHTB';
        $menu_bphtb_group   = true;
        $menu_bphtb         = true;


        return view('bphtb.admin.admin_bphtb_l', compact(
            'data',
            'aktif',
            'bread',
            'tittle',
            'menu_bphtb_group',
            'menu_bphtb',
        ));
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

        $bread              = 'Home | Transaksi | BPHTB | Input';
        $tittle             = 'Input Transaksi BPHTB';
        $menu_bphtb_group   = true;
        $menu_bphtb         = true;

        return view('bphtb.admin.admin_bphtb_a', compact(
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

    public function search_wp()
    {
        if (request()->has('nik')) {
            $nik = request()->nik;
            $wp = BphtbModel::select(
                'nik',
                'nama_wp',
                'alamat_wp',
                'kode_prov_wp',
                'kode_kab_wp',
                'kode_kec_wp',
                'kode_desa_wp',
                'rtrw_wp',
                'kode_pos_wp'
            )
                ->whereNik($nik)
                ->orderByDesc('id')
                ->distinct('nik')
                ->first();

            return response()->json([
                'status' => 'OK',
                'data' => $wp
            ], 200);
        }
    }

    public function search_nop()
    {
        if (request()->has('nop') && request()->has('nik')) {
            $nop = request()->nop;
            $nik = request()->nik;
            $nop = BphtbModel::select(
                'nik',
                'nama_wp',
                'nop',
                'letak_nop',
                'kode_prov_nop',
                'kode_kab_nop',
                'kode_kec_nop',
                'kode_desa_nop',
                'rtrw_nop',
                'luas_tanah',
                'njop_tanah',
                'luas_bangunan',
                'njop_bangunan',
                'hak_nilai_pasar',
                'kode_jenis_perolehan',
                'no_sertifikat'
            )
                ->where('nik', '!=', $nik)
                ->whereNop($nop)
                ->orderByDesc('id')
                ->distinct('nop')
                ->first();

            return response()->json([
                'status' => 'OK',
                'data' => $nop
            ], 200);
        }
    }

    public function kalkulasi_bphtb()
    {
        if (request()->has('kepada') && request()->has('kode_jp') && request()->has('kode_desa') && request()->has('tgl_setor') && request()->has('tgl_bphtb')) {
            $kepada = request()->kepada;
            $kode_jp = request()->kode_jp;
            $kode_desa = request()->kode_desa;
            $tgl_setor = request()->tgl_setor;
            $tgl_bphtb = request()->tgl_bphtb;

            // jika edit bphtb, npoptkp akan mengambil data terdahulu
            if (request()->has('edit')) {
                $npoptkp = request()->edit;
            } else {
                // ambil jenis perolehan
                $jenis_perolehan  = JenisPerolehanModel::whereKodeJenisPerolehan($kode_jp)->first();

                // jika selain hibah, waris, dan hibah wasiat kena tarif 1 kali saja pertahun
                if (
                    $jenis_perolehan->kode_jenis_perolehan == '03' ||
                    $jenis_perolehan->kode_jenis_perolehan == '04' ||
                    $jenis_perolehan->kode_jenis_perolehan == '05'
                ) {
                    // return 'hibah/waris/hibah_wasiat';
                    $npoptkp = $jenis_perolehan->tarif_npoptkp; // 300 juta
                } else {
                    $bphtb_exists = BphtbModel::whereYear('tgl_bphtb', date('Y', strtotime($tgl_bphtb)))
                        ->whereNik($kepada)
                        ->whereStatusPembayaran(STATUS_PEMBAYARAN_LUNAS)
                        ->whereStatusBphtb(STATUS_BPHTB_SUDAH_DISETUJUI)
                        ->count();

                    if ($bphtb_exists > 0) {
                        $npoptkp = 0;
                    } else {
                        $npoptkp = $jenis_perolehan->tarif_npoptkp;
                    }
                }
            }

            $tarif_bphtb = TarifBphtbModel::get();

            // kebutuhan edit, jika edit bphtb dia tetap mempertahankan no_b lama
            if (request()->has('no_b')) {
                $no_urut = $this->getNoUrut($kode_desa, $tgl_setor, request()->no_b);
            } else {
                $no_urut = $this->getNoUrut($kode_desa, $tgl_setor);
            }


            return response()->json([
                'status' => 'OK',
                'npoptkp' => $npoptkp,
                'tarif_bphtb' => $tarif_bphtb,
                'no_urut' => $no_urut
            ], 200);
        }
    }

    public function getNoUrut($kode_desa, $tgl_setor, $no_b_val = 0)
    {
        // mengambil kode_kab && kode_desa dari user input
        $kode_desa_new = explode('.', $kode_desa)[2] . explode('.', $kode_desa)[3];
        $tahun_tgl_setor = substr($tgl_setor, 2, 2);

        // jika edit transaksi
        if ($no_b_val !== 0) {
            // $no_b_val cth: 2201000100002 <= didapat saat edit bphtb

            // struktur no_b 22 010001 00002
            // 22       <= tahun sekarang
            // 010001   <= kode_kab & kode_desa
            // 00002    <= nomor yang di urut
            $kode_desa_dari_val = substr($no_b_val, 2, 6); // mengambil kode_kab & kode_desa
            $tahun_tgl_setor_dari_val = substr($no_b_val, 0, 2);
            if ($tahun_tgl_setor !== $tahun_tgl_setor_dari_val) {
                $kode_desa_dari_val = 0;
            }
        } else { // jika tambah transaksi
            $kode_desa_dari_val = 0;
        }

        // ambil no_b terakhir
        if ($kode_desa_new !== $kode_desa_dari_val) {
            $peralihan = BphtbModel::select('no_b')
                ->whereRaw('SUBSTRING(no_b,1,8)=?', [$tahun_tgl_setor . $kode_desa_new]) // no_b berdasarkan kode_kab & kode_desa saja
                // ->whereYear('tgl_setor', $tahun_tgl_setor)
                ->orderByDesc(DB::raw('SUBSTRING(no_b,9,5)')) // orderBy nomor_urut saja, mengambil yang terbaru biar nanti di tambah +1
                ->first();
        } else {
            $peralihan = BphtbModel::select('no_b')
                ->whereRaw('SUBSTRING(no_b,1,8)=?', [$tahun_tgl_setor . $kode_desa_new])
                ->where('no_b', '!=', $no_b_val)
                // ->whereYear('tgl_setor', $tahun_tgl_setor)
                ->orderByDesc(DB::raw('SUBSTRING(no_b,9,5)'))
                ->first();
        }

        // return substr($peralihan->no_b, 8);
        if ($peralihan != null) {
            $temp_no_b  = (int) substr($peralihan->no_b, 8);
            $no_b       = (int) $temp_no_b + 1;
            $length     = strlen($no_b);

            for ($i = $length + 1; $i <= 5; $i++) {
                $no_b = '0' . $no_b;
            }
        } else {
            $no_b = '00001';
        }

        if ($kode_desa_new !== $kode_desa_dari_val) {
            return $tahun_tgl_setor . $kode_desa_new . $no_b;
        } else {
            return $no_b_val;
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'nik'           => 'required|integer|digits:16',
            'nama_wp'       => 'required',
            'alamat_wp'     => 'required',
            'kode_prov_wp'   => 'required',
            'kode_kab_wp'   => 'required',
            'kode_kec_wp'   => 'required',
            'kode_desa_wp'  => 'required',
            'nop'           => 'required|integer|digits:18',
            'letak_nop'     => 'required',
            'kode_kab_nop'  => 'required',
            'kode_kec_nop'  => 'required',
            'kode_desa_nop' => 'required',
            'kode_jenis_perolehan'  => 'required',
            'no_sertifikat' => 'required',
            'luas_tanah'    => 'required',
            'luas_bangunan' => 'required',
            'njop_tanah'    => 'required',
            'njop_bangunan' => 'required',
            'hak_nilai_pasar'   => 'required',
            'jumlah_setor'      => 'required',
            'no_rekening_bank'  => 'required',
            'tgl_setor'         => 'required',
            'nama_penyetor'     => 'required',
            'status_pembayaran' => 'required',
            'tgl_bphtb'         => 'required',
        ];

        $request->validate($rules);


        // validasi 1

        /*
        /*
        // ==================================================================
        // Disable Code.
        // ==================================================================
        // Validasi ini sudah aman, namun disable dulu 
        // untuk mempelajari pola-pola transaksi di lapangan terlebih dahulu
        // Sebelum diterapkan!



        // ==================================================================
        // Akhir Disable Code
        // ==================================================================
        */
        // validasi jika nik dan nop sudah terdaftar (milik sendiri)
        $cek_milik_sendiri = BphtbModel::whereNik((string)$request->nik)
            ->whereNop((string)$request->nop)
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
            $pesan = 'Data wajib pajak dengan NIK ' . $request->nik .
                ' masih terdapat BPHTB yang belum disetujui! ' .
                'Silahkan setujui transaksi tersebut sebelumnya tersebut ' .
                'untuk dapat melanjutkan transaksi berikutnya! ';
            return back()->with('error', $pesan)
                ->withInput();
        }

        // validasi 3
        // validasi nop jika sudah terdaftar (milik orang) namun status masih belum oke
        $check_status_nop = BphtbModel::whereNop($request->nop)
            ->where('status_pembayaran', '!=', STATUS_PEMBAYARAN_LUNAS)
            ->where('status_bphtb', '!=', STATUS_BPHTB_SUDAH_DISETUJUI)
            ->count();

        if ($check_status_nop > 0) {
            $pesan = 'Anda memasukkan NOP yang sudah terdaftar ' . $request->nop .
                ', namun status BPHTB tersebut belum disetujui. ' .
                'Harap setujui terlebih dahulu untuk melakukan transaksi dengan NOP ini! ' .
                'Atau silahkan input BPHTB atas NOP yang lain!';

            return back()->with('error', $pesan)
                ->withInput();
        }

        $tgl_bphtb = $request->tgl_bphtb;
        $kode_desa_nop = $request->kode_desa_nop;

        $status_bphtb = Auth::user()->user_group == USER_ADMIN ? STATUS_BPHTB_SUDAH_DISETUJUI : STATUS_BPHTB_BELUM_DISETUJUI;
        $status_pembayaran = $request->status_pembayaran;
        if ($status_pembayaran == STATUS_PEMBAYARAN_BELUM_BAYAR) {
            $status_bphtb = STATUS_BPHTB_BELUM_DISETUJUI;
        }

        $opsi_selected = $request->input('customRadio');
        $no_b   = null;
        $tgl_b  = null;
        $persen_c = null;
        $uraian_c = null;
        $uraian_d = null;
        if ($opsi_selected == 'opsi_a') {
            $opsi_a = 'Y';
            $opsi_b = 'T';
            $opsi_c = 'T';
            $opsi_d = 'T';
        } else if ($opsi_selected == 'opsi_b') {
            $opsi_a = 'T';
            $opsi_b = 'Y';
            $opsi_c = 'T';
            $opsi_d = 'T';
            // $no_b = $request->no_b;
            if ($status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI && $status_pembayaran == STATUS_PEMBAYARAN_LUNAS) {
                $no_b = $this->getNoUrut($kode_desa_nop, $request->tgl_setor);

                $cek_no_b_db = BphtbModel::whereNoB($no_b)->count();

                // jika pegawai perang merebutkan nomor urut ambil no urut sekali lagi, kalau perang lagi suruh input ulang
                if ($cek_no_b_db > 0) {
                    $no_b = $this->getNoUrut($kode_desa_nop, $request->tgl_setor, $request->no_b);

                    $cek_no_b_db_one_more = BphtbModel::whereNoB($no_b)->count();

                    if ($cek_no_b_db_one_more > 0) {
                        return back()->with('error', 'Gangguan pada server. Coba lagi!')
                            ->withInput();
                    }
                }
            } else {
                $no_b = null;
            }
            $tgl_b = $request->tgl_b;
        } else if ($opsi_selected == 'opsi_c') {
            $opsi_a = 'T';
            $opsi_b = 'T';
            $opsi_c = 'Y';
            $opsi_d = 'T';
            $persen_c = $request->persen_c;
            $uraian_c = $request->uraian_c;
        } else if ($opsi_selected == 'opsi_d') {
            $opsi_a = 'T';
            $opsi_b = 'T';
            $opsi_c = 'T';
            $opsi_d = 'Y';
            $uraian_d = $request->uraian_d;
        }

        $dev_prov = SettingDefaultModel::whereNamaSettingDefault('default_provinsi')->first()->kode_setting_default;

        $diterima = PenandatanganModel::whereKodePenandatangan('diterima')->whereId($request->diterima_id)->first();
        $diverifikasi = PenandatanganModel::whereKodePenandatangan('diverifikasi')->whereId($request->diverifikasi_id)->first();

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
            'letak_nop'     => $request->letak_nop,
            'kode_desa_nop' => $kode_desa_nop,
            'rtrw_nop'      => $request->rtrw_nop,
            'luas_tanah'    => $request->luas_tanah,
            'njop_tanah'    => str_replace('.', '', $request->njop_tanah),
            'luas_bangunan' => $request->luas_bangunan,
            'njop_bangunan' => str_replace('.', '', $request->njop_bangunan),
            'hak_nilai_pasar'       => str_replace('.', '', $request->hak_nilai_pasar),
            'kode_jenis_perolehan'  => $request->kode_jenis_perolehan,
            'no_sertifikat'         => $request->no_sertifikat,
            'npop'          => str_replace('.', '', $request->npop),
            'npoptkp'       => str_replace('.', '', $request->npoptkp),
            'npopkp'        => str_replace('.', '', $request->npopkp),
            'jumlah_bphtb'  => str_replace('.', '', $request->jumlah),
            'opsi_a'        => $opsi_a,
            'opsi_b'        => $opsi_b,
            'no_b'          => $no_b,
            'tgl_b'         => $tgl_b,
            'opsi_c'        => $opsi_c,
            'persen_c'      => $persen_c,
            'uraian_c'      => $uraian_c,
            'opsi_d'        => $opsi_d,
            'uraian_d'      => $uraian_d,
            'jumlah_setor'  => str_replace('.', '', $request->jumlah_setor),
            'tgl_setor'     => $request->tgl_setor,
            'nama_penyetor' => $request->nama_penyetor,
            'tgl_diterima' => $request->tgl_diterima,
            'nip_diterima' => $diterima ? $diterima->nip_penandatangan : null,
            'diterima_oleh' => $diterima ? $diterima->nama_penandatangan : null,
            // 'kode_ppat'  => $profil_wp->kode_ppat,
            'nip_verifikator' => $diverifikasi ? $diverifikasi->nip_penandatangan : null,
            'nama_verifikator' => $diverifikasi ? $diverifikasi->nama_penandatangan : null,
            'tgl_verifikasi' => $request->tgl_diverifikasi,
            'no_rekening_bank'  => $request->no_rekening_bank,
            'status_pembayaran' => $status_pembayaran,
            'status_bphtb'      => $status_bphtb,
            'created_by'        => Auth::user()->nama
        ];

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


        return redirect()->route('bphtb')->with('success', 'Transaksi BPHTB telah disimpan');
    }

    public function show($id)
    {
        $data = BphtbModel::withTrashed()->find($id);

        if ($data->deleted_at) {
            $is_deleted = true;
        } else {
            $is_deleted = false;
        }

        $bread          = 'Home | Transaksi | BPHTB | Detail';
        $tittle         = 'Detail Transaksi BPHTB';
        $menu_bphtb_group   = true;
        $menu_bphtb         = true;

        return view('bphtb.admin.admin_bphtb_v', compact(
            'data',
            'is_deleted',
            'bread',
            'tittle',
            'menu_bphtb_group',
            'menu_bphtb',
        ));
    }

    public function edit($id)
    {
        $data = BphtbModel::findOrFail($id);
        if (empty($data) || $data == NULL || $data == "") {
            return back()->with('error', 'Data BPHTB tidak ditemukan!');
        }
        if ($data->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI && Auth::user()->user_group > USER_ADMIN) {
            return back()->with('error', 'BPHTB yang telah disetujui oleh Admin / Kabid hanya dapat di Edit / di Ubah oleh Admin!');
        }

        $settingDefProv     = SettingDefaultModel::where('nama_setting_default', 'default_provinsi')->first();
        $settingDefKab      = SettingDefaultModel::where('nama_setting_default', 'default_kabupaten')->first();
        $dataKabDefault     = KabModel::where('kode_kab', $settingDefKab->kode_setting_default)->first();
        $dataProv           = ProvModel::get();
        $dataKec            = KecModel::where('kode_kec', 'LIKE',  $settingDefKab->kode_setting_default . '.' . '%')->get();

        $ref_rekening       = RekeningModel::all();
        $dataJenisPerolehan = JenisPerolehanModel::all();

        $penandatangan_diterima     = PenandatanganModel::whereKodePenandatangan('diterima')->get();
        $penandatangan_diverifikasi = PenandatanganModel::whereKodePenandatangan('diverifikasi')->get();

        $bread              = 'Home | Transaksi | BPHTB | Edit';
        $tittle             = 'Edit Transaksi BPHTB';
        $menu_bphtb_group   = true;
        $menu_bphtb         = true;

        return view('bphtb.admin.admin_bphtb_e', compact(
            'data',
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

    public function update(Request $request, $id)
    {
        $rules = [
            'nik'           => 'required|integer|digits:16',
            'nama_wp'       => 'required',
            'alamat_wp'     => 'required',
            'kode_prov_wp'  => 'required',
            'kode_kab_wp'   => 'required',
            'kode_kec_wp'   => 'required',
            'kode_desa_wp'  => 'required',
            'letak_nop'     => 'required',
            'kode_kab_nop'  => 'required',
            'kode_kec_nop'  => 'required',
            'kode_desa_nop' => 'required',
            'kode_jenis_perolehan' => 'required',
            'no_sertifikat' => 'required',
            'luas_tanah'    => 'required',
            'luas_bangunan' => 'required',
            'njop_tanah'    => 'required',
            'njop_bangunan' => 'required',
            'hak_nilai_pasar'   => 'required',
            'jumlah_setor'      => 'required',
            'no_rekening_bank'  => 'required',
            // 'tgl_setor'         => 'required',
            'nama_penyetor'     => 'required',
            // 'status_pembayaran' => 'required',
            // 'tgl_bphtb'         => 'required',
        ];

        $request->validate($rules);

        $tgl_bphtb = $request->tgl_bphtb;

        $kode_desa_nop = $request->kode_desa_nop;

        $opsi_selected = $request->input('customRadio');

        // $status_pembayaran = $request->status_pembayaran;

        $no_b = null;
        $tgl_b = null;
        $persen_c = null;
        $uraian_c = null;
        $uraian_d = null;
        if ($opsi_selected == 'opsi_a') {
            $opsi_a = 'Y';
            $opsi_b = 'T';
            $opsi_c = 'T';
            $opsi_d = 'T';
        } else if ($opsi_selected == 'opsi_b') {
            $opsi_a = 'T';
            $opsi_b = 'Y';
            $opsi_c = 'T';
            $opsi_d = 'T';

            $get_bphtb = BphtbModel::whereId($id)->select('status_bphtb', 'status_pembayaran')->first();

            if ($get_bphtb->status_pembayaran == STATUS_PEMBAYARAN_LUNAS && $get_bphtb->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI) {
                $no_b = $this->getNoUrut($kode_desa_nop, $request->tgl_setor, $request->no_b);

                $cek_no_b_db = BphtbModel::whereNoB($no_b)->where('id', '!=', $id)->count();

                // jika pegawai perang merebutkan nomor urut ambil no urut sekali lagi, kalau perang lagi suruh input ulang
                if ($cek_no_b_db > 0) {
                    $no_b = $this->getNoUrut($kode_desa_nop, $request->tgl_setor, $request->no_b);

                    $cek_no_b_db_one_more = BphtbModel::whereNoB($no_b)->where('id', '!=', $id)->count();

                    if ($cek_no_b_db_one_more > 0) {
                        return back()->with('error', 'Gangguan pada server. Coba lagi!')
                            ->withInput();
                    }
                }
            } else {
                $no_b = null;
            }
            $tgl_b = $request->tgl_b;
        } else if ($opsi_selected == 'opsi_c') {
            $opsi_a = 'T';
            $opsi_b = 'T';
            $opsi_c = 'Y';
            $opsi_d = 'T';
            $persen_c = $request->persen_c;
            $uraian_c = $request->uraian_c;
        } else if ($opsi_selected == 'opsi_d') {
            $opsi_a = 'T';
            $opsi_b = 'T';
            $opsi_c = 'T';
            $opsi_d = 'Y';
            $uraian_d = $request->uraian_d;
        }

        $diterima       = PenandatanganModel::whereKodePenandatangan('diterima')->whereId($request->diterima_id)->first();
        $diverifikasi   = PenandatanganModel::whereKodePenandatangan('diverifikasi')->whereId($request->diverifikasi_id)->first();

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
            'letak_nop'     => $request->letak_nop,
            'kode_kab_nop'  => $request->kode_kab_nop,
            'kode_kec_nop'  => $request->kode_kec_nop,
            'letak_nop'     => $request->letak_nop,
            'letak_nop'     => $request->letak_nop,
            'kode_desa_nop' => $kode_desa_nop,
            'rtrw_nop'      => $request->rtrw_nop,
            'luas_tanah'    => $request->luas_tanah,
            'njop_tanah'    => str_replace('.', '', $request->njop_tanah),
            'luas_bangunan' => $request->luas_bangunan,
            'njop_bangunan' => str_replace('.', '', $request->njop_bangunan),
            'hak_nilai_pasar'       => str_replace('.', '', $request->hak_nilai_pasar),
            'kode_jenis_perolehan'  => $request->kode_jenis_perolehan,
            'no_sertifikat'         => $request->no_sertifikat,
            'npop'          => str_replace('.', '', $request->npop),
            // 'npoptkp'       => str_replace('.', '', $request->npoptkp),
            'npopkp'        => str_replace('.', '', $request->npopkp),
            'jumlah_bphtb'  => str_replace('.', '', $request->jumlah),
            'opsi_a'        => $opsi_a,
            'opsi_b'        => $opsi_b,
            'no_b'          => $no_b,
            'tgl_b'         => $tgl_b,
            'opsi_c'        => $opsi_c,
            'persen_c'      => $persen_c,
            'uraian_c'      => $uraian_c,
            'opsi_d'        => $opsi_d,
            'uraian_d'      => $uraian_d,
            'jumlah_setor'  => str_replace('.', '', $request->jumlah_setor),
            'tgl_setor'     => $request->tgl_setor,
            'nama_penyetor' => $request->nama_penyetor,
            'tgl_diterima'  => $request->tgl_diterima,
            'nip_diterima'  => $diterima ? $diterima->nip_penandatangan : null,
            'diterima_oleh' => $diterima ? $diterima->nama_penandatangan : null,
            // 'kode_ppat'  => $profil_wp->kode_ppat,
            'nip_verifikator'   => $diverifikasi ? $diverifikasi->nip_penandatangan : null,
            'nama_verifikator'  => $diverifikasi ? $diverifikasi->nama_penandatangan : null,
            'tgl_verifikasi'    => $request->tgl_diverifikasi,
            'no_rekening_bank'  => $request->no_rekening_bank,
            // 'status_pembayaran' => $request->status_pembayaran,
            // 'status_bphtb' => STATUS_BPHTB_SUDAH_DISETUJUI,
            'updated_by' => Auth::user()->nama
        ];

        $update = BphtbModel::whereId($id)->update($data);

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


        return redirect()->route('bphtb.show', ['id' => $id])->with('success', 'Transaksi BPHTB telah disimpan');
    }

    public function delete($id)
    {
        $bphtb = BphtbModel::whereId($id);
        if (empty($bphtb) || $bphtb != NULL || $bphtb == "") {
            return back()->with('error', 'Data BPHTB tidak ditemukan!');
        }
        if ($bphtb->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI && Auth::user()->user_group > USER_ADMIN) {
            // Sebenarnya ini sudah dibatasi oleh Route delete yang hanya bisa dilakukan oleh user group Admin dan Super Admin!
            return back()->with('error', 'BPHTB yang telah disetujui oleh Admin / Kabid tidak dapat di hapus !');
        }

        try {
            $bphtb->update(['deleted_by' => Auth::user()->nama]);
            $bphtb->delete();

            return redirect()->route('bphtb')->with('success', 'Data telah dihapus!');
        } catch (Throwable $th) {
            dd($th);
        }
    }

    public function restore($id)
    {
        $bphtb = BphtbModel::withTrashed()->whereId($id);

        try {
            $bphtb->update(['updated_by' => Auth::user()->nama]);
            $bphtb->restore();

            return redirect()->route('bphtb')->with('success', 'Data telah dihapus!');
        } catch (Throwable $th) {
            dd($th);
        }
    }

    public function export(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $file_name = 'Data Transaksi BPHTB dari ' . $start_date . ' sampai ' . $end_date . ' - Export by ' . env('APP_NAME') . '.xlsx';
        return Excel::download(new BphtbExport($start_date, $end_date), $file_name);
    }

    //--
}
