<?php

namespace App\Http\Controllers\Petunjuk;

use App\Http\Controllers\Controller;

class PetunjukCont extends Controller
{

    public function index(Request $request)
    {
        $view       = 'petunjuk.user.penambahan_user';
        $bread      = 'Home | Petunjuk | Tambah User';
        $tittle     = 'Petunjuk Penambahan Pengguna';

        return view(
            $view,
            compact(
                'bread',
                'tittle',
            )
        );
    }

    public function tambahUser()
    {
        $view       = 'petunjuk.user.petunjuk_user_a';
        $bread      = 'Home | Petunjuk | Tambah User';
        $tittle     = 'Petunjuk Penambahan Pengguna';

        return view(
            $view,
            compact(
                'bread',
                'tittle',
            )
        );
    }

    public function userguide()
    {
        if (session()->get('datauser')->user_group <= 10) {
            $file       = public_path() . "/upload/app/docs/userguide.pdf";
            $nama_file  = 'petunjuk_penggunaan_bpkk.pdf';
        } else {
            $file       = public_path() . "/upload/app/docs/userguide_skpd.pdf";
            $nama_file  = 'petunjuk_penggunaan_skpd.pdf';
        }
        $headers    = array(
            'Content-Type: application/pdf',
        );
        return Response()->download($file, $nama_file, $headers);
    }
    //--
}
