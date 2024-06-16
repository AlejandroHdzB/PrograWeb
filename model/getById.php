<?php
require_once('../model/conexion.php');
require_once('../model/ORM.php');
require_once('../model/producto.php');

if (isset($_GET['id'])) {
    $db = new Database();
    $cnn = $db->getConnection();
    $productoModelo = new Productos($cnn);
    $producto = $productoModelo->getById($_GET['id']);
    echo json_encode($producto);
}
?>
