<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DHT11;
use App\Models\MQ5;
use App\Models\Rain;

class SensorController extends Controller
{
    public function web_all_sensors()
    {
        $data['title'] = 'Sensor';
        $data['breadcrumbs'] = [
            [
                'title' => 'Dashboard',
                'url' => route('dashboard')
            ],
            [
                'title' => 'Sensor',
                'url' => route('sensor.all')
            ]
        ];

        return view('pages.sensor', array_merge($data, [
            "dht11" => DHT11::all(),
            "mq5" => MQ5::all(),
            "rain" => Rain::all()
        ]));
    }

    // Endpoint API tunggal untuk menerima data dari ketiga sensor
    public function api_all_sensors(Request $request)
    {
        // Proses data untuk sensor DHT11
        if ($request->has('suhu') && $request->has('kelembapan')) {
            $dht11 = new DHT11;
            $dht11->name = $request->input('name', 'DHT11'); // Nama default 'DHT11' jika tidak diberikan
            $dht11->suhu = $request->input('suhu');
            $dht11->kelembapan = $request->input('kelembapan');
            $dht11->save();
        }

        // Proses data untuk sensor MQ5
        if ($request->has('nilai_gas')) {
            $mq5 = new MQ5;
            $mq5->name = $request->input('name', 'MQ5'); // Nama default 'MQ5' jika tidak diberikan
            $mq5->nilai_gas = $request->input('nilai_gas');
            $mq5->save();
        }

        // Proses data untuk sensor Rain
        if ($request->has('nilai_rain')) {
            $rain = new Rain;
            $rain->name = $request->input('name', 'Rain'); // Nama default 'Rain' jika tidak diberikan
            $rain->nilai_rain = $request->input('nilai_rain');
            $rain->save();
        }

        return response()->json([
            "message" => "Data telah ditambahkan."
        ], 201);
    }

    public function get_dht11()
    {
        $dht11Data = DHT11::all();
        return response()->json($dht11Data);
    }

    public function get_mq5()
    {
        $mq5Data = MQ5::all();
        return response()->json($mq5Data);
    }

    public function get_rain()
    {
        $rainData = Rain::all();
        return response()->json($rainData);
    }
}
