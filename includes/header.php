<!DOCTYPE html>
<html lang="en">

<?php require_once("./config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("./config/conexion.php"); //Contiene funcion que conecta a la base de datos
session_start(); //Inicia la sesion para el usuario

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

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MULTISERVICIO BARRIGA</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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
							<div class="dropdown navbar-nav me-auto mb-2 mb-lg-0 ">
								<button class="btn btn-light dropdown-toggle align-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Realizar venta</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="venta_directa.php">Hacer Venta Directa</a>
									<a class="dropdown-item" href="historial_venta.php">Historial Compras de Cliente</a>
								</div>
							</div>

						</li>
						<li class="nav-item">
							<a class="nav-link" href="usuariostodos.php">Usuarios</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="verventas.php">Consultar Ventas</a>
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
			[type = "button"],
			[type = "submit"],
			[type = "reset"] {
				display: none;
			}
		}

		hr {
			border: 4px dotted blue;
			width: 50%;
		}
		</style>
	</head>