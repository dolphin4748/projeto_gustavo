<?php

namespace Unimar\Poo;

use Unimar\Poo\Vendedor;

class Produto{

    private Vendedor $vendedor;
    private string $nome;
    private int $qtd;
    private float $valor;

    public function __construct(Vendedor $vendedor, string $nome, int $qtd, float $valor) {
        $this->vendedor = $vendedor;
        $this->nome = $nome;
        $this->qtd = $qtd;
        $this->valor = $valor;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getQtd(): int {
        return $this->qtd;
    }

    public function getValor(): float {
        return $this->valor;
    }

    public function getVendedor(): Vendedor {
        return $this->vendedor;
    }

    public function setVendedor(Vendedor $vendedor): void {
        $this->vendedor = $vendedor;
    }


    // public function setPromocao(float $desconto): void{
    //     $this->temPromocao = true;
    //     $this->desconto = $desconto;
    // }

    public function removerPromocao(): void {
        $this->temPromocao = false;
        $this->desconto = 0;
    }

    public function atualizarEstoque(int $qtd): void {
        if($this->checarEstoque($qtd)) {
            $this->qtd -= $qtd;
        }
    }

    public function checarEstoque(int $qtd): bool {
        if($qtd <= $this->qtd) {
            return true; // Tem estoque suficiente
        } else {
            return false; // Não tem estoque suficiente
        }
    }

    //aq é provavelmente uma função pra usar o polimorfismo q ele pediu
    public function getPreco(): float {
        return $this->valor;
    }

    public function exibirDetalhes(): string {
        return "Jogo: " . $this->nome . ", Estoque: " . $this->qtd . ", Preço: R$" . number_format($this->getPreco(), 2, ',', '.');
    }

    public function getTipo(): string {
        return "produto";
    }
}

