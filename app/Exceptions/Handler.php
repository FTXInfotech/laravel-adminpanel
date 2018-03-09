<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $exception
     *
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
         /*
         * Redirect if token mismatch error
         * Usually because user stayed on the same screen too long and their session expired
         */
        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException) {
            switch (get_class($exception->getPrevious())) {
                case \App\Exceptions\Handler::class:
                    return response()->json([
                        'status' => 'error',
                        'error'  => 'Token has not been provided',
                        'data'   => json_decode("{}"),
                    ], $exception->getStatusCode());
                case \Tymon\JWTAuth\Exceptions\TokenExpiredException::class:
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Token has expired',
                        'data' => json_decode("{}"),
                    ], $exception->getStatusCode());
                case \Tymon\JWTAuth\Exceptions\TokenInvalidException::class:
                case \Tymon\JWTAuth\Exceptions\TokenBlacklistedException::class:
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Token is invalid',
                        'data' => json_decode("{}"),
                    ], $exception->getStatusCode());
                default:
                    break;
            }
        }
        /*
         * Redirect if token mismatch error
         * Usually because user stayed on the same screen too long and their session expired
         */
        if ($exception instanceof TokenMismatchException) {
            return redirect()->route('frontend.auth.login');
        }

        /*
         * All instances of GeneralException redirect back with a flash message to show a bootstrap alert-error
         */
        if ($exception instanceof GeneralException) {
            return redirect()->back()->withInput()->withFlashDanger($exception->getMessage());
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param \Illuminate\Http\Request                 $request
     * @param \Illuminate\Auth\AuthenticationException $exception
     *
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('frontend.auth.login'));
    }
}
