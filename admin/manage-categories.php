<?php
include 'partials/header-blog.php';

$query = "SELECT * FROM categoriasblog ORDER BY titulo ASC" ;
$categorias = mysqli_query($conecction, $query);
?>

<section class="dashboard">
<?php if (isset($_SESSION['add-category-success'])) : ?>
        <!-- Categoría agregada exitosamente-->
        <div class="alert__message success">
            <p>
                <?= $_SESSION['add-category-success'];
                unset($_SESSION['add-category-success']);
                ?>
            </p>
        </div>
        <?php elseif (isset($_SESSION['add-category'])) : ?>
        <!--Error agregar Categoría-->
        <div class="alert__message error">
            <p>
                <?= $_SESSION['add-category'];
                unset($_SESSION['add-category']);
                ?>
            </p>
        </div>
        <?php elseif (isset($_SESSION['edit-category-success'])) : ?>
        <!--Categoría editada correctamente-->
        <div class="alert__message success">
            <p>
                <?= $_SESSION['edit-category-success'];
                unset($_SESSION['edit-category-success']);
                ?>
            </p>
        </div>
        <?php elseif (isset($_SESSION['edit-category'])) : ?>
        <!--Error editar Categoría-->
        <div class="alert__message error">
            <p>
                <?= $_SESSION['edit-category'];
                unset($_SESSION['edit-category']);
                ?>
            </p>
        </div>
        <?php elseif (isset($_SESSION['delete-category-success'])) : ?>
        <!--Categoría eliminada correctamente-->
        <div class="alert__message success">
            <p>
                <?= $_SESSION['delete-category-success'];
                unset($_SESSION['delete-category-success']);
                ?>
            </p>
        </div>
        <?php elseif (isset($_SESSION['delete-category'])) : ?>
        <!--Error eliminar Categoría-->
        <div class="alert__message error">
            <p>
                <?= $_SESSION['delete-category'];
                unset($_SESSION['delete-category']);
                ?>
            </p>
        </div>
        <?php endif?>
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
                        <a href="manage-users.php"><i class="uil uil-users-alt"></i>
                            <h5>Administrar Usuarios </h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php"><i class="uil uil-edit"></i>
                            <h5>Agregar Categoría</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php" class="active"><i class="uil uil-list-ul"></i>
                            <h5>Administrar Categorías </h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Administrar Categorías</h2>
            <?php if (mysqli_num_rows($categorias) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($category = mysqli_fetch_assoc($categorias)) : ?>
                        <tr>
                            <td><?= $category['titulo'] ?> </td>
                            <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id']?>" class="btn1 sm">Editar</td>
                            <td><a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id']?>" class="btn1 sm danger">Borrar</td>
                        </tr>
                        <?php endwhile ?>
                    </tbody>
                    </thead>
                </table>
            <?php else : ?>
                <div class="alert__message error"> <?= "No se encontraron categorías" ?> </div>
            <?php endif ?>
        </main>
    </div>
</section>
<script src="../js/main.js"></script>

</body>

</html>