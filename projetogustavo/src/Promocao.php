<?php

namespace Unimar\Poo;

class Promocao {

    protected float $desconto;

    public function __construct(float $desconto){
        $this->desconto = $desconto;
    }

    public function getDesconto(): float {
        return $this->desconto;
    }

    public function setDesconto(float $valor): void {
        $this->desconto = $valor;
    }

    //polimorfismo pros descontos
    public function aplicarDesconto(float $precoOriginal): float{
        return $precoOriginal - ($precoOriginal * ($this->desconto / 100));
    }
}

