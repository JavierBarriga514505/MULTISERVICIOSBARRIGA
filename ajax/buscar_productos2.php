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
	$aColumns = array('codigo_producto', 'nombre_producto'); //Columnas de busqueda
	$sTable = "productos";
	$sWhere = "";
	if ($_GET['q'] != "") {
		$sWhere = "WHERE (";
		for ($i = 0; $i < count($aColumns); $i++) {
			$sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
		}
		$sWhere = substr_replace($sWhere, "", -3);
		$sWhere .= ')';
	}
	$sWhere .= "ORDER BY fecha_agregado DESC";
	include 'pagination.php'; //include pagination file
	//pagination variables
	$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
	$per_page = 6; //how much records you want to show
	$adjacents  = 2; //gap between pages after number of adjacents
	$offset = ($page - 1) * $per_page;
	//Count the total number of row in your table*/
	$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
	$row = mysqli_fetch_array($count_query);
	$numrows = $row['numrows'];
	$total_pages = ceil($numrows / $per_page);
	$reload = './ver_producto1.php';
	//main query to fetch the data
	$sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
	$query = mysqli_query($con, $sql);
	//loop through fetched data
	if ($numrows > 0) {
?>
		<div class="container">
			<div class="row">
				<?php
				while ($row = mysqli_fetch_array($query)) {
					$referencia = $row['codigo_producto'];
					$id_producto = $row['id_producto'];
					$id_marca = $row['id_marca'];
					$id_categoria = $row['id_categoria'];
					if ($row['estado_producto'] == '1') {
						$sql1 = "select * from detalle_producto where referencia_producto='" . $referencia . "' and movimiento_producto='1' order by fecha_producto DESC LIMIT 1";
						$query1 = mysqli_query($con, $sql1);
						while ($row1 = mysqli_fetch_array($query1)) {
							$sql2 = "select * from marcas, categorias where marcas.id_marca='" . $id_marca . "' and categorias.id_categoria='" . $id_categoria . "'";
							$query2 = mysqli_query($con, $sql2);
							while ($row2 = mysqli_fetch_array($query2)) {
				?>
								<div class="col-md-4 wow fadeIn">
									<div class="single-product-widget">
										<div class="single-wid-product">
											<img src="<?php echo $row['foto_producto'] ?>" title="Descripcion:<?php echo $row['descripcion_producto'] ?>" class="product-thumb img-thumbnail">
											<h2><?php echo $row['nombre_producto'] ?></h2>
											<div class="product-wid-price">
												<center>
													<h5>Marca: <?php echo $row2['nombre_marca'] ?> Categoria: <?php echo $row2['nombre_categoria'] ?></h5>
												</center>
												<center>
													<h5>Precio: $ <?php echo  number_format($row1['precio_publico']) ?> Cantidad: <?php echo $row1['cantidad_producto'] ?></h5>
												</center>
											</div>
											<center> <a href="index1.php"><button type="button" class="btn btn-outline-primary">Ver Mas</button></a>
										</div>
									</div>
								</div>
		<?php }
						}
					}
				}
			}
		} ?>
			</div>
		</div> <br>
		<center>
			<?php
			echo paginate($reload, $page, $total_pages, $adjacents);
			?></span></td>
		</center>