<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use File;
use Image;


trait UploadBerkasTrait
{
    public function uploadFotoUser(Request $request, $namaKolom)
    {
        $file_foto      = $request->file($namaKolom); // Pindahin ke temporary folder
        $tgl            = date('ymd_His');
        $ekstensi       = $request->file($namaKolom)->getClientOriginalExtension();
        $nama_asli      = str_replace(" ", "_", $request->nama);
        $nama_asli      = substr($nama_asli, 0, 30);
        $nama_berkas    = $tgl . '_' . $nama_asli . '.' . $ekstensi;

        // Compress dan pindah ke sub folder comp
        $img            = Image::make($file_foto->getRealPath());
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save('upload/users/comp/' . $nama_berkas);

        // Pindahin kedalam folder upload
        $file_foto->move('upload/users/', $nama_berkas);
        return $nama_berkas;
    }



    //
}
