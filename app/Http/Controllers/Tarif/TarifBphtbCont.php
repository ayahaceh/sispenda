<?php

namespace App\Http\Controllers\Tarif;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarif\TarifBphtbModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\LogsTrait;

class TarifBphtbCont extends Controller
{
    use LogsTrait;
    public function index()
    {
        $data       = TarifBphtbModel::paginate(20);
        $bread      = 'Tarif | BPHTB';
        $tittle     = 'Tarif BPHTB';
        $menu_tarif = true;
        $menu_tarif_bphtb = true;

        return view('tarif.tarif_bphtb_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_tarif',
            'menu_tarif_bphtb',
        ));
    }

    public function store($request)
    {
        // Kode disini
    }

    public function edit($id)
    {
        $data = TarifBphtbModel::whereId($id)->first();
        $bread = 'Tarif | BPHTB | Edit';
        $tittle = 'Edit Tarif BPHTB';
        $menu_tarif = true;
        $menu_tarif_bphtb = true;

        return view('tarif.tarif_bphtb_e', compact(
            'data',
            'bread',
            'tittle',
            'menu_tarif',
            'menu_tarif_bphtb',
        ));
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'kode_tarif_bphtb' => 'required|max:255',
                'persen_tarif_bphtb' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $db = TarifBphtbModel::find($id);
            $db->kode_tarif_bphtb       = $request->kode_tarif_bphtb;
            $db->persen_tarif_bphtb     = $request->persen_tarif_bphtb;
            $db->ket_tarif_bphtb        = $request->ket_tarif_bphtb;
            $db->save();
            // Logs 
            $keg = '#Mengubah (edit) Data Tarif BPHTB kode : ' . $db->kode_tarif_bphtb
                . ' #Tarif Persen : ' . $db->persen_tarif_bphtb;
            $this->simpanLogs(LOGS_TARIF_BPHTB, $id, $keg);
            // .Logs
            return redirect()->route('tarif.bphtb')->with('success', 'Data telah dirubah');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function delete($id)
    {
        // Kode disini
    }



    // ----------------
}
