<?php
require 'config/database.php';

//Unir usuario de la BD
if(isset($_SESSION['user-id'])){
  $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT avatar from usuarios WHERE id=$id";
  $result = mysqli_query($conecction, $query);
  $avatar = mysqli_fetch_assoc($result);  
}

if(!isset($_SESSION['user-id'])){
    header('location: ' . ROOT_URL . 'signin.php');
    die();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link rel="icon" href="../img/aiti.png"/>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../js/bootstrap.min.js">
    <link rel="stylesheet" href="../animate.css/animate.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body style="background-color: #073E63; color:white">
    <nav>
        <div class="container nav__container animate__animated animate__fadeInDown">
            <a class="nav__logo" href="index.php"> Administrador de Blog </a>
            <ul class="nav__items">
                <li>
                <a class="btn btn-info" role="button" href="<?= ROOT_URL ?>blog.php"> <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Ir a Blog </a>
                </li>
                <li class="nav__profile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL . 'img_cargas/' . $avatar['avatar'] ?>">
                    </div>
                    <ul>
                        <li><a href="../logout.php" style="font-size: 1.1rem;"> Cerrar Sesión </a></li>
                    </ul>
                </li>
            </ul>
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    