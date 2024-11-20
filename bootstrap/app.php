<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\CheckEmployeeMiddleware;
use App\Http\Middleware\CheckShipperMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware([ 'web', 'is_login', 'is_admin' ])
                ->prefix('/quan-ly')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));

        //     Route::middleware('web')
        //         ->group(base_path('routes/employee.php'));

        //     Route::middleware('web')
        //         ->group(base_path('routes/shipper.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'is_admin' => CheckAdminMiddleware::class,
            'is_employee' => CheckEmployeeMiddleware::class,
            'is_shipper' => CheckShipperMiddleware::class,
            'is_login' => CheckLoginMiddleware::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            // 'api/v1/cart/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
