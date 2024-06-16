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

        $_SESSION["usr"] = 'Pedro13';

        $user = $_SESSION["usr"];

        $db = new Database();

        $encontrado = $db->verificarDriver();

        if($encontrado){
            $cnn = $db->getConnection();
            $productoModelo = new Productos($cnn);
            $userData = $productoModelo->getInfoByUser($user);

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
    
    <div class="container mt-5">
        <div class="row">
            <!-- Parte Izquierda -->
            <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M13.468 12.37C12.758 11.226 11.383 10 8 10s-4.758 1.226-5.468 2.37A6.99 6.99 0 0 0 8 15a6.99 6.99 0 0 0 5.468-2.63zM8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                </svg>
                <h3 class="mt-3">Información del Usuario</h3>
                
            </div>

            <!-- Parte Derecha -->
            <div class="col-md-8">
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
                <div class="mb-3">
                    <h4>Rol:</h4>
                    <p class="fw-normal"><?php echo $rol; ?></p>
                </div>
                
            </div>
        </div>
    </div>
    
    

</body>
</html>