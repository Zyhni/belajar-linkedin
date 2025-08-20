<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;


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

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class,'logout']);

    // Courses
    Route::get('/courses',[CourseController::class,'index']);
    Route::post('/courses',[CourseController::class,'store']);
    Route::get('/courses/{id}',[CourseController::class,'show']);
    Route::put('/courses/{id}',[CourseController::class,'update']);
    Route::delete('/courses/{id}',[CourseController::class,'destroy']);

    // Enrollments
    Route::post('/enroll/{courseId}',[EnrollmentController::class,'store']);
    Route::get('/my-enrollments',[EnrollmentController::class,'index']);
});
