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



Route::get('skenirana_dokumenta/{url}', 'ScanedContoller@download');
Route::get('skenirana_dokumenta','ScanedContoller@index');
Route::get('sve/','ScanedContoller@tabela');
Route::get('sve/{user}/prikaz/','ScanedContoller@show');
Route::get('/trazi','ScanedContoller@trazi');
Route::get('/search','WordController@search');
