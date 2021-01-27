<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
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

Route::get('/', 'ApplicationController')->where('any', '.*');

// Clear cache and redirect to the home page.
Route::get('/cc', function() {
  $exitCode = Cache::flush();
  $exitCode = Artisan::call('config:cache');
  $exitCode = Artisan::call('cache:clear');
  $exitCode = Artisan::call('view:clear');
  $exitCode = Artisan::call('route:clear');
  $exitCode = Artisan::call('clear-compiled');
  $exitCode = Artisan::call('key:generate');
  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
  return redirect($actual_link);
});

// DB_DATABASE=alimi_erp
// DB_USERNAME=alimi_erp_user
// DB_PASSWORD=MRECEMY7ZO