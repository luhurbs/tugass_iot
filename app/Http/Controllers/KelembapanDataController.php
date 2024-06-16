<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DHT11;

class KelembapanDataController extends Controller
{
    public function latest_kelembapan(){
        $latestKelembapanData = DHT11::latest()->first();
        return response()->json([
            'kelembapan' => $latestKelembapanData ? $latestKelembapanData->kelembapan : null,
            'created_at' => $latestKelembapanData ? $latestKelembapanData->created_at : null,
        ]);
    }
}
