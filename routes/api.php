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
    Route::get('/patients', 'PatientController@index' )->name('patients_index');
    Route::get('/patients/{id}', 'PatientController@show')->name('patients_find');
    Route::get('/patients/prescribers/{prescriber_id}', 'PatientController@findPrescriber')->name('patients_find_prescriber');
    Route::post('/patients/store','PatientController@store')->name('patients_store');
    Route::post('/patients/update/{id}', 'PatientController@update')->name('patients_update');
    Route::post('/patients/delete/{id}', 'PatientController@delete')->name('patients_delete');

    Route::get('/prescribers', 'PrescriberController@index' )->name('prescribers_index');
    Route::get('/prescribers/{id}', 'PrescriberController@show')->name('prescribers_find');
    Route::post('/prescribers/store','PrescriberController@store')->name('prescribers_store');
    Route::post('/prescribers/update/{id}', 'PrescriberController@update')->name('prescribers_update');
    Route::post('/prescribers/delete/{id}', 'PrescriberController@delete')->name('prescribers_delete');

    Route::get('/speciality', 'SpecialityController@index' )->name('speciality_index');
    Route::get('/speciality/{id}', 'SpecialityController@show')->name('speciality_find');
    Route::post('/speciality/store','SpecialityController@store')->name('speciality_store');
    Route::post('/speciality/update/{id}', 'SpecialityController@update')->name('speciality_update');
    Route::post('/speciality/delete/{id}', 'SpecialityController@delete')->name('speciality_delete');
});

