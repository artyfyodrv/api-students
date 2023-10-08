<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\LectionController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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

Route::post('v1/students/create', [StudentController::class, 'create']);
Route::patch('v1/students/update/{id}', [StudentController::class, 'update']);
Route::post('v1/students/delete/{id}', [StudentController::class, 'delete']);
Route::get('v1/students/get-all', [StudentController::class, 'getAll']);
Route::get('v1/students/get-one/{id}', [StudentController::class, 'getOneInfo']);

Route::post('v1/classrooms/create', [ClassroomController::class, 'create']);
Route::patch('v1/classrooms/update/{id}', [ClassroomController::class, 'update']);
Route::post('v1/classrooms/delete/{id}', [ClassroomController::class, 'delete']);
Route::get('v1/classrooms/get-all', [ClassroomController::class, 'getAll']);
Route::get('v1/classrooms/get-one/{id}', [ClassroomController::class, 'getOneInfo']);
Route::post('v1/classrooms/set-schedule', [ClassroomController::class, 'setSchedule']);
Route::get('v1/classrooms/get-schedule/{id}', [ClassroomController::class, 'getSchedule']);

Route::post('v1/lections/create', [LectionController::class, 'create']);
Route::patch('v1/lections/update/{id}', [LectionController::class, 'update']);
Route::post('v1/lections/delete/{id}', [LectionController::class, 'delete']);
Route::get('v1/lections/get-all', [LectionController::class, 'getAll']);
Route::get('v1/lections/get-one/{id}', [LectionController::class, 'getOneInfo']);
