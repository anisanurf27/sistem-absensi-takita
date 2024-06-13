<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\MainController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\EnrollUserController;
use App\Http\Controllers\Requestor\InputIzinController;
use App\Http\Controllers\Requestor\MonitoringDiriController;
use App\Http\Controllers\User\GetDataSensorController;
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

    // Start Super Admin
    Route::prefix('/md-enroll-usr')->middleware(['role:admin'])->group(function(){ 
        Route::get('', [EnrollUserController::class, 'enroll_user'])->name('enroll_user');
        Route::get('/get-data-enroll', [EnrollUserController::class, 'getDataEnroll'])->name('getDataEnroll');
        Route::get('/edit-data-usr/{id}', [EnrollUserController::class, 'editData'])->name('editData');
        Route::get('/delete-data-usr/{id}', [EnrollUserController::class, 'deleteData'])->name('deleteData');
        Route::get('/get-kelas-master', [EnrollUserController::class, 'selectGetKelas'])->name('selectGetKelas'); 
        Route::get('/get-fingerprint-id', [EnrollUserController::class, 'getFingerID'])->name('getFingerID');      
        Route::get('/cek-fingerprint', [EnrollUserController::class, 'checkFingerprint'])->name('checkFingerprint'); 
        Route::get('/add-finger/{id}', [EnrollUserController::class, 'add_finger'])->name('add_finger'); 
        Route::post('/store-user-students', [EnrollUserController::class, 'storeNewStudents'])->name('storeNewStudents');
    });

    Route::prefix('/md-enroll-device')->middleware(['role:admin'])->group(function(){ 
        Route::get('/device', [EnrollUserController::class, 'enroll_device'])->name('enroll_device');
        Route::get('/get-data-device', [EnrollUserController::class, 'getDataDevice'])->name('getDataDevice');
        Route::get('/edit-device/{id}', [EnrollUserController::class, 'editDevice'])->name('editDevice');
        Route::get('/delete-device/{id}', [EnrollUserController::class, 'deleteDevice'])->name('deleteDevice');
        Route::post('/store-device', [EnrollUserController::class, 'storeDevice'])->name('storeDevice');
        Route::post('/store-edit-device', [EnrollUserController::class, 'storeEditDevice'])->name('storeEditDevice');
    });
    // End Super Admin

    // Start Input Perizinan
    Route::prefix('/add-izin')->middleware(['permission:add-permission'])->group(function(){ 
        Route::get('', [InputIzinController::class, 'input_izin'])->name('input_izin');
        Route::get('/get-data-izin', [InputIzinController::class, 'getDataIzin'])->name('getDataIzin');
    });
    // End Input 
    
    // Start Monitoring Diri Siswa
    Route::prefix('/monitoring-diri')->middleware(['permission:add-permission'])->group(function(){ 
        Route::get('', [MonitoringDiriController::class, 'monitoring_presensi_diri'])->name('monitoring_presensi_diri');
        Route::get('/get-data-log', [MonitoringDiriController::class, 'getDataMonitor'])->name('getDataMonitor');
    });
    // End Monitoring Diri Siswa

});

require __DIR__.'/auth.php';