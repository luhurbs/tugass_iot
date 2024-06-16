<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rain;


class RainDataController extends Controller
{
    public function latest_rain() {
        $latestRainData = Rain::latest()->first();
        return response()->json([
            'nilai_rain' => $latestRainData ? $latestRainData->nilai_rain : null,
            'status' => $latestRainData ? ($latestRainData->nilai_rain ? 'Hujan' : 'Tidak Hujan') : 'data tidak tersedia',
            'created_at' => $latestRainData ? $latestRainData->created_at->format('d M Y, H:i:s') : null,
        ]);
    }

}
