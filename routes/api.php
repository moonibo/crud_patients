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
    Route::get('/patients/prescribers/{prescriber_id}', 'PatientController@findPrescriberById')->name('patients_find_prescriber');
    Route::post('/patients/store','PatientController@store')->name('patients_store');
    Route::put('/patients/{id}', 'PatientController@update')->name('patients_update');
    Route::post('/patients/delete/{id}', 'PatientController@delete')->name('patients_delete');

    Route::get('/specialities', 'SpecialityController@index' )->name('specialities_index');
    Route::get('/specialities/{id}', 'SpecialityController@show')->name('specialities_find');
    Route::post('/specialities/store','SpecialityController@store')->name('specialities_store');
    Route::put('/specialities/{id}', 'SpecialityController@update')->name('specialities_update');
    Route::post('/specialities/delete/{id}', 'SpecialityController@delete')->name('specialities_delete');

    Route::get('/consultations', 'ConsultationController@index' )->name('consultations_index');
    Route::get('/consultations/{id}', 'ConsultationController@show')->name('consultations_find');
    Route::post('/consultations/store','ConsultationController@store')->name('consultations_store');
    Route::put('/consultations/{id}', 'ConsultationController@update')->name('consultations_update');
    Route::post('/consultations/delete/{id}', 'ConsultationController@delete')->name('consultations_delete');

    Route::get('/prescribers', 'PrescriberController@index' )->name('prescribers_index');
    Route::get('/prescribers/{id}', 'PrescriberController@show')->name('prescribers_find');
    Route::get('/prescribers/consultation/{consultation_id}', 'PrescriberController@findConsultationById')->name('prescribers_find_consultation');
    Route::get('/prescribers/speciality/{speciality_id}', 'PrescriberController@findSpecialityById')->name('prescribers_find_speciality');
    Route::post('/prescribers/store','PrescriberController@store')->name('prescribers_store');
    Route::put('/prescribers/{id}', 'PrescriberController@update')->name('prescribers_update');
    Route::post('/prescribers/delete/{id}', 'PrescriberController@delete')->name('prescribers_delete');

    Route::get('/prescriptions', 'PrescriptionController@index' )->name('prescriptions_index');
    Route::get('/prescriptions/{id}', 'PrescriptionController@show')->name('prescriptions_find');
    Route::get('/prescriptions/patient/{patient_id}', 'PrescriptionController@findPatientById')->name('prescriptions_find_patient');
    Route::get('/prescriptions/consultation/{consultation_id}', 'PrescriptionController@findConsultationById')->name('prescriptions_find_consultation');
    Route::get('/prescriptions/record/{record_id}', 'PrescriptionController@findRecordById')->name('prescriptions_find_record');
    Route::post('/prescriptions/store','PrescriptionController@store')->name('prescriptions_store');
    Route::put('/prescriptions/{id}', 'PrescriptionController@update')->name('prescriptions_update');
    Route::post('/prescriptions/delete/{id}', 'PrescriptionController@delete')->name('prescriptions_delete');

    Route::get('/records', 'RecordController@index' )->name('prescriptions_index');
    Route::get('/records/{id}', 'RecordController@show')->name('prescriptions_find');
    Route::get('/records/prescriber/{prescriber_id}', 'RecordController@findPrescriberById')->name('records_find_prescriber');
    Route::get('/records/patient/{patient_id}', 'RecordController@findPatientById')->name('records_find_patient');
    Route::get('/records/patient/{patient_id}', 'RecordController@findPatientById')->name('records_find_patient');
    Route::get('/records/patient&prescriber/{patient_id}/{prescriber_id}', 'RecordController@showRecordByPatientIdAndPrescriberId')->name('records_find_recordbypatientandprescriberid');
    Route::post('/records/store','RecordController@store')->name('prescriptions_store');
    Route::put('/records/{id}', 'RecordController@update')->name('prescriptions_update');
    Route::post('/records/delete/{id}', 'RecordController@delete')->name('prescriptions_delete');
});

