<?php
require_once('../model/conexion.php');
require_once('../model/ORM.php');
require_once('../model/producto.php');
require_once('../model/usuario.php');

$db = new Database();
$encontrado = $db->verificarDriver();
$productos = [];


if ($encontrado) {
    $cnn = $db->getConnection();
    $usuarioModelo = new Usuarios($cnn);
    $nombreAdmin = $usuarioModelo->getNombreAdmin(); 
    $usuarios = $usuarioModelo->getAll();
}

if ($encontrado) {
    $cnn = $db->getConnection();
    $productoModelo = new Productos($cnn);
    $productos = $productoModelo->getAll();
}


?>