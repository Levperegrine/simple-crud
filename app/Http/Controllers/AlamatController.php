<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Desa;

class AlamatController extends Controller
{
    public function getKotas($provinsi_id)
    {
        $kotas = Kota::where('provinsi_id', $provinsi_id)->get();
        return response()->json($kotas);
    }

    public function getKecamatans($kota_id)
    {
        $kecamatans = Kecamatan::where('kota_id', $kota_id)->get();
        return response()->json($kecamatans);
    }

    public function getDesas($kecamatan_id)
    {
        $desas = Desa::where('kecamatan_id', $kecamatan_id)->get();
        return response()->json($desas);
    }
}