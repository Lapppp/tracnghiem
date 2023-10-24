<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use InvalidArgumentException;
use BadMethodCallException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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
        $this->reportable(function (Throwable $e) {

        });



//        $this->renderable(function (NotFoundHttpException $e, $request) {
//            dd($e);
//            if ($request->is('api/*')) {
//                return response()->json([
//                    'message' => 'Record not found.'
//                ], 404);
//            }
//        });

//        $this->renderable(function (InvalidOrderException $e, $request) {
//            return response()->view('errors.invalid-order', [], 500);
//        });
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Throwable $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response|void
     */
    public function render($request, Throwable $exception)
    {

        if ($request->is('api/*')) {
            $exception->getStatusCode();

            if ($exception instanceof NotFoundHttpException) {

                return response()->view('errors.404', [], 404);
            }
        } elseif ($request->is('acp/*')) {

            if ($exception instanceof NotFoundHttpException) {
                return response()->view('errors.404', [], 404);
            }
            if ($exception instanceof ModelNotFoundException) {

            }

            if ($exception instanceof HttpResponseException) {
                return response()->view('errors.404', [], 404);
            }

            if ($exception instanceof InvalidArgumentException) {
                return response()->view('errors.404', [], 404);
            }

            if ($exception instanceof BadMethodCallException) {
                return response()->view('errors.404', [], 404);
            }



            if ($exception instanceof AuthenticationException) {
                //$exception = $this->unauthenticated($request, $exception);
            }

            if ($exception instanceof ValidationException) {
                //$exception = $this->convertValidationExceptionToResponse($exception, $request);
            }

            if ($exception instanceof ThrottleRequestsException) {
                return response()->view('errors.404', [], 404);
            }

        }else{
            if ($exception instanceof NotFoundHttpException) {
                return response()->view('errors.404-frontend', [], 404);
            }
            if ($exception instanceof ModelNotFoundException) {
                return response()->view('errors.404-frontend', [], 404);
            }

            if ($exception instanceof HttpResponseException) {
                return response()->view('errors.404-frontend', [], 404);
            }

            if ($exception instanceof InvalidArgumentException) {
                return response()->view('errors.404-frontend', [], 404);
            }

            if ($exception instanceof BadMethodCallException) {
                return response()->view('errors.404-frontend', [], 404);
            }



            if ($exception instanceof AuthenticationException) {
                //$exception = $this->unauthenticated($request, $exception);
            }

            if ($exception instanceof ValidationException) {
                //$exception = $this->convertValidationExceptionToResponse($exception, $request);
            }

            if ($exception instanceof ThrottleRequestsException) {
                return response()->view('errors.404.frontend', [], 404);
            }
        }
        return parent::render($request, $exception);

    }

    public function isValid($value)
    {
        try {
            // Validate the value...
        } catch (Exception $e) {
            report($e);

            return false;
        }
    }

}
