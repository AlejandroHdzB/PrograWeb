<?php
require_once '../model/conexion.php';

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellidos']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $direccion = htmlspecialchars($_POST['direccion']);
    $usuario = htmlspecialchars($_POST['usuario']);
    $password = $_POST['password']; // No aplicamos htmlspecialchars aquí para mantener los caracteres especiales

    if (!validatePassword($password)) {
        echo json_encode(["status" => "error", "message" => "La contraseña debe tener al menos 8 caracteres y contener una mezcla de mayúsculas, minúsculas, números y símbolos."]);
        exit();
    }

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Verificar si el usuario o el teléfono ya existen
        $checkUserPhone = "SELECT COUNT(*) as count, 
                           SUM(CASE WHEN user = ? THEN 1 ELSE 0 END) as user_count,
                           SUM(CASE WHEN telefono = ? THEN 1 ELSE 0 END) as phone_count
                           FROM usuarios WHERE user = ? OR telefono = ?";
        $stmtCheck = $conn->prepare($checkUserPhone);
        $stmtCheck->bindParam(1, $usuario);
        $stmtCheck->bindParam(2, $telefono);
        $stmtCheck->bindParam(3, $usuario);
        $stmtCheck->bindParam(4, $telefono);
        $stmtCheck->execute();
        $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            if ($result['user_count'] > 0 && $result['phone_count'] > 0) {
                echo json_encode(["status" => "error", "message" => "El usuario y el teléfono ya existen."]);
            } elseif ($result['user_count'] > 0) {
                echo json_encode(["status" => "error", "message" => "El usuario ya existe."]);
            } elseif ($result['phone_count'] > 0) {
                echo json_encode(["status" => "error", "message" => "El teléfono ya existe."]);
            }
        } else {
            $sql = "INSERT INTO usuarios (nombre, apellidos, telefono, direccion, user, password, rol) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $apellido);
            $stmt->bindParam(3, $telefono);
            $stmt->bindParam(4, $direccion);
            $stmt->bindParam(5, $usuario);
            $stmt->bindParam(6, $passwordHash);

            $rolPredeterminado = "CLIENTE";
            $stmt->bindParam(7, $rolPredeterminado);

            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Nuevo usuario registrado exitosamente"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Error al ejecutar la consulta"]);
            }
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Error: " . $e->getMessage()]);
    }
    exit();
}

function validatePassword($password)
{
    $longitud = strlen($password) >= 8;
    $mayuscula = preg_match('/[A-Z]/', $password);
    $minuscula = preg_match('/[a-z]/', $password);
    $numero = preg_match('/[0-9]/', $password);
    $simbolo = preg_match('/[^A-Za-z0-9]/', $password);

    return $longitud && $mayuscula && $minuscula && $numero && $simbolo;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../resources/img/icono.ico" type="image/x-icon">
    <link rel="shortcut icon" href="resources/icono.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="../resources/index.css" rel="stylesheet">
    <title>Home</title>
    <style>
        .registration-container {
            max-width: 450px;
            margin: 20px auto 50px;
            /* Reduce el margen superior */
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .registration-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .registration-subtitle {
            font-size: 1rem;
            margin-bottom: 20px;
            color: #6c757d;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .btn-register {
            background-color: #28a745;
            border: none;
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }

        .btn-register:hover {
            background-color: #218838;
        }

        .link-login {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
        }

        .link-login:hover {
            text-decoration: underline;
            color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="jumbotron header-img">
        <div class="container">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="display-1">TecnoTrack</h1>
                    <p>Proyecto de programacion web</p>
                </div>
                <nav class="nav col justify-content-end">
                    <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                    <a class="nav-link" href="../formLogin.php">Iniciar sesión</a>
                    <a class="nav-link" href="#">Registrarse</a>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="registration-container">
            <h2 class="registration-title text-center">Crea una cuenta</h2>
            <p class="registration-subtitle text-center">Es rápido y fácil.</p>
            <form id="registrationForm" action="formRegister.php" method="post">
                <div class="form-row row">
                    <div class="form-group col-md-6 mb-3">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <input type="text" class="form-control" id="apellido" name="apellidos" placeholder="Apellido" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Número de celular" required>
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" required>
                </div>
                <div class="form-group mb-3">
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
                </div>
                <div class="form-group mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="btn btn-register">Registrarte</button>
            </form>
            <a href="../formLogin.php" class="link-login">¿Ya tienes una cuenta?</a>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#registrationForm').on('submit', function(e) {
            e.preventDefault();

            // Validación de contraseña en el lado del cliente
            var password = $('#password').val();
            var longitud = password.length >= 8;
            var mayuscula = /[A-Z]/.test(password);
            var minuscula = /[a-z]/.test(password);
            var numero = /[0-9]/.test(password);
            var simbolo = /[^A-Za-z0-9]/.test(password);

            if (!(longitud && mayuscula && minuscula && numero && simbolo)) {
                alert("La contraseña debe tener al menos 8 caracteres y contener una mezcla de mayúsculas, minúsculas, números y símbolos.");
                return;
            }

            $.ajax({
                url: 'formRegister.php',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    if (response.status === 'success') {
                        window.location.href = '../index.php';
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    try {
                        var response = JSON.parse(xhr.responseText);
                        alert(response.message || 'Ocurrió un error durante el registro.');
                    } catch (e) {
                        alert('Ocurrió un error inesperado durante el registro.');
                    }
                }
            });
        });
    });
</script>

</html>