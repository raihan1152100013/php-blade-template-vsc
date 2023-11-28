<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/blog', 'BlogController@index');
Route::get('/blog/create', 'BlogController@create');
Route::post('/blog', 'BlogController@store');
Route::get('/blog/{id}', 'BlogController@show');
Route::get('/blog/{id}/edit', 'BlogController@edit');
Route::put('/blog/{id}', 'BlogController@update');
Route::delete('/blog/{id}', 'BlogController@destroy');
Route::get('/', function () {
    return view('welcome');
});
