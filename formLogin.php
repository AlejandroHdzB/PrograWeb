<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../resources/icono.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../resources/icono.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <link href="resources/login.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <title>Login</title>
    <style>
        .error-message {
            color: red;
            font-size: 0.875em;
        }
        .input-group {
            position: relative;
        }
        .input-group .form-control:focus {
            z-index: 1;
        }
        .input-group-text {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form id="formLogin" class="container login-container" action="login.php" method="post">
        <h1 class="text-center">Iniciar sesión</h1>
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password">
                <span class="input-group-text" id="togglePassword">
                    <i class="bi bi-eye" id="toggleIcon"></i>
                </span>
            </div>
            <span class="error-message" id="passwordError"></span>
        </div>
        <?php
            if (isset($_SESSION['error'])) {
                echo "<p style='color: red;'>".$_SESSION['error']."</p>";
                unset($_SESSION['error']);
            }
        ?>
        <button type="submit" class="btn" id="btnIniciarSesion">Iniciar sesión</button>
        <a class="text-center" href="">Registrarse</a>
    </form>
    <script>
        $(document).ready(function(){
            $.validator.addMethod("sinCaracteresEspeciales", function(value, element) {
                return this.optional(element) || /^[a-zA-Z0-9ñÑ ]*$/.test(value);
            }, "El usuario no puede contener caracteres especiales");
            $.validator.addMethod("formatoPassword", function(value, element) {
                return this.optional(element) || 
                    /[A-Z]/.test(value) && /[a-z]/.test(value) && /\d/.test(value) && /[@$!%*?&]/.test(value);
            }, "La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.");

            $("#formLogin").validate({
                rules:{
                    usuario:{
                        required:true,
                        maxlength:255,
                        sinCaracteresEspeciales:true
                    },
                    password:{
                        required:true,
                        maxlength:255,
                        formatoPassword:true
                    }
                },
                messages: {
                    usuario:{
                        required:"No ha ingresado su usuario",
                        maxlength:"El usuario no puede execer los 255 caracteres"
                    },
                    password:{
                        required:"No ha ingresado su contraseña",
                        maxlength:"El password no puede execer los 255 caracteres"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "password") {
                        error.appendTo("#passwordError");
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $("#togglePassword").click(function() {
                const passwordField = $("#password");
                const passwordFieldType = passwordField.attr("type");
                const toggleIcon = $("#toggleIcon");

                if (passwordFieldType === "password") {
                    passwordField.attr("type", "text");
                    toggleIcon.removeClass("bi-eye").addClass("bi-eye-slash");
                } else {
                    passwordField.attr("type", "password");
                    toggleIcon.removeClass("bi-eye-slash").addClass("bi-eye");
                }
            });
        });
    </script>
</body>
</html>
