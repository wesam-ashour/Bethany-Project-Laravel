<?php

use App\Http\Controllers\API\FAQApiController;
use App\Http\Controllers\API\PlacesApiController;
use App\Http\Controllers\API\SettingsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EventsApiController;

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
Route::prefix('events')
    ->middleware('localization')
    ->name('events')
    ->controller(EventsApiController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/register', 'register');
        Route::get('/verified/{id}', 'verified');

    });
Route::prefix('places')
    ->middleware('localization')
    ->name('places')
    ->controller(PlacesApiController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::post('/scanned_qr', 'scanned_qr');

    });
Route::prefix('faq')
    ->middleware('localization')
    ->name('faq')
    ->controller(FAQApiController::class)
    ->group(function () {
        Route::get('/', 'index');

    });
Route::prefix('settings')
    ->middleware('localization')
    ->name('settings')
    ->controller(SettingsApiController::class)
    ->group(function () {
        Route::get('/', 'index');

    });
