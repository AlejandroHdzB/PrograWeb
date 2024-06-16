<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resources/icono.ico" type="image/x-icon">
    <link rel="shortcut icon" href="resources/icono.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="./../resources/index.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Agregar producto</title>
</head>
<body>
    <div class="jumbotron header-img">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="display-1">Home</h1>
                    <p>Proyecto de programacion web</p>
                </div>
                <nav class="nav col justify-content-end">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <a class="nav-link" href="formLogin.php">Iniciar sesión</a>
                    <a class="nav-link" href="">Registrar</a>
                </nav>
            </div>           
        </div>
    </div>

    

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $detalles = $_POST['detalles'];

        $errores = [];


        // $errores[] = "El nombre es obligatorio.";
        // $errores[] = "El nombre no puede exceder los 50 caracteres.";
        // $errores[] = "El nombre solo puede contener letras de la 'a' a la 'z', incluyendo la ñ, acentos y caracteres especiales como espacios en blanco, guiones, comas, punto y apostrofes.";
        // $errores[] = "El precio es obligatorio.";
        // $errores[] = "El precio debe ser un número mayor a cero.";
        // $errores[] = "La cantidad es obligatoria.";
        // $errores[] = "La cantidad debe ser un valor numérico.";
        // $errores[] = "La cantidad debe ser un número positivo.";
        // $errores[] = "La cantidad no puede ser tan grande.";
        // $errores[] = "Los detalles son obligatorios.";
        // $errores[] = "Los detalles no pueden exceder los 500 caracteres.";



        // ------------------------------------- nombre -------------------------------------
        $nombre = trim($_POST['nombre']);
        if (empty($nombre)) {
            $errores[] = "El nombre es obligatorio.";

        } elseif (strlen($nombre) > 50) {
            $errores[] = "El nombre no puede exceder los 50 caracteres.";

        } elseif (!preg_match('/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s\-\'.,]+$/', $nombre)) {
            $errores[] = "El nombre solo puede contener letras de la 'a' a la 'z', incluyendo la ñ, acentos y caracteres especiales como espacios en blanco, guiones, comas, punto y apostrofes.";
        }

        // ------------------------------------- precio -------------------------------------
        $precio = trim($_POST['precio']);
        if (empty($precio)) {
            $errores[] = "El precio es obligatorio.";

        } elseif (!is_numeric($precio) || floatval($precio) <= 0) {
            $errores[] = "El precio debe ser un número mayor a cero.";
        }

        // ------------------------------------- cantidad -------------------------------------
        $cantidad = trim($_POST['cantidad']);
        if (empty($cantidad)) {
            $errores[] = "La cantidad es obligatoria.";

        } else {
            // Verificar si es un número
            if (!is_numeric($cantidad)) {
                $errores[] = "La cantidad debe ser un valor numérico.";
            }
            // Verificar si es positiva
            if (intval($cantidad) <= 0) {
                $errores[] = "La cantidad debe ser un número positivo.";
            }
            // Verificar la longitud máxima de 11 dígitos
            if (strlen($cantidad) > 11) {
                $errores[] = "La cantidad no puede ser tan grande.";
            }
            
        }

        // ------------------------------------- detalles -------------------------------------
        $detalles = trim($_POST['detalles']);
        if (empty($detalles)) {
            $errores[] = "Los detalles son obligatorios.";

        } elseif (strlen($detalles) > 500) {
            $errores[] = "Los detalles no pueden exceder los 500 caracteres.";
        }



        // echo "Nombre: " . htmlspecialchars($nombre) . "<br>";
        // echo "Precio: " . htmlspecialchars($precio) . "<br>";
        // echo "Cantidad: " . htmlspecialchars($cantidad) . "<br>";
        // echo "Detalles: " . htmlspecialchars($detalles) . "<br>";

        if (!empty($errores)) {
            echo "<div class='container mt-5'>";

            foreach ($errores as $error) {

                echo "<div class='alert alert-danger' role='alert'> " . htmlspecialchars($error) . "</div>";
            }

            echo "</div>";

        } else {

            require_once('./../model/conexion.php');
            require_once('./../model/ORM.php');
            require_once('./../model/producto.php');


            $db = new Database();

            $encontrado = $db->verificarDriver();

            if( $encontrado ) {

                
                $cnn = $db->getConnection();
                $productoModelo = new Productos($cnn);
                
                $insertar=[];
                
                $insertar['nombre'] = '"' . $nombre . '"';
                $insertar['precio'] = $precio;
                $insertar['cantidad'] = $cantidad;
                $insertar['detalles'] = '"' . $detalles . '"';
                
                if($productoModelo->insert($insertar)) {

                    echo '<div class="container mt-5">';
                    echo '<div class="alert alert-success" role="alert">';
                    echo '<h2 class="alert-heading">El producto fue ingresado</h2>';
                    echo '<ul>';
                    echo '<li><strong>Nombre:</strong> ' . $nombre . '</li>';
                    echo '<li><strong>Precio:</strong> ' . $precio .'</li>';
                    echo '<li><strong>Cantidad:</strong> ' . $cantidad . '</li>';
                    echo '<li><strong>Descripción:</strong> ' . $detalles . '</li>';
                    echo '</ul>';
                    echo '<button type="button" class="btn btn-primary">Aceptar</button>';
                    echo '</div>';
                    echo '</div>';

                } else {
                    echo "<div class='alert alert-danger' role='alert'>Ocurrio un error inesperado :c </div>";
                }
                        
            }
        
        }
    } else {
        echo "Método no permitido.";
    }
    ?>
    

</body>
</html>