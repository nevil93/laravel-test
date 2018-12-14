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

Route::get('/form', ['uses' => 'FormController@view'])->name('form');

Route::post('/form', ['middleware' => 'message.filter', 'uses' => 'FormController@submit']);

Route::get('/data', ['uses' => 'DataController@displayData'])->name('data');

Route::post('/data', ['uses' => 'DataController@search']);
