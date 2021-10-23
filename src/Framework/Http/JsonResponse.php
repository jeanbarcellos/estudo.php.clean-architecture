<?php

namespace Framework\Http;

use Framework\Http\ResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse as SymfonyResponse;

class JsonResponse extends SymfonyResponse implements ResponseInterface
{

}
