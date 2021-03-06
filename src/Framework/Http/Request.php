<?php

namespace Framework\Http;

use Framework\Http\RequestInterface;
use Framework\Utils\ArrayUtil;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest implements RequestInterface
{
    public static function capture(): Request
    {
        $request = static::createFromGlobals();

        $request->request = $request->getRequestReal();

        return $request;
    }

    private function getRequestReal(): ParameterBag
    {
        if (0 === strpos($this->headers->get('Content-Type'), 'application/json')) {
            $jsonDecode = (array) json_decode($this->getContent(), true);

            return new ParameterBag($jsonDecode);
        }

        return in_array($this->getRealMethod(), ['GET', 'HEAD']) ? $this->query : $this->request;
    }

    public function body($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->request->all();
        }

        return ArrayUtil::get($this->request->all(), $key, $default);
    }

    public function query($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->query->all();
        }

        return ArrayUtil::get($this->query->all(), $key, $default);
    }

    public function file($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->files->all();
        }

        return ArrayUtil::get($this->files->all(), $key, $default);
    }

    public function getPath(): string
    {
        $path = trim($this->getPathInfo(), '/');

        return $path === '' ? '/' : $path;
    }
}
