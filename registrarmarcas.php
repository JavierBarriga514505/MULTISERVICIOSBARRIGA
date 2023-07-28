<?php include("includes/header.php"); ?>

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
    <!-- Contact-->
    <section class="vh-100">
        <header class="masthead">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <h2 class="mx-auto my-0 text-uppercase">Registrar Marca</h2>
                </div>
            </div><br>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="well well-sm">
                        <form action="guardar_marca.php" method="POST" enctype="multipart/form-data">

                            <input type="hidden" class="form-control" name="usuario" value="<?php echo $_SESSION['id_usuario']; ?>">

                            <div class="mt-2 form-group">
                                <label for="nombreproducto">Nombre de la marca</label>
                                <input type="text" class="form-control" required name="nombremarca" placeholder="Escriba el nombre de su producto">
                            </div>
                            <center><button type="submit" name="guardar" class="btn btn-primary mt-5"> Registrar</button></center>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>