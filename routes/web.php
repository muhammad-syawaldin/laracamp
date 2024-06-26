<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('welcome');
})->name('welcome');

Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('/checkout/{camp}', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('user/dashboard', [HomeController::class, 'dashboard'])->name('user.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('sign-in-google', [UserController::class, 'google'])->name('sign-in-google');
Route::get('auth/google/callback', [UserController::class, 'handleGoogleCallback'])->name('handle_google_callback');

require __DIR__ . '/auth.php';
