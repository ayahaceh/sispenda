<?php

namespace App\Http\Controllers\Download;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;

class DownloadCont extends Controller
{

    public function index()
    {
    }
    public function apk()
    {
        $nama_file  = 'Earsip.apk';
        $filenya    = public_path('upload/app/docs/' . $nama_file);
        $isExists   = File::exists($filenya);
        if ($isExists == true) {
            return response()->download($filenya);
        } else {
            alert()->error('Download gagal, berkas tidak tersedia', 'Ops');
            return back();
        }
    }
    public function userguide()
    {
        $nama_file  = 'Userguide.pdf';
        $filenya    = public_path('upload/app/docs/' . $nama_file);
        $isExists   = File::exists($filenya);
        if ($isExists == true) {
            return response()->download($filenya);
        } else {
            alert()->error('Download gagal, berkas tidak tersedia', 'Ops');
            return back();
        }
    }


    // ----------------
}
