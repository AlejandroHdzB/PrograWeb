<?php
session_start();
 
require_once('model/conexion.php');
require_once('model/ORM.php');
require_once('model/usuario.php');
 
$usuario = $password = "";
$errores = array();
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!entradaVacia("usuario") && longitudMax("usuario",255) && sinCaracteresEspeciales("usuario")){
        $usuario = $_POST["usuario"];
    }
    if(!entradaVacia("password") && longitudMax("password",255)){
        $password = sha1($_POST["password"]);
    }
 
    if(empty($errores)){
        $db = new Database();
   
        $encontrado = $db->verificarDriver();
   
        if($encontrado){
            $cnn = $db->getConnection();
            $usrModelo = new Usuarios($cnn);
            $data = "user = '".$usuario."' AND password = '".$password."'";
            $login = $usrModelo->validaLogin($data);
            if($login){
                $usr = $login['nombre'];
                $apellidos = $login['apellidos'];
                $_SESSION['nombre'] = $usr;
                $_SESSION['apellidos'] = $apellidos;
                $rol = $login['rol'];
                $_SESSION['rol'] = $rol;
                if ($rol == 'CLIENTE'){
                    echo '<script>
                            alert("Login exitoso de Cliente Redirigiendo...");
                            window.location.href = "cliente/vistaCliente.php";
                        </script>';
                    exit();
                }else{
                    echo '<script>
                            alert("Login exitoso de Administrador Redirigiendo...");
                            window.location.href = "admin/vistaAdmin.php";
                        </script>';
                    exit();
                }
            }else {
                $_SESSION['error'] = "Nombre de usuario o password incorrectos.";
                header("Location: formLogin.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Error en la conexión con la base de datos.";
            header("Location: formLogin.php");
            exit();
        }
    }else {
        $_SESSION['error'] = implode("<br>", $errores);
        header("Location: formLogin.php");
        exit();
    }
}else{
    $_SESSION['error'] = "No se a enviado correctamente el formulario";
    header("Location: formLogin.php");
    exit();
}
 
 
function sinCaracteresEspeciales($campo){
    global $errores;
    if(!preg_match("/^[a-zA-Z0-9ñÑ ]*$/", $_POST[$campo])){
        array_push($errores,"El atributo ". $campo . " no puede tener caracteres especiales");
        return false;
    }
    return true;
}
 
function entradaVacia($campo) {
    global $errores;
    if (empty($_POST[$campo])) {
        array_push($errores,"El atributo ". $campo . " no puede estar vacio");
        return true;
    }
    return false;
}
 
function longitudMax($campo,$valor){
    global $errores;
    if(strlen($_POST[$campo]) <= $valor){
        return true;
    }
    array_push($errores,"El atributo ". $campo . " no puede tener mas de ". $valor ." caracteres");
    return false;
}
 
function formatoPassword($campo) {
    global $errores;
    $password = $_POST[$campo];
    $mayusculas = preg_match('@[A-Z]@', $password);
    $minusculas = preg_match('@[a-z]@', $password);
    $numeros = preg_match('@[0-9]@', $password);
    $caracteresEsp = preg_match('@[\W]@', $password);
 
    if(!$mayusculas || !$minusculas || !$numeros || !$caracteresEsp) {
        array_push($errores,"El atributo ". $campo . " debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial");
        return false;
    }
    return true;
}
 
?>