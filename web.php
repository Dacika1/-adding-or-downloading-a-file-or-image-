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
    return view('welcome');

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home2', 'HomeController@arhiva');
Route::get('licni_podaci/{user}','FrstPageController@index2');
Route::get('podaci','FrstPageController@create');
Route::resource('licni_podaci','FrstPageController');
Route::get('obrazovanje/nadji/{id}','educationController@nadji');
Route::get('obrazovanje/kreiraj/{user}','educationController@kreiraj');
Route::get('obrazovanje/prikaz/{user}','educationController@prikaz');
Route::resource('obrazovanje','educationController');
Route::get('zvanje/nadji/{id}','TitlesController@nadji');
Route::get('zvanje/kreiraj/{user}','TitlesController@kreiraj');
Route::get('zvanje/prikaz/{user}','TitlesController@prikaz');
Route::resource('zvanje','TitlesController');
Route::get('ugovori/nadji/{id}','WorkContractsController@nadji');
Route::get('ugovori/kreiraj/{user}','WorkContractsController@kreiraj');
Route::get('ugovori/prikaz/{user}','WorkContractsController@prikaz');
Route::resource('ugovori','WorkContractsController');
Route::get('drugo_angazovanje/nadji/{id}','NoneducatorExternalsController@nadji');
Route::get('drugo_angazovanje/kreiraj/{work}','NoneducatorExternalsController@kreiraj');
Route::get('drugo_angazovanje/prikaz/{work}','NoneducatorExternalsController@prikaz');
Route::resource('drugo_angazovanje','NoneducatorExternalsController');
Route::get('van_radnog_odnosa/nadji/{id}','ExternalContractsController@nadji');
Route::get('van_radnog_odnosa/kreiraj/{user}','ExternalContractsController@kreiraj');
Route::get('van_radnog_odnosa/prikaz/{user}','ExternalContractsController@prikaz');
Route::post('van_radnog_odnosa2/zvanje','ExternalContractsController@steceno_zvanje');
Route::resource('van_radnog_odnosa','ExternalContractsController');
Route::get('skenirana_dokumenta/{url}', 'ScanedContoller@download');
Route::get('skenirana_dokumenta','ScanedContoller@index');
Route::get('sve/','ScanedContoller@tabela');
Route::get('sve/{user}/prikaz/','ScanedContoller@show');
Route::get('/trazi','ScanedContoller@trazi');
Route::get('/search','WordController@search');