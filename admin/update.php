<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="resources/icono.ico" type="image/x-icon">
    <link rel="shortcut icon" href="resources/icono.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="./../resources/index.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../admin/js/update.js"></script>

    <title>Formulario de Información Productos</title>
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
                        <a class="nav-link active" aria-current="page" href="vistaAdmin.php">Home</a>
                        <a class="nav-link" href="formLogin.php">Iniciar sesión</a>
                        <a class="nav-link" href="">Registrar</a>
                    </nav>
                </div>           
            </div>
        </div>
    <div class="container mt-5">
        <h1>Formulario de Información Productos</h1>
        <form id="formularioActualizar">
            <div class="mb-3">
                <label for="id">Id:</label>
                <input type="text" class="form-control" id="id" name="id" readonly>
            </div>
            <div class="mb-3">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" readonly>
            </div>
            <div class="mb-3">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" id="precio" name="precio" require>
            </div>
            <div class="mb-3">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" require>
            </div>
            <button type="submit" class="btn btn-primary" onclick="update(event,this)">Enviar</button>
        </form>
    </div>

    
</body>
</html>
