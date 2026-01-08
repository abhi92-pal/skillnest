<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\{
    CourseCategoryController,
    CourseController,
    UserController,
    TeacherController
};
use App\Http\Controllers\Api\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login', [LoginController::class, 'login']);
Route::get('/teachers', [TeacherController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);

Route::controller(CourseCategoryController::class)->group(function(){
    Route::get('/category-list', 'index');
});

Route::controller(CourseController::class)->group(function(){
    Route::get('/category-wise-courses', 'getCategoryWiseSimpleList');
    Route::get('/courses', 'index');
    Route::get('/course/{course}/details', 'show');
});

Route::middleware(['apiAuth'])->group(function(){
    Route::post('/refresh', [LoginController::class, 'refresh']);
    
    Route::controller(UserController::class)->group(function(){
        Route::get('/profile', 'profile');
    });
});
