<?php
require 'config/constants.php';

$usuario_email = $_SESSION['signin-data']['usuario_email'] ?? null;
$contrasena = $_SESSION['signin-data']['contrasena'] ?? null;

unset($_SESSION['signin-data']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión </title>
    <link rel="stylesheet" href="./css/blog.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./js/bootstrap.min.js">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body style="background-color: #073E63; color:white;">
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Iniciar Sesión</h2>
            <?php if (isset ($_SESSION['signup-success'])) : ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']);
                        ?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION['signin'])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION['signin'];
                        unset($_SESSION['signin']);
                        ?>
                    </p>
                </div>
            <?php endif?>
            <form action="<?= ROOT_URL ?>signin-logic.php" method="POST">
                <input type="text" name="usuario_email" value="<?=$usuario_email ?>" placeholder="Nombre de Usuario o Correo Electrónico">
                <input type="password" name="contrasena" value="<?=$contrasena ?>" placeholder="Contraseña">
                <button type="submit" name="submit" class="btn" style="background-color: #1597ee;"> Iniciar Sesión </button>
               <!-- <small>¿Aún no está registrado? <a href="signup.php"> Regístrese </a></small> -->
            </form>
        </div>
    </section>
</body>

</html>