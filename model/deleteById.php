<?php
require_once('conexion.php');
require_once('ORM.php');
require_once('producto.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $id = $_GET['id'];

    $db = new Database();
    $cnn = $db->getConnection();
    $productoModelo = new Productos($cnn);

    // Verificar si el producto existe
    $producto = $productoModelo->getById($id);
    if (!$producto) {
        // El producto no existe, devuelve un mensaje de error
        header("HTTP/1.1 404 Not Found");
        echo json_encode(array("message" => "El producto no existe"));
        exit();
    }

    // Eliminar el producto
    $productoModelo->deleteById($id);
    echo json_encode(array("message" => "Producto eliminado exitosamente"));
    exit();
}
?>
