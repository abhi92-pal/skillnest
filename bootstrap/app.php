<?php

use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Middleware\IsTeacherMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        // Register custom route files here
        then: function () {
            Route::middleware('web')
                ->prefix('ad')
                ->group(base_path('routes/admin.php'));
            Route::middleware('web')
                ->prefix('tc')
                ->group(base_path('routes/teacher.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
                                'isAdmin' => IsAdminMiddleware::class,
                                'isTeacher' => IsTeacherMiddleware::class,
                            ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
