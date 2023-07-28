<?php include("includes/header.php"); ?>

<style type="text/css">
	.panel-heading {
		background-color: #12A066;
	}

	.panel {
		border-color: #12A066;
	}
</style>

<header class="masthead">
	<div class="container d-flex h-100 align-items-center">
		<div class="mx-auto text-center">
			<h2 class="mx-auto my-0 text-uppercase">Ver Inventario</h2>
		</div>
	</div><br>
</header>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="well well-sm">
				<h4><i class='glyphicon glyphicon-search'></i> Inventario Total</h4>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table">
						<center>
							<tr>
								<th>Código</th>
								<th>Producto</th>
								<th>Estado</th>
								<th>Agregado</th>
								<th>Marca</th>
								<th>Categoria</th>
								<th>Precio Proveedor</th>
								<th>Cantidad</th>
								<th>Precio Publico</th>
								<th>Último Surtido</th>
								<?php if ($_SESSION['rol'] == 1) { ?>
									<th>Movimientos</th>
									<th>Ganancias</th>
								<?php } ?>
							</tr>
						</center>
						<?php
						$sql1 = "select * from productos, detalle_producto where productos.id_producto=detalle_producto.id_producto and productos.codigo_producto=detalle_producto.referencia_producto ORDER BY detalle_producto.fecha_producto DESC";
						$query1 = mysqli_query($con, $sql1);

						while ($row = mysqli_fetch_array($query1)) {
							$movimiento_producto = $row['movimiento_producto'];
							$id_producto = $row['id_producto'];
							$id_marca = $row['id_marca'];
							$id_categoria = $row['id_categoria'];
							$codigo_producto = $row['codigo_producto'];
							$nombre_producto = $row['nombre_producto'];
							$status_producto = $row['estado_producto'];
							if ($status_producto == 1) {
								$estado = "Activo";
							} else {
								$estado = "Inactivo";
							}
							$date_added = $row['fecha_agregado'];
							$precio_producto = $row['precio_producto'];
							$cantidad = $row["cantidad_producto"];
							$preciopublico = $row['precio_publico'];
							$fecha = $row['fecha_producto'];

							$sql2 = "select * from marcas, categorias where marcas.id_marca='$id_marca' and categorias.id_categoria='$id_categoria'";
							$query2 = mysqli_query($con, $sql2);
							while ($row2 = mysqli_fetch_array($query2)) {
								$nombre_marca = $row2['nombre_marca'];
								$nombre_categoria = $row2['nombre_categoria'];
						?>
								<tr>
									<td> <?php echo $codigo_producto; ?></td>
									<td> <?php echo $nombre_producto; ?></td>
									<td> <?php echo $estado; ?></td>
									<td> <?php echo $date_added; ?></td>
									<td> <?php echo $nombre_marca; ?></td>
									<td> <?php echo $nombre_categoria; ?></td>
									<td> <?php echo number_format($precio_producto); ?></td>
									<td> <?php echo $cantidad; ?></td>
									<td> <?php echo number_format($preciopublico); ?></td>
									<td> <?php echo $fecha; ?></td>
									<td><?php if ($movimiento_producto == '1') {
											echo 'Stock';
										} else if ($movimiento_producto == '2') {
											echo 'Compra al Proveedor';
										} elseif ($movimiento_producto == '3') {
											echo 'Venta del Producto';
										} ?></td>
									<td> <?php if ($movimiento_producto == '3') {
												echo 	$total = number_format(($preciopublico * $cantidad) - ($precio_producto * $cantidad));
											} ?></td>
								</tr>
						<?php
							}
						}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Bootstrap core JS-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Third party plugin JS-->
	</body>
	</html>