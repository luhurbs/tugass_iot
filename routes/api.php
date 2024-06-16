<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LedController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/sensors', [SensorController::class, 'api_all_sensors']);
Route::get('/sensors/dht11', [SensorController::class, 'get_dht11']);
Route::get('/sensors/mq5', [SensorController::class, 'get_mq5']);
Route::get('/sensors/rain', [SensorController::class, 'get_rain']);



// Define the GET routes
// Route::get('/dht11', [SensorController::class, 'get_dht11']);
// Route::get('/mq5', [SensorController::class, 'get_mq5']);
// Route::get('/rain', [SensorController::class, 'get_rain']);

// // Define the POST routes
// Route::post('/dht11', [SensorController::class, 'api_dht11']);
// Route::post('/mq5', [SensorController::class, 'api_mq5']);
// Route::post('/rain', [SensorController::class, 'api_rain']);

// Route::post('/dht11', [SensorController::class, 'api_dht11']);
// Route::post('/mq5', [SensorController::class, 'api_mq5']);
// Route::post('/rain', [SensorController::class, 'api_rain']);

// Route::get('/api/dht11', [SensorController::class, 'get_dht11']);
// Route::get('/api/mq5', [SensorController::class, 'get_mq5']);
// Route::get('/api/rain', [SensorController::class, 'get_rain']);
//Route::post('/kelembapan', [SensorController::class, 'api_kelembapan']);

//CRUD
// Route::get('/users', [UserController::class, 'index']);
// Route::get('/users/{id}', [UserController::class, 'show']);
// Route::get('/users', [UserController::class, 'store']);
// Route::get('/users/{id}', [UserController::class, 'update']);
// Route::get('/users/{id}', [UserController::class, 'destroy']);

// route group name api
Route::group(['as' => 'api.'], function () {
    // resource route
    Route::resource('users', UserController::class)
        ->except(['create', 'edit']);

    // Route::resource('sensor/dht11', SensorController::class)
    //     ->names('sensor.dht');

});

Route::prefix('/leds')->name('leds.')->group(function () {
    Route::get('/', [LedController::class, 'index'])
        -> name ('index');
    Route::get('/{id}', [LedController::class, 'show'])
        -> name ('show');
    Route::post('/', [LedController::class, 'store'])
        -> name ('store');
    Route::put('/{id}', [LedController::class, 'update'])
        -> name ('update');
    Route::delete('/{id}', [LedController::class, 'destroy'])
        -> name ('destroy');
});

Route::put('/{id}/status', [LedController::class, 'updateStatus'])
    ->name('updateStatus');
