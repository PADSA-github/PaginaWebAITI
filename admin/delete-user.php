<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM usuarios WHERE id=$id";
    $result = mysqli_query($conecction, $query);
    $user = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) == 1){
        $avatar_name = $user['avatar'];
        $avatar_path = '../img_cargas/' . $avatar_name;
        //Borrar imagenes
        if($avatar_path){
            unlink($avatar_path);
        }
    }
    //captar fotos de entradas de blog del usuario
    $foto_query = "SELECT foto FROM posts_blog WHERE id_autor=$id";
    $foto_result = mysqli_query($conecction, $foto_query);
    if(mysqli_num_rows($foto_result) > 0){
        while($foto = mysqli_fetch_assoc($foto_result)){
            $foto_path = '../img_cargas/' . $foto['foto'];
            if($foto_path) {
                unlink($foto_path);
            }
        }
    }

    //Borrar usuario de la BD
    $delete_user_query = "DELETE FROM usuarios WHERE id=$id";
    $delete_user_result = mysqli_query($conecction, $delete_user_query);
    if(mysqli_errno($conecction)){
        $_SESSION['delete-user'] = "Error al borrar usuario $nombreUsuario";
    }  else {
        $_SESSION['delete-user-success'] = "Usuario $nombreUsuario eliminado con éxito";
    }
}

header('location: ' . ROOT_URL . 'admin/manage-users.php');
die();