<?php

namespace Core\MyPatients\Infrastructure\Http\Controllers;


use App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation\CreateConsultation;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation\DeleteConsultation;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation\FindAllConsultations;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation\FindConsultationById;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation\UpdateConsultation;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Patient\CreatePatient;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Patient\CreatePatientByPrescriber;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Patient\DeletePatient;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Patient\FindAllPatients;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Patient\FindPatientById;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Patient\FindPatientByPrescriberId;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Patient\UpdatePatient;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber\CreatePrescriber;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber\DeletePrescriber;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber\FindAllPrescribers;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber\FindPrescriberByConsultationId;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber\FindPrescriberById;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber\FindPrescriberBySpecialityId;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber\UpdatePrescriber;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription\CreatePrescription;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription\DeletePrescription;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription\FindAllPrescriptions;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription\FindPrescriptionByConsultationId;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription\FindPrescriptionById;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription\FindPrescriptionByPatientId;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription\FindPrescriptionByPrescriberId;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription\FindPrescriptionByRecordId;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription\UpdatePrescription;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Record\CreateRecord;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Record\UpdateRecord;
use App\Core\MyPatients\Infrastructure\Http\Controllers\RegisteredPrescriber\AuthPrescriber;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality\CreateSpeciality;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality\DeleteSpeciality;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality\FindAllSpecialities;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality\FindSpecialityById;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality\UpdateSpeciality;
use App\Http\Middleware\AcceptJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use InvalidArgumentException;

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

Route::middleware('auth:api')->get('/user', function(Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'prescriber'], function(){
    Route::post('register', [AuthPrescriber::class, 'register']);
    Route::post('login', [AuthPrescriber::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthPrescriber::class, 'logout']);
        Route::get('user', [AuthPrescriber::class, 'user']);

    });
});



Route::group(['namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Patient', 'middleware' => AcceptJson::class], function () {
    Route::get('/patients', FindAllPatients::class)->name('patients_index');
    Route::get('/patients/{id}', FindPatientById::class)->name('patients_find');
    Route::get('/patients/prescribers/{prescriber_id}', FindPatientByPrescriberId::class)->name('patients_find_prescriber');
    Route::post('/patients/store', CreatePatient::class)->name('patients_store');
    Route::post('/patients/prescribers/store', CreatePatientByPrescriber::class)->middleware('auth:api')->name('patients_store');
    Route::put('/patients/{id}', UpdatePatient::class)->name('patients_update');
    Route::post('/patients/delete/{id}', DeletePatient::class)->name('patients_delete');
});

Route::group(['namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality', 'middleware' => AcceptJson::class], function () {
    Route::get('/specialities', FindAllSpecialities::class)->name('specialities_index');
    Route::get('/specialities/{id}', FindSpecialityById::class)->name('specialities_find');
    Route::post('/specialities/store', CreateSpeciality::class)->name('specialities_store');
    Route::put('/specialities/{id}', UpdateSpeciality::class)->name('specialities_update');
    Route::post('/specialities/delete/{id}', DeleteSpeciality::class)->name('specialities_delete');
});

Route::group(['namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation', 'middleware' => AcceptJson::class], function () {
    Route::get('/consultations', FindAllConsultations::class)->name('consultations_index');
    Route::get('/consultations/{id}', FindConsultationById::class)->name('consultations_find');
    Route::post('/consultations/store', CreateConsultation::class)->name('consultations_store');
    Route::put('/consultations/{id}', UpdateConsultation::class)->name('consultations_update');
    Route::post('/consultations/delete/{id}', DeleteConsultation::class)->name('consultations_delete');
});

Route::group(['namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber', 'middleware' => AcceptJson::class], function () {
    Route::get('/prescribers', FindAllPrescribers::class)->name('prescribers_index');
    Route::get('/prescribers/{id}', FindPrescriberById::class)->name('prescribers_find');
    Route::get('/prescribers/consultation/{consultation_id}', FindPrescriberByConsultationId::class)->name('prescribers_find_consultation');
    Route::get('/prescribers/speciality/{speciality_id}', FindPrescriberBySpecialityId::class)->name('prescribers_find_speciality');
    Route::post('/prescribers/store', CreatePrescriber::class)->name('prescribers_store');
    Route::put('/prescribers/{id}', UpdatePrescriber::class)->name('prescribers_update');
    Route::post('/prescribers/delete/{id}', DeletePrescriber::class)->name('prescribers_delete');
});

Route::group(['namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription', 'middleware' => AcceptJson::class], function () {
    Route::get('/prescriptions', FindAllPrescriptions::class )->name('prescriptions_index');
    Route::get('/prescriptions/{id}', FindPrescriptionById::class)->name('prescriptions_find');
    Route::get('/prescriptions/prescriber/{prescriber_id}', FindPrescriptionByPrescriberId::class)->name('prescriptions_find_prescriber');
    Route::get('/prescriptions/patient/{patient_id}', FindPrescriptionByPatientId::class)->name('prescriptions_find_patient');
    Route::get('/prescriptions/consultation/{consultation_id}', FindPrescriptionByConsultationId::class)->name('prescriptions_find_consultation');
    Route::get('/prescriptions/record/{record_id}', FindPrescriptionByRecordId::class)->name('prescriptions_find_record');
    Route::post('/prescriptions/store',CreatePrescription::class)->name('prescriptions_store');
    Route::put('/prescriptions/{id}', UpdatePrescription::class)->name('prescriptions_update');
    Route::post('/prescriptions/delete/{id}', DeletePrescription::class)->name('prescriptions_delete');
});

Route::group(['namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Record', 'middleware' => AcceptJson::class], function () {
    Route::get('/records', 'RecordController@index' )->name('prescriptions_index');
    Route::get('/records/{id}', 'RecordController@show')->name('prescriptions_find');
    Route::get('/records/prescriber/{prescriber_id}', 'RecordController@findByPrescriberId')->name('records_find_prescriber');
    Route::get('/records/patient/{patient_id}', 'RecordController@findByPatientId')->name('records_find_patient');
    Route::get('/records/patient/{patient_id}', 'RecordController@findByPatientId')->name('records_find_patient');
    Route::get('/records/patient&prescriber/{patient_id}/{prescriber_id}', 'RecordController@showRecordByPatientIdAndPrescriberId')->name('records_find_recordbypatientandprescriberid');
    Route::post('/records/store',CreateRecord::class)->name('prescriptions_store');
    Route::put('/records/{id}', UpdateRecord::class)->name('prescriptions_update');
    Route::post('/records/delete/{id}', 'RecordController@delete')->name('prescriptions_delete');
});


