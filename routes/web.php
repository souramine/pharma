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

Route::get('/login', function () {
    return view('login.login');
});



//--------------------------------------Pharmaciens ----------------------------------------------
Route::resource('pharmacien','PharmacienController');
Route::post('/pharmacien/delete/{id}','PharmacienController@destroy');
Route::post('/addPharmacien','PharmacienController@store')->name('addPharmacien');
Route::get('/detail/pharmacien/{id}','PharmacienController@getDetailPharmacien')->name('detailP');

//--------------------------------------Fournisseur ----------------------------------------------
Route::resource('fournisseur','FournisseurController');
Route::post('/fournisseur/delete/{id}','FournisseurController@destroy');
Route::post('/addFournisseur','FournisseurController@store')->name('addFournisseur');
Route::post('/fournisseur','FournisseurController@getFournisseurNom');
Route::get('/detail/fournisseur/{id}','FournisseurController@getDetailFournisseur')->name('detailF');

//--------------------------------------Medicament ----------------------------------------------
Route::resource('medicaments','MedicamentController');
Route::post('/medicaments/delete/{id}','MedicamentController@destroy');
Route::post('/addMedicaments','MedicamentController@store')->name('addMedicaments');
Route::post('/medicament','MedicamentController@getMedicamentNom');

//--------------------------------------Achat ----------------------------------------------
Route::resource('achats','LotController');
Route::post('/achat/delete/{id}','LotController@destroy');
Route::post('/addAchat','LotController@store')->name('addAchat');
Route::get('/detail/achat/{id}','LotController@getDetailLot')->name('detailL');

//--------------------------------------Vente ----------------------------------------------
Route::resource('ventes','VenteController');
Route::post('/vente/checkMedicament/{id}','VenteController@checkMedicament');
Route::post('/vente/delete/{id}','VenteController@destroy');
Route::post('/addVente','VenteController@store')->name('addVente');
Route::get('/detail/vente/{id}','VenteController@afficheDetail')->name('detailV');
//Route::get('/detail/achat/{id}','LotController@getDetailLot')->name('detailL');

