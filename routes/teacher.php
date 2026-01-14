<?php

use App\Http\Controllers\Teacher\Auth\AuthController;
use App\Http\Controllers\Teacher\CourseController;
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\TopicController;
use App\Http\Controllers\Teacher\LessionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['isTeacher'])->group(function(){
    Route::controller(CourseController::class)->group(function(){
        Route::get('/courses', 'index')->name('teacher.course.index');

    });

    Route::controller(TopicController::class)->group(function(){
        Route::get('/topics/{course}', 'index')->name('teacher.topic.index');

    });
    Route::controller(LessionController::class)->group(function(){
        Route::get('/lessions/{topic}', 'index')->name('teacher.lession.index');
        Route::post('/lession/{topic}/save', 'store')->name('teacher.lession.store');
        Route::post('/lession/{lession}/freeze', 'freezeCourse')->name('teacher.lession.freeze');
        Route::post('/lession/{lession}/delete', 'destroy')->name('teacher.lession.destroy');

        Route::get('/lession/{lession}/get-content', 'getContent')->name('teacher.lession.get-content');

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
