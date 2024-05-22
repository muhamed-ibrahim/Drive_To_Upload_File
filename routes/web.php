<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('goto401', [App\Http\Controllers\DriveController::class, 'goto401'])->name('goto.401');


Route::prefix('drive')->group(function(){
    Route::get('publicDrives', [App\Http\Controllers\DriveController::class, 'publicDrives'])->name('public.Drives');
    Route::get('sharedDrive/{id}', [App\Http\Controllers\DriveController::class, 'sharedDrive'])->name('shared.Drive');

    Route::get('driveAll', [App\Http\Controllers\DriveController::class, 'indexAll'])->name('drive.All');

    Route::get('list', [App\Http\Controllers\DriveController::class, 'index'])->name('drive.index');
    Route::get('create', [App\Http\Controllers\DriveController::class, 'create'])->name('drive.create');
    Route::post('create', [App\Http\Controllers\DriveController::class, 'store'])->name('drive.store');
    Route::get('edit/{id}', [App\Http\Controllers\DriveController::class, 'edit'])->name('drive.edit');
    Route::post('update/{id}', [App\Http\Controllers\DriveController::class, 'update'])->name('drive.update');
    Route::get('show/{id}', [App\Http\Controllers\DriveController::class, 'show'])->name('drive.show');
    Route::get('delete/{id}', [App\Http\Controllers\DriveController::class, 'destroy'])->name('drive.destroy');
    Route::get('download/{id}', [App\Http\Controllers\DriveController::class, 'download'])->name('drive.download');

});
