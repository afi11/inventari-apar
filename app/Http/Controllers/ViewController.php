<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    
    public function index()
    {
        $countPunyaSegitiga = app("App\Http\Controllers\CRUDController")->countSegitigaApar(1);
        $countTakPunyaSegitiga = app("App\Http\Controllers\CRUDController")->countSegitigaApar(0);
        $countPunyaPetunjuk = app("App\Http\Controllers\CRUDController")->countPetunjukPenggunaan(1);
        $countTakPunyaPetunjuk = app("App\Http\Controllers\CRUDController")->countPetunjukPenggunaan(0);
        $countPunyaKartuPemeliharaan = app("App\Http\Controllers\CRUDController")->countKartuPemeliharaan(1);
        $countTakPunyaKartuPemeliharaan = app("App\Http\Controllers\CRUDController")->countKartuPemeliharaan(0);
        return view("apar.index", compact("countPunyaSegitiga", "countTakPunyaSegitiga", "countPunyaPetunjuk", 
            "countTakPunyaPetunjuk", "countPunyaKartuPemeliharaan", "countTakPunyaKartuPemeliharaan"));
    }

    public function create()
    {
        $lokasi = app("App\Http\Controllers\CRUDController")->getLokasi();
        $ukuran = app("App\Http\Controllers\CRUDController")->getUkuran();
        $jenis = app("App\Http\Controllers\CRUDController")->getJenis();
        return view("apar.create", compact("lokasi", "ukuran", "jenis"));
    }

    public function detail($id)
    {
        $lokasi = app("App\Http\Controllers\CRUDController")->getLokasi();
        $ukuran = app("App\Http\Controllers\CRUDController")->getUkuran();
        $jenis = app("App\Http\Controllers\CRUDController")->getJenis();
        $apar = app("App\Http\Controllers\CRUDController")->getData($id);
        return view("apar.detail", compact("apar", "lokasi", "ukuran", "jenis"));
    }


}
