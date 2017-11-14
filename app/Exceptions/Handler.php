<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\BadRequestHttpException) {
            return response()->json(['message' => 'token missing.'], 401);
        }

        if ($e instanceof \Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException) {
            // TODO: Maybe writing our own middleware for this would be better
            // than trying to distinguish between them based only upon strings.
            if ($e->getMessage() === 'Token has expired') {
                // This case must be distinguished because our front-end runs a
                // "refresh-as-necessary" approach using expiration as a trigger
                return response()->json(['message' => 'token has expired.'], 401);
            } else {
                return response()->json(['message' => 'invalid token.'], 401);
            }
        }

        return parent::render($request, $e);
    }
}
