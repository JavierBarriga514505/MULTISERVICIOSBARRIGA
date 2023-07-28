<?php include("includes/header.php");
$roles = $_SESSION['rol'];
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
			<h2 class="mx-auto my-0 text-uppercase">Ver Usuarios</h2>
		</div>
	</div><br>
</header>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="well well-sm">
				<h4><i class='glyphicon glyphicon-search'></i>Usuarios Registrados</h4>
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
								<th>Rol</th>
								<center>
									<th colspan="2">Opciones</th>
								</center>
								<?php
								$sql = "SELECT * FROM  usuarios";
								$query = mysqli_query($con, $sql);
								while ($row = mysqli_fetch_array($query)) {
								?>
							<tr>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['direccion_usuario']; ?></td>
								<td> <?php $id_ciudad = $row['IDCIUDAD'];
										$id_usuario = $row['id_usuario'];
										$sql1 = "SELECT * FROM departamentos, ciudades WHERE departamentos.IDDEPARTAMENTO=ciudades.departamentos_IDDEPARTAMENTO and ciudades.IDCIUDAD='$id_ciudad';";
										$query1 = mysqli_query($con, $sql1);
										while ($row1 = mysqli_fetch_array($query1)) { ?>
									<?php echo $row1['NOMBRECIUDAD'] . " - " . $row1['NOMBREDEPARTAMENTO'];
										} ?></td>
								<td><?php $email = $row['email'];
									echo $row['email']; ?></td>
								<td><?php $rol = $row['rol_usuario'];
									if ($rol == '1') {
										echo 'Administrador';
									} elseif ($rol == '2') {
										echo 'Empleado';
									} else {
										echo 'Cliente';
									} ?></td>
								<?php if ($rol != '1') { ?>
									<td><a href="asigna_admin.php?id=<?php echo base64_encode($id_usuario) ?>"><button type="button" class="btn btn-light"> <i class="fa fa-plus bigicon"><br>Asignar como Administrador</i></button></a></td>
									<td><a href="restaura_password.php?id=<?php echo base64_encode($id_usuario) ?>&email=<?php echo base64_encode($email) ?>"><button type="button" class="btn btn-light"> <i class="fa fa-lock bigicon"><br>Restaurar Contraseña</i></button></a></td>
								<?php } ?>
							</tr>
				</div> <?php } ?>
			</table>
			</div>
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>