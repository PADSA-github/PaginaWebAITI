<?php
include 'partials/header-blog.php';

$titulo = $_SESSION['add-category-data']['titulo'] ?? null;
$descripcion = $_SESSION['add-category-data']['descripcion'] ?? null;

unset($_SESSION['add-category-data']);



?>
    <section class="form__section" style="margin-top: 0rem;" >
        <div class="container form__section-container">
            <h2 class="text-center">Agregar Categoría</h2>
            <?php if(isset($_SESSION['add-category'])) : ?>
             <div class="alert__message error">
                <p class= "text-start"> 
                    <?= $_SESSION['add-category'];
                    unset($_SESSION['add-category'])?>
                </p>
            </div> 
            <?php endif ?>
            <form action="<?= ROOT_URL?>admin/add-category-logic.php" method="POST">
                <input type="text" name="titulo" value="<?= $titulo ?>" placeholder="Titulo">
                <textarea rows="4" name="descripcion" value="<?= $descripcion ?>" placeholder="Descripción"></textarea>
                <button type="submit" name="submit" class="btn" style="background-color: #1597ee;"> Agregar Categoría </button>

            </form>
        </div>
    </section>
    <script src="../js/main.js"></script>
</body>
</html>