<?php
include 'partials/header-blog.php';

if (isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM usuarios WHERE id=$id";
    $result = mysqli_query($conecction, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/manage-users.php');
    die();
}
?>
    <section class="form__section" style="margin-top: 0rem;">
        <div class="container form__section-container">
            <h2 class="text-center">Editar Usuario</h2>
            <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" method="POST">
                <input type="hidden" value="<?= $user['id'] ?>" name="id">
                <label for="nombre" class="form-label" style="margin-bottom:-1rem;">Nombre</label>
                <input type="text" value="<?= $user['nombre'] ?>" placeholder="Nombre(s)" name="nombre">
                <label for="apellido" class="form-label" style="margin:-1rem 0rem; ">Apellido</label>
                <input type="text" value="<?= $user['apellido'] ?>" placeholder="Apellidos"name="apellido">
                <label for="email" class="form-label" style="margin:-1rem 0rem; ">Correo Electrónico</label>
                <input type="email" value="<?= $user['email'] ?>" placeholder="Email"name="email">
                <select name="rol">
                    <option disabled selected>Rol de usuario</option>
                    <option value="0">Autor </option>    
                    <option value="1">Administrador</option>
                </select>
           
                <button type="submit" name="submit" class="btn" style="background-color: #1597ee;"> Actualizar Usuario </button>
            </form>
        </div>
    </section>
    <script src="../js/main.js"></script>
</body>

</html>