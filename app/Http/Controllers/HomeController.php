<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        // Ambil info user yang login
        $datasatker = SatkersModel::first();
        // Set session data satker
        session(['datasatker' => $datasatker]);
        return view('home');
    }

    // --
}
