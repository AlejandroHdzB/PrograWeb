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

    <title>Actualizar informacion de usuario</title>
</head>
<body>

    <?php
        require_once('./../model/conexion.php');
        require_once('./../model/ORM.php');
        require_once('./../model/usuario.php');
    
        // $_SESSION["usr"] = 'Pedro13';

        $direccion = '';
        $telefono = '';
        $rol = '';
        $user = '';
        $nombre = '';
        $apellidos = '';
        $update = false;

        if (isset($_GET['user']) && !empty($_GET['user'])) {

            $user = $_GET['user'];

            if (isset($_GET['update']) && !empty($_GET['update'])){
                $update = true;
            }

            $db = new Database();
            $encontrado = $db->verificarDriver();
    
            if($encontrado){
                $cnn = $db->getConnection();
                $usuariosModelo = new Usuarios($cnn);
                $userData = $usuariosModelo->getInfoByUser($user);
    
                if( !empty( $userData ) ) {

                    $direccion = $userData['direccion'];
                    $telefono = $userData['telefono'];
                    $rol = $userData['rol'];
                    $nombre = $userData['nombre'];
                    $apellidos = $userData['apellidos'];

                }

                             
            }
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


                <h3 class="mt-3">Actualizar Informacion</h3>
            </div>

            <!-- Parte Derecha -->
            <div class="col-md-8">

                <div class="row mb-3">
                    <h4>Usuarios</h4>
                    <select class="form-select" id="users" name="users">

                        <?php
                            $db = new Database();
                            $encontrado = $db->verificarDriver();
                            
                            if($encontrado){
                                $cnn = $db->getConnection();
                                $usuariosModelo = new Usuarios($cnn);
                                
                                $users = $usuariosModelo->getAllUsers();
                                
                                echo "<option value=''>Seleccionar usuario</option>";

                                foreach ($users as $usuario) {
                                    $nombreUsuario = $usuario['user'];
                                    $rolUsuario = $usuario['rol'];
                                    
                                    echo "<option value='$nombreUsuario'>$rolUsuario - $nombreUsuario</option>";
                                }
                                    
                            }
                        ?>

                        
                    </select>
                </div>

                <div class="row">


                <?php
                
                    if($user == '' || $nombre == '' ){

                        $mensajeTitulo = $user == '' ? "No se ha seleccionado ningún usuario" : "Usuario no valido";
                        $mensjaeSubTitulo = $user == '' ? "Eleccione un usuario" : "Por favor seleccione un usuario valido";


                        echo "<div class='container mt-5'>";
                        echo "    <div class='card'>";
                        echo "        <div class='card-body'>";
                        echo "            <h5 class='card-title'>{$mensajeTitulo}</h5>";
                        echo "            <p class='card-text text-muted' style='opacity: 0.85;'>{$mensjaeSubTitulo}</p>";
                        echo "        </div>";
                        echo "    </div>";
                        echo "</div>";
                        
                    } else {

                        $msjTelefono = $telefono == '' ? 'El telefono no ha sido asignado.': '';
                        $msjDireccion = $direccion == '' ? 'La dirección no ha sido asignada.': '';

                        echo "<form id='updateForm' action='' method='POST'>";
                        echo "  <h4>Informacion de {$user} ( {$nombre} {$apellidos} )</h4>";
                        echo "  <div class='mb-3'>";
                        echo "      <label for='telefono' class='form-label'>Teléfono</label> <span class='text-danger' id='mensajeTelefono'>{$msjTelefono}</span>";
                        echo "      <input type='number' class='form-control' id='telefono' name='telefono' placeholder='Ingrese el teléfono' value='{$telefono}'>";
                        echo "  </div>";
                        echo "  <div class='mb-3'>";
                        echo "      <label for='direccion' class='form-label'>Dirección</label> <span class='text-danger' id='mensajeDireccion'>{$msjDireccion}</span>";
                        echo "      <input type='text' class='form-control' id='direccion' name='direccion' placeholder='Ingrese la dirección' value='{$direccion}'>";
                        echo "  </div>";
                        echo "  <div class='mb-3 d-flex justify-content-center'>";
                        echo "      <button type='submit' class='btn btn-primary' id='update'>Actualizar Usuario</button>";
                        echo "  </div>";
                        echo "</form>";
                    }         

                ?>  
                    
                </div>
            </div>
        </div>

        <?php
            if( $update ) {
                echo "<div class='alert alert-success mt-2'>";
                echo "Se actualizo la informacion al usuario: {$nombre} {$apellidos} ( {$user} )";
                echo "<p class='mb-0'>Nuevo Telefono: '{$telefono}'</p>";
                echo "<p>Nueva direccion: '{$direccion}'</p>";
                echo "</div>";
            
            }
        ?>

    </div>

    <script>

        $(document).ready(function() {

            $('#users').change(function() {
                let opcionSeleccionada = $(this).val();

                window.location.search = `?user=${opcionSeleccionada}`

            });
            $('#update').click( function(e) {

                console.log('click')
                let telefono = $('#telefono').val().trim();
                let direccion = $('#direccion').val().trim();

                let valid = true;
                let mensaje = "";

                // Validar teléfono
                if (!telefono.match(/^\d+$/) || telefono.length < 10 || telefono.length > 15) {
                    valid = false;
                    mensaje += "El teléfono solo debe contener números y tener una longitud adecuada.\n";
                }

                // Validar dirección
                if (direccion.length === 0 || direccion.length > 128) {
                    valid = false;
                    mensaje += "La dirección no puede ser nula y debe tener como máximo 128 caracteres.\n";
                }

                // Mostrar mensaje de error si no es válido
                if (!valid) {
                    alert(mensaje);
                    e.preventDefault()
                } else {

                    $("#mensajeTelefono").text('')
                    $("#mensajeDireccion").text('')
                }

            } )
        });
    </script>


    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $newTelefono = $_POST['telefono'];
            $newDireccion = $_POST['direccion'];

            $errore = [];

            // Validar teléfono
            if ( empty($newTelefono) ) {
                $errores[] = "El teléfono no puede ser nulo.";

            } elseif (!preg_match('/^\d{10,15}$/', $newTelefono)) {
                $errores[] = "El teléfono solo debe contener números y tener entre 10 y 15 dígitos.";
            }

            // Validar dirección
            if (empty($newDireccion)) {
                $errores[] = "La dirección no puede ser nula.";

            } elseif (strlen($newDireccion) > 128) {
                $errores[] = "La dirección debe tener como máximo 128 caracteres.";
            }

           
            if ( !empty($errores) ) {
                foreach ($errores as $error) {
                    echo "<div class='alert alert-danger mt-3'>{$error}</div>";
                }

            } else {
                
                $db = new Database();
    
                $encontrado = $db->verificarDriver();
    
                if($encontrado){
                    $cnn = $db->getConnection();
                    $productoModelo = new Usuarios($cnn);
                    
                    $actualizar=[];
    
                    $actualizar['telefono'] = $newTelefono;
                    $actualizar['direccion'] = $newDireccion;
    
                    if($productoModelo->updateInfoByUser($user, $actualizar) ){

                        echo "<script>window.location.href = window.location.href + '&update=true';</script>";
                        

                    } else
                        echo "<div class='alert alert-danger mt-3'>El usuario {$user} no es valido, actualizacion fallida</div>";
    
                }
            }




        }
    ?>

    
    
</body>
</html>