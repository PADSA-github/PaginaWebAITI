<?php
require 'config/database.php';
?>

<body class="grid-container">
<header class="header fixed-top" id="header">
        <nav class="navbar navbar-expand-md">
            <div class="container-fluid animate__animated animate__fadeInDown">
                <!--Logotipo-->
                <a class="navbar-brand" href="home.php" id="logo"> 
                    <img src="img/aiti.png"> 
                </a>
                <!--Botón Menu-->
                <button class="navbar-toggler" type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#menu-collapse" 
                    aria-controls="navbarSupportedContent" 
                    aria-expanded="false" 
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--Menu colapsable-->
                <div class="collapse navbar-collapse" id="menu-collapse" style= "background-color: #073E63">
                    <ul class="navbar-nav mx-auto" >
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_URL ?>conocenos.php">Conoce AI-TI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_URL ?>soluciones.php">Soluciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_URL ?>blog.php">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_URL ?>empleos.php">Oportunidades de Empleo</a>
                        </li>
                    </ul>
                    <!--Redes Sociales-->
                    <ul class="navbar-nav flex-row flex-wrap md-auto" >
                        <li class="nav-item col-4 col-md-auto">
                            <a class="nav-link" href="https://www.facebook.com/profile.php?id=100083620180531"> 
                                <i class="bi bi-facebook"></i> 
                            </a>
                        </li>
                        <li class="nav-item col-4 col-md-auto">
                            <a class="nav-link" href="https://twitter.com/AI_TI_SAdeCV"> 
                                <i class="bi bi-twitter"></i> 
                            </a>
                        </li>
                        <li class="nav-item col-4 col-md-auto">
                            <a class="nav-link" href="https://www.linkedin.com/in/ai-ti-sa-de-cv-5577b823b/">
                                <i class="bi bi-linkedin"></i> 
                            </a>
                        </li>
                    </ul>
                    <!--Boton Contacto-->
                    <form class="d-flex">
                        <a href="<?= ROOT_URL ?>contacto.php" class="btn btn-info" role="button">Contacto</a>
                    </form>
                </div>
             </div>
        </nav>
    </header>