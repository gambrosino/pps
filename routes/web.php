<?php

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
Route::auth();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::post('solicitudes', 'SolicitudeController@store');
    Route::post('professional-practices', 'ProfessionalPracticeController@store');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
