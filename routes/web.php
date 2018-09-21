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

Route::post('/api/register', 'UserController@register');
Route::get('/api/verempleados', 'UserController@verempleados');
Route::get('/api/verempleado/{id}', 'UserController@verempleado');
Route::get('/', function () {
    return view('welcome');
});

