<?php
include 'partials/header-blog.php';


$query = "SELECT * FROM categoriasblog";
$categorias = mysqli_query($conecction, $query);

$titulo = $_SESSION['add-post-data']['titulo'] ?? null;
$contenido = $_SESSION['add-post-data'] ['contenido'] ?? null;

unset($_SESSION['add-post-data']);
?>
    <section class="form__section">
        <div class="container form__section-container">
            <h2 class="text-center">Nueva Entrada de Blog</h2>
           <?php if(isset($session['add-post'])) : ?>
                <div class="alert__mesage error">
                 <p> 
                    <?= $_SESSION['add-post'];
                    unset($_SESSION['add-post']);
                    ?>
                 </p>
                </div>
                <?php endif ?>
            <form action="<?= ROOT_URL ?>admin/add-post-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="titulo" value="<?=$titulo ?>" placeholder="Titulo">
                <select name="categoria">
                    <option disabled selected>Categoría</option>
                    <?php while ($category = mysqli_fetch_assoc($categorias)) : ?>
                    <option value="<?=$category['id']?>"><?= $category['titulo'] ?></option>
                   <?php endwhile ?>
                </select>
                <textarea rows="10" name="contenido" placeholder="Contenido"><?=$contenido?></textarea>
                <div class="form_control">
                    <label for="post_destacado"> Post Destacado </label>
                    <input class="form-check-input" name="post_destacado" value="1" type="checkbox" id="post_destacado" checked>
                </div>
                <div class="form_control inline">
                    <label class="custom-file-label" for="foto">Agregar Imagen</label>
                    <input type="file" name="foto" class="custom-file-input" id="foto">
                </div>
                <button type="submit" name="submit" class="btn" style="background-color: #1597ee;">Agregar Post </button>

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