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

Route::get('/', 'PhotoController@album')->name('welcome');
Route::get('/album/{id}', 'PhotoController@show')->name('album.view');

Auth::routes();

Route::group(['prefix'=>'admin/', 'middleware'=>'auth'], function(){
    Route::get('home', 'PhotoController@index')->name('home');
    Route::post('album/photos/store', 'PhotoController@photosStore')->name('photos.store');
    Route::get('photo/delete/{id}', 'PhotoController@destroy')->name('photo.delete');

    // Album
    Route::post('album/store', 'PhotoController@albumStore')->name('album.store');
    Route::get('album/delete/{id}', 'PhotoController@albumDelete')->name('album.delete');
    Route::post('album/edit', 'PhotoController@albumEdit')->name('album.edit');
    Route::get('album/show/{id}', 'PhotoController@albumShow')->name('album.show');

    // User
    Route::group(['middleware' => 'super_admin'], function (){
        Route::get('users', 'HomeController@users')->name('users');
        Route::get('users/delete/{id}', 'HomeController@userDelete')->name('user.delete');
        Route::get('users/edit/{id}', 'HomeController@userEdit')->name('user.edit');
        Route::post('users/update', 'HomeController@userUpdate')->name('update.user');
        Route::post('users/password/change', 'HomeController@userPasswordChange')->name('user.password.update');
        Route::post('user/store', 'HomeController@userRegister')->name('user.register');
    });

    Route::get('profile', 'HomeController@profile')->name('profile');
    Route::get('user/setting', 'HomeController@setting')->name('setting');
    Route::post('user/edit/profile', 'HomeController@editProfile')->name('edit.profile');
    Route::post('user/change/password', 'HomeController@changePassword')->name('user.password.change');
});



