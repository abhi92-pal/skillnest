<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExamslotController;
use App\Http\Controllers\Admin\LessionController;
use App\Http\Controllers\Admin\StreamController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use Illuminate\Support\Facades\Route;

Route::middleware(['isAdmin'])->group(function(){
    Route::controller(CourseController::class)->group(function(){
        Route::get('/courses', 'index')->name('admin.course.index');
        Route::get('/course/create', 'create')->name('admin.course.create');
        Route::post('/course/save', 'store')->name('admin.course.store');
        Route::get('/course/{course}/details', 'show')->name('admin.course.show');
        Route::get('/course/{course}/edit', 'edit')->name('admin.course.edit');
        Route::post('/course/{course}/update', 'update')->name('admin.course.update');

        Route::post('/course/get-topic-structure', 'getSemTopicStruct')->name('admin.course.get-topic-structure');
        Route::post('/course/{course}/freeze', 'freezeCourse')->name('admin.course.freeze');
        Route::post('/course/{course}/change-status', 'changeStatus')->name('admin.course.change-status');
        Route::post('/course/{course}/publish', 'publishCourse')->name('admin.course.publish');
    });

    Route::controller(DashboardController::class)->group(function(){
        Route::get('/', 'index')->name('admin.dashboard');
    });

    Route::controller(ExamslotController::class)->group(function(){
        Route::post('/examslots', 'index')->name('admin.examslot.index');
        Route::post('/manage-examslot', 'createOrUpdate')->name('admin.examslot.manage');
        Route::post('/examslot/{examslot}/delete', 'destroy')->name('admin.examslot.destroy');
    });

    Route::controller(LessionController::class)->group(function(){
        Route::get('/lessions/{topic}', 'index')->name('admin.lession.index');
        Route::get('/lession/{lession}/get-content', 'getContent')->name('admin.lession.get-content');
    });

    Route::controller(StudentController::class)->group(function(){
        Route::get('/students', 'index')->name('admin.student.index');
        Route::get('/student/create', 'create')->name('admin.student.create');
    });
    
    Route::controller(StreamController::class)->group(function(){
        Route::get('/content/{lession}', 'getContent')->name('admin.content.get');
        Route::get('/stream/{token}', 'stream')->name('admin.content.stream');
    });
    
    Route::controller(TeacherController::class)->group(function(){
        Route::get('/teachers', 'index')->name('admin.teacher.index');
        Route::get('/teacher/create', 'create')->name('admin.teacher.create');
        Route::post('/teacher/save', 'store')->name('admin.teacher.store');
        Route::post('/teacher/{user}/update/', 'update')->name('admin.teacher.update');
    });

    Route::controller(AuthController::class)->group(function(){
        Route::post('/logout', 'logout')->name('admin.logout');
    });

});

Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'showLoginForm')->name('admin.login');
    Route::post('/login', 'login')->name('admin.login');
});
