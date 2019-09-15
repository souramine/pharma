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

//--------------------------------------Pharmaciens ----------------------------------------------
Route::resource('pharmacien','PharmacienController')->middleware('auth');
Route::post('/pharmacien/delete/{id}','PharmacienController@destroy')->middleware('auth');
Route::post('/addPharmacien','PharmacienController@store')->name('addPharmacien')->middleware('auth');
Route::get('/detail/pharmacien/{id}','PharmacienController@getDetailPharmacien')->name('detailP')->middleware('auth');

//--------------------------------------Fournisseur ----------------------------------------------
Route::resource('fournisseur','FournisseurController')->middleware('auth');
Route::post('/fournisseur/delete/{id}','FournisseurController@destroy')->middleware('auth');
Route::post('/addFournisseur','FournisseurController@store')->name('addFournisseur')->middleware('auth');
Route::post('/fournisseur','FournisseurController@getFournisseurNom')->middleware('auth');
Route::get('/detail/fournisseur/{id}','FournisseurController@getDetailFournisseur')->name('detailF')->middleware('auth');

//--------------------------------------Medicament ----------------------------------------------
Route::resource('medicaments','MedicamentController')->middleware('auth');
Route::post('/medicaments/delete/{id}','MedicamentController@destroy')->middleware('auth');
Route::post('/addMedicaments','MedicamentController@store')->name('addMedicaments')->middleware('auth');
Route::post('/medicament','MedicamentController@getMedicamentNom')->middleware('auth');

//--------------------------------------Achat ----------------------------------------------
Route::resource('achats','LotController')->middleware('auth');
Route::post('/achat/delete/{id}','LotController@destroy')->middleware('auth');
Route::post('/addAchat','LotController@store')->name('addAchat')->middleware('auth');
Route::get('/detail/achat/{id}','LotController@getDetailLot')->name('detailL')->middleware('auth');

//--------------------------------------Vente ----------------------------------------------
Route::resource('ventes','VenteController')->middleware('auth');
Route::post('/vente/checkMedicament/{id}','VenteController@checkMedicament')->middleware('auth');
Route::post('/vente/delete/{id}','VenteController@destroy')->middleware('auth');
Route::post('/addVente','VenteController@store')->name('addVente')->middleware('auth');
Route::get('/detail/vente/{id}','VenteController@afficheDetail')->name('detailV')->middleware('auth');
//Route::get('/detail/achat/{id}','LotController@getDetailLot')->name('detailL');

//--------------------------------------Dashboard ----------------------------------------------
Route::resource('dash','DashController')->middleware('auth');
Route::resource('/','DashController')->middleware('auth');

//--------------------------------------Profil -------------------------------------------------
Route::resource('profile','ProfilController')->middleware('auth');


//--------------------------------------login -------------------------------------------------
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/home', 'HomeController@index')->name('home');
