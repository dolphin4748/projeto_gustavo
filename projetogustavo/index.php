<?php

require_once 'vendor/autoload.php';

use Unimar\Poo\Usuario;
use Unimar\Poo\Cliente;
use Unimar\Poo\Vendedor;
use Unimar\Poo\ADM;
use Unimar\Poo\Loja;

// instancia array para os usuarios e loja
$usuarios = [];
$loja = new Loja();

// vendedor pre-definido para que tenha algum estoque para o cliente
$usuarios[] = new Vendedor("222.222.222-22", "Vendedor", "Teste", "vendedor@gmail.com", "12345");
$usuarios[] = new Vendedor("333.333.333-33", "Vendedor", "Teste2", "vendedor2@gmail.com", "54321");
$usuarios[] = new Cliente("111.111.111-11", "cliente", "Teste", "cliente@gmail.com", "12345");
$usuarios[] = new ADM("444.444.444-44", "admin", "Teste", "adm@gmail.com", "12345");

// adicionando estoque
$usuarios[0]->adcionarEstoque($loja, "GTA V", 10, 150.00);
$usuarios[0]->adcionarEstoque($loja, "Minecraft", 5, 100.00);
$usuarios[0]->adcionarEstoque($loja, "The Witcher 3", 3, 200.00);

$usuarios[1]->adcionarEstoque($loja, "AVIÃOZINHO DO TRÁFICO 3", 10, 150.00);
$usuarios[1]->adcionarEstoque($loja, "mineirinho ultra adventure 2", 5, 100.00);
$usuarios[1]->adcionarEstoque($loja, "bad rats", 3, 200.00);

// Função para efetuar login ela recebe como parametros email e senha, se houver uma conta com os email e senha passados ela retornara uma classe cliente ou vendedor a depender da conta
function logar(array $usuarios, string $email, string $senha): Usuario|null{
    foreach($usuarios as $user){
        if ($user->getEmail() == $email && $user->getSenha() == $senha){
            echo "Login efetuado com sucesso";
            return $user;
        }
    }

    echo "Não foi possivel fazer login\n";
    
    return null;
}


// ====== MENU PARA CLIENTE ======
function menuCliente(Cliente $cliente, Loja $loja): bool
{
    $menuAberto = true;
    while ($menuAberto) {
        echo "\n===== MENU CLIENTE =====\n";
        echo "1. Listar estoque do vendedor\n";
        echo "2. Adicionar produto ao carrinho\n";
        echo "3. Remover produto do carrinho\n";
        echo "4. Listar carrinho\n";
        echo "5. Comprar carrinho\n";
        echo "6. Depositar dinheiro\n";
        echo "7. Mostrar saldo\n";
        echo "0. Logout\n";

        $opcao = readline("Escolha uma opção: ");

        switch ($opcao) {
            case 1:
                $loja->listarProdutos();
                break;

            case 2:
                $loja->listarProdutos();
                $index = (int)readline("Digite o índice do produto (0,1,2...): ");
                $qtd = (int)readline("Digite a quantidade: ");
                $estoque = $loja->getEstoque();

                if (isset($estoque[$index])) {
                    $cliente->adcionarCarrinho($estoque[$index], (int)$qtd);
                    echo "Produto adicionado ao carrinho!\n";
                } else {
                    echo "Produto inválido.\n";
                }
                break;
            
            case 3:
                $cliente->listarCarrinho();
                $index = (int)readline("Digite o índice do produto (0,1,2...): ");
                $cliente->removerCarrinho($index);
                break;
            case 4:
                $cliente->listarCarrinho();
                break;
            case 5:
                $cliente->comprarCarrinho();
                break;
            case 6:
                $valor = readline("Digite o valor a depositar: ");
                $cliente->getConta()->depositar((float)$valor);
                break;
            case 7:
                echo $cliente->getConta()->retornarDados();
                break;
            case 0:
                echo "Logout realizado!\n";
                $resposta = strtolower(trim(readline("Deseja encerrar o código? (s/n): ")));
                return $resposta !== 's';  // true = continuar, false = encerrar
            default:
                echo "Opção inválida!\n";
        }
    }
    return true;
}

// ====== MENU PARA VENDEDOR ======
function menuVendedor(Vendedor $vendedor, Loja $loja): bool
{
    $menuAberto = true;
    while ($menuAberto) {
        echo "\n===== MENU VENDEDOR =====\n";
        echo "1. Listar estoque\n";
        echo "2. Adicionar produto ao estoque\n";
        echo "3. Remover produto do estoque\n";
        echo "4. Adicionar promocao a um produto\n";
        echo "5. Remover promocao de um produto\n";
        echo "6. Mostrar saldo\n";
        echo "0. Logout\n";

        $opcao = readline("Escolha uma opção: ");

        switch ($opcao) {
            case 1:
                $vendedor->listarEstoque($loja);
                break;
            case 2:
                $nome = readline("Nome do jogo: ");
                $qtd = (int)readline("Quantidade: ");
                $preco = (float)readline("Preço: ");
                $vendedor->adcionarEstoque($loja, $nome, $qtd, $preco);
                break;
            case 3:
                $vendedor->listarEstoque($loja);
                $index = (int)readline("Digite o índice do produto para remover: ");
                $vendedor->removerEstoque($loja, $index);
                break;
            case 4:
                $vendedor->listarEstoque($loja);
                $index = (int)readline("Digite o índice do produto (0,1,2...): ");
                $desconto = (float)readline("Desconto(0 ate 100): ");
                $vendedor->adcionarPromocao($loja, $index, $desconto);
                break;
            case 5:
                $vendedor->listarEstoquePromocao($loja);
                $index = (int)readline("Digite o índice da promocao para remover: ");
                $vendedor->removerPromocao($loja, $index);
                break;
            case 6:
                echo $vendedor->getConta()->retornarDados();
                break;
            case 0:
                echo "Logout realizado!\n";
                $resposta = strtolower(trim(readline("Deseja encerrar o código? (s/n): ")));
                return $resposta !== 's'; // true = continuar, false = encerrar
            default:
                echo "Opção inválida!\n";
        }
    }
    return true;
}



$ativo = true;

while ($ativo) {
    echo "===== LOGIN =====\n";
    $email = readline("Email: ");
    $senha = readline("Senha: ");

    $usuario = logar($usuarios, $email, $senha);

    if ($usuario->getTipo() == "cliente") {
        $ativo = menuCliente($usuario, $loja);
    } elseif ($usuario->getTipo() == "vendedor") {
        $vendedores[$usuario->getEmail()] = $usuario; 
        $ativo = menuVendedor($usuario, $loja);
    } else {
        echo "Login inválido!\n";
    }
}

echo "Programa encerrado!\n";