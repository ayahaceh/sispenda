<?php



namespace App\Http\Controllers\Satkers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SatkersModel;
use File;

class SatkersCont extends Controller
{

    public function index()
    {
        $id         = 1;
        $satkers    = SatkersModel::find($id);
        $bread      = 'Home | Informasi Kantor';
        $tittle     = 'Identitas Pengguna Aplikasi';
        $menu_setting           = true;
        $menu_setting_satker    = true;

        return view('satkers.satker_v', compact(
            'satkers',
            'bread',
            'tittle',
            'menu_setting',
            'menu_setting_satker'
        ));
    }

    public function edit()
    {
        $id             = 1;
        $satkers        = SatkersModel::find($id);
        $bread          = 'Home | Informasi Kantor | Edit';
        $tittle         = 'Informasi Kantor';
        $menu_setting   = true;
        $menu_setting_satker    = true;


        return view('satkers.satker_e', compact(
            'satkers',
            'bread',
            'tittle',
            'menu_setting',
            'menu_setting_satker'
        ));
    }

    public function update(Request $request)
    {
        $id = 1;
        try {
            $satkers = SatkersModel::find($id);
            $satkers->nama_satker       = $request->nama_satker;
            $satkers->alamat_satker     = $request->alamat_satker;
            $satkers->ket_satker        = $request->ket_satker;
            $satkers->nama_satkera      = $request->nama_satkera;
            $satkers->nama_satkerb      = $request->nama_satkerb;
            $satkers->kota_satker       = $request->kota_satker;
            $satkers->prov_satker       = $request->prov_satker;
            $satkers->telp_satker       = $request->telp_satker;
            $satkers->email_satker      = $request->email_satker;
            $satkers->nama_kepala       = $request->nama_kepala;
            $satkers->nip_kepala        = $request->nip_kepala;
            $satkers->jab_kepala        = $request->jab_kepala;

            if ($request->hasFile('logo_satker')) {
                if ($satkers->logo_satker != 'default.png') {
                    $filename = public_path() . '/upload/app/logos/' . $satkers->logo_satker;
                    File::delete($filename);
                }

                $file_logo_satker = $request->file('logo_satker'); // Pindahin ke temporary folder
                $tgl            = date('ymd_His');
                $nama_asli      = $request->file('logo_satker')->getClientOriginalName();
                $nama_asli      = str_replace(" ", "_", $nama_asli);
                $nama_asli      = substr($nama_asli, 0, 80);
                $nama_berkas    = $tgl . '_' . $nama_asli;
                $file_logo_satker->move('upload/app/logos', $nama_berkas); // Pindahin kedalam folder 
                $satkers->logo_satker = $nama_berkas;
            }

            $satkers->save();

            return redirect()->route('setting.satkers')->with('success', 'Data satkers Berhasil diperbaharui.');
        } catch (\Throwable $th) {
            dd("error", $th);
        }
    }

    public function getRefSatker()
    {
        $refSatker = SatkersModel::select('id', 'nama_satker')->orderBy('nama_satker', 'ASC')->get();
        return $refSatker;
    }




    //----
}
