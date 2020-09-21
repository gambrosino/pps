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
    Route::get('professional-practices/{professionalPractice}/', 'ProfessionalPracticeController@show')->name('professional-practices.show');
    Route::get('professional-practices', 'ProfessionalPracticeController@index')->name('professional-practices.index');
    Route::post('professional-practices', 'ProfessionalPracticeController@store')->name('professional-practices.store');

    Route::get('professional-practices/{professionalPractice}/revisions', 'RevisionController@create')->name('revisions.create');
    Route::post('professional-practices/{professionalPractice}/revisions', 'RevisionController@store')->name('revisions.store');
    Route::get('revisions/{revision}', 'RevisionController@show')->name('revisions.show');
    Route::patch('revisions/{revision}', 'RevisionController@update')->name('revisions.update');

    Route::get('solicitude', 'SolicitudeController@index')->name('solicitude.index');
    Route::get('solicitude/create', 'SolicitudeController@create')->name('solicitude.create');
    Route::get('solicitude/{solicitude}', 'SolicitudeController@show')->name('solicitude.show');
    Route::post('solicitude', 'SolicitudeController@store')->name('solicitude.store');

    Route::get('documents/{document}', 'DocumentController@show')->name('documents.show');
    Route::put('documents/{document}', 'DocumentController@update')->name('documents.update');
});

Auth::routes();
