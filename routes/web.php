<?php

use App\Http\Controllers\CurrenciesController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [CurrenciesController::class, 'index'])->name('index.view');
Route::get('/currency-history/{currencyTitle}', [CurrenciesController::class, 'view'])->name('currencyHistory.view');
