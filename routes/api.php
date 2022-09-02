<?php

use App\Http\Controllers\ContinentController;
use App\Http\Controllers\CountryController;
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

/** Country routes */
Route::get('countries', [CountryController::class, 'index']);
Route::post('countries/{country?}', [CountryController::class, 'updateOrCreate']);
Route::get('countries/{country}', [CountryController::class, 'show']);

/** Continent routes */
Route::get('continents', [ContinentController::class, 'index']);

