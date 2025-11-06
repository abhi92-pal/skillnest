<?php

use App\Http\Controllers\Teacher\Auth\AuthController;
use App\Http\Controllers\Teacher\CourseController;
use App\Http\Controllers\Teacher\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['isTeacher'])->group(function(){
    Route::controller(CourseController::class)->group(function(){
        Route::get('/courses', 'index')->name('teacher.course.index');

    });

    Route::controller(DashboardController::class)->group(function(){
        Route::get('/', 'index')->name('teacher.dashboard');
    });

    Route::controller(AuthController::class)->group(function(){
        Route::post('/logout', 'logout')->name('teacher.logout');
    });

});

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'showLoginForm')->name('teacher.login');
    Route::post('/login', 'login')->name('teacher.login');
});
