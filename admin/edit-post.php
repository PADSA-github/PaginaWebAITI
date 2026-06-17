<?php
include 'partials/header-blog.php';

$category_query = "SELECT * FROM categoriasblog";
$categorias = mysqli_query($conecction, $category_query);


if(isset($_GET['id'])){
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts_blog WHERE id=$id";
    $result = mysqli_query($conecction, $query);
    $post = mysqli_fetch_assoc($result);
} else {
    header('location: ' . ROOT_URL . 'admin/');
    die();
}
?>
    <section class="form__section">
        <div class="container form__section-container">
            <h2 class="text-center">Editar Entrada de Blog</h2>
            
            <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id" value="<?= $post['id']?>">
                <input type="hidden" name="previous_foto_name" value="<?= $post['foto']?>">
                <input type="text" name="titulo" value="<?= $post['titulo']?>" placeholder="Titulo">
                <select name="categoria">
                <option disabled selected>Categoría</option>
                    <?php while ($category = mysqli_fetch_assoc($categorias)) : ?>
                    <option value="<?=$category['id'] ?>"><?= $category['titulo'] ?></option>
                    <?php endwhile ?>
                </select>
                <textarea rows="10" name="contenido" placeholder="Contenido"><?= $post['contenido']?></textarea>
                <div class="form_control">
                    <label for="post_destacado"> Post Destacado </label>
                    <input class="form-check-input" type="checkbox" id="post_destacado" checked value="1" name="post_destacado">
                </div>
                <div class="form_control inline">
                    <label class="custom-file-label" for="foto">Cambiar Imagen</label>
                    <input type="file" name="foto" class="custom-file-input" id="foto">
                </div>
                <button type="submit" name="submit" class="btn" style="background-color: #1597ee;"> Actualizar Post</button>

            </form>
        </div>
    </section>
    <script src="https://cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('contenido');
</script>
<script src="../js/main.js"></script>
</body>

</html>