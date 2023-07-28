<?php
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);
session_start();

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {
	// escaping, additionally removing everything that could be (html/javascript-) code
	$q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$aColumns = array('id_marca', 'nombre_marca'); //Columnas de busqueda
	$sTable = "marcas";
	$sWhere = "";
	if ($_GET['q'] != "") {
		$sWhere = "WHERE (";
		for ($i = 0; $i < count($aColumns); $i++) {
			$sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= ')';
	}
	$sWhere .= "ORDER BY id_marca ASC";
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
	$per_page = 10; //how much records you want to show
	$adjacents  = 4; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
	$row = mysqli_fetch_array($count_query);
	$numrows = $row['numrows'];
	$total_pages = ceil($numrows / $per_page);
	$reload = './ver_marcas.php';
	//main query to fetch the data
	$sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
	$query = mysqli_query($con, $sql);
	//loop through fetched data
	if ($numrows > 0) { ?>
		<div class="table-responsive">
			<table class="table">
				<center>
					<tr>
						<th>Código</th>
						<th>Nombre Marca</th>
						<th>Estado</th>
						<th colspan="3">Acciones</th>
					<?php } ?>
					</tr>
				</center>
				<?php
				while ($row = mysqli_fetch_array($query)) {
					$id_marca = $row['id_marca'];
					$nombre_marca = $row['nombre_marca'];
					$status_marca = $row['estado_marca'];
					if ($status_marca == 1) {
						$estado = "Activo";
					} else {
						$estado = "Inactivo";
					}
				?>
					<tr>
						<td> <?php echo $id_marca; ?></td>
						<td> <?php echo $nombre_marca; ?></td>
						<td> <?php echo $estado; ?></td>

						<?php if ($_SESSION['rol'] == 1) { ?>
							<?php if ($status_marca == 1) {
							?><td><a href="inactivar_marca.php?id=<?php echo base64_encode($id_marca) ?>"><button type="button" class="btn btn-light"> <i class="fa fa-ban bigicon"><br>Inactivar</i></button></a></td>
							<?php
							} else { ?>
							<td><a href="activar_marca.php?id=<?php echo base64_encode($id_marca) ?>"><button type="button" class="btn btn-light"> <i class="fa fa-check bigicon"><br>Activar</i></button></a></td>
						<?php }
					} ?>
					</tr>
				<?php
				}
				?>
			</table>
			<center>
				<?php
				echo paginate($reload, $page, $total_pages, $adjacents);
				?></span></td>
			</center>
		</div>
	<?php
}
	?>