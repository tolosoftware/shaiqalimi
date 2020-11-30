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
<<<<<<< HEAD
Route::post('transaction/create', "TransactionController@savetransaction");
Route::get('transaction/getnextserialno', "TransactionController@getserialnumber");
Route::get('transaction/getTransactionData', "TransactionController@getTransactionData");
=======

// Product Review
Route::resource('project','ProjectController');
Route::resource('announcement','AnnouncementController');
Route::resource('organization','OrganizationController');

// Latest Records
Route::get('announce-last','AnnouncementController@latest');
Route::get('project-last','ProjectController@latest');
Route::get('organization-last','OrganizationController@latest');
>>>>>>> 5b321742c76ffbf0cb67fab72c626b6320720276
