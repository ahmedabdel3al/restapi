<?php

namespace App\Exceptions;

use App\Traits\Responser;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use Responser;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($exception, $request);
        }
        if ($exception instanceof ModelNotFoundException) {
            return $this->errorMassage('this model is not identifier ', 404);
        }
        if ($exception instanceof AuthenticationException) {
            return $this->unauthenticated($request, $exception);
        }
        if ($exception instanceof AuthorizationException) {
             return $this->errorMassage($exception->getMessage(),403);
        }
       if ($exception instanceof notFoundHttpException) {
            return $this->errorMassage('this url can not found ',404);
        }
        if ($exception instanceof methodNotAllowedHttpException) {
            return $this->errorMassage('this method is not for the request in not vaild ',404);
        }
        if ($exception instanceof httpException) {
            return $this->errorMassage($exception->getMessage(),$exception->getStatusCode());
        }
        if ($exception instanceof QueryException) {
           $code = $exception->errorInfo[1];
           if($code == 1451){
               return $this->errorMassage('connot remove this resocouse directly ', 409);
           }
            $code = $exception->getCode();
          if($code ==2002){
              return $this->errorMassage('Unspecifed Exception try later ', 500);
          }
        }

        return parent::render($request, $exception);
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();
        return $this->errorMassage($errors, 422);

    }
}
