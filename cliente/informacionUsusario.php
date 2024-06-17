<?php
require_once('../model/GetAll.php');
$_SESSION["usr"] = 'pedro1';
?>
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
    <link href="../resources/styles.css" rel="stylesheet">

    <link rel="icon" href="../resources/img/icono.ico">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Informacion del usuario</title>
</head>
<body>

    <?php
        require_once('./../model/conexion.php');
        require_once('./../model/ORM.php');
        require_once('./../model/producto.php');
        require_once('./../model/usuario.php');
    
        $nombre = '-';
        $apellido = '-';
        $user = '-';
        $direccion = '-';
        $telefono = '-';
        $rol = '-';
        

        $user = $_SESSION["usr"];

        $db = new Database();

        $encontrado = $db->verificarDriver();

        if($encontrado){
            $cnn = $db->getConnection();
            $usuariosModelo = new Usuarios($cnn);
            $userData = $usuariosModelo->getInfoByUser($user);

            $nombre = $userData['nombre'];
            $apellido = $userData['apellidos'];
            $direccion = $userData['direccion'];
            $telefono = $userData['telefono'];
            $rol = $userData['rol'];

            if( $direccion == '' ) $direccion = 'No Asignado';
            if( $telefono == '' ) $telefono = 'No Asignado';
            if( $rol == '' ) $rol = 'No Asignado';

        }

    ?>

    <nav class="navbar navbar-expand-lg navbar-dark style-nav">
        <a class="navbar-brand style-link" href="#" style="font-size: 40px;">
            <img src="../resources/img/icono.ico" alt="Logo">    
            <strong>Autopartes de Camiones</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>Bienvenido: <?php echo $nombre . " "; echo $apellido; ?></strong> 
                    </a>
                    <ul class="style-drop-it:hover style-dropdown dropdown-menu dropdown-menu-end" data-bs-toggle="dropdown" data-bs-display="static" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="informacionUsusario.php">Informacion del usuario</a></li>
                        <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                    </ul>
                </li> 
            </ul>
        </div>

    </nav>
    
    <div class="container mt-5">
        <div class="row">
            <!-- Parte Izquierda -->
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M13.468 12.37C12.758 11.226 11.383 10 8 10s-4.758 1.226-5.468 2.37A6.99 6.99 0 0 0 8 15a6.99 6.99 0 0 0 5.468-2.63zM8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                </svg>
                <h3 class="mt-3">Información del Usuario</h3>
                
            </div>

            <!-- Parte Derecha -->
            <div class="col-md-8 text-white">
                <div class="mb-3">
                    <h4>Nombre:</h4>
                    <p class="fw-normal"><?php echo $nombre; ?></p>
                </div>
                <div class="mb-3">
                    <h4>Apellidos:</h4>
                    <p class="fw-normal"><?php echo $apellido; ?></p>
                </div>
                <div class="mb-3">
                    <h4>Usuario:</h4>
                    <p class="fw-normal"><?php echo $user; ?></p>
                </div>
                <div class="mb-3">
                    <h4>Teléfono:</h4>
                    <p class="fw-normal"><?php echo $telefono; ?></p>
                </div>
                <div class="mb-3">
                    <h4>Dirección:</h4>
                    <p class="fw-normal"><?php echo $direccion; ?></p>
                </div>
                
                
            </div>
        </div>
    </div>
    
    

</body>
</html>