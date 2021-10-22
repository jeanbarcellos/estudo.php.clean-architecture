```php
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
        $input = new Container();

        // Assert
        $this->assertInstanceOf(Container::class, $input);
    }

```