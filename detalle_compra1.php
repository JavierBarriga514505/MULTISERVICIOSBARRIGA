<?php
include("includes/header.php");

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

<div class="table-responsive">
	<table class="table">
		<p>
			<center><img src="images/logo.png" width="900" align="left" class="img-fluid" alt="Logo Empresa">
				<h2> Multiservicio Barriga </h2>
		</p>
		<th>Imagen</th>
		<th>Nombre</th>
		<th>Valor Unidad</th>
		<th>Cantidad Pedida</th>
		<th>Valor Total</th>

		<center> <?php echo '<h2> Recibo N°' . $id_compra1 ?></center>
		<?php echo '<h3> <P align="right">Fecha de Compra:' . $fecha1 ?><br>
		<?php echo 'Total a pagar:' . number_format($total1) . '</h2>' ?><br>
		<?php echo '<h5> <P align="right"> Datos del Cliente: ' . $name ?><br>
		<?php echo 'Documento: ' . $tipo_documento . ' N° ' . $numero_documento ?><br>
		<?php echo 'Correo Electronico: ' . $email ?><br>
		<?php echo ' Celular: ' . $celular . '</p></h5>' ?><br>
		<center>
			<H3> Productos Comprados </H3>
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
	</table>
	<center>
		<div class="printbutton">
			<input type="button" value="Imprimir" class="printbutton"><br><br>
		</div>
		<a href="verventas.php"> <input type="button" value="Volver"></button></a>
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