<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForbidenCont extends Controller
{
    function index()
    {
        $bread = 'Home | Forbiden Access! ';
        $tittle = 'Forbiden!';
        return view('admin.user_forbiden', compact(
            'bread',
            'tittle'
        ));
    }

    function not_found()
    {
        $bread = 'Home | Unknown Record';
        $tittle = 'Data Tidak ditemukan!';
        return view('admin.not_found', compact(
            'bread',
            'tittle'
        ));
    }

    function deny()
    {
    }
    //-------------
}
