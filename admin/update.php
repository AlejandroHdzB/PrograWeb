<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Información Productos</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../admin/js/update.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Formulario de Información Productos</h1>
        <form id="formularioActualizar">
            <div class="form-group">
                <label for="id">Id:</label>
                <input type="text" class="form-control" id="id" name="id" readonly>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" readonly>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" id="precio" name="precio" require>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" require>
            </div>
            <button type="submit" class="btn btn-primary" onclick="update(event,this)">Enviar</button>
        </form>
    </div>

    
</body>
</html>
