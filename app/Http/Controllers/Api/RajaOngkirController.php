<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class RajaOngkirController extends Controller
{
    public function getProvinces()
    {
        $provinces = Province::all();
        return response()->json([
            'success'   => true,
            'message'   => 'List Data Provinsi',
            'data'      => $provinces
        ]);
    }

    public function getCities(Request $request)
    {
        $city = City::where('province_id', $request->province_id)->get();
        return response()->json([
            'success'   => true,
            'message'   => 'List Data Cities By Provinces',
            'data'      => $city
        ]);
    }

    public function checkOngkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 456,                         //kode ID kota asal
            'destination'   => $request->city_destination,  //Id kota/kabupaten tujuan
            'weight'        => $request->weight,            //berat barang (gram)
            'courier'       => $request->courier            //kode kurir pengiriman: ['jne','tiki','pos,]->untuk jenis starter
        ])->get();

        return response()->json([
            'success'       => true,
            'message'       => 'List Data Cost All Courier : ' . $request->courier,
            'data'          => $cost
        ]);
    }
}
