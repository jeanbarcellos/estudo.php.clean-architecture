<?php

namespace Framework\Http\Exceptions;

use Framework\Http\Exceptions\HttpException;

class NotFoundHttpException extends HttpException
{
    protected $code = 404;
    protected $message = 'Not Found';
}
