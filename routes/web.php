<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolewaiseAuthController;



Route::get('/login',  [LoginController::class, 'index'])->name('login');
Route::post('/login',  [LoginController::class, 'login']);
Route::get('/logout',  [LoginController::class, 'logout']);


Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('index');
    })->name('index');


    // role
    Route::get('/role-list', [RoleController::class, 'index']);
    Route::post('/role-list', [RoleController::class, 'saveRole']);
    Route::post('/role-edit', [RoleController::class, 'editRole']);
    Route::get('/delete-role/{id}', [RoleController::class, 'deleteRole']);

    // team
    Route::get('/team-list', [TeamController::class, 'index']);
    Route::post('/team-list', [TeamController::class, 'createTeam']);
    Route::post('/team-update', [TeamController::class, 'updateTeam']);
    Route::get('/delete-team/{id}', [TeamController::class, 'deleteTeam']);


    // user
    Route::get('/user-list', [UserController::class, 'index']);
    Route::get('/user-attendance', [UserController::class, 'userAttendance']);
    Route::post('/user-list', [UserController::class, 'saveUser']);
    Route::post('/user-update', [UserController::class, 'editUser']);
    Route::get('/delete-user/{id}', [UserController::class, 'deleteUser']);

    // permission
    Route::get('/permission', [RolewaiseAuthController::class, 'index']);

     // profile list
    Route::post('/editprofile',  [ProfileController::class, 'editprofile']);
    Route::post('/changePassword',  [ProfileController::class, 'changePassword']);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});
