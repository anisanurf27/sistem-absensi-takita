<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\MainController;
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
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [MainController::class, 'home'])->name('home');
    
    Route::get('/profile', [ProfileController::class, 'changeProfile'])->name('changeProfile');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('updateProfile');

    // Start Input Email
    Route::post('/input-email', [MainController::class, 'inputEmail'])->name('inputEmail');
    // End Input Email

});

require __DIR__.'/auth.php';
