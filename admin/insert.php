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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../admin/js/insert.js"></script>
    <link href="../resources/styles.css" rel="stylesheet">
    

    <title>Agregar producto</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark style-nav">
    <a class="navbar-brand style-link" href="vistaAdmin.php" style="font-size: 40px;">
        <img src="../resources/img/icono.ico" alt="Logo">    
        <strong>Autopartes de Camiones</strong>
    </a>


</nav>



    <div class="container mt-5">
    <   <h1>Formulario de Inserción Productos</h1>
        <form id="productForm">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label> <span id="nombreError" class="text-danger"></span>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre" require>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label> <span id="precioError" class="text-danger"></span>
                <input type="number" class="form-control" id="precio" name="precio" placeholder="Ingresa el precio" require>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label> <span id="cantidadError" class="text-danger"></span>
                <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Ingresa la cantidad" require>
            </div>
            <div class="mb-3">
                <label for="detalles" class="form-label">Detalles</label> <span id="detallesError" class="text-danger"></span>
                <textarea class="form-control" id="detalles" name="detalles" placeholder="Ingresa la descripcion"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" onclick="insert(event,this)">Enviar</button>
        </form>
    </div>