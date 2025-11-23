<?php

namespace Unimar\Poo;

class Loja {

    private array $estoque = [];

    public function adicionarJogo(Produto $produto): void{
        echo "item acionado ao estoque de produtos.\n";
        $this->estoque[] = $produto;
    }

    public function removerJogo(int $index): bool {

        if (array_key_exists($index, $usuarios)) {
            //isso aqui é pra remover um item do array, essa função unset destroi var ou item de array
            echo "removendo {$this->estoque[$index]->getNomeJogo()} do estoque.\n";
            unset($this->estoque[$index]);
            $this->estoque = array_values($this->estoque);
            return true;
        }
        echo "Jogo não existe.\n";
        return false;
    }

    public function adicionarPromocao(int $index, float $desconto): bool{
        
        if (array_key_exists($index, $this->estoque)) {
            $estoque[$index]->setPromocao($desconto);
            return true;
        }
        return false;
    }

    public function removerPromocao(string $nome): bool{
        
        if (array_key_exists($index, $this->estoque)) {
            $estoque[$index]->removerPromocao();
            return true;
        }
        return false;
    }

    public function listarProdutos(): void{
        foreach ($this->estoque as $index => $produto) {
            echo "\n## ";
            echo "[{$index}] ";
            echo "Jogo: {$produto->getNome()}";
            echo "Estoque: {$produto->getQtd()}";
            echo "Preço final: R$ " . number_format($produto->getPreco(), 2) . "\n";
            echo "-----------------------\n";
        }
    }

    public function getEstoque(){
        return $this->estoque;
    }
}

