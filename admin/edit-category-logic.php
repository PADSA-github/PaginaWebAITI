<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $descripcion = filter_var($_POST['descripcion'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!$titulo || !$descripcion){
        $_SESSION['edit-category'] = "Error al editar categoria";
    } else {
        $query = "UPDATE categoriasblog SET titulo='$titulo', descripcion='$descripcion' WHERE id=$id LIMIT 1";
        $result = mysqli_query($conecction, $query);

        if(mysqli_errno($conecction)){
            $_SESSION['edit-category'] = "Error al actualizar categoría";
        } else {
            $_SESSION['edit-category-success'] = "Categoría $titulo actualizado correctamente";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();