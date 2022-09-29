<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\UrllistController;
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

Route::get('/', [CheckController::class, 'create']);
Route::post('/', [CheckController::class, 'store']);
Route::get('/results', [ResultsController::class, 'show_results']);
Route::get('/url_list', [UrllistController::class, 'show_urls']);