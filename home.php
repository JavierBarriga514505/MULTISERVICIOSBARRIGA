<?php include("includes/header.php");
if ($_SESSION['rol'] == 1 or $_SESSION['rol'] == 2) {
    $variable = "ver_producto.php";
} else {
    $variable = "ver_producto1.php";
}
?>

<head>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Masthead-->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
                <br>
                <h1 class="mx-auto my-0 text-uppercase">MULTISERVICIOS BARRIGA</h1>
                <br>
                <h3 class="text-black-50 mx-auto mt-2 mb-5">Plataforma web para la comercalizacion de repuestos automotrices para la empresa MULTISERVICIOS BARRIGA en Saldaña - Tolima</h3>
                <h4 class="text-black-50 mx-auto mt-2 mb-5"> ¿Quieres conocer mas acerca de nuestros productos? <a class="btn btn-primary js-scroll-trigger" href="<?php echo $variable; ?>">Click Aquí</a>
                </h4>
            </div>
        </div><br>
    </header>
    <!-- Contact-->
    <section class="contact-section bg-black">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Ubicación</h4>
                            <hr class="my-4" />
                            <div class="small text-black-50">Saldaña-Tolima, Colombia</div>
                            <div class="small text-black-50">Espinal-Tolima, Colombia</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">CONTÁCTENOS</h4>
                            <hr class="my-4" />
                            <div class="small text-black-50"><a target="_blank" href="https://www.facebook.com/EnriqueFlorian.524">Javier Enrique Barriga Florian,</a></div>
                            <div class="small text-black-50"><a target="_blank">Correo:jbarriga95@itfip.edu.co</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Telefonos</h4>
                            <hr class="my-4" />
                            <div class="small text-black-50">+57 3106187237</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <div class="footer">
        <?php include("includes/piedepagina.php"); ?>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>