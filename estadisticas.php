<?php // representan todos los reportes estadistico de la aplicacion por ejemplo los productos mas vendidos y menos vendidos en una fecha especifica o en un rango de fecha
include_once('php/conexion.php');

class Procesar extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function build_report($year)
	{
		$total = array();
		for ($i = 0; $i < 12; $i++) {
			$month = $i + 1;
			$sql = $this->db->query("SELECT SUM(cantidad_producto) AS total FROM detalle_producto WHERE MONTH(fecha_producto) = '$month' AND YEAR(fecha_producto) = '$year' and movimiento_producto = '3' order by SUM(cantidad_producto) ASC LIMIT 1");
			$total[$i] = 0;
			foreach ($sql as $key) {
				$total[$i] = ($key['total'] == null) ? 0 : $key['total'];
			}
		}
		return $total;
	}
}

if (!empty($_POST['year'])) {
	$_SESSION['year'] = $_POST['year'];
	$class = new Procesar;
	$run = $class->build_report($_POST['year']);
	exit(json_encode($run));
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
	<style>
		@media print {
			html {
				zoom: 50%;
			}

			/* Se aplicará la siguiente regla CSS */
			button,
			[type="button"],
			[type="submit"],
			[type="reset"] {
				display: none;
			}
		}

		hr {
			border: 4px dotted blue;
			width: 50%;
		}
	</style>
	<br>
	<div id="printbutton" class="container printbutton">
		<div class="row">
			<div class="cols-md-12">
				<div class="panel">
					<div class="panel-heading">
						<div class="pull-right">
							<h4><i class='glyphicon glyphicon-stats'></i> Estadisticas Cantidad de Productos Vendidos</h4>
						</div>
						<label class="col-sm-12 control-label"><span class="glyphicon glyphicon-calendar"></span> Buscar por Año</label>
						<div class="col-sm-12"><select  class="form-control" onChange="mostrarResultados(this.value); myFunction(); " name="year" id="year" >
								<?php
								if ($_SESSION['year'] != null) {
									$yearfijo = $_SESSION['year'];
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
							</select>
						</div>
						<center>
					</div>
				
					<div class="panel-body">
						<div class="table-responsive">
							<table align="center" width="1000" border="0">
								<center>
									<tr>
										<div class="pull-left">
											<td>
												<?php
												echo "<center>";
												$sql1 = "SELECT SUM(cantidad_producto) as suma, referencia_producto FROM detalle_producto WHERE YEAR(fecha_producto) = '" .$yearfijo. "' and movimiento_producto= '3' Group by referencia_producto order by SUM(cantidad_producto)  DESC LIMIT 1";
												$query = mysqli_query($con, $sql1);
												while ($row1 = mysqli_fetch_array($query)) {
													$producto = $row1['referencia_producto'];
													$suma = $row1['suma'];
													$sql2 = "SELECT * FROM productos WHERE codigo_producto='" . $producto . "'";
													$query = mysqli_query($con, $sql2);
													while ($row2 = mysqli_fetch_array($query)) {
														$producto2 = $row2['nombre_producto'];
													}
													if ($producto != 0 and $producto2 != "") {
														echo "PRODUCTO MAS VENDIDO EN ESTE AÑO " . $yearfijo;
														echo "<br>";
														echo " REF°  " . $producto . " NOMBRE " . $producto2, " CANTIDAD VENDIDA " . $suma;
													} else {
														if ($producto == 0 or $producto2 == 0) {
															echo "NO HAY REGISTROS EN ESTE AÑO " . $yearfijo;
														}
													}
												}
												echo "</center>"; ?>
											
	</td>  <div class="btn-group"><td> 		<center>	 <br>							

    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    
      <span class="caret">   Consultar mas </span>
  </button>
    <ul class="dropdown-menu">
      <li><a href="masvendidosaño.php" >+ Vendidos por año</a></li>
      <li><a href="masvendidosfecha.php">+ Vendidos por mes</a></li>
    </ul>  </td>
  </div><br><br></center>
										</div>
										<div class="pull-right">
											<td>
												<?php
												echo "<center>";
												$sql2 = "SELECT SUM(cantidad_producto) as suma1, referencia_producto FROM detalle_producto WHERE YEAR(fecha_producto) = '".$yearfijo."' and movimiento_producto = '3' Group by referencia_producto order by SUM(cantidad_producto) ASC LIMIT 1";
												$query2 = mysqli_query($con, $sql2);
												while ($row2 = mysqli_fetch_array($query2)) {
													$producto4 = $row2['referencia_producto'];
													$suma2 = $row2['suma1'];
													$sql3 = "SELECT * FROM productos WHERE codigo_producto='" . $producto4 . "'";
													$query = mysqli_query($con, $sql3);
													while ($row3 = mysqli_fetch_array($query)) {
														$producto3 = $row3['nombre_producto'];
													}
													if ($producto4 != 0 and $producto3 != "") {
														echo "PRODUCTO MENOS VENDIDO EN ESTE AÑO " . $yearfijo;
														echo "<br>";
														echo 	"REF°  " . $producto4 . " NOMBRE " . $producto3 . " CANTIDAD VENDIDA " . $suma2;
													} else {
														if ($producto == 0 or  $producto2 == 0) {
															echo "NO HAY REGISTROS EN ESTE AÑO " . $yearfijo;
														}
													}
												}
												echo "</center>";
												?>
											   
   </td><center><div class="btn-group"><td> <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    
      <span class="caret">  Consultar mas </span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="menosvendidosaño.php">- Vendidos por año</a></li>
      <li><a href="menosvendidosfecha.php">- Vendidos por mes</a></li>
    </ul>
<br></td>  </div></center>
										</div>
									</tr>
								</center>
							</table>
						</div><br>
						<div class="resultados"><canvas id="grafico"></canvas></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<center><a href="home.php" ><button class="btn btn-warning">  Volver</button></a></center>

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/chartJS/Chart.min.js"></script>
	<script>
		$(document).ready(mostrarResultados(<?php echo $yearfijo; ?>));

		function mostrarResultados(year) {
			$('.resultados').html('<canvas id="grafico"></canvas>');
			$.ajax({
				type: 'POST',
				url: 'estadisticas.php',
				data: 'year=' + year,
				dataType: 'JSON',
				success: function(response) {
					var Datos = {
						labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
						datasets: [{
							fillColor: 'rgba(11,28,14,0.6)', //COLOR DE LAS BARRAS
							strokeColor: 'rgba(3,2,11,7)', //COLOR DEL BORDE DE LAS BARRAS
							highlightFill: 'rgba(3,2,18,0.6)', //COLOR "HOVER" DE LAS BARRAS
							highlightStroke: 'rgba(6,19,17,0.7)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
							data: response
						}]
					}
					var contexto = document.getElementById('grafico').getContext('2d');
					window.Barra = new Chart(contexto).Bar(Datos, {
						responsive: true
					});
					Barra.clear();
				}
			});
			return false;
		}
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Third party plugin JS-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
	<!-- Core theme JS-->
	<script src="js/scripts.js"></script>
</body>

</html>