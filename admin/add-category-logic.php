<?php

require 'config/database.php';

if (isset($_POST['submit'])) {
    $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $descripcion = filter_var($_POST['descripcion'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$titulo) {
        $_SESSION['add-category'] = "Ingrese el título";
    } elseif (!$descripcion) {
        $_SESSION['add-category'] = "Ingrese una descripción";
    }

    //redirige a la página en caso de una entrada invalida
    if (isset($_SESSION['add-category'])) {
        $_SESSION['add-category-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-category.php');
        die();
    } else {
        //ingresar datos a BD
        $query = "INSERT INTO categoriasblog (titulo, descripcion) VALUES ('$titulo', '$descripcion')";
        $result = mysqli_query($conecction, $query);
        if (mysqli_errno($conecction)) {
            $_SESSION['add-category'] = "Error al agregar categoria";
            header('location: ' . ROOT_URL . "admin/add-category.php");
            die();
        } else {
            $_SESSION['add-category-success'] = "Categoría $titulo agregada exitosamente";
            header('location: ' . ROOT_URL . 'admin/manage-categories.php');
            die();
        }
    }
}
