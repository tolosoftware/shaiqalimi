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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->post('/logout', 'AuthController@logout');
Route::get('user', 'UserController@user')->middleware('auth:api');
Route::resource('users', 'UserController');
Route::resource('itemtype', 'ItemTypeController');
Route::resource('item', 'ItemController');
Route::resource('uom', 'MeasurmentUnitController');
Route::resource('storage', 'StorageController');
Route::get('totalstorage', 'StorageController@totalstorage');
Route::resource('fuelstation', 'FuelStationController');
Route::get('latestfuelstation', 'FuelStationController@latest');
Route::resource('fuelstorestation', 'FuelStationStorageController');
Route::post('users1', 'UserController@store');
Route::post('users1', 'UserController@store');

// Sales
Route::resource('sale1', 'SaleOneController');
Route::resource('sale2', 'SaleTwoController');
Route::resource('sale3', 'SaleThreeController');
Route::resource('sale4', 'SaleFourController');
Route::get('sales', 'SaleOneController@allSales');
Route::get('sales/{id}', 'SaleOneController@show');
Route::get('sale/{id}', 'SaleOneController@showSale');
Route::delete('sales/{sale}', 'SaleOneController@deleting');

// Product Review
Route::resource('project', 'ProjectController');
Route::resource('proposal', 'ProposalController');
Route::resource('currency', 'CurrencyController');
Route::resource('operation', 'OperationController');
Route::resource('acount_type', 'AccountTypeController');
Route::get('accounts', 'AccountTypeController@allAccounts');
Route::resource('clients', 'ClientController');
Route::resource('item-type', 'ItemTypeController');
Route::resource('items', 'ItemController');
Route::resource('m-units', 'MeasurmentUnitController');
Route::resource('pro-item', 'ProItemController');
Route::resource('account', 'AccountController');
Route::resource('transfer', 'TransferController');
Route::resource('notification', 'NotificationController');

Route::resource('godam', 'InventoryController');
Route::get('firstgodam', 'InventoryController@first');

Route::resource('financial', 'FinancialRecordController');
Route::resource('despenser', 'FuelDespenserController');

// Latest Records
// Route::get('announce-last','ProposalController@latest');
Route::get('project-last', 'ProjectController@latest');
Route::resource('companies', 'CompanyController');
Route::post('currency/rates', 'CurrencyController@rates');
Route::get('serial-num', 'SerialNumberController@latest');
Route::post('financial-account', 'FinancialRecordController@byaccount');
Route::post('storage-station', 'FuelStationStorageController@bystation');

Route::get('lastest-projects', 'ProjectController@latestProject');
Route::get('active-project', 'ProjectController@activeProject');
Route::get('client/{id}', 'ProjectController@getClient');

//vendors
Route::resource('vendors', 'VendorController');
Route::resource('procurments', 'PurchaseController');
Route::get('purchSerialNO', 'PurchaseController@serial');
Route::get('sources', 'StorageController@allTypeSource');

//Archive
Route::get('accoutload', 'AccountController@getaccount');
//transactions
Route::resource('transaction', 'TransactionController');
Route::get('transactionSerialnum', 'TransactionController@serial');

//Expenses
Route::resource('expenses', 'ExpensesController');
Route::get('exserialno', 'ExpensesController@serial');
Route::get('item-records/{item_id}', 'StockRecordController@itemRecords');
Route::get('bank-accounts', 'AccountController@bankAccounts');

// Archive
Route::resource('archive', 'ArchiveController');
Route::post('archive/upload', 'ArchiveController@upload');
Route::post('remove-file', 'ArchiveController@removeFile');

Route::get('mostresent', 'ArchiveController@mostresent');
Route::get('sale/project/{project_id}', 'ProjectController@projectSales');
Route::get('sale/project/type/{project_id}', 'ProjectController@projectTypeChart');
Route::get('sale/project/item-chart/{project_id}', 'ProjectController@projectItemChart');
// Route::get('transaction/view/{transaction_id}', 'TransactionController@');
