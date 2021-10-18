<?php

namespace Core\Iterator;

use Core\Iterator\InputData;
use Core\Iterator\OutputData;

abstract class UseCase
{
    abstract public function handle(InputData $inputData): OutputData;
}
