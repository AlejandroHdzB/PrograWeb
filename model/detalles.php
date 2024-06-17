<?php
require_once('../model/conexion.php');
require_once('../model/ORM.php');
require_once('../model/producto.php');

$respuesta = array();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $db = new Database();
    $encontrado = $db->verificarDriver();

    if($encontrado){
        $cnn = $db->getConnection();
        $productoModelo = new Productos($cnn);
        $producto = $productoModelo->getById($id);
        if($producto){
            $respuesta = array(
                'estado' => 'ok',
                'data' => $producto
            );
        } else {
            $respuesta = array(
                'estado' => 'error',
                'mensaje' => 'No se encontró el producto'
            );
        }
    } else {
        $respuesta = array(
            'estado' => 'error',
            'mensaje' => 'Error al conectar con la base de datos'
        );
    }
}else {
    $respuesta = array(
        'estado' => 'error',
        'mensaje' => 'ID no proporcionado'
    );
}
echo json_encode($respuesta);
?>