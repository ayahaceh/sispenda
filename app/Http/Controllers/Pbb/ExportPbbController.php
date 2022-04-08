<?php

namespace App\Http\Controllers\Pbb;

use App\Exports\PbbExportExcel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportPbbController extends Controller
{
    public function toExcel()
    {
        $file_name = 'pbb-export-' . date('Ymd_His') . ' - Export by ' . env('APP_NAME') . '.xlsx';
        return Excel::download(new PbbExportExcel, $file_name);
    }
}
