<?php

namespace Unimar\Poo;

use Unimar\Poo\Usuario;

class ADM extends Usuario{

    public function adcionarUsuario(array $usuarios, Usuario $usuario): array{
        // recebe uma lista de usuarios(a array que esta no index) e atribui o novo usuario e rotorna lista alterada
        $usuarios[] = $usuario;
        return $usuarios;
    }

    public function removerUsuario(array $usuarios, int $index): array{
        // checa se o indice existe se não da um echo e retorna a lista como era se sim remove usuario e retorna lista alterada
        if (array_key_exists($index, $usuarios)) {
            echo "removendo {$usuarios[$index]->getNomeCompleto()}.\n";
            unset($usuarios[$index]);
            $usuarios = array_values($usuarios);
            return $usuarios;
        }
        echo "Usuario não existe.\n";
        return $usuarios;
    }

    public function listarUsuarios(array $usuarios){
        foreach ($usuarios as $index => $user) {
            echo "\n## ";
            echo "[{$index}] ";
            echo "Nome: {$user->getCpf()}";
            echo "Nome: {$user->getNomeCompleto()}";
            echo "Nome: {$user->getEmail()}";
            echo " ##\n";
            echo "-----------------------";
        }
    }

    public function getTipo(): string{
        return "adm";
    }
}