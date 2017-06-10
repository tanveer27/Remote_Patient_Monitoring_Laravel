<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::auth();
    Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
    Route::get('/home', 'HomeController@index');
    Route::post('/contactUs', 'Auth\AuthController@contactUs');
    Route::get('/doctorList', 'HomeController@doctorList');
    Route::get('/webSubscribe/{doctor}',['as' => 'webSubscribe', 'uses' => 'HomeController@webSubscribe']);
    Route::get('/webUnSubscribe/{doctor}',['as' => 'webUnSubscribe', 'uses' => 'HomeController@webUnSubscribe']);
    Route::get('/confirmSubscribe/{patient}',['as' => 'confirmSubscribe', 'uses' => 'DoctorController@confirmSubscribe']);
    Route::get('/doctorProfile', 'HomeController@doctorProfile');
    Route::get('/userProfile', 'HomeController@userProfile');
    Route::post('/doctorProfileUpdate', 'HomeController@doctorProfileUpdate');
    Route::post('/userProfileUpdate', 'HomeController@userProfileUpdate');
    Route::post('/viewPermit', 'HomeController@viewPermit');
    Route::post('/weightprescription', 'HomeController@weightprescription');
    Route::post('/bpprescription', 'HomeController@bpprescription');
    Route::post('/spo2prescription', 'HomeController@spo2prescription');
     Route::post('/activityprescription', 'HomeController@activityprescription');
    Route::post('/tempprescription', 'HomeController@tempprescription');
    Route::post('/glucoseprescription', 'HomeController@glucoseprescription');
    Route::get('/doctorHome',['as' => 'doctorHome', 'uses' => 'DoctorController@getPatients']);
    Route::get('/bloodpressure/{patient}',['as' => 'bloodpressure', 'uses' => 'DoctorController@bloodpressure']);
    Route::get('/patient_information/{patient}',['as' => 'patient_information', 'uses' => 'DoctorController@patient_information']);
    Route::get('/spo2/{patient}',['as' => 'spo2', 'uses' => 'DoctorController@spo2']);
    Route::get('/activity/{patient}',['as' => 'activity', 'uses' => 'DoctorController@activity']);
    Route::get('/bloodpressure/{bp}/{report}',['as' => 'bpreport', 'uses' => 'DoctorController@bpreport']);
    Route::get('/spo2/{spo2}/{report}',['as' => 'spo2report', 'uses' => 'DoctorController@spo2report']);
    Route::get('/activity/{activity}/{report}',['as' => 'activityreport', 'uses' => 'DoctorController@activityreport']);
    Route::get('/temperature/{temp}/{report}',['as' => 'tempreport', 'uses' => 'DoctorController@tempreport']);
    Route::get('/temperature/{patient}',['as' => 'temperature', 'uses' => 'DoctorController@temperature']);
    Route::get('/weight/{patient}',['as' => 'weight', 'uses' => 'DoctorController@weight']);
    Route::get('/weight/{weight}/{report}',['as' => 'weightreport', 'uses' => 'DoctorController@weightreport']);
    Route::get('/glucose/{glucose}/{report}',['as' => 'glucosereport', 'uses' => 'DoctorController@glucosereport']);
    Route::get('/glucose/{patient}',['as' => 'glucose', 'uses' => 'DoctorController@glucose']);
    //Route::post('/doctorProfileUpdate',['as' => 'doctorProfileUpdate', 'uses' => 'DoctorController@profileUpdate']);
    Route::get('/patientHome',['as' => 'patientHome', 'uses' => 'PatientWebController@getViews']);
    Route::get('/prescriptionOverview/{patient}',['as' => 'prescriptionOverview', 'uses' => 'HomeController@prescriptionOverview']);




});






$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->get('/', function() {
        return ['Fruits' => 'Delicious and healthy!'];
    });
    $api->post('authenticate', 'App\Http\Controllers\AuthenticatePatient@authenticate');
    $api->post('logout', 'App\Http\Controllers\AuthenticatePatient@logout');
    $api->get('token', 'App\Http\Controllers\AuthenticatePatient@getToken');
    $api->get('registerPatient', 'App\Http\Controllers\AuthenticatePatient@registerpat');
    $api->get('authenticatedUser', 'App\Http\Controllers\AuthenticatePatient@getAuthenticatedUser');
    $api->post('subscribe', 'App\Http\Controllers\PatientController@subscribe');
    $api->post('enterBpData', 'App\Http\Controllers\PatientController@enterBpData');
    $api->post('enterGlucoseData', 'App\Http\Controllers\PatientController@enterGlucoseData');
    $api->post('enterSPO2Data', 'App\Http\Controllers\PatientController@enterSPO2Data');
    $api->post('enterActivityData', 'App\Http\Controllers\PatientController@enterActivityData');
    $api->post('enterWithingsData', 'App\Http\Controllers\PatientController@enterWithingsData');
    $api->post('enterTemperatureData', 'App\Http\Controllers\PatientController@enterTemperatureData');
    $api->get('getDoctorList', 'App\Http\Controllers\PatientController@getDoctorList');
    $api->post('getBpData', 'App\Http\Controllers\PatientController@getBpData');
    $api->get('getBpReports', 'App\Http\Controllers\PatientController@getBpReports');
    $api->post('getSPO2Data', 'App\Http\Controllers\PatientController@getSPO2Data');
    $api->get('getSPO2Reports', 'App\Http\Controllers\PatientController@getSPO2Reports');
    $api->post('getTemperatureData', 'App\Http\Controllers\PatientController@getTemperatureData');
    $api->get('getTemperatureReports', 'App\Http\Controllers\PatientController@getTemperatureReports');
    $api->post('itoken', 'App\Http\Controllers\PatientController@itoken');
    $api->post('getGlucoseData', 'App\Http\Controllers\PatientController@getGlucoseData');
    $api->post('updateProfile', 'App\Http\Controllers\PatientController@updateProfile');
    $api->get('getGlucoseReports', 'App\Http\Controllers\PatientController@getGlucoseReports');
    $api->get('getPrescriptions', 'App\Http\Controllers\PatientController@getPrescriptions');
    $api->post('getWeightData', 'App\Http\Controllers\PatientController@getWeightData');
    $api->get('getWeightReports', 'App\Http\Controllers\PatientController@getWeightReports');
    $api->post('enterWeightData', 'App\Http\Controllers\PatientController@enterWeightData');
    $api->post('getActivityData', 'App\Http\Controllers\PatientController@getActivityData');
    $api->get('getActivityReports', 'App\Http\Controllers\PatientController@getActivityReports');
});
