<?php

namespace App\Http\Controllers\Tarif;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarif\TarifNjopModel;
// use App\Http\Traits\LogsTrait;

use App\Models\Alamat\KabModel;
use App\Models\Alamat\KecModel;
use App\Models\Alamat\DesaModel;

class TarifNjopCont extends Controller
{
    // use LogsTrait;
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $keyword    = $request->cari;
            $data       = TarifNjopModel::select('tarif_njop.*', 'desa.nama_desa')
                ->leftJoin('desa', 'desa.kode_desa', 'tarif_njop.kode_desa')
                ->where('tarif_njop.kode_desa', 'LIKE',  '%' . $keyword . '%')
                ->orWhere('nama_desa', 'LIKE',  '%' . $keyword . '%')
                ->paginate(20);
            $clearButton    = true;
        } else {
            $data           = TarifNjopModel::orderBy('kode_desa', 'ASC')->paginate(20);
            $clearButton    = false;
            $keyword        = '';
        }
        // dd($data);
        // Ambil data lainya
        $bread          = 'Home | Tarif | Zona Nilai Tanah';
        $tittle         = 'Daftar Tarif Zona Nilai Tanah';
        $menu_tarif     = true;
        $menu_tarif_znt = true;

        return view('tarif.tarif_njop_l', compact(
            'data',
            'clearButton',
            'keyword',

            'bread',
            'tittle',
            'menu_tarif',
            'menu_tarif_znt',
        ));
    }

    public function pilih_njop_tanah($kode_desa)
    {
        $dataNjopTanah = TarifNjopModel::where('kode_desa', $kode_desa)->get();
        return response()->json($dataNjopTanah);
    }

    public function kodeDesaAutoComplete(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = DesaModel::select('id', 'kode_desa', 'nama_desa')
                ->where(function ($query) use ($search) {
                    $query->where('kode_desa', 'LIKE', "%$search%");
                        // ->orwhere('nik', 'LIKE', "%$search%");
                })->get();
            foreach($data as $item){
                $data[] = array(
                    'id' => $item->kode_desa,
                    'text' => $item->kode_desa,
                    'nama_desa' => $item->nama_desa,
                  );
            }
        }
        return response()->json($data);
    }

    public function store(Request $request)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'kode_tarif_bphtb' => 'required|max:255',
            //     'persen_tarif_bphtb' => 'required|numeric',
            // ]);

            // if ($validator->fails()) {
            //     return back()->withErrors($validator)->withInput();
            // }

            $db = new TarifNjopModel;
            $db->kode_desa          = $request->kode_desa;
            $db->kode_tarif_njop    = $request->kode_tarif_njop;
            $db->jumlah_tarif_njop  = $request->jumlah_tarif_njop;
            $db->ket_tarif_njop     = 'Tarif '. $request->kode_tarif_njop. ' - '.$request->nama_desa;
            $db->save();
            // Logs 
            // $keg = '#Mengubah (edit) Data Tarif BPHTB kode : ' . $db->kode_tarif_bphtb
            //     . ' #Tarif Persen : ' . $db->persen_tarif_bphtb;
            // $this->simpanLogs(LOGS_TARIF_ZNT, $id, $keg);
            // .Logs
            return back()->with('success', 'Data telah disimpan');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // $validator = Validator::make($request->all(), [
            //     'kode_tarif_bphtb' => 'required|max:255',
            //     'persen_tarif_bphtb' => 'required|numeric',
            // ]);

            // if ($validator->fails()) {
            //     return back()->withErrors($validator)->withInput();
            // }

            $db = TarifNjopModel::find($id);
            $db->kode_desa          = $request->kode_desa;
            $db->kode_tarif_njop    = $request->kode_tarif_njop;
            $db->jumlah_tarif_njop  = $request->jumlah_tarif_njop;
            $db->ket_tarif_njop     = 'Tarif '. $request->kode_tarif_njop. ' - '.$request->nama_desa;
            $db->save();
            // Logs 
            // $keg = '#Mengubah (edit) Data Tarif BPHTB kode : ' . $db->kode_tarif_bphtb
            //     . ' #Tarif Persen : ' . $db->persen_tarif_bphtb;
            // $this->simpanLogs(LOGS_TARIF_ZNT, $id, $keg);
            // .Logs
            return back()->with('success', 'Data telah dirubah');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function delete($id)
    {
        $db = TarifNjopModel::find($id);
        $db->delete();
        return back()->with('success', 'Data telah dihapus');
    }

    // ----------------
}
