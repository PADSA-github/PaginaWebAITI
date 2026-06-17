<?php
       
    if (isset($_POST['submit'])) {

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $mensaje = $_POST['mensaje'];

        $errors = array();

    if (empty($nombre)) {
        $errors[] = "El campo nombre es obligatorio";
    }
    if (empty($apellido)) {
        $errors[] = "El campo apellido es obligatorio";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "La dirección de correo electrónico no es válida";
    }
    if (empty($telefono)) {
        $errors[] = "El campo teléfono es obligatorio";
    }

    if (count($errors) == 0) {
    
        $destino = "info@ai-ti.com.mx"; 
    $contenido = "Datos de contacto: \n\nNombre: " . $nombre ." ". $apellido . "\nCorreo Electrónico: " . 
    $email . "\nTeléfono: " . $telefono . "\nMensaje: " . $mensaje . "\n\nSolicitud creada en formulario Contáctanos de la página ai-ti.com.mx";
   
    try{
    mail($destino,"Nueva Solicitud de Contacto", $contenido);
    $respuesta = 'Solicitud enviada correctamente. Pronto nos pondremos en contacto con usted';
    
    } catch(Exception $e){
        $respuesta = 'Mensaje ' . $mail->ErrorInfo;
  }
}
    }
?>
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

    <section class="inicio" id="contact">
        <div class="container mt-5" style="padding-top: 30px;">

            <div class="col-md-12">
                <h1 class="text-center" style="font-size: 50px;"> Contáctanos</h1>
                <?php
                if (isset($errors)) {
                    if (count($errors) > 0) {
                ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <?php
                                    foreach ($errors as $error) {
                                        echo $error . '<br>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                }
                    ?>
                     <?php if(isset($respuesta)) { ?>
                        <div class="row">
                        <div class="col-12">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <?php echo $respuesta; ?>
                        </div>
                        </div>
                        </div>
                        <?php } ?>
                    <form class="row g-3" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                        <div class="col-md-6">
                            <i class="bi bi-person-circle"></i>
                            <label for="nombre" class="form-label">Nombre*</label>
                            <input type="text" class="form-control" id="nombre" name="nombre">
                        </div>
                        <div class="col-md-6">
                            <i class="bi bi-person-circle"></i>
                            <label for="apellido" class="form-label">Apellido*</label>
                            <input type="text" class="form-control" id="apellido" name="apellido">
                        </div>
                        <div class="col-md-8">
                            <i class="bi bi-envelope"></i>
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com">
                        </div>
                        <div class="col-md-4">
                            <i class="bi bi-telephone"></i>
                            <label for="telefono" class="form-label">Teléfono*</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="+52 55 1234 5678">
                        </div>
                        <div class="col-md-12">
                            <i class="bi bi-chat-left-text"></i>
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="3" placeholder="Su mensaje"></textarea>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="submit" name="submit" class="btn btn-primary">Enviar
                            </button>
                        </div>
                    </form>
                   
    </section>
    <section class="main">
        <div class="conatiner">
            <div class="wrap">
                <div class="box3">
                    <div class="poster p1">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <h1>Teléfono</h1>
                    <h1>
                        <p>55 5941 6890</p>
                        <p>55 5941 6898</p>
                    </h1>
                </div>
                <div class="box3">
                    <div class="poster p2">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h1>Correo Electrónico </h1>
                    <h1>
                        <p>info@ai-ti.com.mx</p>
                    </h1>
                </div>

                <div class="box3">
                    <div class="poster p3">
                        <i class="bi bi-building"></i>
                    </div>
                    <h1>Nuestras Oficinas</h1>
                    <h1>
                        <p>Viveros de la Floresta #56</p>
                        <p>Viveros de la Loma. C.P. 54080</p>
                        <p>Tlalnepantla de Baz, Estado de México.</p>
                    </h1>
                </div>
            </div>
        </div>
        </div>
    </section>
    <?php
    include 'partials/footer.php';
    ?>
</body>

</html>