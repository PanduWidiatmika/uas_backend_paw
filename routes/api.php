<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::get('email/verify/{id}', 'Api\VerificationController@verify')->name('verificationapi.verify');
Route::get('email/resend', 'Api\VerificationController@resend')->name('verificationapi.resend');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('menu', 'Api\MenuController@index');
    Route::get('menu/{id}', 'Api\MenuController@show');
    Route::post('menu', 'Api\MenuController@store');
    Route::put('menu/{id}', 'Api\MenuController@update');
    Route::delete('menu/{id}','Api\MenuController@destroy');
    Route::put('profile/{id}', 'Api\UserController@update');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('pegawai', 'Api\PegawaiController@index');
    Route::get('pegawai/{id}', 'Api\PegawaiController@show');
    Route::post('pegawai', 'Api\PegawaiController@store');
    Route::put('pegawai/{id}', 'Api\PegawaiController@update');
    Route::delete('pegawai/{id}', 'Api\PegawaiController@destroy');
});

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('transaction','Api\TransactionController@index');
    Route::get('transaction/{id}','Api\TransactionController@show');
    Route::post('transaction','Api\TransactionController@store');
    Route::put('transaction/{id}','Api\TransactionController@update');
    Route::delete('transaction/{id}','Api\TransactionController@destroy');
});