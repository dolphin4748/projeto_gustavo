<?php

namespace Unimar\Poo;

use Unimar\Poo\Produto;

class Promocao extends Produto{

    protected float $desconto;

    public function __construct(Vendedor $vendedor, string $nome, int $qtd, float $valor, float $desconto) {
        parent::__construct($vendedor, $nome, $qtd, $valor);
        $this->setDesconto($desconto);
    }

    public function getDesconto(): float {
        return $this->desconto;
    }

    private function setDesconto(float $valor): void {
        $this->desconto = $valor;
    }

    public function exibirDetalhes(): string {
        return "Jogo: " . $this->getNome() . ", Estoque: " . $this->getQtd() . ", Preço: R$" . number_format($this->getPreco(), 2, ',', '.'). ", Desconto: ". number_format($this->getDesconto(), 2, ',', '.'). "%";
    }

    //polimorfismo pros descontos
    public function getPreco(): float{
        $valor = parent::getValor();
        return $valor - ($valor * ($this->desconto / 100));
    }

    public function getTipo(): string {
        return "promocao";
    }
}

