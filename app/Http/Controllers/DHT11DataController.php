<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DHT11;

class DHT11DataController extends Controller
{
    public function latest_dht11() {
        $latestDHT11Data = DHT11::latest()->first();
        return response()->json([
            'suhu' => $latestDHT11Data ? $latestDHT11Data->suhu : null,
            'created_at' => $latestDHT11Data ? $latestDHT11Data->created_at : null,
        ]);
    }

}
