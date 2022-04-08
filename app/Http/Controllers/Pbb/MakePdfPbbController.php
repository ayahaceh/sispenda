<?php

namespace App\Http\Controllers\Pbb;

use App\Http\Controllers\Controller;
use App\Models\Pbb;
use PDF;

class MakePdfPbbController extends Controller
{
    public function showPdf(Pbb $pbb)
    {

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 'format' => [179, 191],
            "margin-top" => 0,
            "margin-bottom" => 0,
        ]);
        $html = view('pbb/admin/make_pdf', compact("pbb"));
        $mpdf->WriteHTML($html);
        header('Content-Type: application/pdf');
        $mpdf->Output("oke.pdf", "I");
    }
    public function sttsPdf(Pbb $pbb)
    {

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 'format' => [119, 350],
            "margin-top" => 0,
            "margin-bottom" => 0,
        ]);
        $html = view('pbb/admin/make_pdf_stts', compact("pbb"));
        $mpdf->WriteHTML($html);
        header('Content-Type: application/pdf');
        $mpdf->Output("oke.pdf", "I");
    }
}
