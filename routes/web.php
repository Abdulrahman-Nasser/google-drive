<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\DriveController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes([
    'verify' => true
]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// view all files
Route::get('/allfile', [DriveController::class, 'allFile'])->name('drive.allFile')->middleware('Admin_role');



Route::middleware(['auth' , 'verified'])->group(function () {
    Route::prefix("drives")->group(function () {
        ///////////////// method get/////////////

        // view list of files
        Route::get('index', [DriveController::class, 'index'])->name('drive.index');
        // create file route
        Route::get('create', [DriveController::class, 'create'])->name('drive.create');
        //show file details 
        Route::get('show/{id}', [DriveController::class, 'show'])->name('drives.show');
        // Edit file Route
        Route::get('edit/{id}', [DriveController::class, 'edit'])->name('drives.edit');
        // Delete file route
        Route::get('destroy/{id}', [DriveController::class, 'destroy'])->name('drives.destroy');
        // download file route
        Route::get('download/{id}', [DriveController::class, 'download'])->name('drives.download');
        // shared files
        Route::get('shared', [DriveController::class, 'shared'])->name('drives.shared');
        // share file to public
        Route::get('share/{id}', [DriveController::class, 'share'])->name('drives.share');
        // public files 
        Route::get('publicFile/{id}', [DriveController::class, 'showSharedFile'])->name('drives.publicFile');
        // 401 error
        Route::get('401', [HomeController::class, 'goto401'])->name('goto401');

        //////////// method post//////////////

        // store the data in database
        Route::post('store', [DriveController::class, 'store'])->name('drives.store');
        // update file route
        Route::post('update/{id}', [DriveController::class, 'update'])->name('drives.update');
    });
});

// Admin
Route::get('adminPage' ,[AdminController::class , 'adminPage'])->name('admin.page');
Route::get('adminHome' , [AdminController::class , 'index'])->name('admin.home')->middleware('auth:Admin');
Route::post('adminLogin' , [AdminController::class , 'Login'])->name('admin.login');
