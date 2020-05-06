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
    return redirect('/page/1');
});
Route::get('/page/{currentPage}', ['as' => 'posts', 'uses' => 'AdvertisementController@renderAllAds']);
Route::get('/register', 'RegisterController@validator');
Route::get('/createAd', 'AdvertisementController@renderAdCreationForm');
Route::post('/submitAdCreation', 'AdvertisementController@submitAdCreationForm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
