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


Auth::routes();
Route::get('/', function () {
    return redirect('/posts');
});
Route::get('/posts', ['as' => 'posts', 'uses' => 'AdvertisementController@renderAllAds']);
Route::get('/createAd', 'AdvertisementController@renderAdCreationForm')->middleware('auth');
Route::get('/ad/{id}', 'AdvertisementController@renderAdById');
Route::get('/updateAd/{id}', 'AdvertisementController@renderAdUpdateForm')->middleware('auth');
Route::post('/submitAdCreation/', 'AdvertisementController@submitAdForm')->middleware('auth');
Route::post('/submitAdCreation/{id}', 'AdvertisementController@submitAdForm')->middleware('auth');
Route::post('/submitAdUpdate', 'AdvertisementController@submitAdForm')->middleware('auth');


