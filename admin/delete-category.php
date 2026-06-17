<?php
require 'config/database.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $update_query = "UPDATE posts_blog SET id_categoria=7 WHERE id_categoria=$id";
    $update_result = mysqli_query($conecction, $update_query);

    if (!mysqli_errno($conecction)) {

        $query = "DELETE FROM categoriasblog WHERE id=$id LIMIT 1";
        $result = mysqli_query($conecction, $query);
        $_SESSION['delete-category-success'] = "Categoria eliminada correctamente";
    }
}
header('location: ' . ROOT_URL . 'admin/manage-categories.php');
die();
