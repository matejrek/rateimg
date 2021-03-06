<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\ObjavaController@public')->name('home');

Auth::routes(['verify' => true]);



Route::group(['middleware' => 'auth'], function () {
    Route::get('/createObjava', 'App\Http\Controllers\ObjavaController@create');
    Route::post('/saveObjava', 'App\Http\Controllers\ObjavaController@store');
    Route::get('/home', 'App\Http\Controllers\ObjavaController@index')->name('home');

    Route::get('/editObjava/{id}', 'App\Http\Controllers\ObjavaController@edit');
    Route::post('/saveEdit/{id}', 'App\Http\Controllers\ObjavaController@update');

    Route::get('/deleteObjava/{id}', 'App\Http\Controllers\ObjavaController@destroy');
});


Route::get('/like/{id}', 'App\Http\Controllers\ObjavaController@like');
Route::get('/dislike/{id}', 'App\Http\Controllers\ObjavaController@dislike');