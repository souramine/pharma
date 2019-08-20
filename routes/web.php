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
Route::post('/pharmacien/delete/{id}','PharmacienController@destroy');
Route::post('/addPharmacien','PharmacienController@store')->name('addPharmacien');

//--------------------------------------Fournisseur ----------------------------------------------
Route::resource('fournisseur','FournisseurController');
Route::post('/fournisseur/delete/{id}','FournisseurController@destroy');
Route::post('/addFournisseur','FournisseurController@store')->name('addFournisseur');

//--------------------------------------Medicament ----------------------------------------------
Route::resource('medicaments','MedicamentController');
Route::post('/medicaments/delete/{id}','MedicamentController@destroy');
Route::post('/addMedicaments','MedicamentController@store')->name('addMedicaments');

