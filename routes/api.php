<?php

use App\Http\Controllers\API\EmployeeController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/sanctum/token/', function (Request $request) {
    $request->validate([
        'email' => 'required|email'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        throw ValidationException::withMessages([
            'email' => ['Не удалось найти пользователя с указанным электронным адресом.'],
        ]);
    }

    return $user->createToken('api_token')->plainTextToken;
});

Route::middleware('auth:sanctum')->post('/employees/started_work', [EmployeeController::class, 'started_work']);
Route::middleware('auth:sanctum')->post('/employees/finished_work', [EmployeeController::class, 'finished_work']);

