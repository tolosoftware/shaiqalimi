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
Route::resource('itemtype', 'ItemTypeController');
Route::resource('item', 'ItemController');
Route::resource('uom', 'MeasurmentUnitController');
Route::resource('storage', 'StorageController');
Route::resource('fuelstation', 'FuelStationController');
Route::post('users1','UserController@store');

// Product Review
Route::resource('project', 'ProjectController');
Route::resource('proposal', 'ProposalController');
Route::resource('organization', 'OrganizationController');
Route::resource('currency', 'CurrencyController');
Route::resource('operation', 'OperationController');
Route::resource('acount_type', 'AccountTypeController');
Route::resource('clients', 'ClientController');
Route::resource('item-type', 'ItemTypeController');
Route::resource('items', 'ItemController');
Route::resource('m-units', 'MeasurmentUnitController');
Route::resource('pro-item', 'ProItemController');
Route::resource('account', 'AccountController');
Route::resource('financial', 'FinancialRecordController');
Route::resource('despenser', 'FuelDespenserController');

// Latest Records
// Route::get('announce-last','ProposalController@latest');
Route::get('project-last', 'ProjectController@latest');
Route::get('organization-last', 'OrganizationController@latest');
Route::post('currency/rates', 'CurrencyController@rates');
Route::get('serial-num', 'SerialNumberController@latest');
Route::post('financial-account', 'FinancialRecordController@byaccount');
Route::post('storage-station', 'FuelStationStorageController@bystation');
