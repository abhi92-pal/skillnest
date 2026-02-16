<?php

use App\Http\Controllers\Teacher\Auth\AuthController;
use App\Http\Controllers\Teacher\CourseController;
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\ExampaperController;
use App\Http\Controllers\Teacher\TopicController;
use App\Http\Controllers\Teacher\LessionController;
use App\Http\Controllers\Teacher\StreamController;
use Illuminate\Support\Facades\Route;

Route::middleware(['isTeacher'])->group(function(){
    Route::controller(CourseController::class)->group(function(){
        Route::get('/courses', 'index')->name('teacher.course.index');

    });

    Route::controller(ExampaperController::class)->group(function(){
        Route::get('/exam-paper-structure', 'index')->name('teacher.exampaper-structure.index');
        Route::get('/exam-paper-structure/{exampaper}/details', 'show')->name('teacher.exampaper-structure.show');
        // Route::get('/exampaper-structure/create', 'create')->name('admin.exampaper-structure.create');
        // Route::post('/exampaper-structure/save', 'store')->name('admin.exampaper-structure.store');
        // // Route::post('/examslot/{examslot}/delete', 'destroy')->name('admin.examslot.destroy');

        // Route::post('/exampaper-structure/{exampaper}/freeze', 'freezeExampaper')->name('admin.exampaper-structure.freeze');
        // Route::post('/exampaper-structure/get-semesters', 'getSemesters')->name('admin.exampaper-structure.get.semesters');
        // Route::post('/exampaper-structure/get-topics', 'getTopics')->name('admin.exampaper-structure.get.topics');
        // Route::post('/exampaper-structure/get-examslots', 'getExamSlots')->name('admin.exampaper-structure.get.examslots');
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

    Route::controller(StreamController::class)->group(function(){
        Route::get('/content/{lession}', 'getContent')->name('teacher.content.get');
        Route::get('/stream/{token}', 'stream')->name('teacher.content.stream');
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
