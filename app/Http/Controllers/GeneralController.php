<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

// use App\Models\SPMModel;
// use App\Models\Logs\LogsModel;
// use App\Models\UserModel;
// use App\Models\Setting\SettingAppModel;

class GeneralController extends Controller
{

    public function index()
    {
        // dd(USER_PENATA_KAS);
        // Ambil data lainya
        $bread      = 'Home';
        $tittle     = 'Dashboard';
        $menu_home  = true;

        $hari_ini   = date('Y-m-d');
        $date       = Carbon::parse($hari_ini);
        $weekNumber = $date->weekNumberInMonth;
        $start      = $date->startOfWeek()->toDateString();
        $end        = $date->endOfWeek()->toDateString();

        dump($weekNumber);
        dump($start);
        dump($end);


        return view('dashboard.dashboard_v', compact(
            'bread',
            'tittle',
            'menu_home'
        ));
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }


    // ---
}
