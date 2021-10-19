<?php

interface Validable
{
    /**
     * Retorna true se, e somente se, os dados atenderem aos requisitos de validação.
     *
     * @return bool
     */
    public function isValid(): bool;

    /**
     * Retorna um array de mensagens que explica por que a chamada isValid() mais recente retornou false.
     *
     * Caso não tenha havido erro, retornará um array vazio.
     *
     * @return array
     */
    public function getErrors(): array;

    /**
     * Validar e lançar exceção em caso de erro.
     *
     * @return void
     */
    public function validate(): void;
}
