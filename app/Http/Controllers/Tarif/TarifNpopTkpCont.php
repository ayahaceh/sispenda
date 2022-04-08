<?php

namespace App\Http\Controllers\Tarif;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarif\NpopTkpModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Traits\LogsTrait;

class TarifNpopTkpCont extends Controller
{
    use LogsTrait;
    public function index()
    {
        $data       = NpopTkpModel::paginate(20);
        $bread      = 'Tarif | NPOP TKP';
        $tittle     = 'Tarif NPOP TKP';
        $menu_tarif = true;
        $menu_tarif_npoptkp = true;

        return view('tarif.tarif_npop_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_tarif',
            'menu_tarif_npoptkp',
        ));
    }

    public function store($request)
    {
        // Kode disini
    }

    public function edit($id)
    {
        $data = NpopTkpModel::whereId($id)->first();
        $bread = 'Tarif | NPOP TKP | Edit';
        $tittle = 'Edit Tarif NPOP TKP';
        $menu_tarif = true;
        $menu_tarif_npoptkp = true;

        return view('tarif.tarif_npop_e', compact(
            'data',
            'bread',
            'tittle',
            'menu_tarif',
            'menu_tarif_npoptkp',
        ));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_npop_tkp' => 'required|max:255',
            'tarif_npop_tkp' => 'required|numeric|digits_between:1,10',
            'default' => 'required|' . Rule::in([0, 1]),
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $db = NpopTkpModel::find($id);
            $db->kode_npop_tkp  = $request->kode_npop_tkp;
            $db->tarif_npop_tkp = $request->tarif_npop_tkp;
            $db->ket_npop_tkp   = $request->ket_npop_tkp;
            $db->default        = $request->default;
            $db->updated_by     = Auth::user()->nama;
            $db->save();
            // Logs 
            $keg = '#Mengubah (edit) Data Tarif NPOPTKP kode : ' . $db->kode_npop_tkp
                . ' #Tarif : ' . $db->tarif_npop_tkp . ' #Menjadi : ' . $request->kode_npop_tkp . ' #Tarif : ' . $request->tarif_npop_tkp;
            $this->simpanLogs(LOGS_TARIF_NPOPTKP, $id, $keg);
            // .Logs
            return redirect()->route('tarif.npoptkp')->with('success', 'Data telah disimpan');
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
