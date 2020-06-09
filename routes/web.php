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

Route::get('/', 'PhotoController@album');
Route::get('/album/{id}', 'PhotoController@show')->name('album.show');

Auth::routes();

Route::group(['middleware'=>'auth'], function(){
    Route::get('/home', 'PhotoController@index')->name('home');
    Route::get('/album', 'PhotoController@index')->name('album.index');
    Route::post('/album/store', 'PhotoController@store')->name('album.store');
    Route::post('/album/add/photo', 'PhotoController@addPhoto')->name('album.add.photo');
    Route::post('/album/cover', 'PhotoController@albumCover')->name('album.cover');
    Route::post('/photo/delete/{id}', 'PhotoController@destroy')->name('photo.delete');
});



