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
    return view('started');
});

//--------------------------------------Pharmaciens ----------------------------------------------
Route::resource('pharmacien','PharmacienController');
Route::get('/salut','PharmacienController@salut');
Route::post('/deletePharmacien/{id}','PharmacienController@destroy')->name('deletePharmacien');
Route::post('/addPharmacien','PharmacienController@store')->name('addPharmacien');

