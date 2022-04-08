<?php

namespace App\Http\Controllers\Pbb;

use App\Http\Controllers\Controller;
use App\Models\Pbb;
use Illuminate\Http\Request;


class AdminPbbCont extends Controller
{
    public function index(Request $request)
    {
        $data           = "Ini View untuk menampilkan Tabel PBB Terhutang";
        $bread          = 'Home | Transaksi | PBB';
        $tittle         = 'Daftar Transaksi PBB';
        $menu_pbb_group = true;
        $menu_pbb       = true;
        $tahun = $request->tahun ?? date("Y");
        $pbb = Pbb::whereYear("tgl_pbb", $tahun)->with("desaWp", "desaNop", "kecamatanWp", "kecamatanNop", "kabupatenWp", "KabupatenNop")->orderBy("nama_wp", "asc");

        if ($request->has("cari"))
            $pbb->where(function ($q) use ($request) {
                $q->where("nama_wp", "like", "%" . $request->cari . "%")
                    ->orWhere("nik", "like", "%" . $request->cari . "%")
                    ->orWhere("nop", "like", "%" . $request->cari . "%");
            });
        $pbbs = $pbb->latest()->paginate(20);
        return view('pbb/admin/admin_pbb_l', compact(
            'data',
            'bread',
            "pbbs",
            "tahun",
            'tittle',
            'menu_pbb_group',
            'menu_pbb'
        ));
    }
    public function edit(Pbb $pbb)
    {
        $bread          = 'Home | Transaksi | PBB';
        $tittle         = 'Edit Transaksi PBB';
        $menu_pbb_group = true;
        $menu_pbb       = true;
        return view('pbb/admin/edit-pbb', compact(
            'tittle',
            'bread',
            "pbb",
            'menu_pbb_group',
            'menu_pbb'
        ));
    }
    public function update(Request $request,  Pbb $pbb)
    {
        if ($request->has("pbb"))
            return $this->update_nilai($pbb);
        else if ($request->has("button_wp"))
            return $this->updateWajibPajak($pbb);
        else if ($request->has("button_op"))
            return $this->updateObjectPajak($pbb);
    }

    public function show(Pbb $pbb)
    {
        return view("pbb.admin.lihat-print", compact("pbb"));
    }
    public function print(Pbb $pbb, $type = "pbb")
    {
        if ($type == "pbb")
            return view("pbb.admin.make_pdf-pbb", compact("pbb"));
        return view("pbb.admin.make_pdf_stts", compact("pbb"));
    }



    private function updateObjectPajak($pbb)
    {
        $data = request()->validate([
            "letak_nop" => "required",
            "kode_prov_nop" => "required",
            "kode_kab_nop" => "required",
            "kode_kec_nop" => "required",
            "kode_desa_nop" => "required",
            "rtrw_nop" => "required",
            "kode_pos_nop" => "nullable",
        ]);
        $pbb->update($data);
        return  redirect()->back()->with('success', "Obejk Pajak Telah Di Update");
    }
    private function updateWajibPajak($pbb)
    {
        $data = request()->validate([
            "nik" => "required",
            "nama_wp" => "required",
            "alamat_wp" => "required",
            "kode_prov_wp" => "required",
            "kode_kab_wp" => "required",
            "kode_kec_wp" => "required",
            "kode_desa_wp" => "required",
            "rtrw_wp" => "required",
            "kode_pos_wp" => "required",
        ]);
        $pbb->update($data);
        return  redirect()->back()->with('success', "Wajib Pajak Telah Di Update");
    }
    private function update_nilai($pbb)
    {
        $data = request()->validate([
            "luas_tanah" => "required",
            "njop_tanah" => "required",
            "luas_bangunan" => "required",
            "njop_bangunan" => "required",
            "jumlah_njop" => "required",
            "jumlah_njoptkp" => "required",
            "jumlah_njop_pbb" => "required",
            "jumlah_terhutang" => "required",
        ]);
        $pbb->update($data);
        return  redirect()->back()->with('success', "Nilai PBB Telah Di Update");
    }
}
