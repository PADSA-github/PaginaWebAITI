<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AITI</title>
    <link rel="icon" href="img/aiti.png" />
    <!--Boostrap y CSS-->
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/blog.css">
    <link rel="stylesheet" href="./css/header-nav-footer.css">
    <link rel="stylesheet" href="./css/movil.css">
    <link rel="stylesheet" href="./css/efectos.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./js/bootstrap.min.js">
    <link rel="stylesheet" href="./animate.css/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&family=Josefin+Slab&family=Montserrat&family=Poppins&display=swap" rel="stylesheet">

    
    <?php
    include 'partials/header.php';

    $featured_query = "SELECT * FROM posts_blog WHERE destacado=1";
    $featured_result = mysqli_query($conecction, $featured_query);
    $featured = mysqli_fetch_assoc($featured_result);

    $featured_emp_query = "SELECT * FROM vacantes WHERE destacado=1";
    $featured_emp_result = mysqli_query($conecction, $featured_emp_query);
    $featured_emp = mysqli_fetch_assoc($featured_emp_result);
    ?>


    <section class="inicio">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="title-container">
                        <div class="title-mask">
                            <h1 class="title-content">
                                <span class="title-highlight">innovación en TI</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="main">
        <!--Sección Sobre AI-TI-->
        <section class="contenido" id="about">
            <ul class="section-content list-unstyled">
                <li class="about-left animate__animated animate__backInLeft"></li>
                <li class="about-right">
                    <h3 class="section-title"> Sobre <span>AI-TI</span></h3>
                    <p> AI-TI surge en 2012 con la perspectiva de ofrecer soluciones empresariales a través de la consultoría e incorporación
                        de recursos externos a nuestros socios, debido a la constante dinámica del área de Tecnologías de Información.
                    </p>
                    <p>
                        Nuestros logros nos han permitido colaborar con empresas líderes a nivel nacional y ampliando nuestra participación en el extranjero.
                    </p>
                    <p>
                        La capacitación y adaptación permanente han sido nuestro lema, que nos permite avanzar estrechamente con nuestros socios en el innovador mundo tecnológico
                    </p>
                    <a class="btn btn-primary" href="conocenos.php" role="button">Conocer más</a>
                </li>
            </ul>
        </section>
        <!--Banner con Parallax-->
        <div class="parallax" style="background-image: url(img/servsol.jpg)">
            <h1 class=" text-center" style="color: white;">Servicios y soluciones</h1>
        </div>
        <!--Servicios y soluciones-->
        <section class="contenido" id="servicios">
            <ul class="section-content list-unstyled">
                <li class="servicios-left">
                    <p>En AI-TI tenemos la experiencia necesaria para hacer crecer tu empresa ofreciendo servicios de innovación tecnológica de calidad de manera progresiva y eficiente para llegar a nuevos mercados de forma competitíva.
                    </p>
                    <div class="text-end" style="padding: 10px;">
                        <a class="btn btn-primary " href="soluciones.php" role="button">Conocer más</a>
                    </div>
                    <img class="img-contenido" src="img/servsol.gif">
                </li>
                <!-- Lista Servicios y Soluciones-->
                <li class="servicios-right">
                    <div class="container">
                        <div class="row row-cols-1">
                            <div class="con justify-content-center align-content-center">
                                <div class="front ">
                                    <i class="bi bi-terminal" style="font-size: 70px;"></i>
                                    <h1> Servicios de Aplicaciones</h1>
                                </div>
                                <div class="overlay">
                                    <div class="texto-back justify-content-center align-content-center">
                                        <p style="line-height: 0.5;">Desarrollo de aplicaciones</p>
                                        <p style="line-height: 0.5;">Administración de aplicaciones</p>
                                        <p style="line-height: 0.5;">Definición de requerimientos e ideas de negocio</p>
                                        <p style="line-height: 0.5;">Ejecución de Pruebas y QA</p>
                                        <p style="line-height: 0.5;">Implementación de Soluciones </p>
                                    </div>
                                </div>
                            </div>
                            <div class="con justify-content-center align-content-center">
                                <div class="front">
                                    <i class="bi bi-file-code" style="font-size: 70px;"></i>
                                    <h1> Productos</h1>
                                </div>
                                <div class="overlay">
                                    <div class="texto-back justify-content-center align-content-center">
                                        <p>Contamos con productos dirigidos a mejorar áreas administrativas y operativas de nuestros
                                            clientes simplificando las tareas.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="con justify-content-center align-content-center">
                                <div class="front ">
                                    <i class="bi bi-terminal" style="font-size: 70px;"></i>
                                    <h1> Fábrica de Software</h1>
                                </div>
                                <div class="overlay">
                                    <div class="texto-back justify-content-center align-content-center">
                                        <p>Desarrollo de soluciones en apego a métricas y estándares de desarrollo con profesionalismo y compromiso a el cliente.</p>
                                        <p>Eficientamos la forma de desarrollar soluciones que entreguen valor a nuestros clientes con mayor calidad y velocidad.</p>
                                        <p>Entrega de documentación de referencia a las soluciones desarrolladas.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </li>
            </ul>
        </section>
        <!--Banner con Parallax-->
        <div class="parallax" style="background-image: url(img/bannerwork.jpg)">
            <h1 class=" text-center" style="color: white;">Trabaja con nosotros</h1>
        </div>
        <!--Trabaja con Nosotros-->
        <section class="contenido" id="empleo">
            <ul class="section-content list-unstyled">
                <li class="empleo-left">
                    <h2 class="text-enc" style="color:  #073E63">En AI-TI buscamos tu talento</h2>
                    <p>Envía tus datos o aplica a una de nuestras vacantes activas.
                    </p>
                    <div class="text-end" style="padding: 10px;">
                        <a class="btn btn-primary " href="empleos.php" role="button"> Ver todas las vacantes </a>
                    </div>
                    <img class="img-contenido" src="img/job.gif">
                </li>
                <li class="empleo-right" style="margin-top:1rem;">
                <iframe id="hiringroom-iframe-id" src="https://hiringroom.com/api/vacancies/get_vacancy_list_frame/aiti" width="100%" frameborder="0" style="max-height:550px;overflow-y:scroll;"></iframe>
	<script type="text/javascript">
		window.addEventListener("message", (e) => {
		if (e.data.height) document.getElementById("hiringroom-iframe-id").height = e.data.height + "px";
		});
	</script>
                </li>
            </ul>
        </section>
        <!--Banner con Parallax-->
        <div class="parallax" style="background-image: url(img/newsblog.jpg)">
            <h1 class=" text-center" style="color: white;">Blog AI-TI</h1>
        </div>
       <!-- Blog-->
       <section class="contenido" id="blog">
            <ul class="section-content list-unstyled">
                
                <li class="blog-right">
                    <?php if (mysqli_num_rows($featured_result) == 1) : ?>
                        <section class="featured" style="margin-top: 1rem;">
                            <div class="container featured__container animate__animated animate__fadeInDown">
                                <div class="post__thumbnail">
                                    <a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"> <img src="./img_cargas/<?= $featured['foto'] ?>"></a>
                                </div>
                                <div class="post__info">
                                    <?php
                                    $id_categoria = $featured['id_categoria'];
                                    $categoria_query = "SELECT * FROM categoriasblog WHERE id=$id_categoria";
                                    $categoria_result = mysqli_query($conecction, $categoria_query);
                                    $categoria = mysqli_fetch_assoc($categoria_result);

                                    ?>
                                    <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $categoria['id'] ?>" class="category__button"> <?= $categoria['titulo'] ?> </a>
                                    <h2 class="post__title"><a href="<?= ROOT_URL ?>post.php?id=<?= $featured['id'] ?>"> <?= $featured['titulo'] ?> </a></h2>
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
                                    <div class="text-center boton_blog" style="padding: 20px; padding-bottom: 100px">
                        <a class="btn btn-primary " href="blog.php" role="button"> Visita el blog completo </a>
                    </div>
                                </div>
                               
                        </section>
                    <?php endif ?>
                </li>
            </ul>
        </section>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?php
    include 'partials/footer.php';
    ?>
    </body>
</html>

