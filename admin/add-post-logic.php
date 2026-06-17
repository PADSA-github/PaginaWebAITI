<?php
require 'config/database.php';

if(isset($_POST['submit'])){
    $id_autor = $_SESSION['user-id'];
    $titulo = filter_var($_POST['titulo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $contenido = filter_var($_POST['contenido'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id_categoria = filter_var($_POST['categoria'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $post_destacado = filter_var($_POST['post_destacado'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $foto = $_FILES['foto'];

    $post_destacado = $post_destacado == 1 ?: 0;

    if(!$titulo){
        $_SESSION['add-post'] = "Ingrese un título";
    } elseif(!$id_categoria){
        $_SESSION['add-post'] ="Seleccione una categoria";
    } elseif(!$contenido){
        $_SESSION['add-post'] ="Ingrese el contenido del artículo";
    }  elseif(!$foto['name']){
            $_SESSION['add-post'] = "Elija una imagen";
   } else {
    $time = time();
    $foto_name = $time . $foto['name'];
    $foto_tmp_name = $foto['tmp_name'];
    $foto_destination_path = '../img_cargas/' . $foto_name;

    $allowed_files = ['png', 'jpg', 'jpeg'];
    $extension = explode('.', $foto_name);
    $extension = end($extension);
    if(in_array($extension, $allowed_files)){
        if($foto['size'] <2_000_000){
            move_uploaded_file($foto_tmp_name, $foto_destination_path);
        }else{
            $_SESSION['add-post'] = "La imagen debe pesar menos de 2mb";
        }
    } else {
        $_SESSION['add-post'] = "La imagen debe contar con extensión png, jpg o jpeg";
    }
    }
    if(isset($_SESSION['add-post'])){
        $_SESSION['add-post-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-post.php');
        die();
    } else {
    if($post_destacado ==1){
        $zero_all_post_destacado_query = "UPDATE posts_blog SET destacado=0";
        $zero_all_post_destacado_result = mysqli_query($conecction, $zero_all_post_destacado_query);
    }        
        
    $query = "INSERT INTO posts_blog (titulo, contenido, foto, id_categoria, id_autor, destacado) VALUES 
    ('$titulo', '$contenido', '$foto_name', '$id_categoria', '$id_autor', '$post_destacado')";
    $result = mysqli_query($conecction, $query); 

    if(!mysqli_errno($conecction)){
        $_SESSION['add-post-success'] = "Nueva entrada agregada exitosamente";
        header('location: ' . ROOT_URL .'admin/');
        die();
    }
}
}

header('location: ' . ROOT_URL . 'admin/add-post.php');
die();