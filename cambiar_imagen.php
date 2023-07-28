<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

$producto = $_GET["id"];
$id_producto = base64_decode($producto);

$consulta = "SELECT * FROM productos WHERE id_producto='$id_producto';";
$resul = mysqli_query($con, $consulta);
while ($row = mysqli_fetch_array($resul)) {
    $imagen = $row['foto_producto'];
    $nombre_producto = $row['nombre_producto'];
}

include("includes/header.php");
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
    <!-- Contact-->
    <section class="vh-100">

        <header class="masthead">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <h2 class="mx-auto my-0 text-uppercase">Actualizar Fotografia del Producto</h2>
                    <h3> <?php echo $nombre_producto; ?></h3>
                </div>
            </div><br>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="well well-sm">
                        <form action="guardar_imagen.php" method="POST" enctype="multipart/form-data">
                            <center>
                                <div class="form-group">
                                    <img src="<?php echo $imagen ?>" width="400" height="341">
                                    <div>
                            </center>
                            <input type="hidden" class="form-control" name="idproducto" value="<?php echo $id_producto; ?>">
                            <div class="form-group">
                                <label for="image" class="col-sm-2 control-label">Sube la Fotografia del Producto </label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" id="image" required class="form-control">
                                </div>
                            </div>
                            <br>
                            <center><button type="submit" name="guardar" class="btn btn-primary mt-5"> Actualizar Foto</button></center>
                        </form>
                        <center> <br>
                            <a class="btn btn-danger js-scroll-trigger" href="ver_producto.php">Regresar</a>
                        </center>
                    </div>
                </div>
            </div>
        </div> <br><br></div>
        </div>
    </section>
    <div class="footer">
        <?php include("includes/piedepagina1.php"); ?>
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