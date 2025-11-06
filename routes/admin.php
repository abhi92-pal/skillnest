<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['isAdmin'])->group(function(){
    Route::controller(CourseController::class)->group(function(){
        Route::get('/courses', 'index')->name('admin.course.index');
        Route::get('/course/create', 'create')->name('admin.course.create');
        Route::post('/course/save', 'store')->name('admin.course.store');
        Route::get('/course/{course}/edit', 'edit')->name('admin.course.create');
        Route::post('/course/{course}/update', 'update')->name('admin.course.update');

        Route::post('/course/{course}/freeze', 'freezeCourse')->name('admin.course.freeze');
        Route::post('/course/{course}/change-status', 'changeStatus')->name('admin.course.change-status');
        Route::post('/course/{course}/publish', 'publishCourse')->name('admin.course.publish');
    });

    Route::controller(DashboardController::class)->group(function(){
        Route::get('/', 'index')->name('admin.dashboard');
    });

    Route::controller(AuthController::class)->group(function(){
        Route::post('/logout', 'logout')->name('admin.logout');
    });
});

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'showLoginForm')->name('admin.login');
    Route::post('/login', 'login')->name('admin.login');
});
