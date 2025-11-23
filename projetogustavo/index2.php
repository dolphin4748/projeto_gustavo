<?php

require_once 'vendor/autoload.php';

use Unimar\Poo\Usuario;
use Unimar\Poo\Cliente;
use Unimar\Poo\Vendedor;
use Unimar\Poo\ADM;

$lista = [];

$adm = new ADM("111.111.111-44", "adm", "teste", "adm@gamil.com", "12345");

$lista[] = new Cliente("111.111.111-11", "clinte", "teste", "cliente@gamil.com", "12345");
$lista[] = new Cliente("111.111.111-22", "clinte2", "teste", "cliente@gamil.com", "12345");
$lista[] = new Cliente("111.111.111-33", "clinte3", "teste", "cliente@gamil.com", "12345");

$adm->listarUsuarios($lista);

$lista = $adm->adcionarUsuario($lista, new Cliente("111.111.111-55", "clinte4", "teste", "cliente@gamil.com", "12345"));

$adm->listarUsuarios($lista);

$lista = $adm->removerUsuario($lista, 0);

$adm->listarUsuarios($lista);