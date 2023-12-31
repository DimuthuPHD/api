<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {

        });
    }

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Flare, Sentry, Bugsnag, etc.
     *
     * @return void
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof MissingAbilityException) {
            // You can customize the response for MissingAbilityException here
            return response()->json([
                'errors' => [
                    'status' => 401,
                    'message' => 'Unauthorized',
                ],
            ], 401);
        }

        return parent::render($request, $exception);
    }
}
