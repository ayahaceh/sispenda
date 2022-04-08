<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Logs\LogsModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PeralihanNopModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Exports\BpnExport;

// use App\Http\Requests\TransaksiPeralihan;
// use App\Models\Referensi\JenisPerolehanModel;
// use App\Models\NopPbbModel;
// use Illuminate\Support\Facades\DB;
// use App\Models\Referensi\RekeningModel;



class LogsCont extends Controller
{

    public function index()
    {
        $data = LogsModel::where('user_id', Auth()->user()->id)->paginate(20);
        $bread          = 'Home | Activity | My Activity';
        $tittle         = 'Aktivitas Saya';
        $menu_logs      = true;
        $menu_my_logs   = true;

        return view('logs.logs_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_logs',
            'menu_my_logs',
        ));
    }

    public function operator()
    {
        $data = LogsModel::select('logs.*', 'users.nama')
            ->join('users', 'users.id', 'logs.user_id')
            ->where('users.user_group', USER_OPERATOR)
            ->paginate(20);
        $bread          = 'Home | Activity | Operator';
        $tittle         = 'Aktivitas Operator';
        $menu_logs      = true;
        $menu_logs_operator     = true;

        return view('logs.logs_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_logs',
            'menu_logs_operator',
        ));
    }

    public function admin()
    {
        $data = LogsModel::select('logs.*', 'users.nama')->join('users', 'users.id', 'logs.user_id')
            ->where('users.user_group', USER_ADMIN)
            ->paginate(20);
        $bread          = 'Home | Activity | Admin';
        $tittle         = 'Aktivitas Admin';
        $menu_logs      = true;
        $menu_logs_admin     = true;

        return view('logs.logs_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_logs',
            'menu_logs_admin',
        ));
    }

    public function pejabat()
    {
        $data = LogsModel::select('logs.*', 'users.nama')->join('users', 'users.id', 'logs.user_id')
            ->where('users.user_group', USER_KABID)
            ->orWhere('users.user_group', USER_KABAN)
            ->paginate(20);
        $bread          = 'Home | Activity | Pejabat';
        $tittle         = 'Aktivitas Pejabat';
        $menu_logs      = true;
        $menu_logs_pejabat     = true;

        return view('logs.logs_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_logs',
            'menu_logs_pejabat',
        ));
    }

    public function ppat()
    {
        $data = LogsModel::select('logs.*', 'users.nama')->join('users', 'users.id', 'logs.user_id')
            ->where('users.user_group', USER_PPAT)
            ->paginate(20);
        $bread          = 'Home | Activity | PPAT';
        $tittle         = 'Aktivitas PPAT';
        $menu_logs      = true;
        $menu_logs_ppat     = true;

        return view('logs.logs_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_logs',
            'menu_logs_ppat',
        ));
    }

    public function publik()
    {
        $data = LogsModel::select('logs.*', 'users.nama')->join('users', 'users.id', 'logs.user_id')
            ->where('users.user_group', USER_BPN)
            ->orWhere('users.user_group', USER_PUBLIK)
            ->paginate(20);
        $bread          = 'Home | Activity | BPN dan Publik';
        $tittle         = 'Aktivitas BPN dan Publik';
        $menu_logs      = true;
        $menu_logs_publik     = true;

        return view('logs.logs_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_logs',
            'menu_logs_publik',
        ));
    }

    public function hapus($id)
    {
        $hapus = LogsModel::find($id);
        // dd($hapus);
        $hapus->delete();
        return back()->with('warning', 'Logs Aktivitas Telah Dihapus!');
    }

    public function kosongkan()
    {
        // $data = "Sukses Hapus";
        // dd($data);
        LogsModel::truncate();
        return back()->with('success', 'Logs Aktivitas telah dikosongkan permanen!');
    }

    public function semua_logs()
    {
        $data = LogsModel::select('logs.*', 'users.nama')->join('users', 'users.id', 'logs.user_id')
            ->where('users.user_group', '>', USER_SUPER_ADMIN)
            ->paginate(20);
        $bread          = 'Home | Activity | All';
        $tittle         = 'Semua Aktivitas Pengguna';
        $menu_logs      = true;
        $menu_logs_semua     = true;

        return view('logs.logs_l', compact(
            'data',
            'bread',
            'tittle',
            'menu_logs',
            'menu_logs_semua',
        ));
    }


    //--
}
