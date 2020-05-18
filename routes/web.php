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

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'reset' => false,
    'verify' => false,
]);
//Route::get('/', 'MainController@index');
//Route::post('/create-present', 'MainController@createPresent');

Route::get('/present/{token}', 'PresentController@index');
Route::post('/colors/{token}', 'PresentController@colors');
Route::get('/migrated', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
//    Artisan::call('migrate');
//    Artisan::call('db:seed');
    echo '<h3>All cache has been cleared.</h3>';

});

Route::get('/', 'Backend\AuthController@index');
Route::group(['namespace' => 'Backend', 'middleware' => 'auth'], function () {
    Route::delete('/', 'AuthController@delete');
    Route::post('/create-present', 'AuthController@create');
    Route::put('/create-present/{id}', 'AuthController@create');
    Route::get('/setting/{id}', 'AuthController@get');
    Route::get('/setting/{present}/{sub}', 'SubheadingManyController@get');
    Route::post('/setting/update', 'MainSlideController@update');
});

Route::any('{error}', function ($page) {
    abort(404);
});
