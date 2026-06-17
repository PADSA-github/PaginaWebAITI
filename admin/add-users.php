<?php
include 'partials/header-blog.php';

$nombre = $_SESSION['add-users-data']['nombre'] ?? null;
$apellido = $_SESSION['add-users-data']['apellido'] ?? null;
$nombreUsuario = $_SESSION['add-users-data']['nombreUsuario'] ?? null;
$email = $_SESSION['add-users-data']['email'] ?? null;
$crearContrasena = $_SESSION['add-users-data']['crearContrasena'] ?? null;
$repetirContrasena = $_SESSION['add-users-data']['repetirContrasena'] ?? null;



unset($_SESSION['add-users-data']);
?>
    <section class="form__section">
        <div class="container form__section-container">
            <h2 class="text-center">Nuevo Usuario</h2>
            <?php if(isset($_SESSION['add-users'])) : ?>
            <div class="alert__message error ">
                <p class= "text-start"> 
                    <?= $_SESSION['add-users'];
                    unset($_SESSION['add-users']); ?>
                </p>
            </div> 
            <?php endif?>
            <form action="<?= ROOT_URL ?>admin/add-users-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="nombre" value="<?= $nombre ?>" placeholder="Nombre(s)">
                <input type="text" name="apellido" value="<?= $apellido ?>" placeholder="Apellidos">
                <input type="text" name="nombreUsuario" value="<?= $nombreUsuario ?>" placeholder="Nombre de Usuario">
                <input type="email" name="email" value="<?= $email ?>" placeholder="Correo Electrónico">
                <input type="password" name="crearContrasena" value="<?= $crearContrasena ?>" placeholder="Contraseña">
                <input type="password" name="repetirContrasena" value="<?= $repetirContrasena ?>" placeholder="Repetir Contraseña">
                <select name="rol">
                    <option disabled selected>Rol de usuario</option>
                    <option value="0">Autor</option>    
                    <option value="1">Administrador</option>
                </select>
                <div class="form__control">
                    <label for="avatar">Foto de perfil</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
                <button type="submit" class="btn" name="submit" style="background-color: #1597ee;"> Agregar Usuario </button>
            </form>
        </div>
    </section>
    <script src="../js/main.js"></script>
</body>

</html>