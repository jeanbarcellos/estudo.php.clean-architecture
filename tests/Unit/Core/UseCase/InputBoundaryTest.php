<?php

namespace Tests\Unit\Framework;

// use App\UseCases\ModelInputBoundary;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use Tests\Unit\Core\UseCase\ModelInputBoundary;

class ModelInputBoundaryTest extends TestCase
{
    private $data = [
        'email' => 'jeanbarcellos@hotmail.com',
        'name' => 'Jean Barcellos',
    ];

    private function getInstance(): ModelInputBoundary
    {
        return new ModelInputBoundary($this->data['name'], $this->data['email']);
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
        $input = new ModelInputBoundary($this->data['name'], $this->data['email']);

        // Assert
        $this->assertInstanceOf(ModelInputBoundary::class, $input);
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

    public function test_magicCall_returnException()
    {
        $this->expectException(RuntimeException::class);

        // Arrange
        $input = $this->getInstance();

        // Act && Assert
        $input->getLastName();
    }

    public function test_magicGet()
    {
        // Arrange
        $input = $this->getInstance();

        // Act && Assert
        $this->assertEquals($this->data['name'], $input->name);
        $this->assertEquals($this->data['email'], $input->email);
    }

    public function test_magicGet_returnException()
    {
        $this->expectException(RuntimeException::class);

        // Arrange
        $input = $this->getInstance();

        // Act && Assert
        $eita = $input->lastName;
    }

    public function test_implementsArrayAccess_offsetExists()
    {
        // Arrange
        $actual = $this->getInstance();

        // Act && Assert
        $this->assertTrue(isset($actual['name']));
    }

    public function test_implementsArrayAccess_offsetGet()
    {
        // Arrange
        $actual = $this->getInstance();

        // Act && Assert
        $this->assertEquals($this->data['name'], $actual['name']);
        $this->assertEquals($this->data['email'], $actual['email']);
    }

    public function test_implementsArrayAccess_offsetSet()
    {
        $this->expectException(RuntimeException::class);

        // Arrange
        $actual = $this->getInstance();

        // Act
        $actual['name'] = 'teste';
    }

    public function test_implementsArrayAccess_offsetUnset()
    {
        $this->expectException(RuntimeException::class);

        // Arrange
        $actual = $this->getInstance();

        // Act
        unset($actual['name']);
    }

    public function test_create()
    {
        // Arrange
        $actual = ModelInputBoundary::create($this->data);

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
        $actual = $input->getValues();

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
