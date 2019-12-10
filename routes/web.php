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

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/doctors', 'DoctorController@index')->name('doctors');
Route::get('/doctors/{doctor}', 'DoctorController@show');

Route::get('/services', 'ServiceController@index')->name('services');
Route::get('/services/{service}', 'ServiceController@show');

Route::post('/signup', 'AppointmentAjaxController@create')->name('signup')->middleware('auth');
Route::post('/getintervals', 'AppointmentAjaxController@getIntervals')->name('getintervals')->middleware('auth');
Route::post('/delappointment', 'AppointmentAjaxController@delete')->name('delappointment')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
