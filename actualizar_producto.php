<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

$producto = $_GET["id"];
$codigo = $_GET["codigo"];
$id_producto = base64_decode($producto);
$codigo_producto = base64_decode($codigo);

$consulta = "SELECT * FROM productos, detalle_producto WHERE productos.id_producto=detalle_producto.id_producto and productos.codigo_producto=detalle_producto.referencia_producto and detalle_producto.referencia_producto='$codigo_producto'and 	detalle_producto.id_producto='$id_producto'
		and detalle_producto.movimiento_producto='1' order by detalle_producto.fecha_producto DESC LIMIT 1;";
$resul = mysqli_query($con, $consulta);
while ($row = mysqli_fetch_array($resul)) {
  $imagen = $row['foto_producto'];
  $nombre_producto = $row['nombre_producto'];
  $cantidad = $row['cantidad_producto'];
  $precioproveedor = $row['precio_producto'];
  $preciopublico = $row['precio_publico'];
  $descripcion = $row['descripcion_producto'];
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
          <h3 class="mx-auto my-0 text-uppercase">Actualizar Informacion del Producto</h3>
          <h4> <?php echo $codigo_producto . ' - ' . $nombre_producto; ?></h4>
        </div>
      </div><br>
    </header>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="well well-sm">
            <center>
              <div class="form-group">
                <img src="<?php echo $imagen ?>" width="200" height="141">
                <div>
            </center>
            <div class="mt-2 form-group">
              <label for="cantidad">Descripcion</label>
              <textarea class="form-control" readonly name="descripcion">
	<?php echo $descripcion; ?> 
	</textarea>
            </div>
            <div class="mt-2 form-group">
              <label for="cantidad">Cantidad en Stock</label>
              <input type="number" class="form-control" readonly placeholder="Cantidad del producto" value="<?php echo $cantidad; ?>" name="cantidad">
            </div>
            <div class="mt-2 form-group">
              <label for="cantidad">Precio al Proveedor</label>
              <input type="number" class="form-control" readonly placeholder="Precio del proveedor del producto" value="<?php echo $precioproveedor; ?>" name="pproveedor">
            </div>
            <div class="mt-2 form-group">
              <label for="cantidad">Precio al Publico</label>
              <input type="number" class="form-control" readonly placeholder="Precio al publico del producto" value="<?php echo $preciopublico; ?>" name="ppublico">
            </div>
            <input type="hidden" class="form-control" name="idproducto" value="<?php echo $id_producto; ?>">
            <input type="hidden" class="form-control" name="codigoproducto" value="<?php echo $codigo_producto; ?>">
            <BR>
            <center>
              <a href="actualizar_stock.php?id=<?php echo base64_encode($id_producto) ?>&codigo=<?php echo base64_encode($codigo_producto) ?>"><button type="button" class="btn btn-primary"> Actualizar Stock Producto</button></a>
              <a href="activar_producto.php?id=<?php echo base64_encode($id_producto)?>"><button type="button" class="btn btn-success" > Activar Producto</button></a>
              <br><br><a class="btn btn-danger js-scroll-trigger" href="ver_producto.php">Regresar</a>
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