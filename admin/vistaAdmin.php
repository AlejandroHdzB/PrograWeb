<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../resources/icono.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../resources/icono.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../admin/js/vistaAdmin.js"></script>
    <link href="../resources/styles.css" rel="stylesheet">
    <title>Datos</title>
</head>
<body>
    <h1 class="text-center">Datos</h1>
    <div class="div-add">
        <p>Agregar camion:</p>
        <button class="circular-button">
            <img src="../resources/img/agregar.png" alt="Eliminar">
        </button>
    </div>
    <table class="table table-striped text-center">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Detalles</th>
                <th scope="col">Actualizar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                <td>1</td>
                <td>Llantas</td>
                <td>500</td>
                <td>20</td>
                <td>
                <button class='circular-button'>
                <img src='../resources/img/info.png' alt='Informacion'>
                </button>
                </td>
                <td>
                <button class='circular-button actualizar' onclick="extraeElementosFila(this)">
                <img src='../resources/img/actualizar.png' alt='Actualizar'>
                </button>
                </td>
                <td>
                <button class='circular-button' >
                <img src='../resources/img/eliminar.png' alt='Eliminar'>
                </button>
                </td>
                </tr>

                <tr>
                <td>2</td>
                <td>Para brisas</td>
                <td>2000</td>
                <td>20</td>
                <td>
                <button class='circular-button'>
                <img src='../resources/img/info.png' alt='Informacion'>
                </button>
                </td>
                <td>
                <button class='circular-button actualizar' onclick="extraeElementosFila(this)">
                <img src='../resources/img/actualizar.png' alt='Actualizar'>
                </button>
                </td>
                <td>
                <button class='circular-button' >
                <img src='../resources/img/eliminar.png' alt='Eliminar'>
                </button>
                </td>
                </tr>
        </tbody>
    </table>
</body>

</html>