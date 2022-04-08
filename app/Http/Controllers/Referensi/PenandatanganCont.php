<?php

namespace App\Http\Controllers\Referensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PenandatanganModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Throwable;

// use App\Http\Requests\ValidateRekening;
// use App\Models\Logs\LogsModel;
// use App\Http\Traits\LogsTrait;

class PenandatanganCont extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data = PenandatanganModel::where('nip_penandatangan', 'LIKE', '%' . $request->cari . '%')
                ->orwhere('nama_penandatangan', 'LIKE', '%' . $request->cari . '%')
                ->orderBy('kode_penandatangan', 'DESC')
                ->paginate(20);
        } else {
            $data = PenandatanganModel::orderBy('kode_penandatangan', 'DESC')
                ->paginate(20);
        }

        // Ambil data lainya
        $bread          = 'Home | Daftar Petugas BPHTB';
        $tittle         = 'Daftar Petugas BPHTB';
        $menu_setting   = true;
        $menu_setting_petugas = true;

        return view('petugas.petugas_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_setting',
            'menu_setting_petugas'
        ));
        //--
    }
    public function get_bendahara()
    {
        $dataBendahara = PenandatanganModel::select('id', 'kode_penandatangan', 'nip_penandatangan', 'nama_penandatangan')
            ->where('kode_penandatangan', 'diterima')
            ->orderBy('id', 'ASC')
            ->get();
        return response()->json($dataBendahara);
        //--
    }

    public function get_verifikator()
    {
        $dataVerifikator = PenandatanganModel::select('id', 'kode_penandatangan', 'nip_penandatangan', 'nama_penandatangan')
            ->where('kode_penandatangan', 'diverifikasi')
            ->orderBy('id', 'ASC')
            ->get();
        return response()->json($dataVerifikator);
        //--
    }

    public function create()
    {
        $bread          = 'Home | Daftar Petugas BPHTB | Tambah';
        $tittle         = 'Tambah Petugas BPHTB';
        $menu_setting   = true;
        $menu_setting_petugas = true;

        return view('petugas.petugas_a', compact(
            'bread',
            'tittle',
            'menu_setting',
            'menu_setting_petugas'
        ));
    }

    public function store(Request $request)
    {
        $rules = [
            'nip_penandatangan' => 'required|numeric|min:18|unique:penandatangan',
            'nama_penandatangan' => 'required|string',
            'kode_penandatangan' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->with('validator', 'store')->withErrors($validator)->withInput();
        }

        try {
            $data = new PenandatanganModel;
            $data->kode_penandatangan = $request->kode_penandatangan;
            $data->nip_penandatangan = $request->nip_penandatangan;
            $data->nama_penandatangan = $request->nama_penandatangan;
            $data->created_by = Auth::user()->nama;
            $data->save();

            return redirect()->route('petugas')->with('success', 'Data telah disimpan!');
        } catch (Throwable $th) {
            dd($th);
        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nip_penandatangan' => 'required|numeric|min:18|' . Rule::unique('penandatangan')->ignore($id),
            'nama_penandatangan' => 'required|string',
            'kode_penandatangan' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->with([
                'validator' => 'edit',
                'route' => route('petugas.update', ['id' => $id])
            ])->withErrors($validator)->withInput();
        }

        try {
            $model = PenandatanganModel::whereId($id);

            $data = [
                'kode_penandatangan' => $request->kode_penandatangan,
                'nip_penandatangan' => $request->nip_penandatangan,
                'nama_penandatangan' => $request->nama_penandatangan,
                'updated_by' => Auth::user()->nama
            ];

            $model->update($data);

            return redirect()->route('petugas')->with('success', 'Data telah disimpan!');
        } catch (Throwable $th) {
            dd($th);
        }
    }

    public function hapus($id)
    {
        try {
            $model = PenandatanganModel::whereId($id);
            $model->update(['deleted_by' => Auth::user()->nama]);
            $model->delete();

            return redirect()->route('petugas')->with('success', 'Data dipindahkan ke sampah!');
        } catch (Throwable $th) {
            dd($th);
        }
    }
    //---
}
