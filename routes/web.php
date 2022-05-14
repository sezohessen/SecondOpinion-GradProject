<?php

use Illuminate\Support\Facades\Auth;

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
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en']) ) {
        session()->put('app_locale', $locale);
        return back();
    }
    return view('errors.404');
});
//Route::group(['middleware' => 'SetLocale'], function () {


Auth::routes();
Route::group(['prefix' => 'dashboard','as' => 'dashboard.','namespace'=>"Dashboard", 'middleware' => ['role:superadministrator|administrator']], function () {
    Route::get('/', 'DashboardController@index')->name('index');

    Route::resource('/governorate','GovernorateController');
    Route::resource('/city','CityController');
    Route::resource('/terms','TermsController');
    Route::resource('/PPolicy','PrivacyPolicyController');
    Route::resource('/settings','SettingsController');
    Route::resource('/contact','ContactController');
    Route::resource("/specialty","SpecialtyController");
    Route::resource("/doctor","DoctorController");
    Route::resource("/patient","PatientController");
    Route::resource("/center","CenterController");
    Route::resource("/radiology","RadiologyController");



    Route::resource('users', 'UserController');

    Route::delete('/governorate/destroy/all','GovernorateController@multi_delete');
    Route::delete('/city/destroy/all','CityController@multi_delete');
    Route::resource("/specialty/destroy/all","SpecialtyController@multi_delete");
    /* Route::resource("/doctor/destroy/all","DoctorController@multi_delete"); */
    /* Route::resource("/radiology/destroy/all","RadiologyController@multi_delete");
 */


});


// Start website /////////////////////////////////////////////////////////////////////////////////
Route::group(['namespace'=>"Website",'as' => 'Website.'],function () {
    Route::get('/', 'HomeController@index')->name('Index');
    Route::get('/doctors','DoctorWebsitePagesController@home')->name('page.doctors');
    Route::get('/doctors/getcity/{id}','DoctorWebsitePagesController@showCities');
    Route::get('/doctors/search','DoctorWebsitePagesController@search')->name('doctors.search');
    Route::get('/doctor/{field}/{id}/{name}','DoctorWebsitePagesController@show')->name('doctor.profile');

});
Route::group(['as' => 'Website.','namespace'=>"Website", 'middleware' => 'auth'], function () {

});

Route::group(['prefix' => 'doctor','as' => 'doctor.','namespace'=>"Doctor", 'middleware' => ['role:doctor']], function () {
    Route::get('/pending-radiologies','DoctorRadiologyController@index')->name('pending.radiology');
    Route::get('/completed-radiologies','DoctorRadiologyController@completed')->name('completed.radiology');
    Route::get('/feedback/{id}','DoctorRadiologyController@feedback')->name('feedback.radiology');
    Route::post('/feedback/create/{id}','DoctorRadiologyController@givefeedback')->name('feedback.radiology.create');
    Route::get('/radiology/show/{id}','DoctorRadiologyController@show')->name('show.radiology');
    Route::get('/download/{id}/{radiology_id}','DoctorRadiologyController@DownloadFile')->name('downloadfile');
    Route::get('/my-account','DoctorRadiologyController@Account')->name('account');
    Route::post('/update-account','DoctorRadiologyController@Update')->name('update.account');
    Route::get('/show-completed-radiology/{id}','DoctorRadiologyController@ShowCompleted')->name('show.completed');
    Route::get('/download-report/{id}','DoctorRadiologyController@DownloadReport')->name('download.report');
});
Route::group(['prefix' => 'patient','as' => 'patient.','namespace'=>"Patient", 'middleware' => ['role:patient']], function () {

});
Route::group(['prefix' => 'center','as' => 'center.','namespace'=>"Center", 'middleware' => ['role:center']], function () {
    Route::get('/pending-radiologies','CenterController@pending')->name('pending.radiology');
    Route::get('/completed-radiologies','CenterController@completed')->name('completed.radiology');
    Route::get('/radiology/show/{id}','CenterController@show')->name('show.radiology');
    Route::get('/show-completed-radiology/{id}','CenterController@ShowCompleted')->name('show.completed');
    Route::get('/download/{id}/{radiology_id}','CenterController@DownloadFile')->name('downloadfile');
    Route::get('/download-report/{id}/{rad}','CenterController@DownloadReport')->name('download.report');
});





