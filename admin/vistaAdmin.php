<?php
require_once('../model/GetAll.php');
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
    <link href="../resources/styles.css" rel="stylesheet">
    <link rel="icon" href="../resources/img/icono.ico">
    <title>Administrador</title>
</head>

<body>
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
                        <strong>Bienvenid@ Admin: <?php echo $nombreAdmin; ?></strong>
                    </a>
                    <ul class="style-drop-it:hover style-dropdown dropdown-menu dropdown-menu-end" data-bs-toggle="dropdown" data-bs-display="static" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Actualizar Datos</a></li>
                        <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>

    <div class="div-add">
        <p>Agregar producto</p>
        <button class="circular-button">
            <img src="../resources/img/agregar.png" alt="Agregar">
        </button>
    </div>

    <div class="container-table">
        <table class="table-bordered style-table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Id</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Precio</th>
                    <th scope="col" class="text-center">Cantidad</th>
                    <th scope="col" class="text-center">Detalles</th>
                    <th scope="col" class="text-center">Actualizar</th>
                    <th scope="col" class="text-center">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($productos as $producto) {
                    echo "<tr>";
                    echo "<td class='text-center'>{$producto['id']}</td>";
                    echo "<td class='text-center'>{$producto['nombre']}</td>";
                    echo "<td class='text-center'>{$producto['precio']}</td>";
                    echo "<td class='text-center'>{$producto['cantidad']}</td>";
                    echo "<td class='text-center'>
                <div class='d-flex justify-content-center'>
                        <button class='circular-button detalles-button' data-id='{$producto['id']}'>
                          <img src='../resources/img/info.png' alt='Informacion'>
                        </button>
                </div>
                      </td>";
                    echo "<td class='text-center'>
                <div class='d-flex justify-content-center'>
                        <button class='circular-button'>
                          <img src='../resources/img/actualizar.png' alt='Actualizar'>
                        </button>
                </div>
                      </td>";
                    echo "<td class='text-center'>
                <div class='d-flex justify-content-center'>
                <button class='circular-button eliminar-button' data-id='{$producto['id']}'>
                        <img src='../resources/img/eliminar.png' alt='Eliminar'>
                </button>
                </div>
                      </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="productModalLabel">Detalles del Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <p id="modal-id"></p>
                    <p id="modal-nombre"></p>
                    <p id="modal-precio"></p>
                    <p id="modal-cantidad"></p>
                    <p id="modal-detalles"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        //Aqui hacemos el GetById, comprobando por medio de JS 
        document.addEventListener('DOMContentLoaded', function() {
            var detalleButtons = document.querySelectorAll('.detalles-button');
            detalleButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var productId = button.getAttribute('data-id');
                    fetch('../model/getById.php?id=' + productId)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            document.getElementById('modal-id').innerText = 'ID: ' + data.id;
                            document.getElementById('modal-nombre').innerText = 'Nombre: ' + data.nombre;
                            document.getElementById('modal-precio').innerText = 'Precio: $' + data.precio + '.00 MX';
                            document.getElementById('modal-cantidad').innerText = 'Cantidad: ' + data.cantidad
                            document.getElementById('modal-cantidad').innerText = 'Cantidad: ' + data.cantidad + ' piezas en stock';
                            document.getElementById('modal-detalles').innerText = 'Detalles: \n' + data.detalles;
                            var myModal = new bootstrap.Modal(document.getElementById('productModal'));
                            myModal.show();
                        })
                        .catch(error => console.error('Error:', error.message));

                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var eliminarButtons = document.querySelectorAll('.eliminar-button');
            eliminarButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var productId = button.getAttribute('data-id');
                    if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                        fetch('../model/deleteById.php?id=' + productId, {
                                method: 'DELETE'
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Error al eliminar el producto');
                                }
                                return response.json();
                            })
                            .then(data => {
                                alert('Producto eliminado exitosamente');
                                location.reload();
                            })
                            .catch(error => console.error('Error:', error.message));
                    }
                });
            });
        });
    </script>

</body>

</html>