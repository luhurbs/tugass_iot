<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LedController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\DHT11DataController;
use App\Http\Controllers\KelembapanDataController;
use App\Http\Controllers\MQ5DataController;
use App\Http\Controllers\RainDataController;
use App\Http\Controllers\SensorDataController;
use App\Service\WhatsappNotificationService;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.landing');
});

Route::get('/dashboard', function () {
    $data ['title'] = 'Dashboard';
        $data ['breadcrumbs'][]= [
            'title' => 'Dashboard',
            'url' => route('dashboard')
        ];
    return view('pages.dashboard', $data);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    //Leds
    Route::get('leds', [LedController::class, 'index'])->name('leds.index');
    Route::post('leds', [LedController::class, 'store'])->name('leds.store');
    Route::put('/leds/{id}', [LedController::class, 'update'])->name('leds.update');

    //Sensor
    Route::get('sensor', [SensorController::class, 'web_all_sensors'])->name('sensor.all');
    Route::post('sensor', [SensorController::class, 'web_all_sensors'])->name('sensor.all');

    Route::get('/whatsapp', function () {
        $target = request('target');
        $message = 'Ada kebocoran gas di rumah anda, segera cek dan perbaiki';
        $response = WhatsappNotificationService::sendMessage($target, $message);
        echo $response;
    });

});

// Route::get('/sensor', [SensorController::class, 'web_index'])->name('sensor.dht11');

//Route::get('dht11', [DHT11DataController::class, 'latest_dht11']) -> name('latest_dht11');
Route::get('kelembapan', [KelembapanDataController::class, 'latest_kelembapan']) -> name('latest_kelembapan');
Route::get('mq5', [MQ5DataController::class, 'latest_mq5']) -> name('latest_mq5');
Route::get('rain', [RainDataController::class, 'latest_rain']) -> name('latest_rain');

Route::get('suhu', [DHT11DataController::class, 'latest_dht11'])->name('latest_dht11');

require __DIR__.'/auth.php';
