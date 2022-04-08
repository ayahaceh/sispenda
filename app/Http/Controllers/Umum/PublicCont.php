<?php

namespace App\Http\Controllers\Umum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicCont extends Controller
{
    public function index()
    {
        $title = 'E-Arsip | Home';
        $bread = 'Home';
        // $sesss = session::all();
        return view('Dashboard/dashboard_v', ['bread' => $bread, 'tittle' => $title,]);
    }

    public function forbiden()
    {
        // form forbiden
        $title = 'Forbiden';
        $bread = 'Home';
        // $sesss = session::all();
        return view('admin/user_forbiden', ['bread' => $bread, 'tittle' => $title,]);
    }








    //-------------------
}
