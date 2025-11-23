<?php

namespace Unimar\Poo;

use Unimar\Poo\Usuario;
use Unimar\Poo\Produto;
use Unimar\Poo\Loja;

class Vendedor extends Usuario
{
    //Função para adcionar algum item no estoque
    public function adcionarEstoque(Loja $loja, string $nomeJogo, int $qtd, float $preco) {
        $produto = new Produto($this, $nomeJogo, $qtd, $preco);

        $loja->adicionarJogo($produto);
    }

    public function adcionarPromocao(Loja $loja, int $index, float $desconto) {
        $loja->adicionarPromocao($index, $desconto);
    }

    //Função para remover algum item do estoque
    public function removerEstoque(Loja $loja, int $index) {
        $loja->removerJogo($index);       
    }

    public function removerPromocao(Loja $loja, int $index) {
        $loja->removerPromocao($index);       
    }

    //Função para exibir os itens no estoque
    public function listarEstoque(Loja $loja) {
        $estoque = array_filter($loja->getEstoque(), function($prod) {
            return $prod->getVendedor() === $this;
        });

        if (empty($estoque)){
            echo "\nnão existe nenhum item no estoque atual.\n";
        }else{
            echo "\nitens do estoque de produtos: \n";
            foreach ($estoque as $i => $item) {
                echo "[$i] ". $item->exibirDetalhes(). "\n";
            }
        }
    } 

    public function listarEstoquePromocao(Loja $loja){
        $estoque = array_filter($loja->getEstoque(), function($prod) {
            return $prod->getVendedor() == $this && $prod->getTipo() == "promocao";
        });

        if (empty($estoque)){
            echo "\nnão existe nenhum item em promoção no estoque atual.\n";
        }else{
            echo "\nitens do estoque de produtos: \n";
            foreach ($estoque as $i => $item) {
                echo "[$i] ". $item->exibirDetalhes(). "\n";
            }
        }
    }

    public function getEstoque(Loja $loja){
        $estoque = array_filter($loja->getEstoque(), function($prod) {
            return $prod->getVendedor() == $this;
        });

        return $estoque;
    }

    public function getTipo(): string{
        return "vendedor";
    }

}



