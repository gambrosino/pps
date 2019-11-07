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

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('solicitude/{solicitude}/accept', 'ProfessionalPracticeController@create')->name('professional-practices.create');
    Route::post('professional-practices', 'ProfessionalPracticeController@store')->name('professional-practices.store');
    Route::post('professional-practices/{professionalPractice}/revisions', 'RevisionController@store')->name('revisions.store');

    Route::patch('revisions/{revision}', 'RevisionController@update')->name('revisions.update');

    Route::get('solicitude', 'SolicitudeController@index')->name('solicitude.index');
    Route::get('solicitude/create', 'SolicitudeController@create')->name('solicitude.create');
    Route::get('solicitude/{solicitude}', 'SolicitudeController@show')->name('solicitude.show');
    Route::post('solicitude', 'SolicitudeController@store')->name('solicitude.store');
});

Auth::routes();
