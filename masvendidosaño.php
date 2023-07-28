<?php
include_once('php/conexion.php');



if (!empty($_GET['year'])) {
	$_SESSION['year'] = $_GET['year'];
	
	}else{
		$_SESSION['year'] =date("Y");
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php session_start(); //Inicia la sesion para el usuario

	if (!$_SESSION['id_usuario']) {
		header('location: logout.php'); //Restriccion si no hay sesion activa sale directamente al index
	}
	$sql1 = "SELECT * FROM  usuarios where id_usuario='" . $_SESSION['id_usuario'] . "'"; // Si existe la session trae todos los datos del usuario
	$query1 = mysqli_query($con, $sql1);

	while ($d1 = mysqli_fetch_array($query1)) {
		$id = $d1['id_usuario'];
		$rol = $d1['rol_usuario'];
		$nombre = $d1['name'];
	}

	$_SESSION['id_usuario'] = $id; // Traera el id del usuario
	$_SESSION['rol'] = $rol; // Restricciones del rol del usuario
	?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MULTISERVICIO BARRIGA</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="icon" type="image/png" href="images/carroicono.png" />

</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<img src="images/carroicono.png" align="left" width="30" height="30"> <a class="navbar-brand" href="index.php"> MULTISERVICIO BARRIGA</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="home.php">Principal</a>
					</li>
					<?php if ($_SESSION['rol'] == 1 or $_SESSION['rol'] == 2) { ?>
						<li class="nav-item">
							<div class="dropdown navbar-nav me-auto mb-2 mb-lg-0 ">
								<button class="btn btn-light dropdown-toggle align-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Productos</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="ver_producto.php">Ver productos</a>
									<a class="dropdown-item" href="registraproducto.php">Registrar Productos</a>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="usuariostodos.php">Usuarios</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="verventas.php">Ventas</a>
						</li>
						<li class="nav-item">
							<div class="dropdown navbar-nav me-auto mb-2 mb-lg-0 ">
								<button class="btn btn-light dropdown-toggle align-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Marcas</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="ver_marcas.php">Ver Marcas</a>
									<a class="dropdown-item" href="registrarmarcas.php">Registrar Marcas</a>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<div class="dropdown navbar-nav me-auto mb-2 mb-lg-0 ">
								<button class="btn btn-light dropdown-toggle align-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Categorias</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="ver_categorias.php">Ver Categorias</a>
									<a class="dropdown-item" href="registrarcategorias.php">Registrar Categorias</a>
								</div>
							</div>
						<li class="nav-item">
							<div class="dropdown navbar-nav me-auto mb-2 mb-lg-0 ">
								<button class="btn btn-light dropdown-toggle align-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Inventario</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="ver_inventario.php">Ver Inventario</a>
									<a class="dropdown-item" href="recibodiario.php">Generar Recibo de Diario</a>
									<a class="dropdown-item" href="estadisticas.php">Estadisticas</a>
								</div>
							</div>
						</li>
			</div>
			</li>
		<?php } else { ?>
			<?php if ($_SESSION['rol'] == 3) { ?>
				<li class="nav-item">
					<a class="nav-link" href="ver_producto1.php">Ver Productos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="carrito.php">Mi Carrito de Compras</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="ver_compras.php">Mis Compras</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="nosotros.php">Sobre nosotros</a>
				</li>
		<?php }
					} ?></ul>
		<div class="dropdown navbar-nav me-auto mb-2 mb-lg-0 ">
			<button class="btn btn-light dropdown-toggle align-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Hola <?php echo $nombre; ?></button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="usuario.php">Ver Usuario</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="logout.php">Cerrar Sesion</a>
			</div>
		</div>
		</div>
		</div>
	</nav>

	<br>
<header class="masthead">
	<div class="container d-flex h-100 align-items-center">
		<div class="mx-auto text-center">
			<h2 class="mx-auto my-0 text-uppercase">Productos mas Vendidos segun su Año</h2>
		</div>
	</div><br>
</header>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="well well-sm">
		<center>
			<label class="col-sm-12 control-label"><span class="glyphicon glyphicon-calendar"></span> Buscar por Año</label>
					<form method="GET" action="masvendidosaño.php">
					
 	<div class="col-sm-12"><select  class="form-control" name="year" id="year" >
								<?php
								if ($_GET['year'] != null) {
									$yearfijo = $_GET['year'];
								} else {
									$yearfijo = date("Y");
								}

								$yearfijo1 = date("Y");
								$yearsuma = $yearfijo1 + 0013;
								for ($i = 2018; $i < $yearsuma; $i++) {
									if ($i == $yearfijo) {
										echo '<option value="' . $i . '" selected>' . $i . '</option>';
									} else {
										echo '<option value="' . $i . '">' . $i . '</option>';
									}
								}
								?>
							</select> <br>
							<button type="submit" class="btn btn-primary">Buscar</button></form>
						</div>
			</div></center>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table">
					
						<?php
					echo "<center>";
												$sql1 = "SELECT SUM(cantidad_producto) as suma, referencia_producto FROM detalle_producto WHERE YEAR(fecha_producto) = '" .$yearfijo. "' and movimiento_producto= '3' Group by referencia_producto order by SUM(cantidad_producto)  DESC LIMIT 5";
												$query = mysqli_query($con, $sql1);
												$sql3 = "SELECT COUNT(*) as total FROM detalle_producto WHERE YEAR(fecha_producto) = '" .$yearfijo. "' and movimiento_producto= '3' Group by referencia_producto DESC LIMIT 5";
												$query3 = mysqli_query($con, $sql3);
												
												$variable= mysqli_num_rows($query3);
												if($variable!=0){
													echo "<br>";
												echo "<h3> PRODUCTO MAS VENDIDO EN ESTE AÑO " . $yearfijo."<h3>";
												echo "<br>";}
													?>
													<div class="table-responsive">
													<table class="table table-hover">
													  <thead>
														<tr>
														<th>Imagen</th>
														<th>Referencia N°</th>
														<th>Nombre Producto</th>
														<th>Cantidad Vendida</th>
														  </tr>
														</thead>
														<tbody>
														
													<?php
												while ($row1 = mysqli_fetch_array($query)) {
													$producto = $row1['referencia_producto'];
													$suma = $row1['suma'];
													$sql2 = "SELECT * FROM productos WHERE codigo_producto='" . $producto . "'";
													$query1 = mysqli_query($con, $sql2);
													while ($row2 = mysqli_fetch_array($query1)) {
														$producto2 = $row2['nombre_producto'];
														$foto=$row2['foto_producto'];
													if(!empty($producto)  and  !empty($producto2) and $variable!=0) {
													 echo "<tr>";
														echo "<td> ";
														?>
														<img src="<?php echo $row2['foto_producto'] ?>" title="Descripcion:<?php echo $row2['descripcion_producto'] ?>" width="80" class="product-thumb img-thumbnail">
													<?php 
														echo "</td>";
														echo " <td>   " . $producto . " </td>";
														echo "<td> " . $producto2, " </td>" ;
														echo "<td> " . $suma." Unidades </td>";
												 echo "</tr>";
													}													
												}}
											if($variable==0){echo "NO HAY REGISTROS EN ESTE AÑO " .$yearfijo;}

												echo "</center>"; ?>
				 </tbody>
</table>
</div>
				</div>
			</div>
		</div>
	</div>
			
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Third party plugin JS-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
	<!-- Core theme JS-->		
</body>

</html>