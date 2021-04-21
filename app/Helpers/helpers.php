<?php

//helper untuk membuat mata uang IDR 

use Carbon\Carbon;

if (!function_exists('moneyFormat')) {

    function moneyFormat($str)
    {
        return 'Rp. ' . number_format($str, '0', '', '.');
    }
}
// helper membuat konfersi tanggal ke bahasa Indonesia
if (!function_exists('dateID')) {

    function dateID($tanggal)
    {
        $value = Carbon::parse($tanggal);
        $parse = $value->locale('id');
        return $parse->translatedFormat('1, d F Y');
    }
}
