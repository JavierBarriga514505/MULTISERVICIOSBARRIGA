<?php
//aqui se detalla la compra que ha realizado un usuario en la empresa, de acuerdo al numero de compra y el id de usuario
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos

session_start();
$mensaje1 = $_GET["id"];
$mensaje = base64_decode($mensaje1);
$usuario1 = $_GET["usuario"];
$id_usuario = base64_decode($usuario1);
$sql = "SELECT * FROM  compras, detalle_compra WHERE compras.id_usuario='$id_usuario' and detalle_compra.id_compra='$mensaje' and compras.id_compra='$mensaje';";
$query = mysqli_query($con, $sql);
$sql0 = "SELECT * FROM  compras WHERE id_usuario='$id_usuario' and id_compra='$mensaje';";
$query0 = mysqli_query($con, $sql0);

while ($row0 = mysqli_fetch_array($query0)) {
	$id_compra1 = $row0['id_compra'];
	$fecha1 = $row0['fecha'];
	$total1 = $row0['total'];
}
$sql2 = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario'";

$query2 = mysqli_query($con, $sql2);

while ($row2 = mysqli_fetch_array($query2)) {
	$name = $row2['name'];
	$tipo_documento = $row2['tipo_documento'];
	$numero_documento = $row2['numero_documento'];
	$celular = $row2['celular_usuario'];
	$email = $row2['email'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MULTISERVICIO BARRIGA</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel="icon" type="image/png" href="images/carroicono.png" />
	<style >
	@media print{
  .oculto-impresion, .oculto-impresion *{
    display: none !important;
  }
}
div.table-responsive{
        border:2px solid black;
}
	</style>
</head>

<body>
<fieldset>
<div class="table-responsive" >
	<table class="table">
		<p>
			<center><img src="images/logo.png" width="800" align="left" class="img-fluid" alt="Logo Empresa">
				<h2> Multiservicio Barriga </h2>
		</p>
		<tr><td colspan="5" align="center">	<H3> Productos Comprados </H3></td></tr>
		<th>Producto</th>
		<th>Nombre</th>
		<th>Valor Unidad</th>
		<th>Cantidad Pedida</th>
		<th>Valor Total</th>

		<center> <?php echo '<h2> Recibo N°' . $id_compra1 ?></center>
		<?php echo '<h4> <P align="right">Fecha de Compra: ' . $fecha1 ?><br>
		<?php echo 'Total a pagar: $' . number_format($total1) . '</h4>' ?><br>
		<?php echo '<h5> <P align="right"> Datos del Cliente: ' . $name ?><br>
		<?php echo 'Documento: ' . $tipo_documento . ' N° ' . $numero_documento ?><br>
		<?php echo 'Correo Electronico: ' . $email ?><br>
		<?php echo ' Celular: ' . $celular . '</p></h5>' ?><br>
		<center>
		
		</center>
		<?php
		while ($row = mysqli_fetch_array($query)) {
			$id_compra = $row['id_compra'];
			$fecha = $row['fecha'];
			$total = $row['total'];
			$estado = $row['estado'];
			$id_usuario1 = $row['id_usuario'];
			$id_producto = $row['id_producto'];
			$referencia_producto = $row['referencia_producto'];
			if ($id_usuario1 == $id_usuario) {

				$sql1 = "SELECT * FROM  productos WHERE id_producto='$id_producto' and codigo_producto='$referencia_producto'";
				$query1 = mysqli_query($con, $sql1);

				while ($row1 = mysqli_fetch_array($query1)) {
		?>
					<tr>
						<td> <img src="<?php echo $row1['foto_producto'] ?>" width="200" height="150"></td>
						<td><?php echo $row1['nombre_producto'] ?></td>
						<td><?php $precio_publico = $row['precio_individual_producto'];
							echo  number_format($precio_publico) ?> </td>
						<td><?php echo $cantidad_producto = $row['cantidad_prod'] ?></td>
						<td><?php echo number_format($total = $cantidad_producto * $precio_publico); ?></td>
					</tr>
		<?php
				}
			}
		} ?>
		<tr><td><h3>Total a Pagar</h3></td> 
		<td colspan="5"align="right"><h2> $ <?php echo number_format($total1); ?></h2></td></tr>
	</table>
</fieldset>	
<br>
	<center>
		<div class="printbutton">
			<input type="button" value="Imprimir" class="oculto-impresion"><br><br>
		</div>
		<a href="historial_venta.php"> <input type="button" value="Volver" class="oculto-impresion"></button></a>
		<script>
			document.querySelectorAll('.printbutton').forEach(function(element) {
				element.addEventListener('click', function() {
					print();

				});
			});
		</script><br>

</div>
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
</body>

</html>