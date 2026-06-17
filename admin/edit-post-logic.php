<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $id = filter_var($_POST['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $previous_foto_name = filter_var($_POST['previous_foto_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contenido = filter_var($_POST['contenido'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id_categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_NUMBER_INT);
    $post_destacado = filter_var($_POST['post_destacado'], FILTER_SANITIZE_NUMBER_INT);
    $foto = $_FILES['foto'];

    $post_destacado = $post_destacado == 1 ?: 0;

    if (!$titulo) {
        $_SESSION['edit-post'] = "Favor de agregar un título";
    } elseif (!$id_categoria) {
        $_SESSION['edit-post'] = "Favor de elegir una categoría";
    } elseif (!$contenido) {
        $_SESSION['edit-post'] = "Favor de agregar contenido";
    } else {
        if ($foto['name']) {
            $previous_foto_path = '../img_cargas/' . $previous_foto_name;
            if ($previous_foto_path) {
                unlink($previous_foto_path);
            }

            $time = time();
            $foto_name = $time . $foto['name'];
            $foto_tmp_name = $foto['tmp_name'];
            $foto_destination_path = '../img_cargas/' . $foto_name;

            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $foto_name);
            $extension = end($extension);
            if (in_array($extension, $allowed_files)) {
                if ($foto['size'] < 2000000) {
                    move_uploaded_file($foto_tmp_name, $foto_destination_path);
                } else {
                    $_SESSION['edit-post'] = "La imagen es muy grande. Debe pesr menos de 2mb";
                }
            } else {
                $_SESSION['edit-post'] = "Formato de imagen inválido. Formatos admitidos: jpg, jpeg, png";
            }
        }
    }
    if ($_SESSION['edit-post']) {
        header('location: ' . ROOT_URL . 'admin/');
        die();
    } else {
        if ($post_destacado == 1) {
            $zero_all_post_destacado_query = "UPDATE posts_blog SET destacado = 0";
            $zero_all_post_destacado_result = mysqli_query($conecction, $zero_all_post_destacado_query);
        }

        $foto_to_insert = $foto_name ?? $previous_foto_name;

        $query = "UPDATE posts_blog SET titulo='$titulo', contenido='$contenido', foto='$foto_to_insert',
        id_categoria=$id_categoria, destacado=$post_destacado WHERE  id=$id LIMIT 1";
        $result = mysqli_query($conecction, $query);
    }
    if (!mysqli_errno($conecction)) {
        $_SESSION['edit-post-success'] = "Post actualizado con éxito";
    }
}

header('location: ' . ROOT_URL . 'admin/');
die();
