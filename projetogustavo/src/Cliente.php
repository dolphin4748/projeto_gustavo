<?php

namespace Unimar\Poo;

use Unimar\Poo\Usuario;
use Unimar\Poo\Produto;
use Unimar\Poo\ContaCorrente;

class Cliente extends Usuario
{
    private $carrinho = [];

    //Função para adcionar algum item no carrinho
    public function adcionarCarrinho(Produto $produto, int $qtd): void{
        echo "item acionado ao carrinho de compras. \n";
        $this->carrinho[] = [
            "produto" => $produto,
            "qtd" => $qtd
        ];
    }

    //Função para remover algum item do carrinho
    public function removerCarrinho(int $index) {
        echo "removendo ". $this->carrinho[$index]["produto"]->getNomeJogo(). " do carrinho.\n";
        unset($this->carrinho[$index]);
        $this->carrinho = array_values($this->carrinho);        
    }

    //Método para efetuar a compra dos itens dentro do carrinho, como Vai funcionar
    //1. Soma o  preco de todos os produtos em uma variavel total
    //2. Verifica se algum dos produtos não possui estoque para poder efetuar a compra, tendo a variavel vericar = true ao fim do loop se todos os itens estivem em estoque
    //3. se vericar == true, é checado se o usuario possui saldo para efetuar a compra  
    //4. Se sim, é feito a transferencia, atualizado o estoque do produto e por fim é removido do carrinho, isso para cada item da array carrinho
    //5. se não possuir saldo ou verificar == false nenhuma compra é efetuada e é printada na tela o motivo do erro
    public function comprarCarrinho(): bool {
        if (empty($this->carrinho)) {
            echo "Carrinho esta vazio, não há nada para comprar.\n";
            return false;
        }

        $total = array_reduce($this->carrinho, fn($carry, $item) => $carry + $item["produto"]->getPreco() * $item["qtd"], 0.0);
        $verificar = true;

        foreach ($this->carrinho as $item){
            $verificar = $item["produto"]->checarEstoque($item["qtd"]);
            if ($verificar == false){
                break;
            }
        }
        if ($verificar){

            echo "total a ser gasto: R$". number_format($total, 2, ',', '.'). "\n";
            if ($this->getConta()->temSaldoDisponivel($total)){ //checa se a transferencia deu certo, porem ainda não existe nenhuma conta de pagamento
                foreach ($this->carrinho as $item) {
                    $this->getConta()->transferir($item["produto"]->getVendedor()->getConta(), $item["produto"]->getPreco() * $item["qtd"]);
                    $item["produto"]->atualizarEstoque($item["qtd"]);
                    $this->removerCarrinho(0);
                }
                return true;
            }else{
                echo "saldo insuficiente para realizar a compra.\n";
                return false;
            }
        }else{
            echo "algum dos item pesentes no carrinho não possui estoque para efetuar a compra.\n";
            return false;
        }
    }

    //Função para exibir os itens no carrinho
    public function listarCarrinho() {

        if (empty($this->carrinho)){
            echo "\nnão existe nenhum item no carrinho atual.\n";
        }else{
            echo "\nitens do carrinho de compras: \n";
            foreach ($this->carrinho as $id => $item) {
                echo "[$id] ". $item["produto"]->exibirDetalhes(). " | qtd: ". $item["qtd"]. "\n";
            }
        }
    } 

    public function getTipo(): string{
        return "cliente";
    }
}



