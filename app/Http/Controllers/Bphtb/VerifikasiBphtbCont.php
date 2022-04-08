<?php

namespace App\Http\Controllers\Bphtb;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateVerifikasi;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\KecModel;
use App\Models\Alamat\ProvModel;
use Illuminate\Http\Request;
use App\Models\BphtbModel;
use App\Models\PenandatanganModel;
use App\Models\Referensi\JenisPerolehanModel;
use App\Models\Referensi\RekeningModel;
use App\Models\Setting\SettingDefaultModel;
use Illuminate\Support\Facades\Auth;

class VerifikasiBphtbCont extends Controller
{
    public function index(Request $request)
    {
        if (!request()->has('status')) {
            return redirect()->route('bphtb.verifikasi', 'status=' . STATUS_BPHTB_BELUM_VERIFIKASI);
        }

        $status = request()->status;

        if (Auth::user()->user_group == USER_OPERATOR && $status == STATUS_BPHTB_BELUM_DISETUJUI) {
            return back()->with('error', 'Hanya admin yang boleh melihat daftar BPHTB yang belum disetujui!');
        }

        if ($request->has('cari')) {
            $keyword = $request->cari;
            $bphtb = new BphtbModel;

            if ($status == 'Sudah Bayar (pending)') {
                $data = $bphtb->whereNotNull('berkas_bukti_pembayaran')
                    ->where('status_bphtb', '!=', STATUS_BPHTB_SUDAH_DISETUJUI)
                    ->where('status_pembayaran', STATUS_PEMBAYARAN_BELUM_BAYAR)
                    ->orWhere('status_pembayaran', STATUS_PEMBAYARAN_SEDANG_VERIFIKASI);
            } else if ($status == STATUS_PEMBAYARAN_BELUM_BAYAR) {
                $data = $bphtb->where('status_pembayaran', STATUS_PEMBAYARAN_BELUM_BAYAR)
                    ->where('status_bphtb', STATUS_BPHTB_BELUM_DISETUJUI)
                    ->where('berkas_bukti_pembayaran', null);
            } elseif ($status == STATUS_BPHTB_BELUM_DISETUJUI) {
                $data = $bphtb->where('status_bphtb', STATUS_BPHTB_BELUM_DISETUJUI)
                    ->where('status_pembayaran', STATUS_PEMBAYARAN_LUNAS);
            } else {
                $data = $bphtb->where('status_bphtb', $status);
            }

            $data = $data->where(function ($query) use ($keyword) {
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
            });
        } else {
            $bphtb = new BphtbModel;

            if ($status == 'Sudah Bayar (pending)') {
                $data = $bphtb->whereNotNull('berkas_bukti_pembayaran')
                    ->where('status_pembayaran', STATUS_PEMBAYARAN_BELUM_BAYAR)
                    ->where('status_bphtb', '!=', STATUS_BPHTB_SUDAH_DISETUJUI);
            } else if ($status == STATUS_PEMBAYARAN_BELUM_BAYAR) {
                $data = $bphtb->where('status_pembayaran', STATUS_PEMBAYARAN_BELUM_BAYAR)
                    ->where('status_bphtb', STATUS_BPHTB_BELUM_DISETUJUI)
                    ->where('berkas_bukti_pembayaran', null);
            } elseif ($status == STATUS_BPHTB_BELUM_DISETUJUI) {
                $data = $bphtb->where('status_bphtb', STATUS_BPHTB_BELUM_DISETUJUI)
                    ->where('status_pembayaran', STATUS_PEMBAYARAN_LUNAS);
            } else {
                $data = $bphtb->where('status_bphtb', $status);
            }
        }

        $data = $data->orderByDesc('id')->paginate(20);

        $bread                  = 'Home | Transaksi | BPHTB';
        $tittle                 = 'Daftar Transaksi BPHTB';
        $menu_tindakan_bphtb_group = true;

        if (request()->status == STATUS_BPHTB_BELUM_VERIFIKASI) {
            $menu_tindakan_bphtb  = STATUS_BPHTB_BELUM_VERIFIKASI;
        } else if (request()->status == 'Sudah Bayar (pending)') {
            $menu_tindakan_bphtb  = 'Sudah Bayar (pending)';
        } else if (request()->status == STATUS_BPHTB_BELUM_DISETUJUI) {
            $menu_tindakan_bphtb  = STATUS_BPHTB_BELUM_DISETUJUI;
        } else if (request()->status == STATUS_PEMBAYARAN_BELUM_BAYAR) {
            $menu_tindakan_bphtb  = STATUS_PEMBAYARAN_BELUM_BAYAR;
        }

        return view('bphtb.verifikasi.verifikasi_bphtb_l', compact(
            'data',
            // 'aktif',
            'bread',
            'tittle',
            'menu_tindakan_bphtb_group',
            'menu_tindakan_bphtb',
        ));
    }

    public function show($id)
    {
        $data = BphtbModel::withTrashed()->find($id);

        $bread                  = 'Home | Transaksi | BPHTB | Detail';
        $tittle                 = 'Detail Transaksi BPHTB';
        $menu_bphtb_group       = true;
        $menu_bphtb  = true;

        return view('bphtb.verifikasi.verifikasi_bphtb_v', compact(
            'data',
            // 'is_deleted',
            'bread',
            'tittle',
            'menu_bphtb_group',
            'menu_bphtb',
        ));
    }

    public function edit($id)
    {
        $data = BphtbModel::find($id);

        $status = request()->has('status');

        if (!$status) {
            return redirect()->route('bphtb.verifikasi');
        }

        if (Auth::user()->user_group == USER_OPERATOR && request()->status == STATUS_BPHTB_BELUM_DISETUJUI) {
            return back()->with('error', 'Hanya admin yang boleh melihat daftar BPHTB yang belum disetujui!');
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

        $bread              = 'Home | Transaksi | BPHTB | Verifikasi';
        $tittle             = 'Verifikasi Transaksi BPHTB';

        $menu_tindakan_bphtb_group = true;

        if (request()->status == STATUS_BPHTB_BELUM_VERIFIKASI) {
            $menu_tindakan_bphtb  = STATUS_BPHTB_BELUM_VERIFIKASI;
        } else if (request()->status == 'Sudah Bayar (pending)') {
            $menu_tindakan_bphtb  = 'Sudah Bayar (pending)';
        } else if (request()->status == STATUS_BPHTB_BELUM_DISETUJUI) {
            $menu_tindakan_bphtb  = STATUS_BPHTB_BELUM_DISETUJUI;
        } else if (request()->status == STATUS_PEMBAYARAN_BELUM_BAYAR) {
            $menu_tindakan_bphtb  = STATUS_PEMBAYARAN_BELUM_BAYAR;
        } else {
            $menu_tindakan_bphtb = true;
        }

        return view('bphtb.verifikasi.verifikasi_bphtb_e', compact(
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
            'menu_tindakan_bphtb_group',
            'menu_tindakan_bphtb'
        ));
    }

    public function update(Request $request, $id)
    {
        // dd($request);

        // $bendahara          = PenandatanganModel::where('nip_penandatangan', $request->get_bendahara_update)->first();
        // $nip_bendahara      = $bendahara->nip_penandatangan;
        // $nama_bendahara     = $bendahara->nama_penandatangan;

        // $diterima       = PenandatanganModel::whereKodePenandatangan('diterima')->whereId($request->get_bendahara_update)->first();
        // $diverifikasi   = PenandatanganModel::whereKodePenandatangan('diverifikasi')->whereId($request->get_verifikator_update)->first();

        // try {
        //     $BPHTB = BphtbModel::where('id', $request->id_bphtb)->first();
        //     $BPHTB->tgl_diterima        = $request->get_tgl_diterima_update;
        //     $BPHTB->nip_diterima        = $diterima ? $diterima->nip_penandatangan : null;
        //     $BPHTB->diterima_oleh       = $diterima ? $diterima->nama_penandatangan : null;
        //     $BPHTB->tgl_verifikasi      = $request->get_tgl_verifikator_update;
        //     $BPHTB->nip_verifikator     = $diverifikasi ? $diverifikasi->nip_penandatangan : null;
        //     $BPHTB->nama_verifikator    = $diverifikasi ? $diverifikasi->nama_penandatangan : null;

        //     $BPHTB->status_pembayaran   = $request->get_status_pelunasan_update;
        //     $BPHTB->status_bphtb        = $request->get_status_bphtb_update;

        //     $BPHTB->updated_by          = session()->get('datauser')->nama;
        //     $BPHTB->updated_at          = now();
        //     $BPHTB->save();

        //     return back()->with('success', 'Data BPHTB telah diupdate!');
        //     //--
        // } catch (\Throwable $th) {
        //     dd("error", $th);
        //     return back()->with('error', 'Data BPHTB gagal diupdate!');
        // }

        // validasi 2
        // validasi apakah ada data tanah wp sendiri yg status nya belum oke
        $cek_status_bphtb = BphtbModel::whereNik((string)$request->nik)
            ->where('id', '!=', $id)
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

        $tgl_bphtb = $request->tgl_bphtb;

        $kode_desa_nop = $request->kode_desa_nop;

        $opsi_selected = $request->input('customRadio');

        $status_bphtb = Auth::user()->user_group == USER_OPERATOR ? STATUS_BPHTB_BELUM_DISETUJUI : $request->status_bphtb;
        $status_pembayaran = $request->status_pembayaran;

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

            $admin_bphtb = new AdminBphtbCont;

            if ($status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI && $status_pembayaran == STATUS_PEMBAYARAN_LUNAS) {
                $no_b = $admin_bphtb->getNoUrut($kode_desa_nop, $request->tgl_setor);

                $cek_no_b_db = BphtbModel::whereNoB($no_b)->count();

                // jika pegawai perang merebutkan nomor urut ambil no urut sekali lagi, kalau perang lagi suruh input ulang
                if ($cek_no_b_db > 0) {
                    $no_b = $admin_bphtb->getNoUrut($kode_desa_nop, $request->tgl_setor, $request->no_b);

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
            'tgl_diterima'  => $request->tgl_diterima,
            'nip_diterima'  => $diterima ? $diterima->nip_penandatangan : null,
            'diterima_oleh' => $diterima ? $diterima->nama_penandatangan : null,
            'nip_verifikator'   => $diverifikasi ? $diverifikasi->nip_penandatangan : null,
            'nama_verifikator'  => $diverifikasi ? $diverifikasi->nama_penandatangan : null,
            'tgl_verifikasi'    => $request->tgl_diverifikasi,
            'no_rekening_bank'  => $request->no_rekening_bank,
            'status_pembayaran' => $status_pembayaran,
            'status_bphtb' => $status_bphtb,
            'updated_by' => Auth::user()->nama
        ];

        try {

            BphtbModel::whereId($id)->update($data);

            return redirect()->route('bphtb.verifikasi', 'status=' . $request->status)->with('success', 'Data BPHTB telah diverifikasi!');
        } catch (\Throwable $th) {
            dd("error", $th);
            return back()->with('error', 'Data BPHTB gagal diupdate!');
        }
    }


    //--
}
