<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\SurveysController;
use App\Http\Controllers\SurveyQuestionController;
use App\Http\Controllers\RolewaiseAuthController;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });
});


Route::get('/getRole/{id}', [RoleController::class, 'getRole']);
Route::get('/getSurvey/{id}', [SurveysController::class, 'getSurvey']);
Route::get('/getSurveyQuestion/{id}', [SurveyQuestionController::class, 'getSurveyQuestion']);
Route::get('/getUser/{id}', [UserController::class, 'getUser']);
Route::get('/getTeamLeaderDetails/{id}', [TeamController::class, 'getTeamLeaderDetails']);


Route::post('/giveAccessPage/{id}', [RolewaiseAuthController::class, 'giveAccess']);
Route::post('/denyAccessPage/{id}', [RolewaiseAuthController::class, 'denyAccess']);
Route::get('/authentication/{id}', [RolewaiseAuthController::class, 'getRoleAuthentication']);
