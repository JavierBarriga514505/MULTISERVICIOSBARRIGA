<?php include("includes/header.php"); ?>

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
			<h2 class="mx-auto my-0 text-uppercase">Ver Usuario</h2>
		</div>
	</div><br>
</header>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="well well-sm">
				<h4><i class='glyphicon glyphicon-search'></i>Tu Informacion Personal</h4>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table">
						<center>
							<tr>
								<th>Nombre</th>
								<th>Direccion </th>
								<th>Ciudad</th>
								<th>Correo Electronico</th>
								<center>
									<th colspan="2">Opciones</th>
								</center>
								<?php
								$id_usuario = $_SESSION['id_usuario'];
								$sql = "SELECT * FROM  usuarios WHERE id_usuario='$id_usuario';";
								$query = mysqli_query($con, $sql);
								while ($row = mysqli_fetch_array($query)) {
								?>
							<tr>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['direccion_usuario']; ?></td>
								<td> <?php $id_ciudad = $row['IDCIUDAD'];
										$sql1 = "SELECT * FROM departamentos, ciudades WHERE departamentos.IDDEPARTAMENTO=ciudades.departamentos_IDDEPARTAMENTO and ciudades.IDCIUDAD='$id_ciudad';";
										$query1 = mysqli_query($con, $sql1);
										while ($row1 = mysqli_fetch_array($query1)) { ?>
									<?php echo $row1['NOMBRECIUDAD'] . " - " . $row1['NOMBREDEPARTAMENTO'];
										} ?></td>
								<td><?php echo $row['email'] ?></td>
								<td><a href="modificar_datos.php?id=<?php echo base64_encode($id_usuario) ?>"><button type="button" class="btn btn-light"> <i class="fa fa-plus bigicon"><br>Modificar Datos</i></button></a></td>
								<td><a href="cambiar_password.php?id=<?php echo base64_encode($id_usuario) ?>"><button type="button" class="btn btn-light"> <i class="fa fa-lock bigicon"><br>Cambiar Contraseña</i></button></a></td>
							</tr>
				</div>
				</table>
			</div>
		</div>
	</div>
<?php } ?>
</div>
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<div class="footer">
	<?php include("includes/piedepagina.php"); ?>
</div>