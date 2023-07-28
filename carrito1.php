<?php include("includes/header.php");
// Ver el carrito de un usuario en especifico
$usuario = $_GET["idusuario"];
$id_usuario=base64_decode($usuario);

$sql = "SELECT * FROM  usuarios WHERE id_usuario='$id_usuario';";
$query = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($query)) {
	$nombre = $row['name'];
	$tipo_documento = $row['tipo_documento'];
	$numero_documento = $row['numero_documento'];
	$celular_usuario = $row['celular_usuario'];
	$email = $row['email'];
	$direccion_usuario = $row['direccion_usuario'];
	$ciudad_usuario = $row['IDCIUDAD'];
}
?>

<style type="text/css">
	.panel-heading {
		background-color: #12A066;
	}

	.panel {
		border-color: #12A066;
	}

	.bg-image-vertical {
		position: relative;
		overflow: hidden;
		background-repeat: no-repeat;
		background-position: right center;
		background-size: auto 100%;
	}

	.column {
		width: 100%;
	}

	@media (min-width: 600px) {
		.column {
			width: 50%;
		}
	}

	html {
		min-height: 100%;
		position: relative;
	}

	body {
		margin: 0;
		margin-bottom: 40px;
	}

	footer {
		background-color: black;
		position: absolute;
		bottom: 0;
		width: 100%;
		height: 40px;
		color: white;
	}
</style>

<header class="masthead">
	<div class="container d-flex h-100 align-items-center">
		<div class="mx-auto text-center">
			<h2 class="mx-auto my-0 text-uppercase">Carrito de Compras</h2>
		</div>
	</div><br>
</header>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="well well-sm">
				<h4><i class='glyphicon glyphicon-search'></i>Ver Productos en Carrito</h4>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table">
						<center>
							<tr>
								<th>Código</th>
								<th>Producto</th>
								<th>Precio Unidad</th>
								<th>Cantidad Solicitada</th>
								<th>Marca</th>
								<th>Categoria</th>
								<th>Total</th>
								<th>Eliminar del Carrito</th>

								<form class="form-horizontal" method="POST" action="comprar1.php">
								<input type="hidden" value="<?php echo $id_usuario;?>" name="id_usuario">
									<?php
									$id_usuario = $id_usuario;
									$sql = "SELECT * FROM  cart WHERE id_usuario='$id_usuario';";
									$query = mysqli_query($con, $sql);
									while ($row = mysqli_fetch_array($query)) {

										$referencia = $row['referencia_producto'];
										$id_producto = $row['id_producto'];
										$precio_producto = $row['precio_producto'];
										$cantidad_producto = $row['cantidad_producto'];
										$id_carrito = $row['id_carrito'];

										$sql1 = "select * from productos where id_producto='" . $id_producto . "' and codigo_producto='" . $referencia . "'";
										$query1 = mysqli_query($con, $sql1);

										while ($row1 = mysqli_fetch_array($query1)) {
											$id_marca = $row1['id_marca'];
											$id_categoria = $row1['id_categoria'];

											$sql2 = "select * from marcas, categorias where marcas.id_marca='" . $id_marca . "' and categorias.id_categoria='" . $id_categoria . "'";
											$query2 = mysqli_query($con, $sql2);

											while ($row2 = mysqli_fetch_array($query2)) {
									?>
							<tr>
								<td> <img src="<?php echo $row1['foto_producto'] ?>" width="50" height="!00"></td>
								<td><?php echo $row1['nombre_producto'] ?></td>
								<td><?php $precio_publico = $row['precio_producto'];
												echo  number_format($precio_producto) ?> </td>
								<td><?php echo $cantidadproducto = $row['cantidad_producto'] ?></td>
								<td><?php echo $row2['nombre_marca'] ?></td>
								<td><?php echo $row2['nombre_categoria'] ?></td>
								<td><?php echo number_format($total = $cantidad_producto * $precio_producto); ?></td>
								<td><a href="eliminar_carrito1.php?id=<?php echo base64_encode($id_carrito) ?>&usuario=<?php echo base64_encode($id_usuario) ?>"><button type="button" class="btn btn-light"> <i class="fa fa-ban bigicon"><br>Eliminar</i></button></a></td>
					<?php }
										}
									} ?>
							</tr>
					</table>
				</div>
				<input id="id" name="id" type="hidden" value="1" class="form-control">

			</div>
		</div>
	</div>
	<center><input class="btn btn-primary" type="submit" value="Comprar"></td>
	</center>
</div>
</form>
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>

</html>