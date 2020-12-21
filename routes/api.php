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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:api')->post('/logout', 'AuthController@logout');
Route::resource('users', 'UserController');
Route::post('users1','UserController@store');

// Product Review
Route::resource('project','ProjectController');
Route::resource('announcement','AnnouncementController');
Route::resource('organization','OrganizationController');
Route::resource('currency','CurrencyController');
Route::resource('operation','OperationController');

// Latest Records
Route::get('announce-last','AnnouncementController@latest');
Route::get('project-last','ProjectController@latest');
Route::get('organization-last','OrganizationController@latest');
Route::post('currency/rates','CurrencyController@rates');
