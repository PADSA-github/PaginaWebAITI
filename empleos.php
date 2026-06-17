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

<body class="grid-container-empleos">
    <?php
    include 'partials/header.php';
    ?>
    <section class="main__emp">
    
    <iframe id="hiringroom-iframe-id" src="https://hiringroom.com/api/vacancies/get_vacancy_list_frame/aiti" width="100%" frameborder="0" style="max-height:460px;overflow-y:scroll;"></iframe>
	<script type="text/javascript">
		window.addEventListener("message", (e) => {
		if (e.data.height) document.getElementById("hiringroom-iframe-id").height = e.data.height + "px";
		});
	</script>
    </section>
    <?php
    include 'partials/footer.php';
    ?>
</body>

</html>