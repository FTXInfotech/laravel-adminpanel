<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

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
        if (strpos($request->url(), '/api/') !== false) {
            \Log::debug('API Request Exception - '.$request->url().' - '.$exception->getMessage().(!empty($request->all()) ? ' - '.json_encode($request->except(['password'])) : ''));

            if ($exception instanceof AuthorizationException) {
                return $this->setStatusCode(403)->respondWithError($exception->getMessage());
            }

            if ($exception instanceof MethodNotAllowedHttpException) {
                return $this->setStatusCode(403)->respondWithError('Please check HTTP Request Method. - MethodNotAllowedHttpException');
            }

            if ($exception instanceof NotFoundHttpException) {
                return $this->setStatusCode(403)->respondWithError('Please check your URL to make sure request is formatted properly. - NotFoundHttpException');
            }

            if ($exception instanceof GeneralException) {
                return $this->setStatusCode(403)->respondWithError($exception->getMessage());
            }

            if ($exception instanceof ModelNotFoundException) {
                return $this->setStatusCode(403)->respondWithError('Item could not be found. Please check identifier.');
            }

            if ($exception instanceof ValidationException) {
                \Log::debug('API Validation Exception - '.json_encode($exception->validator->messages()));

                return $this->setStatusCode(422)->respondWithError($exception->validator->messages());
            }

            /*
            * Redirect if token mismatch error
            * Usually because user stayed on the same screen too long and their session expired
            */
            if ($exception instanceof UnauthorizedHttpException) {
                switch (get_class($exception->getPrevious())) {
                    case self::class:
                        return $this->setStatusCode($exception->getStatusCode())->respondWithError('Token has not been provided.');
                }
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
            session()->flash('dontHide', $exception->dontHide);

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

    /**
     * get the status code.
     *
     * @return statuscode
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * set the status code.
     *
     * @param [type] $statusCode [description]
     *
     * @return statuscode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * respond with error.
     *
     * @param $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithError($message)
    {
        return $this->respond([
                'error' => [
                    'message'     => $message,
                    'status_code' => $this->getStatusCode(),
                ],
            ]);
    }

    /**
     * Respond.
     *
     * @param array $data
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $headers = [])
    {
        return response()->json($data, $this->getStatusCode(), $headers);
    }
}
