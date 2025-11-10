<?php

namespace Unimar\Poo;

use Unimar\Poo\Vendedor;

//CLASSE PRODUTO, PRIMEIROS PASSOS:
//============================================================================
//1.Criar a classe Produto
//2.Criar os atributos vendedor, nome do jogo, quantidade em estoque e preço
//3.Criar o construtor da classe Produto
//4.Criar os métodos getters para cada atributo
//5.Criar alguns objetos da classe Produto
//6.Exibir os atributos de cada objeto criado
//7.Criar um método para atualizar o estoque do produto
//8.Integrar essa classe com as outras classes do projeto
//============================================================================

//RESUMO:Fazer com que toda vez que o produto for comprado, o estoque diminua

class Produto{

    private Vendedor $vendedor;
    private string $nomeJogo;
    private int $qtd;
    private float $preco;

    public function __construct(Vendedor $vendedor, string $nomeJogo, int $qtd, float $preco) {
        $this->vendedor = $vendedor;
        $this->nomeJogo = $nomeJogo;
        $this->qtd = $qtd;
        $this->preco = $preco;
    }

    //Métodos getters para cada atributo
    public function getNomeJogo() {
        return $this->nomeJogo;
    }

    public function getQtd() {
        return $this->qtd;
    }

    public function getPreco() {
        return $this->preco;
    }

    //Método para checar o estoque do produto, como Vai funcionar
    //1. Recebe a quantidade vendida em um parametro
    //2. Verifica se a quantidade vendida é menor ou igual a quantidade no estoque
    //3. Se sim, retorna um True
    //4. Se nao, retorna false indicando que não tem estoque suficiente
    public function checarEstoque(int $quantidadeVendida) {
        if($quantidadeVendida <= $this->qtd) {
            return true; // Tem estoque suficiente
        } else {
            return false; // Não tem estoque suficiente
        }
    }

    //Método para atualizar o estoque do produto quando uma venda é realizada e como Vai funcionar
    //1. Recebe a quantidade vendida em um parametro
    //2. Usa o metodo checar estoque como condição para atualizar o estoque
    //3. Se sim, diminui a quantidade em estoque
    public function atualizarEstoque(int $quantidadeVendida) {
        if($this->checarEstoque($quantidadeVendida)) {
            $this->qtd -= $quantidadeVendida;
        }
    }

    //Função para exibir os atributos do produto
    public function exibirDetalhes() {
        return "Jogo: " . $this->nomeJogo . ", Estoque: " . $this->qtd . ", Preço: R$" . number_format($this->preco, 2, ',', '.'). "\n";
    }

    public function getVendedor(): Vendedor{
        return $this->vendedor;
    }
}




