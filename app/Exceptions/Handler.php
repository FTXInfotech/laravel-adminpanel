<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Illuminate\Validation\ValidationException;

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
        if ($exception instanceof TokenMismatchException) {
            return redirect()->route('frontend.auth.login');
        }

        /*
         * All instances of GeneralException redirect back with a flash message to show a bootstrap alert-error
         */
        if ($exception instanceof GeneralException) {
            return redirect()->back()->withInput()->withFlashDanger($exception->getMessage());
        }

        if(strpos($request->url(), '/api/') !== false)
        {
            \Log::debug("API Request Exception - ". $request->url() ." - " . $exception->getMessage() . (!empty($request->all()) ? ' - ' . json_encode($request->except(['password'])) : ''));

            if($exception instanceof MethodNotAllowedHttpException)
            {
                return response()->json((object) [
                    'status'        => false,
                    'errorCode'     => 'METHOD_NOT_ALLOWED',
                    'message'       => 'Please check HTTP Request Method. - MethodNotAllowedHttpException'
                ], 403);
            }

            if($exception instanceof NotFoundHttpException)
            {
                return response()->json((object) [
                    'status'        => false,
                    'errorCode'     => 'URL_NOT_FOUND',
                    'message'       => 'Please check your URL to make sure request is formatted properly. - NotFoundHttpException'
                ], 403);
            }

            if($exception instanceof GeneralException)
            {
                return response()->json((object) [
                    'status'        => false,
                    'errorCode'     => 'EXCEPTION',
                    'message'       => $exception->getMessage()
                ], 403);
            }

            if($exception instanceof ModelNotFoundException)
            {
                return response()->json((object) [
                    'status'        => false,
                    'errorCode'     => 'ITEM_NOT_FOUND',
                    'message'       => 'Item could not be found. Please check identifier.'
                ], 403);
            }

            if($exception instanceof ValidationException)
            {
                \Log::debug("API Validation Exception - " . json_encode($exception->validator->messages()));

                return response()->json((object) [
                    'status'        => false,
                    'errorCode'     => 'VALIDATION_EXCEPTION',
                    'messages'      => $exception->validator->messages()
                ], 403);
            }
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
