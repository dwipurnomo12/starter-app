<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingApplicationController;
use App\Http\Controllers\UserController;

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::get('/aplikasi', [SettingApplicationController::class, 'index']);
    Route::put('/aplikasi/{id}', [SettingApplicationController::class, 'update']);

    Route::get('/role/get-data', [RoleController::class, 'GetRoles']);
    Route::resource('/role', RoleController::class);

    Route::get('/permission/get-data', [PermissionController::class, 'getPermissions']);
    Route::resource('/permission', PermissionController::class);

    Route::get('/user/get-data', [UserController::class, 'getUsers']);
    Route::resource('/user', UserController::class);
});
