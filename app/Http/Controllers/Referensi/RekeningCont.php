<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Referensi\RekeningModel;
use App\Http\Requests\ValidateRekening;
use App\Models\Logs\LogsModel;
use App\Http\Traits\LogsTrait;

class RekeningCont extends Controller
{
    use LogsTrait;
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $rekening = RekeningModel::where('no_rekening', 'LIKE', '%' . $request->cari . '%')
                ->orwhere('nama_rekening', 'LIKE', '%' . $request->cari . '%')
                ->orwhere('status_rekening', 'LIKE', '%' . $request->cari . '%')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        } else {
            $rekening = RekeningModel::orderBy('id', 'DESC')
                ->paginate(10);
        }

        // Ambil data lainya
        $bread          = 'Home | Daftar Rekening Penerima';
        $tittle         = 'Daftar Rekening Penerimaan';
        $menu_setting   = true;
        $menu_setting_rekening = true;

        return view('rekening.rekening_l', compact(
            'rekening',
            'bread',
            'tittle',
            'menu_setting',
            'menu_setting_rekening'
        ));
    }

    public function create()
    {
        // Ambil data lainya
        $bread  = 'Home | Rekening Penerimaan';
        $tittle = 'Rekening Penerimaan';
        $menu_setting = true;
        $menu_setting_rekening = true;

        return view('rekening.rekening_a', compact(
            'bread',
            'tittle',
            'menu_setting',
            'menu_setting_rekening'
        ));
    }

    public function store(ValidateRekening $request)
    {
        try {
            $RK                     = new RekeningModel;
            $RK->no_rekening        = $request->no_rekening;
            $RK->nama_rekening      = $request->nama_rekening;
            $RK->status_rekening    = 'Tidak';


            if ($request->hasFile('gambar_qris')) {
                $gambar_qris      = $request->file('gambar_qris'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('gambar_qris')->getClientOriginalExtension();
                $nama_asli      = pathinfo($gambar_qris, PATHINFO_FILENAME); // Ambil nama file tanpa ekstensi
                $nama_asli      = str_replace(" ", "_", $nama_asli);
                $nama_asli      = substr($nama_asli, 0, 10);
                $nama_berkas_qris = $tgl . '_' . $nama_asli . '.' . $ekstensi;
                // File Asli Pindahin kedalam folder upload
                $gambar_qris->move('upload/rekening/', $nama_berkas_qris);
                // dd($nama_berkas);
            } else {
                $nama_berkas_qris = NULL;
            }

            if ($request->hasFile('gambar_logo_bank')) {
                $gambar_logo_bank      = $request->file('gambar_logo_bank'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('gambar_logo_bank')->getClientOriginalExtension();
                $nama_asli      = pathinfo($gambar_logo_bank, PATHINFO_FILENAME); // Ambil nama file tanpa ekstensi
                $nama_asli      = str_replace(" ", "_", $nama_asli);
                $nama_asli      = substr($nama_asli, 0, 10);
                $nama_berkas_logo_bank = $tgl . '_' . $nama_asli . '.' . $ekstensi;
                // File Asli Pindahin kedalam folder upload
                $gambar_logo_bank->move('upload/rekening/', $nama_berkas_logo_bank);
                // dd($nama_berkas);
            } else {
                $nama_berkas_logo_bank = NULL;
            }

            $RK->gambar_qris        = $nama_berkas_qris;
            $RK->gambar_logo_bank   = $nama_berkas_logo_bank;
            $RK->save();
            // Logs 
            $keg = '#Menambahkan Data Rekening Penerimaan No : ' . $request->no_rekening
                . '#Nama Rekening :' . $request->nama_rekening;
            $this->simpanLogs(LOGS_REKENING, 99, $keg);
            // .Logs

            return redirect()->route('rekening')->with('success', 'Rekening Penerimaan telah ditambahkan!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }


    public function edit($id)
    {
        // Ambil data lainya
        $bread      = 'Home | Edit Rekening Penerimaan';
        $tittle     = 'Edit Rekening Penerimaan';
        $menu_setting           = true;
        $menu_setting_rekening  = true;
        $rekening           = RekeningModel::find($id);

        if (empty($rekening)) {
            return redirect()->route('notfound')->with('gagal', 'Data tidak ditemukan!');
        }

        return view('rekening.rekening_e', compact(
            'rekening',
            'bread',
            'tittle',
            'menu_setting',
            'menu_setting_rekening'
        ));
    }

    public function update(ValidateRekening $request, $id)
    {
        try {
            $RK                 = RekeningModel::find($id);
            $RK->no_rekening    = $request->no_rekening;
            $RK->nama_rekening  = $request->nama_rekening;
            if ($request->hasFile('gambar_qris')) {
                $gambar_qris      = $request->file('gambar_qris'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('gambar_qris')->getClientOriginalExtension();
                $nama_asli      = pathinfo($gambar_qris, PATHINFO_FILENAME); // Ambil nama file tanpa ekstensi
                $nama_asli      = str_replace(" ", "_", $nama_asli);
                $nama_asli      = substr($nama_asli, 0, 10);
                $nama_berkas_qris = $tgl . '_' . $nama_asli . '.' . $ekstensi;
                // File Asli Pindahin kedalam folder upload
                $gambar_qris->move('upload/rekening/', $nama_berkas_qris);
                // dd($nama_berkas);
                $RK->gambar_qris        = $nama_berkas_qris;
            }

            if ($request->hasFile('gambar_logo_bank')) {
                $gambar_logo_bank      = $request->file('gambar_logo_bank'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $ekstensi       = $request->file('gambar_logo_bank')->getClientOriginalExtension();
                $nama_asli      = pathinfo($gambar_logo_bank, PATHINFO_FILENAME); // Ambil nama file tanpa ekstensi
                $nama_asli      = str_replace(" ", "_", $nama_asli);
                $nama_asli      = substr($nama_asli, 0, 10);
                $nama_berkas_logo_bank = $tgl . '_' . $nama_asli . '.' . $ekstensi;
                // File Asli Pindahin kedalam folder upload
                $gambar_logo_bank->move('upload/rekening/', $nama_berkas_logo_bank);
                // dd($nama_berkas);
                $RK->gambar_logo_bank   = $nama_berkas_logo_bank;
            }

            $RK->save();

            // Logs 
            $keg = '#Mengubah Data Rekening Penerimaan No : ' . $RK->no_rekening
                . '#Menjadi :' . $request->no_rekening;
            $this->simpanLogs(LOGS_REKENING, $id, $keg);
            // .Logs

            return redirect()->route('rekening')->with('success', 'Rekening telah di update!');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function view($id)
    {
        // Ambil data lainya
        $bread      = 'Home | Lihat Rekening Penerimaan';
        $tittle     = 'Lihat Detail Rekening Penerimaan';
        $menu_setting   = true;
        $menu_setting_rekening  = true;
        $rekening           = RekeningModel::find($id);

        if (empty($rekening)) {
            return redirect()->route('notfound')->with('gagal', 'Data tidak ditemukan!');
        }

        return view('rekening.rekening_v', compact(
            'rekening',
            'bread',
            'tittle',
            'menu_setting',
            'menu_setting_rekening'
        ));
    }

    public function hapus($id)
    {
        // Hapus (Softdelete dengan mencatat Id user yang hapus)
        $RK = RekeningModel::where('id', $id)
            ->update([
                'deleted_at'     => date('Y-m-d H:i:s'),

            ]);
        // Logs 
        $keg = '#Menghapus Data Rekening Penerimaan No : ' . $RK->no_rekening;
        $this->simpanLogs(LOGS_REKENING, $id, $keg);
        // .Logs
        return redirect()->route('rekening')->with('success', 'Rekening telah dihapus dari database!');
    }

    // Ambil Ref untuk Referensi
    public function getRefRekening()
    {
        $refRekening = RekeningModel::select('id', 'no_rekening', 'nama_rekening')->orderBy('id', 'ASC')->get();
        return $refRekening;
    }
    // Ambil Rekening untuk 
    public function get_rekening()
    {
        $dataRekening = RekeningModel::select('id', 'no_rekening', 'nama_rekening')->orderBy('id', 'ASC')->get();
        return response()->json($dataRekening);
    }
    // Ambil Rekening untuk 
    public function get_rekening_one($rekening_bank)
    {
        $dataRekening = RekeningModel::where('no_rekening', $rekening_bank)->get();
        return response()->json($dataRekening);
    }

    // ---
}
