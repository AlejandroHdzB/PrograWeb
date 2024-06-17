<?php
// Verificar si se recibió un ID de producto válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $productId = $_GET['id'];

    // Realizar la conexión a la base de datos y la eliminación del producto
    require_once('../model/conexion.php'); // Asegúrate de que la ruta sea correcta
    require_once('../model/ORM.php'); // Asegúrate de que la ruta sea correcta

    $db = new Database();
    $encontrado = $db->verificarDriver();

    if ($encontrado) {
        $cnn = $db->getConnection();
        $productoModelo = new ORM('id', 'productos', $cnn); // Asegúrate de que los parámetros sean correctos

        // Intentar eliminar el producto
        try {
            $productoModelo->deleteById($productId);
            // Si la eliminación se realiza con éxito, devuelve una respuesta JSON
            http_response_code(200);
            echo json_encode(array('message' => 'Producto eliminado exitosamente.'));
        } catch (Exception $e) {
            // Si ocurre un error durante la eliminación, devuelve un mensaje de error
            http_response_code(500);
            echo json_encode(array('message' => 'No se pudo eliminar el producto. Error: ' . $e->getMessage()));
        }
    } else {
        // Si no se encuentra la base de datos, devuelve un mensaje de error
        http_response_code(500);
        echo json_encode(array('message' => 'No se pudo conectar a la base de datos.'));
    }
} else {
    // Si no se proporciona un ID de producto válido, devuelve un mensaje de error
    http_response_code(400);
    echo json_encode(array('message' => 'No se proporcionó un ID de producto válido.'));
}
?>
