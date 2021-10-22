<?php

namespace Tests\Unit\Framework;

use App\UseCases\UserCreateInputBoundary;
use PHPUnit\Framework\TestCase;

class UserCreateInputBoundaryTest extends TestCase
{
    private $data = [
        'email' => 'jeanbarcellos@hotmail.com',
        'name' => 'Jean Barcellos',
    ];

    private function getInstance(): UserCreateInputBoundary
    {
        return new UserCreateInputBoundary($this->data['name'], $this->data['email']);
    }

    /*
     * Exemplo de Nomenclatura de Testes de unidade

     * ObjetoEmTeste_MetodoComportamentoEmTeste_ComportamentoEsperado
     *     •  Pedido_AdicionarPedidoItem_DeveIncrementarUnidadesSeItemJaExistente
     *     •  Estoque_RetirarItem_DeveEnviarEmailSeAbaixoDe10Unidades

     * MetodoEmTeste_EstadoEmTeste_ComportamentoEsperado
     *     •  AdicionarPedidoItem_ItemExisteCarrinho_DeveIncrementarUnidadesDoItem
     *     •  RetirarItemEstoque_EstoqueAbaixoDe10Unidades_DeveEnviarEmailDeAviso
     */
    public function test_construct_newInstance_instance()
    {
        // Arrange && Act
        $input = new UserCreateInputBoundary($this->data['name'], $this->data['email']);

        // Assert
        $this->assertInstanceOf(UserCreateInputBoundary::class, $input);
        $this->assertEquals($this->data['name'], $input->getName());
        $this->assertEquals($this->data['email'], $input->getEmail());
    }

    public function test_magicCall()
    {
        // Arrange
        $input = $this->getInstance();

        // Act && Assert
        $this->assertEquals($this->data['name'], $input->getName());
        $this->assertEquals($this->data['email'], $input->getEmail());
    }

    public function test_magicGet()
    {
        // Arrange
        $input = $this->getInstance();

        // Act && Assert
        $this->assertEquals($this->data['name'], $input->name);
        $this->assertEquals($this->data['email'], $input->email);
    }

    public function test_implementsArrayAccess()
    {
        // Arrange
        $actual = $this->getInstance();

        // Act && Assert
        $this->assertEquals($this->data['name'], $actual['name']);
        $this->assertEquals($this->data['email'], $actual['email']);
    }

    public function test_create()
    {
        // Arrange
        $actual = UserCreateInputBoundary::create($this->data);

        // Act && Assert
        $this->assertEquals($this->data['name'], $actual['name']);
        $this->assertEquals($this->data['email'], $actual['email']);
    }

    public function test_toArray()
    {
        // Arrange
        $input = $this->getInstance();

        // Act
        $actual = $input->toArray();

        // Assert
        $this->assertIsArray($actual);
    }

    public function test_getValues()
    {
        // Arrange
        $input = $this->getInstance();

        // Act
        $actual = $input->toArray();

        // Assert
        $this->assertIsArray($actual);
        $this->assertEquals($this->data['name'], $actual['name']);
        $this->assertEquals($this->data['email'], $actual['email']);
    }

    public function test_getValue()
    {
        // Arrange
        $input = $this->getInstance();

        // Act
        $actual = $input->getValue('email');

        // Assert
        $this->assertEquals($this->data['email'], $actual);
    }

}
