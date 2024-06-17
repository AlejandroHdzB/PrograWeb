<?php
session_start();

require_once('../model/conexion.php');
require_once('../model/ORM.php');
require_once('../model/producto.php');

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'CLIENTE') {
    $_SESSION['error'] = "Intenta ingresar a la pagina cliente, con un usuario que tiene un rol diferente o no ha iniciado sesión";
    header('Location: ../formLogin.php');
    exit();
}

$db = new Database();

$encontrado = $db->verificarDriver();

if($encontrado){
    $cnn = $db->getConnection();
    $productoModelo = new Productos($cnn);
    $productos = $productoModelo->getAll();
}else{
    $_SESSION['error'] = "Error al conectar con la base de datos";
    header("Location: ../formLogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../resources/icono.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../resources/icono.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="../resources/styles.css" rel="stylesheet">
    <title>Productos</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg style-nav">
        <div class="container-fluid">
            <img src="../resources/img/logo.png">
            <h1>Partes de camiones</h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle style-link" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Bienvenido: <?php echo $_SESSION['nombre']." ".$_SESSION['apellidos'] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end style-dropdown">
                            <li><a class="dropdown-item style-drop-it" href="#">Actualizar datos</a></li>
                            <li><a class="dropdown-item style-drop-it" id="cerrarSesion">Cerrar sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-table">
        <table class="style-table table-bordered text-center">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Detalles</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach($productos as $producto){
                    echo "<tr>".
                        "<td>" . $producto['id'] . "</td>".
                        "<td>" . $producto['nombre'] . "</td>".
                        "<td>" . $producto['precio'] . "</td>".
                        "<td>" . $producto['cantidad'] . "</td>".
                        "<td class='center-button'>".
                        "<button class='circular-button detallesProducto'>".
                        "<img src='../resources/img/info.png' alt='Informacion'>".
                        "</button>".
                        "</td>";
                }
            ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="modalDetalles" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id ="modalResponse" class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(".detallesProducto").click(function(){
                let id = $(this).closest("tr").find("td:first").text();
                $.ajax({
                    type: "POST",
                    url: "../model/detalles.php",
                    data: { id: id },
                    success: function(respuesta){
                        const datos = JSON.parse(respuesta);
                        let mensaje = '';
                        if(datos.estado === 'ok'){
                            const producto = datos.data[0];
                            const detalles = producto.detalles.split(',');
                            detalles.forEach((d) => {
                                mensaje +=`
                                    <h6>${d}</h6>
                                `;
                            })
                        }else{
                            mensaje = `<h6>${datos.mensaje}</h6>`;
                        }
                        $("#modalTitle").text('Detalles');
                        $("#modalResponse").html(mensaje);
                        $("#modalDetalles").modal('show');
                    },
                    error: function(){
                        $("#modalTitle").text('Error');
                        $("#modalResponse").html('<h6>Error en la solicitud</h6>');
                        $("#modalDetalles").modal('show');
                    }
                });
            });

            $("#cerrarSesion").click(function(){
                $.ajax({
                    url: '../model/cerrarSesion.php',
                    type: 'POST',
                    success: function(response) {
                        $("#modalTitle").text('Información');
                        $("#modalResponse").html('<h6>Sesión cerrada correctamente</h6>');
                        $("#modalDetalles").modal('show');
                        $('#modalDetalles').on('hidden.bs.modal', function () {
                            window.location.href = '../index.php'; 
                        });
                    },
                    error: function(xhr, status, error) {
                        $("#modalTitle").text('Error');
                        $("#modalResponse").html('<h6>Hubo un problema al cerrar la sesión</h6>');
                        $("#modalDetalles").modal('show');
                    }
                });
            });
        });
    </script>
</body>
</html>