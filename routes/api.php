<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'App\Http\Controllers', 'middleware' => \App\Http\Middleware\AcceptJson::class], function () {
    Route::get('/patients', 'PatientController@index' )->name('index');
    Route::get('/patients/{id}', 'PatientController@show')->name('find');
    Route::post('/patients/store','PatientController@store')->name('store');
    Route::post('/patients/update/{id}', 'PatientController@update')->name('update');
    Route::post('/patients/delete/{id}', 'PatientController@delete')->name('delete');
});

