<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('app');
// });

Route::get('/{any}', function () {
    return view('app');
    // })->where('any', '.*');
})->where('any', '^(?!ad|tc|ex).*$');

Route::get('/ex/{any}', function () {
    return view('exam-app');
    // })->where('any', '.*');
})->where('any', '.*$');


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
