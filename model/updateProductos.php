<?php
require_once('conexion.php');
require_once('ORM.php');
require_once('Producto.php');

$db = new Database();

$encontrado = $db->verificarDriver();

if($encontrado){
    $cnn = $db->getConnection();
    $productoModelo = new Productos($cnn);
    $actualizar = [];
        // Verificar si los datos fueron enviados mediante POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Acceder a los datos recibidos
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];

        $valPrecio=validarNumeros($precio); 
        $valCantidad=validarNumeros($cantidad);
        if($valPrecio && $valCantidad){
            $actualizar['precio'] = $precio;
            $actualizar['cantidad'] = $cantidad;
            if($productoModelo->updateById($id,$actualizar)){
                echo "Actualizacion completa";
            }else{
                echo "Actualizacion no concluida";
            }

        }else{
            echo "Inconsistencia en tipo de datos.";
        }
    
    } else {
        echo "Error: La solicitud debe ser mediante POST";
    }
    

}

function validarNumeros($numero){
    $bnd = true;
    if($numero < 0){
        $bnd = false;
    }
    return $bnd;
    
}

?>