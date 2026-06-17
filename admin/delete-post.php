<?php
require 'config/database.php';

if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM posts_blog WHERE id=$id";
    $result = mysqli_query($conecction, $query);

    if(mysqli_num_rows($result)==1){
        $post = mysqli_fetch_assoc($result);
        $foto_name = $post['foto'];
        $foto_path = '../img_cargas/' . $foto_name;

        if($foto_path) {
            unlink($foto_path);

            $delete_post_query = "DELETE FROM posts_blog WHERE id=$id LIMIT 1";
            $delete_post_result = mysqli_query($conecction, $delete_post_query);

            if(!mysqli_errno($conecction)){
                $_SESSION['delete-post-success'] = "Post eliminado exitosamente";
            }
        }
    }
}

header('location: ' . ROOT_URL . 'admin/');
die();