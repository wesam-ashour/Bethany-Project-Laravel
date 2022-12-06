<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TouristController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('admins', AdminController::class);
    Route::resource('users', UserController::class);
    Route::resource('events', EventController::class);
    Route::resource('places', PlaceController::class);
    Route::resource('tourists', TouristController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('faq', QuestionController::class);
    Route::resource('options', OptionController::class);

    Route::get('generate/', [PlaceController::class, 'generator'])->name('generator');
    Route::post('showQr/', [PlaceController::class, 'showQr'])->name('showQr');
    Route::get('pdf/{id}', [PlaceController::class, 'generatePDF']);
    Route::get('event/register/{id}', [EventController::class, 'register']);
    Route::post('event/send/message/', [EventController::class, 'sendMessage'])->name('sendMessage');

});

require __DIR__.'/auth.php';
