<?php

namespace Unimar\Poo;

use Unimar\Poo\Promocao;

class Produto extends Promocao {

    private string $vendedor;
    private string $nome;
    private int $qtd;
    private float $valor;
    private bool $temPromocao = false;

    public function __construct(string $vendedor, string $nome, int $qtd, float $valor){
    
        parent::__construct(0); // não tem promoção inicialmente
        $this->vendedor = $vendedor;
        $this->nome = $nome;
        $this->qtd = $qtd;
        $this->valor = $valor;
    }

    public function getNome(): string{
        return $this->nome;
    }

    public function getQtd(): int{
        return $this->qtd;
    }

    public function getValor(): float{
        return $this->valor;
    }

    public function getVendedor(): string {
        return $this->vendedor;
    }

    public function setVendedor(string $vendedor): void{
        $this->vendedor = $vendedor;
    }


    public function setPromocao(float $desconto): void{
        $this->temPromocao = true;
        $this->desconto = $desconto;
    }

    public function removerPromocao(): void{
        $this->temPromocao = false;
        $this->desconto = 0;
    }

    public function atualizarEstoque(int $novoValor): void{
        $this->qtd = $novoValor;
    }

    public function checarEstoque(): bool{
        return $this->qtd > 0;
    }

    //aq é provavelmente uma função pra usar o polimorfismo q ele pediu
    public function getPrecoFinal(): float{
        if (!$this->temPromocao) {
            return $this->valor;
        }

        return parent::aplicarDesconto($this->valor);
    }
}

