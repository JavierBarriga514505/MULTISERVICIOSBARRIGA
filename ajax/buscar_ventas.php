<?php //buscar todas las ventas que se han realixado en el sistema por parte del administrador
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);
session_start();
$id_usuario = $_SESSION['id_usuario'];

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {
	// escaping, additionally removing everything that could be (html/javascript-) code
	$q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$aColumns = array('id_compra', 'total'); //Columnas de busqueda
	$sTable = "compras";
	$sWhere = "";
	if ($_GET['q'] != "") {
		$sWhere = "WHERE (";
		for ($i = 0; $i < count($aColumns); $i++) {
			$sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= 'AND id_usuario="' . $id_usuario . '"';
		$sWhere .= ')';
	}
	$sWhere .= "ORDER BY fecha DESC";
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
	$reload = './ver_compras.php';
	//main query to fetch the data
	$sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
	$query = mysqli_query($con, $sql);
	//loop through fetched data
	if ($numrows > 0) { ?>
		<div class="table-responsive">
			<table class="table">
				
					<tr><center>
						<th class="text-center">N°Recibo</th>
						<th class="text-center">Fecha</th>
						<th class="text-center">Total</th>
						<th class="text-center">Comprado (Online/Fisico)</th>
						<th class="text-center">Estado</th>
						<th class="text-center">Cliente </th>
						<th class="text-center" colspan="3">Opciones</th>
	</center>
					</tr>
			
				<?php
				while ($row = mysqli_fetch_array($query)) {
					$id_compra = $row['id_compra'];
					$fecha = $row['fecha'];
					$total = $row['total'];
					$estado = $row['estado'];
					$id_usuario1 = $row['id_usuario'];
					$tipo_compra=$row['tipo_compra'];

				?>
					<tr>
						<td><?php echo $id_compra; ?></td>
						<td><?php echo $fecha; ?></td>
						<td><?php echo number_format($total); ?></td>
						<td><?php echo $tipo_compra; ?></td>
						<td> <?php if ($estado == '1') {
								?><a href="actualizar_estado.php?id=<?php echo base64_encode($id_compra) ?>"><?php echo '<button type="button" class="btn btn-warning">Pendiente</button>'; ?> </a>
							<?php
								} else if ($estado == '2') {
									echo '<button type="button" class="btn btn-success">Pagada</button>';
								} else if ($estado == '3') {
									echo '<button type="button" class="btn btn-danger">Cancelada</button>';
								} ?>
						<td><?php
							$sql2 = "SELECT * FROM  usuarios where id_usuario='$id_usuario1'";
							$query2 = mysqli_query($con, $sql2);
							while ($row2 = mysqli_fetch_array($query2)) {
								echo 	$row2['name'];
							}
							?></td>
						<td><a href="detalle_compra1.php?id=<?php echo base64_encode($id_compra) ?>&usuario=<?php echo base64_encode($id_usuario1) ?>"><button type="button" class="btn btn-primary"><i class="fa fa-plus bigicon"> Ver Mas</i></button></a></td>
						<td><a href="subirrecibo1.php?mensaje=<?php echo base64_encode($id_compra) ?>"><button type="button" class="btn btn-info"><i class="fa fa-file-upload bigicon"> Ver Recibo de Pago</i></button></a></td>
						<?php if ($estado == '1') { ?><td><a href="cancelarcompra.php?id=<?php echo base64_encode($id_compra) ?>"><button type="button" class="btn btn-danger"><i class="fa fa-file-minus bigicon"> Cancelar Compra</i></button></a></td>
						<?php } ?>
						</td>
					</tr>
				<?php  } ?>
			</table>
			<center>
				<?php
				echo paginate($reload, $page, $total_pages, $adjacents);
				?></span></td>
			</center>
		</div>
<?php
	}
}
?>