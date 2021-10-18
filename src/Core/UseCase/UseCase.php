<?php

namespace Core\UseCase;

use Core\UseCase\InputData;
use Core\UseCase\OutputData;

abstract class UseCase
{
    abstract public function handle(InputData $inputData): OutputData;
}
