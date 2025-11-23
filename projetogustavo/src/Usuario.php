<?php

namespace Unimar\Poo;

use Unimar\Poo\Cliente;
use Unimar\Poo\Vendedor;
use Unimar\Poo\ContaCorrente;

abstract class Usuario
{

    private string $cpf;
    private string $nome;
    private string $sobrenome;
    private string $email;
    private string $senha;
    private ContaCorrente $conta;

    public function __construct(string $cpf, string $nome, string $sobrenome, string $email, string $senha){
        $this->setCpf($cpf);
        $this->setNomeCompleto($nome, $sobrenome);
        $this->setEmail($email);
        $this->senha = $senha;
        $this->conta = new ContaCorrente($this, 0);
    }

    public function logout(){
        echo "Usuario deslogado.\n";
        return null;
    } 

    public function setNomeCompleto(string $nome, string $sobrenome){
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
    }
    public function getNomeCompleto(): string{
        return $this->nome . " " . $this->sobrenome;
    }

    public function setCpf(string $cpf){
        $this->cpf = $cpf;
    }
    public function getCpf(): string{
        return $this->cpf;
    }

    protected function setEmail(string $email){
        $this->email = $email;
    }
    public function getEmail(): string{
        return $this->email;
    }
    
    protected function setSenha(string $senha){
        $this->senha = $senha;
    }
    public function getSenha(): string{
        return $this->senha;
    }

    public function getConta(): ContaCorrente{
        return $this->conta;
    }
    
    abstract public function getTipo(): string;

}



