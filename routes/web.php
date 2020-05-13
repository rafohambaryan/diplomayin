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
Route::get('/', 'MainController@index');
Route::post('/create-present', 'MainController@createPresent');
Route::post('/create-present/{id}', 'MainController@createPresent');
Route::get('/present/{token}', 'PresentController@index');
Route::get('/migrated', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
//    Artisan::call('migrate');
//    Artisan::call('db:seed');
    echo '<h3>All cache has been cleared.</h3>';

});


Auth::routes();

Route::get('/setting/{token}', 'HomeController@index');
