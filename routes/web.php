<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('user.home');
// })->name('home');

// Route::get('/admin', [LoginController::class, 'login']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->middleware('guest');

Route::post('/ceklogin', [loginController::class, 'ceklogin']);

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// Route::get('/dashboard/admins/checkUsername', [SuperAdminController::class, 'checkUsername'])->middleware('auth');

// Route::resource('/dashboard/admins', SuperAdminController::class)->middleware('auth');

// Route::resource('/dashboardadmin/services', AdminController::class)->middleware('auth');
// Route::get('/dashboardadmin/services/{service}', [AdminController::class, 'showTable'])->name('admin.showTable')->middleware('auth');


// Route::resource('/dashboard/services', ServiceController::class)->middleware('auth');
// Route::get('/dashboard/services/{service}', [ServiceController::class, 'showTable'])->name('service.showTable')->middleware('auth');
// Route::delete('/dashboard/services/{service}', [ServiceController::class, 'deletetable'])->name('delete.table')->middleware('auth');

Route::delete('/delete-template/{slug}', [ServiceController::class, 'deleteTemplate'])->name('delete.template');

Route::get('/download-template/{service}', [ServiceController::class, 'downloadTemplate'])->name('download.template')->middleware('auth');

// routes/web.php
Route::get('download-uploaded-template/{service}', [ServiceController::class, 'downloadUploadedTemplate'])->name('download.uploaded.template');

Route::post('/upload-excel-template', [ServiceController::class, 'uploadExcelTemplate'])->name('upload.excel.template');

Route::get('/import', [ImportController::class, 'index'])->name('import');
Route::post('/import', [ImportController::class, 'import'])->name('import');

Route::delete('/delete-data/{table}/{id}', [AdminController::class, 'delete'])->name('delete.data');

Route::get('/', [UserController::class, 'index'])->name('home');

Route::group(['middleware' => ['checkRole:superadmin']], function () {
    Route::get('/dashboard', function(){
        return view('superadmin.home');
    });

    Route::get('/dashboard/admins/checkUsername', [SuperAdminController::class, 'checkUsername']);

    Route::resource('/dashboard/admins', SuperAdminController::class);

    Route::resource('/dashboard/services', ServiceController::class);
    Route::get('/dashboard/services/{service}', [ServiceController::class, 'showTable'])->name('service.showTable');
    Route::delete('/dashboard/services/{service}', [ServiceController::class, 'deletetable'])->name('delete.table');
});

Route::group(['middleware' => ['checkRole:admin']], function () {
    Route::get('/dashboardadmin', function(){
        return view('admin.home');
    });

    Route::resource('/dashboardadmin/services', AdminController::class);
    Route::get('/dashboardadmin/services/{service}', [AdminController::class, 'showTable'])->name('admin.showTable');
});















