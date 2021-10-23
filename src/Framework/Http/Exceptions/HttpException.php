<?php

namespace Framework\Http\Exceptions;

use RuntimeException;
use Throwable;

class HttpException extends RuntimeException
{
    protected $code = 400;
    protected $message = 'Bad Request';
}
