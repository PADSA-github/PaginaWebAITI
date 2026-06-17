<?php
include 'partials/header-blog.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM categoriasblog WHERE id=$id";
    $result = mysqli_query($conecction, $query);
    if (mysqli_num_rows($result) == 1) {
        $category = mysqli_fetch_assoc($result);
    }
} else {
    header('location: ' . ROOT_URL . 'admin/manage-categories.php');
    die();
}
?>
<section class="form__section" style="margin-top: 0rem;">
    <div class="container form__section-container">
        <h2 class="text-center">Editar Categoría</h2>
        <form action="<?= ROOT_URL ?>admin/edit-category-logic.php" method="POST">
            <input type="hidden" name="id" value="<?= $category['id'] ?>" placeholder="id">
            <input type="text" name="titulo" value="<?= $category['titulo'] ?>" placeholder="Titulo">
            <textarea rows="4" name="descripcion" placeholder="Descripción"><?= $category['descripcion'] ?></textarea>
            <button type="submit" name="submit" class="btn" style="background-color: #1597ee;"> Actualizar Categoría </button>
        </form>
    </div>
</section>
<script src="../js/main.js"></script>
</body>

</html>