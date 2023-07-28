<?php //buscar todos los clientes que tiene el sistemas y asi buscar su historial de compras o realizar venta directa
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);
session_start();

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {
	// escaping, additionally removing everything that could be (html/javascript-) code
	$q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
	$aColumns = array('numero_documento', 'name'); //Columnas de busqueda
	$sTable = "usuarios";
	$sWhere = "";
	if ($_GET['q'] != "") {
		$sWhere = "WHERE (";
		for ($i = 0; $i < count($aColumns); $i++) {
			$sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= ')';
	}
	$sWhere .= "ORDER BY id_usuario DESC";
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
	$reload = './ver_producto.php';
	//main query to fetch the data
	$sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
	$query = mysqli_query($con, $sql);
	//loop through fetched data
	if ($numrows > 0) { ?>
		<div class="table-responsive">
			<table class="table">
				<center>
					<tr>
						<th>Id Cliente</th>
						<th>Nombre</th>
						<th>Tipo de Documento</th>
						<th>Numero de Documento</th>
						<th>Celular</th>
						<th>Email</th>
						<?php if ($_SESSION['rol'] == 1) { ?>
							<th colspan="4">Realizar Compra</th>
						<?php } ?>
					</tr>
				</center>
				<?php
				while ($row = mysqli_fetch_array($query)) {
					$id_usuario=$row['id_usuario'];
					$nombre = $row['name'];
					$tipo_documento=$row['tipo_documento'];
					$numero_documento=$row['numero_documento'];
					$celular=$row['celular_usuario'];
					$email=$row['email'];
					$rol=$row['rol_usuario'];
					if($rol==3){
					
				?>
							<tr>
								<td> <?php echo $id_usuario; ?></td>
								<td> <?php echo $nombre; ?></td>
								<td> <?php echo $tipo_documento; ?></td>
								<td> <?php echo $numero_documento; ?></td>
								<td> <?php echo $celular; ?></td>
								<td> <?php echo $email; ?></td>
							<?php if ($_SESSION['rol'] == 1) { ?>
									<td><a href="ver_producto2.php?id=<?php echo base64_encode($id_usuario) ?>&nombre=<?php echo base64_encode($nombre) ?>"><button type="button" class="btn btn-primary"><i class="fa fa-cart-arrow-down "><br>Realizar Compra</i></button></a></td>
									<?php } ?>
							</tr>
				<?php
					}		
	}}
				
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