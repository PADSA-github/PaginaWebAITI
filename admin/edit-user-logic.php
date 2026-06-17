<?php 
require 'config/database.php';


if (isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nombreUsuario = filter_var($_POST['nombreUsuario'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $rol = filter_var($_POST['rol'], FILTER_SANITIZE_NUMBER_INT);

    if(!$nombre || !$apellido) {
        $_SESSION['edit-user'] = "Datos inválidos, favor de revisar";
    } else {
        //actualizar usuario
        $query = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', 
        email='$email', admin='$rol' WHERE id=$id LIMIT 1";
        $result = mysqli_query($conecction, $query);

        if(mysqli_errno($conecction)){
            $_SESSION['edit-user'] = "Error al actualizar los datos del usuario";
        } else {
            $_SESSION['edit-user-success'] = "Usuario $nombre $apellido actualizado correctamente";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();
?>