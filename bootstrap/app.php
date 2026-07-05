<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Daftarkan Security Headers sebagai middleware global (semua request)
        $middleware->append(\App\Http\Middleware\SecurityHeaders::class);

        $middleware->alias([
            'operator' => \App\Http\Middleware\IsOperator::class,
            'admin'    => \App\Http\Middleware\IsAdmin::class,
            'role'     => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        // Jika user sudah login dan mengakses halaman guest (/login), arahkan langsung ke dashboard yang sesuai
        $middleware->redirectUsersTo(function () {
            if (auth()->user()?->role === 'admin') {
                return '/admin/dashboard';
            }
            return '/operator/dashboard';
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
