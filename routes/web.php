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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::post('professional-practices', 'ProfessionalPracticeController@store');
    Route::post('professional-practices/{professionalPractice}/revisions', 'RevisionController@store')->name('revision.store');

    Route::patch('revisions/{revision}', 'RevisionController@update');

    Route::get('solicitudes', 'SolicitudeController@create')->name('solicitude.create');
    Route::post('solicitudes', 'SolicitudeController@store');
});

Auth::routes();

