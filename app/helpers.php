<?php
// ===========================
// BPHTB
// ===========================

function kekata($x)
{
    $x = abs($x);
    $angka = array(
        "", "satu", "dua", "tiga", "empat", "lima",
        "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
    );
    $temp = "";
    if ($x < 12) {
        $temp = " " . $angka[$x];
    } else if ($x < 20) {
        $temp = kekata($x - 10) . " belas";
    } else if ($x < 100) {
        $temp = kekata($x / 10) . " puluh" . kekata($x % 10);
    } else if ($x < 200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x < 1000) {
        $temp = kekata($x / 100) . " ratus" . kekata($x % 100);
    } else if ($x < 2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x < 1000000) {
        $temp = kekata($x / 1000) . " ribu" . kekata($x % 1000);
    } else if ($x < 1000000000) {
        $temp = kekata($x / 1000000) . " juta" . kekata($x % 1000000);
    } else if ($x < 1000000000000) {
        $temp = kekata($x / 1000000000) . " milyar" . kekata(fmod($x, 1000000000));
    } else if ($x < 1000000000000000) {
        $temp = kekata($x / 1000000000000) . " trilyun" . kekata(fmod($x, 1000000000000));
    }
    return $temp;
}

function terbilang($x, $style = 4)
{
    if ($x < 0) {
        $hasil = "minus " . trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }
    return $hasil;
}

if (!function_exists('clear_numeric')) {
    function clear_numeric($val = null)
    {
        $result = str_replace('.', '', $val);
        $result = str_replace(',', '.', $result);
        return $result;
    }
}

if (!function_exists('formatRupiah')) {
    function formatRupiah($angka)
    {

        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
}

// ===========================
// PENENTUAN TEMPLATE
// ===========================
if (!function_exists('setTemplate')) {
    function setTemplate()
    {
        $user_group = session()->get('datauser')->user_group;
        if ($user_group < 6) {
            return 'templates/main_template';
        } elseif ($user_group >= 6 && $user_group <= 10) {
            return 'templates/user_template';
        } else {
            return 'templates/web_template';
        }
    }
}

// ===========================
// OMS
// ===========================



if (!function_exists('formatDate')) {
    function formatDate($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d');
    }
}

if (!function_exists('formatDateAddMonth')) {
    function formatDateAddMonth($value, $num)
    {
        return \Carbon\Carbon::parse(formatDate($value))->addMonths($num)->format('Y-m-d');
    }
}

if (!function_exists('formatDateIndo')) {
    function formatDateIndo($value)
    {
        // 8 September 2021
        return \Carbon\Carbon::parse($value)->isoFormat('D MMMM Y');
    }
}

if (!function_exists('formatDateDayIndo')) {
    function formatDateDayIndo($value)
    {
        // Rabu, 8 September 2021
        return \Carbon\Carbon::parse($value)->isoFormat('dddd, D MMMM Y');
    }
}


if (!function_exists('formatDayIndo')) {
    function formatDayIndo($value)
    {
        // Rabu
        return \Carbon\Carbon::parse($value)->isoFormat('dddd');
    }
}

if (!function_exists('formatMonthIndo')) {
    function formatMonthIndo($bulan)
    {
        if ($bulan == '01') {
            return "Januari";
        } else if ($bulan == '02') {
            return "Februari";
        } else if ($bulan == '03') {
            return "Maret";
        } else if ($bulan == '04') {
            return "April";
        } else if ($bulan == '05') {
            return "Mei";
        } else if ($bulan == '06') {
            return "Juni";
        } else if ($bulan == '07') {
            return "Juli";
        } else if ($bulan == '08') {
            return "Agustus";
        } else if ($bulan == '09') {
            return "September";
        } else if ($bulan == '10') {
            return "Oktober";
        } else if ($bulan == '11') {
            return "November";
        } else if ($bulan == '12') {
            return "Desember";
        }
    }
}
