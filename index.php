<?php

require_once("config.php");

//Carrega um usuário
//$user = new Usuario();
//$user->loadById(62);
//echo $user;

//Carega uma lista de usuários
//$lista = Usuario::getList();
//echo json_encode($lista);

//Carega uma lista de usuários buscando pelo email
//$search = Usuario::search("c");
//echo json_encode($search);

//Carrega um usuário pelo login
//$usuario = new Usuario();
//$usuario->login("velasco@hotelgiant.com", "123");
//echo $usuario;

//Criando um novo usuário
//$usuario = new Usuario("vel@vel.com", "123", "Veloso", "Vicente", "Admin", "r7.jpeg");
//$usuario->insert();
//echo $usuario;

//Alterar Usuário
$usuario = new Usuario();

$usuario->loadById(64);

$usuario->update("teste", "teste", "teste", "teste", "teste", "teste");

echo $usuario;

