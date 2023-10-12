<?php

use App\Http\Controllers\EmailConfigurationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post("configuration", [EmailConfigurationController::class, "createConfiguration"])->name("configuration.store");

Route::get("email", [EmailConfigurationController::class, "composeEmail"])->name("email");

Route::post("compose-email", [EmailConfigurationController::class, "sendEmail"])->name('compose-email');