<?php
include 'partials/header-blog.php';

$current_admin_id = $_SESSION['user-id'];

$query = "SELECT * FROM usuarios WHERE NOT id=$current_admin_id";
$users = mysqli_query($conecction, $query);
?>

<section class="dashboard">
    <?php if (isset($_SESSION['add-users-success'])) : ?>
        <!-- Usuario agregado exitosamente-->
        <div class="alert__message success">
            <p>
                <?= $_SESSION['add-users-success'];
                unset($_SESSION['add-users-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-user-success'])) : ?>
        <!-- Usuario actualizado exitosamente-->
        <div class="alert__message success">
            <p>
                <?= $_SESSION['edit-user-success'];
                unset($_SESSION['edit-user-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-user'])) : ?>
        <!-- Usuario actualizado error-->
        <div class="alert__message error">
            <p>
                <?= $_SESSION['edit-user'];
                unset($_SESSION['edit-user']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-user-success'])) : ?>
        <!-- Usuario actualizado exitosamente-->
        <div class="alert__message success">
            <p>
                <?= $_SESSION['edit-user-success'];
                unset($_SESSION['edit-user-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-user-success'])) : ?>
        <!-- Usuario eliminado exitosamente-->
        <div class="alert__message success">
            <p>
                <?= $_SESSION['delete-user-success'];
                unset($_SESSION['delete-user-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-user'])) : ?>
        <!-- Usuario eliminado error-->
        <div class="alert__message error">
            <p>
                <?= $_SESSION['delete-user'];
                unset($_SESSION['delete-user']);
                ?>
            </p>
        </div>
    <?php endif ?>
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="add-post.php"><i class="uil uil-pen"></i>
                        <h5>Agregar Entrada de Blog </h5>
                    </a>
                </li>
                <li>
                    <a href="index.php"><i class="uil uil-postcard"></i>
                        <h5>Administrar Entradas de Blog </h5>
                    </a>
                </li>
                <?php if (isset($_SESSION['usuario_admin'])) : ?>
                    <li>
                        <a href="add-users.php"><i class="uil uil-user-plus"></i>
                            <h5>Agregar Usuario </h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-users.php" class="active"><i class="uil uil-users-alt"></i>
                            <h5>Administrar Usuarios </h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php"><i class="uil uil-edit"></i>
                            <h5>Agregar Categoría</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php"><i class="uil uil-list-ul"></i>
                            <h5>Administrar Categorías </h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Administrar Usuarios</h2>
            <?php if (mysqli_num_rows($users) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Nombre de Usuario</th>
                            <th>Administrador</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = mysqli_fetch_assoc($users)) : ?>
                            <tr>
                                <td><?= "{$user['nombre']} {$user['apellido']}" ?> </td>
                                <td><?= $user['nombreUsuario'] ?></td>
                                <td><?= $user['admin'] ? 'Sí' : 'No' ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn1 sm">Editar</td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="btn1 sm danger">Borrar</td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                    </thead>
                </table>
            <?php else : ?>
                <div class="alert__message error text-center"> <?= "No se encontraron usuarios" ?> </div>
            <?php endif ?>
        </main>
    </div>
</section>

<script src="../js/main.js"></script>
</body>

</html>