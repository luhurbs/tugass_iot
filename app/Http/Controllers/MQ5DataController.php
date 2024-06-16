<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MQ5;

class MQ5DataController extends Controller
{
    public function latest_mq5(){
        $latestMQ5Data = MQ5::latest()->first();
        return response()->json([
            'nilai_gas' => $latestMQ5Data ? $latestMQ5Data->nilai_gas : null,
            'created_at' => $latestMQ5Data ? $latestMQ5Data->created_at : null,
        ]);
    }
}
