<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Auth\AuthenticationException;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {   
        if($exception instanceof ValidationException){
            return $this->convertValidationExceptionToResponse($exception, $request);
        }

        if($exception instanceof ModelNotFoundException){
            
            $modelName = strtolower(class_basename($exception->getModel()));
            return response()->json(['erros'=>'Does not exist any '.$modelName.' with the spesific id.', 'code'=>404], 404);
        }

        if($exception instanceof NotFoundHttpException){
            
            return response()->json(['erros'=>'The specified URL cannot be found', 'code'=>404], 404);
        }

        if($exception instanceof AuthorizationException){
            
            return response()->json(['erros'=>$exception->getMessage(), 'code'=>403], 403);
        }

        if($exception instanceof AuthenticationException){
            
            return response()->json(['error' => 'Unauthenticated.', 'code' => 401], 401);
        }


        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception){
        return response()->json(['error' => 'Unauthenticated.', 'code' => 401], 401);
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {


        $errors = $e->validator->errors()->getMessages();

        return response()->json(['erros'=>$errors, 'code'=>422], 422);

    }
        

      
}
