<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AITI</title>
    <link rel="icon" href="img/aiti.png" />
    <!--Boostrap y CSS-->
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/header-nav-footer.css">
    <link rel="stylesheet" href="./css/efectos.css">
    <link rel="stylesheet" href="./css/pag-conocenos.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./js/bootstrap.min.js">
    <link rel="stylesheet" href="./animate.css/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amaranth&family=Josefin+Slab&family=Montserrat&family=Poppins&display=swap" rel="stylesheet">

</head>

<body class="grid-container" id="about-inicio">
    <?php
    include 'partials/header.php';
    ?>

    <section class="inicio">
        <section class="contenido" >
            <div class="container-fluid section-content list-unstyled">
                <div class="row">

                    <div class="about-inicio-left animate__animated animate__backInLeft">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="title-container2">
                                        <div class="title-mask">
                                            <h1 class="title-content">
                                                <span class="title-highlight" style="font-size: .8em;">Sobre AITI</span>
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="about-inicio-right">


                            <p> AI-TI surge en 2012 con la perspectiva de ofrecer soluciones empresariales a
                                través de la consultoría e incorporación de recursos externos a nuestros socios,
                                debido a la constante dinámica del área de Tecnologías de Información.
                            </p>
                            <p>AI-TI se consolida como una organización que brinda ventajas competitivas, debido
                                a las alianzas estratégicas establecidas con diversos propietarios de software
                            </p>
                            <p>
                                Nuestros logros nos han permitido colaborar con empresas líderes a nivel nacional y
                                ampliando nuestra participación en el extranjero.
                            </p>
                            <p>
                                La capacitación y adaptación permanente han sido nuestro lema, que nos permite avanzar estrechamente con nuestros socios en el innovador mundo tecnológico
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </section>
    <section class="main">
        <div class="grid">
            <div class="container">
                <div class="row valores d-flex justify-content-center">
                    <div class="col elemento">
                        <div class="box" style="background-image: url(img/mision.jpg)">
                            <h3 class="text-center"> Misión </h3>
                            <div class="back">
                                <h3 class="cont">Innovar, ofrecer y desarrollar soluciones en TI a nuestros clientes eficientando sus procesos,
                                    áreas funcionales y operativas para el cumplimiento de sus objetivos y metas, posicionándolos como líderes
                                    del mercado.</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col elemento">
                        <div class="box" style="background-image: url(img/vision.jpg)">
                            <h3 class="text-center"> Visión </h3>
                            <div class="back">
                                <h3 class="cont">Ser una consultora competitiva capaz de ofrecer servicios, soluciones y productos en TI con la
                                    mayor calidad y el menor riesgo a medianas y grandes empresas. </h3>
                                <h3 class="cont">Ofreciendo las tecnologías mas actuales del
                                    mercado por encima de nuestros competidores para México, LATAM, Estados Unidos y Canadá.</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col elemento">
                        <div class="box" style="background-image: url(img/objetivo.jpg)">
                            <h3 class="text-center"> Objetivos</h3>
                            <div class="back">
                                <h3 class="cont"> Participar como socios de negocios con las empresas, aportando nuestros conocimientos y experiencia,
                                    para la creación de soluciones y productos.</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col elemento">
                        <div class="box" style="background-image: url(img/valores.jpg)">
                            <h3 class="text-center"> Valores </h3>
                            <div class="back">
                                <h3 class="cont">Lealtad</h3>
                                <h3 class="cont">Perseverancia</h3>
                                <h3 class="cont">Tenacidad</h3>
                                <h3 class="cont">Pro-actividad</h3>
                                <h3 class="cont">Compromiso.</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Banner con Parallax-->
        <div class="parallax" style="background-image: url(img/clientes.jpg)">
            <h1 class=" text-center" style="color: white">Casos de Éxito</h1>
        </div>
        <!--Clientes-->
        <!--
        <section class="contenido" id="clientes">
            <ul class="section-content list-unstyled" style="background-color: #073E63">
                <li class="clientes-left">
                    <h2 class="text-end">Lo más importante para AI-TI son nuestros clientes.</h2>
                    <p>Este compromiso se traduce en pasión por el servicio y profesionalismo comprometiéndonos en la resolución de tus necesidades.</p>
                    <p>La satisfacción de nuestros clientes es nuestra mejor carta de presentación.</p>
                    <div class="text-end" style="padding: 10px;">
                        <img class="img-contenido-clientes" src="img/clientes.gif">
                    </div>

                </li>
                <li class="clientes-right">
                    <div class="container">
                        <hr class="mt-2 mb-5">
                        <div class="row text-center text-lg-start">
                            <div class="col-md-4 col-sm-6">
                                <a href="#" class="d-block mb-4 h-100">
                                    <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/AvhMzHwiE_0/400x300" alt="">
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <a href="#" class="d-block mb-4 h-100">
                                    <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/2gYsZUmockw/400x300" alt="">
                                </a>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <a href="#" class="d-block mb-4 h-100">
                                    <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/EMSDtjVHdQ8/400x300" alt="">
                                </a>
                            </div>
                        </div>
                </li>
            </ul>
        </section> -->
         <section class="contenido" id="clientes">
        <div class="card-group">
            <div class="card">
                <img src="img/cuenta.jpg" class="card-img-top" alt="..." >
                <div class="card-body">
                    <h5 class="card-title text-center">Grupo C1FRA</h5>
                    <p class="card-text text-center"><small> Cuenta por Pagar SICAPLUS</small></p>
                    <p class="card-text text-center"><small>1995-1996</small></p>
                    <p class="card-text text-center">Generación de la Cuenta por Pagar para todos los negocios del grupo C1FRA</p>
                   
                </div>
            </div>
            <div class="card">
                <img src="img/cedis.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title text-center">Wal-Mart de México y Centro América, S. de R.L. de C.V. </h5>
                    <p class="card-text text-center"><small>  Oasys Radiofrecuencia</small></p>
                    <p class="card-text text-center"><small> 2001</small></p>
                    <p class="card-text text-center">
                    Cedis Tiendas Vips. Se realizo la integración de sistema de Radiofrecuencia para las operaciones de Recibo y Distribución del Cedis Tiendas Vips.

                    </p>
                   
                </div>
            </div>
            <div class="card">
                <img src="img/desarrollo.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                <h5 class="card-title text-center">Wal-Mart de México y Centro América, S. de R.L. de C.V. </h5>
                    <p class="card-text text-center"><small>  MART-PLUS</small></p>
                    <p class="card-text text-center"><small> 2001</small></p>
                    <p class="card-text text-center">
                    Se realizó una re - ingenieria de procesos de la Cuenta por pagar, para la producción Batch, que se ejecutan en el site del Mainframe IBM-9121 de Bentonville, Ar. Reduciendo los tiempo de ejecución de 250 min hasta 37 min, logrando un reducción en el consumo de tiempo maquina hasta un 87%.

                    </p>
                   
                </div>
            </div>
        </div>
</section>
        <!--Banner con Parallax-->
        <div class="parallax" style="background-image: url(img/servsol.jpg)">
            <h1 class=" text-center" style="color: white;">Innovando</h1>
        </div>
        <!--Innovando-->
        <section class="contenido" id="innovando" style="background-color: #073E63">
            <ul class="section-content list-unstyled">
                <li class="innova-left animate__animated animate__backInLeft"></li>
                <li class="innova-right">
                    <p>
                        Tenemos como objetivos el progreso y la competitividad dentro del mercado tecnológico, empleando como herramientas
                        la innovación y la constante formulación de modelos de negocio rentables para las necesidades de nuestros clientes
                        a través del mundo digital.
                    </p>
                    <p>
                        Los cambios tan acelerados obliga a las organizaciones a implementar procesos de modernización que les permitan hacer
                        frente a los nuevos retos de manera dinámica optimizando sus procesos operativos con la finalidad de potenciar la
                        innovación, reducir costos de desarrollo, soporte y mantenimiento.
                    </p>
                    <p>
                        En AI-TI tenemos la experiencia necesaria para hacer crecer tu empresa ofreciendo servicios de innovación tecnológica de
                        calidad de manera progresiva y eficiente para llegar a nuevos mercados de forma competitiva.
                    </p>
                </li>
            </ul>
        </section>
    </section>
    <?php
    include 'partials/footer.php';
    ?>
</body>

</html>