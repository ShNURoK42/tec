<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UploadController;
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

//Route::name('report.')->prefix('report')->group(function () {
//});

Route::get('/login', function () {
    return response()->json(['error' => 'Unauthenticated'], 401);
})->name('login');
Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee/{employee}', [EmployeeController::class, 'show'])->name('employee.show');
Route::get('/upload', [EmployeeController::class, 'upload'])->name('employee.upload');
Route::post('/upload', UploadController::class)->name('employee.upload.store');
