<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\MainController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Requestor\InputIzinController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'changeProfile'])->name('changeProfile');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('updateProfile');

    // Start Input Email
    Route::post('/input-email', [MainController::class, 'inputEmail'])->name('inputEmail');
    // End Input Email

    // Start Input Perizinan
    Route::prefix('/add-izin')->middleware(['permission:add-permission'])->group(function(){ 
        Route::get('', [InputIzinController::class, 'input_izin'])->name('input_izin');
        Route::get('/get-data', [InputIzinController::class, 'getDataIzin'])->name('getDataIzin');
    });
    // End Input Perizinan

});

require __DIR__.'/auth.php';
