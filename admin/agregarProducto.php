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



    <div class="container mt-5">
        <h2 class="mb-4">Agregar Producto</h2>
        <form id="productForm" action="procesar_agregarProducto.php" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label> <span id="nombreError" class="text-danger"></span>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre">
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label> <span id="precioError" class="text-danger"></span>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Ingresa el precio">
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label> <span id="cantidadError" class="text-danger"></span>
                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingresa la cantidad">
            </div>
            <div class="mb-3">
                <label for="detalles" class="form-label">Detalles</label> <span id="detallesError" class="text-danger"></span>
                <textarea class="form-control" id="detalles" name="detalles" placeholder="Ingresa la descripcion"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>


    <script>
        $(document).ready(function() {
            $('#productForm').on('submit', function(event) {

                let valid = true;

                let nombre = $('#nombre').val().trim();
                let precio = $('#precio').val().trim();
                let cantidad = $('#cantidad').val().trim();
                let detalles = $('#detalles').val().trim();

                if (nombre === '') { // Nombre
                    valid = false;
                    $('#nombre').addClass('is-invalid');
                    $('#nombreError').text('El nombre es obligatorio.')
                } else {
                    $('#nombre').removeClass('is-invalid');
                    $('#nombreError').text('')
                }

                if (precio === '' ) { // Precio
                    valid = false;
                    $('#precio').addClass('is-invalid');
                    $('#precioError').text('El precio es obligatorio.')
                } else if ( parseFloat(precio) <= 0 ){
                    valid = false;
                    $('#precio').addClass('is-invalid');
                    $('#precioError').text('El precio debe ser mayor a cero.')

                } else {
                    $('#precio').removeClass('is-invalid');
                    $('#precioError').text('')
                }
                
                if (cantidad === '') { // Cantidad
                    valid = false;
                    $('#cantidad').addClass('is-invalid');
                    $('#cantidadError').text('La cantidad es obligatoria.')
                    
                } else if ( parseInt(cantidad) <= 0 ){
                    valid = false;
                    $('#cantidad').addClass('is-invalid');
                    $('#cantidadError').text('La cantidad debe ser mayor a cero.')

                } else {
                    $('#cantidad').removeClass('is-invalid');
                    $('#cantidadError').text('')
                }
                
                if (detalles === '') { // Detalles
                    valid = false;
                    $('#detalles').addClass('is-invalid');
                    $('#detallesError').text('Los detalles son obligatorios.')
                } else {
                    $('#detalles').removeClass('is-invalid');
                    $('#detallesError').text('')
                }

                if ( !valid) {
                    event.preventDefault(); 
                }
            });
        });
    </script>
    

</body>
</html>