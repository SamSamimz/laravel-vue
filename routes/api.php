<?php
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return response()->json($request);
});

Route::get('/test', function () {
    return response()->json(['message' => 'Your application is awesome!'], 200);
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::logout('/logout',[AuthController::class,'logout'])->name('logout');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',LogoutController::class)->name('logout');
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/categories', CategoryController::class);
    Route::apiResource('/blogs', BlogController::class);
});