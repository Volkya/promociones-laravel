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
});
// Route::get('promociones.list.excel', 'PromocionesController@exportexcel')->name('promociones.excel');
Route::post('/import', "PromocionesController@import");


// Inserción de datos prueba
Route::get("/crear", "RawController@crear");
Route::get("/listar", "RawController@listar");
Route::get("/updatear", "RawController@updatear");
Route::get("/eliminar", "RawController@eliminar");
