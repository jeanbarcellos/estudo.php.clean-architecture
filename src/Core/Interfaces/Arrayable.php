<?php

namespace Core\Interfaces;

interface Arrayable
{
    /**
     * Obter array a partir do objeto.
     *
     * @return array
     */
    public function toArray(): array;
}
