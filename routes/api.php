<?php

namespace Core\MyPatients\Infrastructure\Http\Controllers;


use App\Core\MyPatients\Infrastructure\Http\Controllers\Allergy\CreateAllergy;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Allergy\DeleteAllergy;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Allergy\FindAllAllergies;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Allergy\FindAllergyById;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Allergy\UpdateAllergy;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation\CreateConsultation;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation\DeleteConsultation;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation\FindAllConsultations;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation\FindConsultationById;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation\UpdateConsultation;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Method\CreateMethod;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Method\DeleteMethod;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Method\FindAllMethods;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Method\FindMethodById;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Method\UpdateMethod;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Pathology\CreatePathology;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Pathology\DeletePathology;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Pathology\FindAllPathologies;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Pathology\FindPathologyById;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Pathology\UpdatePathology;
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
use App\Core\MyPatients\Infrastructure\Http\Controllers\Record\DeleteRecord;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Record\FindAllRecords;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Record\FindRecordById;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Record\FindRecordByPatientAndPrescriberId;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Record\FindRecordByPatientId;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Record\FindRecordByPrescriberId;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Record\UpdateRecord;
use App\Core\MyPatients\Infrastructure\Http\Controllers\RegisteredPrescriber\AuthPrescriber;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality\CreateSpeciality;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality\DeleteSpeciality;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality\FindAllSpecialities;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality\FindSpecialityById;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality\UpdateSpeciality;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Step\CreateStep;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Step\DeleteStep;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Step\FindAllSteps;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Step\FindStepById;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Step\FindStepByMethodId;
use App\Core\MyPatients\Infrastructure\Http\Controllers\Step\UpdateStep;
use App\Http\Middleware\AcceptJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\RegisteredPrescriber'], function(){
    Route::post('/register', [AuthPrescriber::class, 'register'])->name('register');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('/logout', [AuthPrescriber::class, 'logout'])->name('logout');

    });
});

//'middleware' => 'auth:api'

Route::group(['prefix' => 'patients', 'namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Patient', ], function (){
    Route::get('/', FindAllPatients::class)->name('patients_index');
    Route::get('/{id}', FindPatientById::class)->name('patients_find');
    Route::get('/prescribers/{prescriber_id}', FindPatientByPrescriberId::class)->name('patients_find_prescriber');
    Route::post('/store', CreatePatient::class)->name('patients_store');
    Route::post('/prescribers/store', CreatePatientByPrescriber::class)->name('patients_prescribers_store');
    Route::put('/{id}', UpdatePatient::class)->name('patients_update');
    Route::post('/delete/{id}', DeletePatient::class)->name('patients_delete');
});

Route::group(['prefix' => 'specialities', 'namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Speciality', ], function () {
    Route::get('/', FindAllSpecialities::class)->name('specialities_index');
    Route::get('/{id}', FindSpecialityById::class)->name('specialities_find');
    Route::post('/store', CreateSpeciality::class)->name('specialities_store');
    Route::put('/{id}', UpdateSpeciality::class)->name('specialities_update');
    Route::post('/delete/{id}', DeleteSpeciality::class)->name('specialities_delete');
});

Route::group(['prefix' => 'consultations', 'namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Consultation', ], function () {
    Route::get('/', FindAllConsultations::class)->name('consultations_index');
    Route::get('/{id}', FindConsultationById::class)->name('consultations_find');
    Route::post('/store', CreateConsultation::class)->name('consultations_store');
    Route::put('/{id}', UpdateConsultation::class)->name('consultations_update');
    Route::post('/delete/{id}', DeleteConsultation::class)->name('consultations_delete');
});

Route::group(['namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Prescriber', ], function () {
    Route::get('/prescribers', FindAllPrescribers::class)->name('prescribers_index');
    Route::get('/prescribers/{id}', FindPrescriberById::class)->name('prescribers_find');
    Route::get('/prescribers/consultation/{consultation_id}', FindPrescriberByConsultationId::class)->name('prescribers_find_consultation');
    Route::get('/prescribers/speciality/{speciality_id}', FindPrescriberBySpecialityId::class)->name('prescribers_find_speciality');
    Route::post('/prescribers/store', CreatePrescriber::class)->name('prescribers_store');
    Route::put('/prescribers/{id}', UpdatePrescriber::class)->name('prescribers_update');
    Route::post('/prescribers/delete/{id}', DeletePrescriber::class)->name('prescribers_delete');
});

Route::group(['namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Prescription', ], function () {
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

Route::group(['namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Record', ], function () {
    Route::get('/records', FindAllRecords::class )->name('records_index');
    Route::get('/records/{id}', FindRecordById::class)->name('records_find');
    Route::get('/records/prescriber/{prescriber_id}', FindRecordByPrescriberId::class)->name('records_find_prescriber');
    Route::get('/records/patient/{patient_id}', FindRecordByPatientId::class)->name('records_find_patient');
    Route::get('/records/patient&prescriber/{patient_id}/{prescriber_id}', FindRecordByPatientAndPrescriberId::class)->name('records_find_record_by_patient_and_prescriber_id');
    Route::post('/records/store',CreateRecord::class)->name('records_store');
    Route::put('/records/{id}', UpdateRecord::class)->name('records_update');
    Route::post('/records/delete/{id}', DeleteRecord::class)->name('records_delete');
});

Route::group(['prefix' => 'allergies', 'namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Allergy', ], function () {
    Route::get('/', FindAllAllergies::class)->name('allergies_index');
    Route::get('/{id}', FindAllergyById::class)->name('allergies_find');
    Route::post('/store', CreateAllergy::class)->name('allergies_store');
    Route::put('/{id}', UpdateAllergy::class)->name('allergies_update');
    Route::post('/delete/{id}', DeleteAllergy::class)->name('allergies_delete');
});

Route::group(['prefix' => 'pathologies', 'namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Pathology'], function() {
    Route::get('/', FindAllPathologies::class)->name('pathologies_index');
    Route::get('/{id}', FindPathologyById::class)->name('pathologies_find');
    Route::post('/store', CreatePathology::class)->name('pathologies_store');
    Route::put('/{id}', UpdatePathology::class)->name('pathologies_update');
    Route::post('/delete/{id}', DeletePathology::class)->name('pathologies_delete');
});

Route::group(['prefix' => 'steps', 'namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Step'], function() {
    Route::get('/', FindAllSteps::class)->name('steps_index');
    Route::get('/{id}', FindStepById::class)->name('steps_find');
    Route::get('/methods/{id}', FindStepByMethodId::class)->name('method_find_step');
    Route::post('/store', CreateStep::class)->name('steps_store');
    Route::put('/{id}', UpdateStep::class)->name('steps_update');
    Route::post('/delete/{id}', DeleteStep::class)->name('steps_delete');
});

Route::group(['prefix' => 'methods', 'namespace' => 'App\Core\MyPatients\Infrastructure\Http\Controllers\Method'], function() {
    Route::get('/', FindAllMethods::class)->name('methods_index');
    Route::get('/{id}', FindMethodById::class)->name('methods_find');
    Route::post('/store', CreateMethod::class)->name('methods_store');
    Route::put('/{id}', UpdateMethod::class)->name('methods_update');
    Route::post('/delete/{id}', DeleteMethod::class)->name('methods_delete');
});
