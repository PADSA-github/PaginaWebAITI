<?php
include 'partials/header-blog.php';

$current_user_id = $_SESSION['user-id'];
$query = "SELECT id, titulo, id_categoria FROM posts_blog WHERE id_autor=$current_user_id ORDER BY id DESC";
$posts = mysqli_query($conecction, $query);
?>

<section class="dashboard">
    <?php if (isset($_SESSION['add-post-success'])) : ?>
        <!-- Post agregado exitosamente-->
        <div class="alert__message success">
            <p>
                <?= $_SESSION['add-post-success'];
                unset($_SESSION['add-post-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['add-post'])) : ?>
        <!-- Post no agregado. Error-->
        <div class="alert__message error">
            <p>
                <?= $_SESSION['add-post'];
                unset($_SESSION['add-post']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-post-success'])) : ?>
        <!-- Post actualizado exitosamente-->
        <div class="alert__message success">
            <p>
                <?= $_SESSION['edit-post-success'];
                unset($_SESSION['edit-post-success']);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['edit-post'])) : ?>
        <!-- Post No actualizado. Error-->
        <div class="alert__message error">
            <p>
                <?= $_SESSION['edit-post'];
                unset($_SESSION['edit-post']);
                ?>
            </p>
        </div>
        <?php elseif (isset($_SESSION['delete-post-success'])) : ?>
        <!-- Post eliminado exitosamente-->
        <div class="alert__message success">
            <p>
                <?= $_SESSION['delete-post-success'];
                unset($_SESSION['delete-post-success']);
                ?>
            </p>
        </div>
        <?php elseif (isset($_SESSION['delete-post'])) : ?>
        <!-- Post No eliminado. Error-->
        <div class="alert__message error">
            <p>
                <?= $_SESSION['delete-post'];
                unset($_SESSION['delete-post']);
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
                    <a href="index.php" class="active"><i class="uil uil-postcard"></i>
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
                        <a href="manage-categories.php"><i class="uil uil-list-ul"></i>
                            <h5>Administrar Categorías </h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Administrar Entradas de Blog</h2>
            <?php if (mysqli_num_rows($posts) > 0) : ?>
                <table>
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                            <?php
                            $id_categoria = $post['id_categoria'];
                            $category_query = "SELECT titulo FROM categoriasblog WHERE id=$id_categoria";
                            $category_result = mysqli_query($conecction, $category_query);
                            $category = mysqli_fetch_assoc($category_result);
                            ?>
                            <tr>
                                <td><?= $post['titulo'] ?></td>
                                <td><?= $category['titulo'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id'] ?>" class="btn1 sm">Editar</td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>" class="btn1 sm danger">Borrar</td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                    </thead>
                </table>
            <?php else : ?>
                <div class="alert__message error"><?= "No hay entradas de blog disponibles" ?> </div>
            <?php endif ?>
        </main>
    </div>
</section>
<script src="../js/main.js"></script>

</body>

</html>
