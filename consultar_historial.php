<?php
// aqui se consulta el historial de compras de un un usuario ya seleccionado, igual se busca por fecha de compra un producto que anteriormente halla adquirido el cliente
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);



if (!empty($_GET['fecha'])) {
	$fecha = $_GET['fecha'];
	$id_cliente=$_GET['id'];
	$nombre_cliente=$_GET['nombre'];
	$consulta = "SELECT productos.id_producto,productos.codigo_producto,productos.nombre_producto,productos.foto_producto,compras.fecha,detalle_compra.precio_individual_producto,detalle_compra.cantidad_prod FROM compras,detalle_compra,productos WHERE compras.id_usuario='$id_cliente' and compras.id_compra=detalle_compra.id_compra and detalle_compra.id_producto=productos.id_producto and detalle_compra.referencia_producto=productos.codigo_producto and DATE(compras.fecha)='$fecha';";
	}else{
		
		$cliente = $_GET["id"];
$clientenombre= $_GET["nombre"];
$id_cliente = base64_decode($cliente);
$nombre_cliente = base64_decode($clientenombre);
	$consulta = "SELECT productos.id_producto,productos.codigo_producto,productos.nombre_producto,productos.foto_producto,compras.fecha,detalle_compra.precio_individual_producto,detalle_compra.cantidad_prod FROM compras,detalle_compra,productos WHERE compras.id_usuario='$id_cliente' and compras.id_compra=detalle_compra.id_compra and productos.id_producto=detalle_compra.id_producto and productos.codigo_producto=detalle_compra.referencia_producto;";
	
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
                <div class="mx-auto text-center"><br>
                    <h2 class="mx-auto my-0 text-uppercase">Productos Comprados por <?php echo $nombre_cliente;?></h2>
                                   </div>
			<a href="carrito1.php?idusuario=<?php echo base64_encode($id_cliente); ?>"><button type="button" class="btn btn-info">Ver Carrito de Compras</button></a>
	
            </div><br>
					       
	   </header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="well well-sm">
					<form method="GET" action="consultar_historial.php">
					<div class="col-sm-12">
			<?php  $fechaactual = date('Y-m-d H:i:s');?>
<b> Fecha a Consultar:</b>
<input type="date" id="fecha" name="fecha" class="form-control"required><br>
<input type="hidden" value="<?php echo $id_cliente;?>" name="id">
<input type="hidden" value="<?php echo $nombre_cliente;?>" name="nombre">
	  <center>						<button type="submit" class="btn btn-primary">Buscar</button></center><br></form>
						</div>
					<div class="table-responsive">
			<table class="table">
				<center>
					<tr>
						<th>Foto Producto</th>
						<th>Nombre Producto</th>
						<th>Fecha de Compra</th>
						<th>Precio Unidad Comprada</th>
						<th>Cantidad Comprada</th>
						<th>Stock Actual</th>
						<th>Precio Actual</th>
						<?php if ($_SESSION['rol'] == 1) { ?>
							<th colspan="4">Agregar al Carrito</th>
						<?php } ?>
					</tr>
				</center>
                     <?php 

			 
$resul = mysqli_query($con, $consulta);
while ($row = mysqli_fetch_array($resul)) {
    $imagen = $row['foto_producto'];
    $nombre_producto = $row['nombre_producto'];
	$fecha=$row['fecha'];
	$precioi=$row['precio_individual_producto'];
	$cantidadp=$row['cantidad_prod'];
	$referencia=$row['codigo_producto'];
	$id_producto=$row['id_producto'];
	$sql11 = "select * from detalle_producto where referencia_producto='" . $referencia . "' and movimiento_producto='1' order by fecha_producto DESC LIMIT 1";
						$query11 = mysqli_query($con, $sql11);
						while ($row1 = mysqli_fetch_array($query11)) {
							$preciopublico=$row1['precio_publico'];
							$stock=$row1['cantidad_producto'];?>
	
	<tr>
								<td><img src="<?php echo $row['foto_producto'] ?>" title="Descripcion:<?php echo $row['nombre_producto'] ?>" width = "200" height = "40"  class="product-thumb img-thumbnail"></td>
								<td> <?php echo $nombre_producto; ?></td>
								<td><?php echo $fecha; ?></td>
								<td><?php echo $precioi; ?></td>
								<td><?php echo $cantidadp; ?></td>
								<td><?php echo $stock; ?></td>
								<td><?php echo $preciopublico; ?></td>
								<td><center><form action="anadirproductocarrito1.php" method="POST">
													<label for="Cantidad_Comprar">Cantidad a Comprar:</label>
													<input type="hidden" id="stock_producto" name="stock_producto" value="<?php echo $stock; ?>">
													<input type="hidden" id="precio_producto" name="precio_producto" value="<?php echo $preciopublico; ?>">
													<input type="hidden" id="id_producto" name="id_producto" value="<?php echo $id_producto; ?>">
													<input type="hidden" id="codigo_producto" name="codigo_producto" value="<?php echo $referencia; ?>">
													<input type="number" id="cantidad_pedir" name="cantidad_pedir" required min="1" max="<?php echo $stock; ?>">
													<input type="hidden" value="<?php echo $id_cliente;?>" name="id_usuario">
													<br><center> <i class="fa fa-shopping-cart"></i> <input class="btn btn-outline-primary" type="submit" value="Agregar al Carrito">
												</form></center></td>
	
	<?php
}}
?>
			</table>
			</div>
                        <center> <br>
                            <a class="btn btn-danger js-scroll-trigger" href="historial_venta.php">Regresar</a>
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