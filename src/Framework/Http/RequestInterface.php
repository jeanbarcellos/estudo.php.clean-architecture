<?php

namespace Framework\Http;

interface RequestInterface
{
    public function getMethod();

    public function getPath();

    public function body($key = null, $default = null);

    public function query($key = null, $default = null);

    public function file($key = null, $default = null);

}
