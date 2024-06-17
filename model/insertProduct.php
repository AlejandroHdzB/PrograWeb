<?php
require_once('conexion.php');
require_once('ORM.php');
require_once('Producto.php');

$db = new Database();

$encontrado = $db->verificarDriver();

if ($encontrado) {
    $cnn = $db->getConnection();
    $productoModelo = new Productos($cnn);
    $insert = [];
    // Verificar si los datos fueron enviados mediante POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Acceder a los datos recibidos

        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $detalles = $_POST['detalles'];

        $vacioId = validarNumeros($precio);
        $vacioNombre = validarNumeros($cantidad);
        $vacioPrecio = validarNumeros($precio);
        $vacioCantidad = validarNumeros($cantidad);

        if ($vacioId && $vacioNombre && $vacioPrecio && $vacioCantidad) {

            $valPrecio = validarNumeros($precio);
            $valCantidad = validarNumeros($cantidad);
            if ($valPrecio && $valCantidad) {
                $insert['nombre'] = $nombre;
                $insert['precio'] = $precio;
                $insert['cantidad'] = $cantidad;
                $insert['detalles'] = $detalles;
                if ($productoModelo->insert($insert)) {
                    echo "Insercion completa completa";
                } else {
                    echo "Insercion no concluida";
                }
            } else {
                echo "Inconsistencia en tipo de datos.";
            }
        } else {
            echo "Algunos datos son vacios";
        }
    } else {
        echo "Error: La solicitud debe ser mediante POST";
    }
}

function esVacio($dato)
{
    $bnd = true;
    if ($dato === null || $dato === '' || !isset($dato)) {
        $bnd = false;
    }


    if (is_string($dato) && trim($dato) === '') {
        $bnd = false;
    }

    return $bnd;
}

function validarNumeros($numero)
{
    $bnd = true;
    if ($numero < 0) {
        $bnd = false;
    }
    return $bnd;
}
