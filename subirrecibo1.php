<?php include("includes/header.php");

$mensaje1 = $_GET["mensaje"];
$mensaje = base64_decode($mensaje1);
$sql = "SELECT * FROM  compras WHERE id_compra='$mensaje';";
$query = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($query)) {
  $foto_recibo = $row['foto_recibo'];
}
$recibo = 'uploads/noimage.jpeg';
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
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="well well-sm">
        <div class="mt-2 form-group">
          <div class="single-wid-product">
            <center>
              <label for="image">
                <h2>Ver Recibo de Pago </h2>
              </label><br>
              <img src="<?php echo $foto_recibo; ?>" title="Descripcion: Recibo de Compra" class="product-thumb img-thumbnail">
              <center>
                <?php if ($foto_recibo != $recibo) { ?>
                <?php echo 'Imagen Ya subida <br>';
                } else { ?>
                  <form action="guardar_imagen2.php" method="POST" enctype="multipart/form-data">
                    <center>
                      <div class="form-group">
                        <input type="file" name="image" id="image" required class="form-control">
                        <input type="hidden" name="mensaje" id="mensaje" value="<?php echo $mensaje; ?>" class="form-control">
                        <button type="submit" name="guardar" class="btn btn-primary mt-5"> Subir Foto</button><br><br>
                      <?php } ?>
                      <a href="verventas.php"> <button type="button" class="btn btn-light">Volver</button></a>
                    </center>
                    <br>
                  </form>
          </div>
          </center>
        </div>
      </div>
      </center>
    </div>
  </div>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>