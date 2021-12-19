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
    Route::resource("/patient","DoctorController");
    Route::resource("/center","DoctorController");



    Route::resource('users', 'UserController');

    Route::delete('/governorate/destroy/all','GovernorateController@multi_delete');
    Route::delete('/city/destroy/all','CityController@multi_delete');


});


// Start website /////////////////////////////////////////////////////////////////////////////////
Route::group(['namespace'=>"Website",'as' => 'Website.'],function () {

    Route::get('/', function(){
        return redirect()->route("dashboard.index");
    })->name('index');


});
Route::group(['as' => 'Website.','namespace'=>"Website", 'middleware' => 'auth'], function () {

});

Route::group(['prefix' => 'doctor','as' => 'doctor.','namespace'=>"Doctor", 'middleware' => ['role:doctor']], function () {

});
Route::group(['prefix' => 'doctor','as' => 'doctor.','namespace'=>"Doctor", 'middleware' => ['role:patient']], function () {

});
Route::group(['prefix' => 'doctor','as' => 'doctor.','namespace'=>"Doctor", 'middleware' => ['role:center']], function () {

});





