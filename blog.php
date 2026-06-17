<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AITI</title>
    <link rel="icon" href="img/aiti.png" />
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&family=Josefin+Slab&family=Montserrat&family=Poppins&display=swap" rel="stylesheet">

</head>

<body class="grid-container">
    <?php
    include 'partials/header.php';

    $featured_query = "SELECT * FROM posts_blog WHERE destacado=1";
    $featured_result = mysqli_query($conecction, $featured_query);
    $featured = mysqli_fetch_assoc($featured_result);
    

    $post_query = "SELECT * FROM posts_blog ORDER BY fecha_hora DESC";
    $posts = mysqli_query($conecction, $post_query);
    ?>
    <section class="inicio__blog">
        <?php if (mysqli_num_rows($featured_result) == 1) : ?>
            <section class="featured">
                <div class="container featured__container">
                    <div class="post__thumbnail">
                    <a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"><img src="./img_cargas/<?= $featured['foto'] ?>"></a>
                    </div>
                    <div class="post__info">
                        <?php
                        $id_categoria = $featured['id_categoria'];
                        $categoria_query = "SELECT * FROM categoriasblog WHERE id=$id_categoria";
                        $categoria_result = mysqli_query($conecction, $categoria_query);
                        $categoria = mysqli_fetch_assoc($categoria_result);

                        ?>
                        <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $featured['id_categoria'] ?>" class="category__button"> <?= $categoria['titulo'] ?> </a>
                        <h2 class="post__title">
                            <a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"> <?= $featured['titulo'] ?> </a></h2>
                        <p class="post_body text-start">
                       
                            <?= strip_tags (html_entity_decode(substr($featured['contenido'], 0, 300))) ?>...
                        </p>
                        <div class="post__author">
                            <?php
                            $id_autor = $featured['id_autor'];
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
                                    <?= date("M d, Y - H:i", strtotime($featured['fecha_hora'])) ?>
                                </small>
                            </div>
                        </div>
                    </div>
            </section>
        <?php endif ?>
        <!-- Botones Categorías -->
        <section class="main">
        <section class="category__buttons <?= $featured ? '' : 'section__extra-margin' ?>">
            <div class="container category__buttons-container">
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
   
        <!-- Serie de Blogs-->
        <section class="posts" >
            <div class="container posts__container">
                <?php while ($post = mysqli_fetch_assoc($posts)) : ?>
                    <article class="post">
                        <div class="post__thumbnail">
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"> <img src="./img_cargas/<?= $post['foto'] ?>"></a>
                        </div>
                        <div class="post__info">
                            <?php
                            $id_categoria = $post['id_categoria'];
                            $categoria_query = "SELECT * FROM categoriasblog WHERE id=$id_categoria";
                            $categoria_result = mysqli_query($conecction, $categoria_query);
                            $categoria = mysqli_fetch_assoc($categoria_result);

                            ?>
                            <a href="<?= ROOT_URL?>category-posts.php?id=<?= $post['id_categoria']?>" class="category__button"> <?=$categoria['titulo'] ?> </a>
                            <h2><a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"> <?= $post['titulo'] ?> </a></h2>
                            <p class="post_body text-start">
                            <?= strip_tags (html_entity_decode(substr($featured['contenido'], 0, 300))) ?>...
                            </p>
                            <div class="post__author" style="margin-bottom: 5rem;">
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
    </section>
    <?php
    include 'partials/footer_blog.php';
    ?>

</body>

</html>