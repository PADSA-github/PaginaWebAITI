<?php

require 'config/database.php';

//obtener datos de registro
if(isset($_POST['submit'])){
    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nombreUsuario = filter_var($_POST['nombreUsuario'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $crearContrasena = filter_var($_POST['crearContrasena'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $repetirContrasena = filter_var($_POST['repetirContrasena'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $rol = filter_var($_POST['rol'], FILTER_SANITIZE_NUMBER_INT);
    $avatar = $_FILES['avatar'];
    
    //Validar datos de entrada
    if(!$nombre){
        $_SESSION['add-users'] = "Ingrese su nombre";
    }elseif (!$apellido){
        $_SESSION['add-users'] = "Ingrese su apellido";
    }elseif (!$nombreUsuario){
        $_SESSION['add-users'] = "Ingrese un nombre de usuario";
    }elseif (!$email){
        $_SESSION['add-users'] = "Ingrese su correo electrónico";   
    }elseif (strlen($crearContrasena) < 8 || strlen($repetirContrasena) < 8){
        $_SESSION['add-users'] = "Ingrese una contraseña mayor a 8 caracteres";
    }elseif (!$crearContrasena){
        $_SESSION['add-users'] = "Ingrese una contraseña";
    }elseif (!$repetirContrasena){
        $_SESSION['add-users'] = "Ingrese nuevamente su contraseña";
    }elseif (!$avatar['name']){
        $_SESSION['add-users'] = "Suba una imagen de perfil";
    } else {
        if($crearContrasena !== $repetirContrasena){
            $_SESSION['add-users'] = "Las contraseñas no coinciden";
        } else {
            //encriptar contraseña
            $encrip_contrasena = password_hash($crearContrasena, PASSWORD_DEFAULT);
            //checar si email o usuario ya existe en BD
            $user_check_query = "SELECT * FROM usuarios WHERE nombreUsuario = '$nombreUsuario' OR email = '$email'";
            $user_check_result = mysqli_query($conecction, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0){
                $_SESSION['add-users'] = "El nombre de usuario o el correo electrónico ya existen";
            } else {
                //renombrar imagen
                $time = time();
                $avatar_name = $time . $avatar['name'];
                $avatar_tmp_name = $avatar['tmp_name'];
                $avatar_dest_path = '../img_cargas/' . $avatar_name;
                //validar imagen
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extention = explode('.', $avatar_name);
                $extention = end($extention);
                if(in_array($extention, $allowed_files)){
                    //asegurar que la imagen no sea superior a 1mb
                    if($avatar['size'] < 1000000){
                        //cargar imagen
                        move_uploaded_file($avatar_tmp_name, $avatar_dest_path);
                    } else {
                        $_SESSION['add-users'] = 'La imagen es muy pesada. Tamaño máximo permitido: 1mb';
                    }
                } else{
                    $_SESSION['add-users'] = 'La extensión de la imagen debe ser png, jpg o jpeg';
                }
            }
        }
    }
    //redirección de error
if(isset ($_SESSION['add-users'])){
    //pasar información de vuelta a formulario
    $_SESSION['add-users-data'] = $_POST;
    header('location: ' . ROOT_URL . 'admin/add-users.php');
} else {
    $insert_user_query = "INSERT INTO usuarios (nombre, apellido, nombreUsuario, email, contrasena, avatar, admin) 
    VALUES('$nombre', '$apellido', '$nombreUsuario', '$email', '$encrip_contrasena', '$avatar_name', '$rol')";

    $insert_user_result = mysqli_query($conecction, $insert_user_query);

    if (!mysqli_errno($conecction)){
        // redireccionar a login con success message
        $_SESSION['add-users-success'] = "Usuario $nombreUsuario registrado exitosamente.";
        header('location: ' . ROOT_URL . 'admin/manage-users.php');
        die(); 
    }
}


//Cuando se quiera acceder a esta página sin enviar registro
}else {
    header('location: '. ROOT_URL . 'admin/add-users.php');
    die();
}
