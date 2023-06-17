<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('facility');
});
Route::get('/worker', function () {
    return view('worker');
});
Route::get('/population', function () {
    return view('population');
});
Route::get('/map', function () {
    return view('map');
});
Route::get('/map_facility', function () {
    return view('map_facility');
})->name('map_facility');
Route::get('/map_dr_spesialis', function () {
    return view('map_dr_spesialis');
})->name('map_dr_spesialis');

Route::get('/jawa-timur.json', function () {
    return response()->file('public/jawa-timur.json');
  });
Auth::routes();
Route::post('/get-color', [App\Http\Controllers\CityFacilityController::class, 'getColorByCityFacility']);
Route::post('/get-color-worker', [App\Http\Controllers\FacilityWorkerController::class, 'getColorByFacilityWorker']);
// Route::post('/get-color', [App\Http\Controllers\FacilityWorkerController::class, 'getColorByFacilityWorker']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
