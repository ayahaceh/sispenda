<?php

namespace App\Http\Traits;

// use Illuminate\Http\Request;
use File;
use Image;

// use App\Models\ProsesPjbModel;

trait UploadFotoUserTrait
{
    public function uploadFotoUser($path_1, $path_2, $foto_lama, $foto_diupload, $nama_filenya, $ekstensi)
    {
        // Upload Foto Asli dan compress foto juga

        if ($foto_lama != 'default.JPG' || $foto_lama != 'default.PNG') {
            // remove last users photo
            $filename = public_path() . $path_1 . $foto_lama;
            File::delete($filename);
            $filename = public_path() . $path_2 . $foto_lama;
            File::delete($filename);
        }

        $tgl            = date('ymd_His');
        $file_foto      = $foto_diupload; // Pindahin ke temporary folder
        $nama_filenya   = str_replace(" ", "_", $nama_filenya);
        $nama_filenya   = substr($nama_filenya, 0, 50);
        $nama_simpan    = $tgl . '_' . $nama_filenya . '.' . $ekstensi;
        // dd($nama_simpan);
        // $ekstensi       = $request->file('foto')->getClientOriginalExtension();
        // $nama_asli      = $request->file('foto')->getClientOriginalName();
        // $nama_asli      = pathinfo($nama_asli, PATHINFO_FILENAME); // Ambil nama file tanpa ekstensi

        // Compress dan pindah ke sub folder comp
        $image          = $foto_diupload;
        $img            = Image::make($image->getRealPath());
        $img->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path_1 . $nama_simpan);

        $file_foto->move($path_2, $nama_simpan); // Pindahin kedalam folder upload
        return $nama_simpan;
    }



    //
}
