<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoria</title>
    <!--Boostrap y CSS-->
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/blog.css">
    <link rel="stylesheet" href="./css/header-nav-footer.css">
    <link rel="stylesheet" href="./css/efectos.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./js/bootstrap.min.js">
    <link rel="stylesheet" href="./animate.css/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!--Fonts-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="grid-container-categorias">
    <?php
    include 'partials/header.php';

    if (isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM posts_blog WHERE id_categoria=$id ORDER BY fecha_hora DESC";
        $posts = mysqli_query($conecction, $query);
    } else {
        header('location: ' . ROOT_URL . 'blog.php');
        die();
    }
    ?>

    <section class="main__cat">
        <header class="category__title">
            <h2>
                <?php
                $id_categoria = $id;
                $categoria_query = "SELECT * FROM categoriasblog WHERE id=$id";
                $categoria_result = mysqli_query($conecction, $categoria_query);
                $categoria = mysqli_fetch_assoc($categoria_result);
                echo $categoria['titulo'];
                ?>
            </h2>
        </header>
        <?php if (mysqli_num_rows($posts) > 0) : ?>
        <section class="posts">
            <div class="container posts__container" style="margin-top:20px; margin-bottom:-10px;">
                <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                    <article class="post">
                        <div class="post__thumbnail">
                            <img src="./img_cargas/<?= $post['foto'] ?>">
                        </div>
                        <div class="post__info">
                            <h2><a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"> <?= $post['titulo'] ?> </a></h2>
                            <p class="post_body text-start">
                            <?= strip_tags (html_entity_decode(substr($post['contenido'], 0, 300))) ?>...
                            </p>
                            <div class="post__author">
                                <?php
                                $id_autor = $post['id_autor'];
                                $autor_query = "SELECT * FROM usuarios WHERE id=$id_autor";
                                $autor_result = mysqli_query($conecction, $autor_query);
                                $autor = mysqli_fetch_assoc($autor_result);

                                ?>
                                <div class="post__author-avatar">
                                    <img src="./img_cargas/<?= $autor['avatar'] ?>">
                                </div>
                                <div class="post__author-info">
                                    <h5> Por: <?= "{$autor['nombre']} {$autor['apellido']}" ?> </h5>
                                    <small>
                                        <?= date("M d, Y - H:i", strtotime($post['fecha_hora'])) ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile ?>
            </div>
        </section>
        <?php else :  ?>
            <div class="alert__message error" style="margin-top: 5rem;">
                <h4 class="text-center"> No se encontraron entradas para esta categoría </h4>
            </div>
        <?php endif ?>
        <!-- Botones Categorías -->
        <section class="category__buttons">
            <div class="container category__buttons-container" >
                <?php 
                $all_categories_query = "SELECT * FROM categoriasblog";
                $all_categories = mysqli_query($conecction, $all_categories_query);
                ?>
                <?php while($categoria = mysqli_fetch_assoc($all_categories)) : ?>
                <a href="<?= ROOT_URL?>category-posts.php?id=<?= $categoria['id'] ?>" class="category__button"><?=$categoria['titulo'] ?></a>
            <?php endwhile ?>
            </div>
        </section>
    </section>
    <?php
    include 'partials/footer_blog.php';
    ?>
    <script src="./js/main.js"></script>
</body>

</html>