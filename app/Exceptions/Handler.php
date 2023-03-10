<?php

namespace App\Exceptions;

use ErrorException;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $exception, $request) {
            if ($request->is('v1/*')) {
                return response()->json([
                    'code' => 404,
                    'status' => false,
                    'msg' => $exception->getMessage(),
                    'error' => 1
                ], 404);
            }
        });

        $this->renderable(function (HttpException $exception, $request) {
            if ($request->is('v1/*')) {
                return response()->json([
                    'code' => $exception->getstatusCode(),
                    'status' => false,
                    'msg' => $exception->getMessage(),
                    'error' => 1,
                    'error_detail' => [
                        'code' => $exception->getStatusCode(),
                        'headers' => $exception->getHeaders(),
                        'line' => $exception->getLine(),
                    ]
                ], $exception->getstatusCode());
            }
        });

        $this->renderable(function (Exception $exception, $request) {
            if ($request->is('v1/*')) {
                return response()->json([
                    'code' => 400,
                    'status' => false,
                    'msg' => $exception->getMessage(),
                    'error' => 1
                ], 400);
            }
        });
    }
}