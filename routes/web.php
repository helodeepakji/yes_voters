<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveysController;
use App\Http\Controllers\AssignSurveyController;
use App\Http\Controllers\RolewaiseAuthController;
use App\Http\Controllers\SurveyResponseController;
use App\Http\Controllers\SurveyQuestionController;



Route::get('/login',  [LoginController::class, 'index'])->name('login');
Route::post('/login',  [LoginController::class, 'login']);
Route::get('/logout',  [LoginController::class, 'logout']);


Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('index');
    })->name('index');
    
    Route::get('/', function () {
        return view('index');
    })->name('home');
    
    Route::get('/analytics', function () {
        return view('analytics');
    })->name('analytics');

    
    Route::get('/response-list', function () {
        return view('response');
    });


    // role
    Route::get('/role-list', [RoleController::class, 'index']);
    Route::post('/role-list', [RoleController::class, 'saveRole']);
    Route::post('/role-edit', [RoleController::class, 'editRole']);
    Route::get('/delete-role/{id}', [RoleController::class, 'deleteRole']);
    
    // surveys
    Route::get('/surveys-list', [SurveysController::class, 'index']);
    Route::get('/surveys-list/assigned-user/{id}', [AssignSurveyController::class, 'index']);
    Route::get('/delete-user-assign/{id}/survey/{survey_id}', [AssignSurveyController::class, 'deleteAssign']);
    Route::post('/surveys-list', [SurveysController::class, 'saveSurveys']);
    Route::post('/surveys-edit', [SurveysController::class, 'editSurveys']);
    Route::get('/delete-survey/{id}', [SurveysController::class, 'deleteSurveys']);
    
    // surveys qustion
    Route::get('/survey-question/{id?}', [SurveyQuestionController::class, 'index']);
    Route::post('/add-question', [SurveyQuestionController::class, 'addSurveyQuestion']);
    Route::post('/edit-question', [SurveyQuestionController::class, 'editSurveyQuestion']);
    Route::get('/delete-question/{id}', [SurveyQuestionController::class,'deleteSurveyQuestion']);    
    
    // surveys response
    Route::get('/user-response/{id?}', [SurveyResponseController::class, 'userResponse']);
    Route::get('/survey-response/{id?}', [SurveyResponseController::class, 'surveyResponse']);
    
    // assign survey
    Route::post('/assign-user', [AssignSurveyController::class, 'assignUser']);
    Route::post('/assign-team', [AssignSurveyController::class, 'assignTeam']);

    // team
    Route::get('/team-list', [TeamController::class, 'index']);
    Route::post('/team-list', [TeamController::class, 'createTeam']);
    Route::post('/team-update', [TeamController::class, 'updateTeam']);
    Route::get('/team-delete/{id}', [TeamController::class, 'deleteTeam']);


    // user
    Route::get('/user-list', [UserController::class, 'index']);
    Route::get('/user-attendance', [UserController::class, 'userAttendance']);
    Route::post('/user-list', [UserController::class, 'saveUser']);
    Route::post('/user-update', [UserController::class, 'editUser']);
    Route::get('/delete-user/{id}', [UserController::class, 'deleteUser']);

    // permission
    Route::get('/permission', [RolewaiseAuthController::class, 'index']);

     // profile list
    Route::post('/editprofile/{id}',  [ProfileController::class, 'editprofile']);
    Route::post('/changePassword',  [ProfileController::class, 'changePassword']);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/{id}', [ProfileController::class, 'userProfile']);
});
