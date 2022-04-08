<?php

namespace App\Libraries\FPDF;

use Codedge\Fpdf\Fpdf\Fpdf;

class Pdf extends Fpdf
{
    function __construct(){
        $this->setFontPath();
    }

    public function setFontPath(){
        $this->fontpath = app_path().'/Libraries/FPDF/font/';
    }
}
?>