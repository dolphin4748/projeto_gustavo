<?php

namespace Unimar\Poo;

use Unimar\Poo\Produto;
use Unimar\Poo\Promocao;

class Loja {

    private array $estoque = [];

    public function adicionarJogo(Produto $produto): void{
        echo "item acionado ao estoque de produtos.\n";
        $this->estoque[] = $produto;
    }

    public function removerJogo(int $index): bool {

        if (array_key_exists($index, $this->estoque)) {
            //isso aqui é pra remover um item do array, essa função unset destroi var ou item de array
            echo "removendo {$this->estoque[$index]->getNome()} do estoque.\n";
            unset($this->estoque[$index]);
            $this->estoque = array_values($this->estoque);
            return true;
        }
        echo "Jogo não existe.\n";
        return false;
    }

    public function adicionarPromocao(int $index, float $desconto): bool{
        
        if (array_key_exists($index, $this->estoque)) {
            echo "adcionando uma promocao ao jogo {$this->estoque[$index]->getNome()}.\n";
            $produto = $this->estoque[$index];
            $this->estoque[$index] = new Promocao($produto->getVendedor(), $produto->getNome(), $produto->getQtd(), $produto->getValor(), $desconto);
            return true;
        }
        echo "Jogo não existe.\n";
        return false;
    }

    public function removerPromocao(int $index): bool{
        
        if (array_key_exists($index, $this->estoque)) {
            $produto = $this->estoque[$index];
            if ($produto->getTipo() == "promocao"){
                echo "removendo a promocao do jogo {$this->estoque[$index]->getNome()}.\n";
                $this->estoque[$index] = new Produto($produto->getVendedor(), $produto->getNome(), $produto->getQtd(), $produto->getValor());
                return true;
            }
            echo "Esse produto não esta em promoção.\n";
            return false;
        }
        echo "Jogo não existe.\n";
        return false;
    }

    public function listarProdutos(): void{
        foreach ($this->estoque as $index => $produto) {
            echo "[$index] ". $item->exibirDetalhes(). "\n";
        }
    }

    public function getEstoque(){
        return $this->estoque;
    }
}

