<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    //obtener datos
    $usuario_email = filter_var($_POST['usuario_email'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contrasena = filter_var($_POST['contrasena'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$usuario_email) {
        $_SESSION['signin'] = "Usuario o email requeridos";
    } elseif (!$contrasena) {
        $_SESSION['signin'] = "Contraseña requerida";
    } else {
        //Comparar con BD
        $fetch_user_query = "SELECT * FROM usuarios WHERE nombreUsuario='$usuario_email' OR 
        email='$usuario_email'";
        $fetch_user_result = mysqli_query($conecction, $fetch_user_query);

        if (mysqli_num_rows($fetch_user_result) == 1) {
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record['contrasena'];
            //comparar contraseñas 
            if (password_verify($contrasena, $db_password)) {
                $_SESSION['user-id'] = $user_record['id'];
                if ($user_record['admin'] == 1) {
                    $_SESSION['usuario_admin'] = true;
                }
                header('location: ' . ROOT_URL . 'admin/');
            } else {
                $_SESSION['signin'] = "Contraseña incorrecta";
            }
        } else {
            $_SESSION['signin'] = "Usuario no encontrado";
        }
    }
    //Redireccionar a la propia página
    if (isset($_SESSION['signin'])){
        $_SESSION['signin-data'] = $POST;
        header('location: ' . ROOT_URL . "signin.php");
        die();
    }
} else {
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}
