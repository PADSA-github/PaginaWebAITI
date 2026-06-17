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
    <link rel="stylesheet" href="./css/movil.css">
    <link rel="stylesheet" href="./css/soluciones.css">
    <link rel="stylesheet" href="./css/contacto.css">
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
    ?>

    <section class="inicio">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="title-container">
                        <div class="title-mask">
                            <h1 class="title-content">
                                <span class="title-highlight">Soluciones</span>
                                <p>Servicios</p>
                                <p>Productos</p>
                                <p>Fábrica de Software</p>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="main">
        <!--Banner con Parallax-->
        <div class="parallax" style="background-image: url(img/servsol.jpg)">
            <h1 class=" text-center" style="color: white;">Servicios</h1>
        </div>
        <!--Servicios-->
        <section class="contenido" id="servicios">
            <div class="conatiner">
                <div class="wrap">
                    <div class="box">
                        <h1>Desarrollo de Aplicaciones</h1>
                        <div class="poster p1">
                            <i class="bi bi-terminal"></i>
                        </div>
                    </div>
                    <div class="box">
                        <h1>Definición de requerimientos e ideas de negocio </h1>
                        <div class="poster p2">
                            <i class="bi bi-card-checklist"></i>
                        </div>
                    </div>

                    <div class="box">
                        <h1>Administración de Aplicaciones </h1>
                        <div class="poster p3">
                            <i class="bi bi-journal-code"></i>
                        </div>
                    </div>

                    <div class="box">
                        <h1>Pruebas & QA</h1>
                        <div class="poster p4">
                            <i class="bi bi-code-slash"></i>
                        </div>
                    </div>

                    <div class="box">
                        <h1>Soporte de Aplicaciones</h1>
                        <div class="poster p5">
                            <i class="bi bi-wrench"></i>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="section-title"> Servicios en <span>Cloud</span></h3>
            <div class="conatiner">
                <div class="wrap">
                    <div class="box2">
                        <h1>Arquitectura de Soluciones Cloud y Multicloud</h1>
                        <div class="poster p1">
                            <i class="bi bi-cloud"></i>
                        </div>
                    </div>
                    <div class="box2">
                        <h1>Servicio de migración e integración de soluciones a Cloud y Multicloud </h1>
                        <div class="poster p2">
                            <i class="bi bi-arrow-down-up"></i>
                        </div>
                    </div>

                    <div class="box2">
                        <h1>Consultoría, implementación desarrollo y gestión de soluciones</h1>
                        <div class="poster p3">
                            <i class="bi bi-pc-display"></i>
                        </div>
                    </div>

                    <div class="box2">
                        <h1>Consultoría de implementación de DRP y BCP</h1>
                        <div class="poster p4">
                            <i class="bi bi-hdd-rack"></i>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!--Banner con Parallax-->
        <div class="parallax" style="background-image: url(img/servsol.jpg)">
            <h1 class=" text-center" style="color: white;"> Productos</h1>
        </div>
        <!--Productos-->
        <section class="contenido" id="productos">
            <ul class="section-content-productos list-unstyled">
                <li class="productos-left animate__animated animate__backInLeft" style="background-image: url(img/producto.jpg);"></li>
                <li class="productos-right">
                    <p> Contamos con productos dirigidos a mejorar áreas administrativas y
                        operativas de nuestros clientes simplificando las tareas.</p>
                </li>
            </ul>
        </section>
        <!--Banner con Parallax-->
        <div class="parallax" style="background-image: url(img/servsol.jpg)">
            <h1 class=" text-center" style="color: white;"> Fábrica de Software</h1>
        </div>
        <!--Fábrica de Software-->
        <section class="contenido" id="fabrica" style="background-color: #073E63">
            <ul class="section-content-fabrica list-unstyled">

                <li class="fabrica-left " style="background-color:#073E63;">
                    <img class="text-center animate__animated animate__backInLeft" src="img/FabSW.png">
                </li>


                <li class="fabrica-right">
                    <p> En AI-TI estamos enfocados en el desarrollo de soluciones tecnológicas por medio de la creación
                        y aprovechamiento de código con el objetivo de resolver las necesidades de nuestros clientes y
                        apoyar en alcanzar sus objetivos, teniendo siempre presente la innovación, agilidad y el apego a las métricas
                        y estándares de desarrollo. </p>
                    <p>
                        La fábrica de Software ha permitido la generación de proyectos aprovechando los recursos y conocimientos adquiridos.
                        Para obtener procesos eficaces y funcionales, nos hemos comprometido a supervisar cada fase de los procesos asegurando su calidad e
                        impulsando a la integración continua.
                    </p>

                </li>
            </ul>

            <div class="conatiner">
                <div class="wrap" id="fabricaSW">
                    <div class="box3">
                        <div class="poster p1">
                            <i class="bi bi-kanban"></i>
                        </div>
                        <h1>Oficina de Proyectos</h1>
                        <h1>
                            <p>Manejo de metodologías ágiles: Scrum, Kanban, Lean.</p>
                            <p>Reportes de indicadores y estatus oportuno</p>
                            <p>Administración de riesgos</p>
                            <p>Enfoque en entrega de valor</p>
                        </h1>
                    </div>
                    <div class="box3">
                        <div class="poster p2">
                            <i class="bi bi-list-check"></i>
                        </div>
                        <h1>Análisis y Diseño </h1>
                        <h1>
                            <p>Levantamiento de requerimientos</p>
                            <p>Generación de especificaciones técnicas y fundamentales</p>
                            <p>Modelado de Datos</p>
                            <p>Prototipado
                            <p>
                        </h1>
                    </div>
                    <div class="box3">
                        <div class="poster p1">
                            <i class="bi bi-bullseye"></i>
                        </div>
                        <h1>Estándares de Calidad</h1>
                        <h1>
                            <p>Pruebas Automatizadas</p>
                            <p>Versionamiento y depuración de código y entregables.</p>

                        </h1>
                    </div>

                </div>
            </div>
            </div>


            <div class="box4">

                <h1>Desarrollo</h1>
                <h2>

                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img/logo-mainframe.png" class="rounded mx-auto d-block" alt="mainframe">
                            </div>
                            <div class="carousel-item">
                                <div class="row cloud">
                                    <div class="col-md-4">
                                        <img src="img/GCP.png" class="rounded mx-auto d-block" alt="Google CLoud">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="img/azure.png" class="rounded mx-auto d-block" alt="azure">
                                    </div>
                                    <div class="col-md-4 ">
                                        <img src="img/aws.png" class="rounded mx-auto d-block" alt="aws" style="height: 80px; margin-top: 30px">
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="img/premise.png" class="rounded mx-auto d-block" alt="On-Premise">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </h2>
            </div>
        </section>




    </section>
    <?php
    include 'partials/footer.php';
    ?>
</body>

</html>