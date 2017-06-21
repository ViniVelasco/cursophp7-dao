<?php

require_once("config.php");


$user = new Usuario();
$user->loadById(62);

echo $user;

//$usuarios = $sql->select("SELECT * FROM users");

//echo json_encode($usuarios);

