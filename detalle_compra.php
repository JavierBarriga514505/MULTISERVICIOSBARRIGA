<?php
include("includes/header.php");
$id_usuario = $_SESSION['id_usuario'];
$mensaje1 = $_GET["id"];
$mensaje = base64_decode($mensaje1);
$sql = "SELECT * FROM  compras, detalle_compra WHERE compras.id_usuario='$id_usuario' and detalle_compra.id_compra='$mensaje' and compras.id_compra='$mensaje';";
$query = mysqli_query($con, $sql);
$sql0 = "SELECT * FROM  compras WHERE id_usuario='$id_usuario' and id_compra='$mensaje';";
$query0 = mysqli_query($con, $sql0);

while ($row0 = mysqli_fetch_array($query0)) {
	$id_compra1 = $row0['id_compra'];
	$fecha1 = $row0['fecha'];
	$total1 = $row0['total'];
}
?>

<div class="table-responsive">

	<table class="table">
		<th>Imagen</th>
		<th>Nombre</th>
		<th>Valor Unidad</th>
		<th>Cantidad Pedida</th>
		<th>Valor Total</th>
		<center> <?php echo '<h2> Recibo N°' . $id_compra1 ?>
			<?php echo '<h3> Fecha de Compra:' . $fecha1 ?><br>
			<?php echo 'Total a pagar:' . number_format($total1) ?></center>
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
		<a href="ver_compras.php"> <button type="button" class="btn btn-light">Volver</button></a>
	</center>
	<br>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
</body>

</html>