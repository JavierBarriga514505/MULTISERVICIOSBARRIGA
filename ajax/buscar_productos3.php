<?php //buscar todos los productos para acer la compra por parte de adminitrador a un cliente
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);
session_start();

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {
	$id_cliente=mysqli_real_escape_string($con, (strip_tags($_REQUEST['id_usuario'], ENT_QUOTES)));
	$nombre=mysqli_real_escape_string($con, (strip_tags($_REQUEST['nombre_usuario'], ENT_QUOTES)));
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
						<th>Producto</th>
						<th>Código</th>
						<th>Nombre</th>
						<th>Marca</th>
						<th>Categoria</th>
						<th>Cantidad en Stock</th>
						<th>Precio Unidad</th>
						
						<?php if ($_SESSION['rol'] == 1) { ?>
							<th colspan="4">Agregar al Carrito</th>
						<?php } ?>
					</tr>
				</center>
				<?php
				while ($row = mysqli_fetch_array($query)) {
					$referencia = $row['codigo_producto'];
					$id_producto = $row['id_producto'];
					$sql1 = "select * from detalle_producto where referencia_producto='" . $referencia . "' and movimiento_producto='1' order by fecha_producto DESC LIMIT 1";
					$query1 = mysqli_query($con, $sql1);
					while ($row1 = mysqli_fetch_array($query1)) {
						$id_producto = $row['id_producto'];
						$id_marca = $row['id_marca'];
						$id_categoria = $row['id_categoria'];
						$codigo_producto = $row['codigo_producto'];
						$nombre_producto = $row['nombre_producto'];
						$status_producto = $row['estado_producto'];
						if ($status_producto == 1) {
							$estado = "Activo";
						} else {
							$estado = "Inactivo";
						}
						$date_added = $row['fecha_agregado'];
						$precio_producto = $row1['precio_producto'];
						$stock = $row1["cantidad_producto"];
						$preciopublico = $row1['precio_publico'];
						$fecha = $row1['fecha_producto'];

						$sql2 = "select * from marcas, categorias where marcas.id_marca='$id_marca' and categorias.id_categoria='$id_categoria'";
						$query2 = mysqli_query($con, $sql2);
						while ($row2 = mysqli_fetch_array($query2)) {
							$nombre_marca = $row2['nombre_marca'];
							$nombre_categoria = $row2['nombre_categoria'];
				?>
							<tr>
								<td> <img src="<?php echo $row['foto_producto'] ?>" width="200" height="150"></td>
								<td> <?php echo $codigo_producto; ?></td>
								<td> <?php echo $nombre_producto; ?></td>
								<td> <?php echo $nombre_marca; ?></td>
								<td> <?php echo $nombre_categoria; ?></td>
								<td> <?php echo $stock; ?></td>
								<td> <?php echo $preciopublico; ?></td>
								<td><center><form action="anadirproductocarrito1.php" method="POST">
													<label for="Cantidad_Comprar">Cantidad a Comprar:</label>
													<input type="hidden" id="stock_producto" name="stock_producto" value="<?php echo $stock; ?>">
													<input type="hidden" id="precio_producto" name="precio_producto" value="<?php echo $preciopublico; ?>">
													<input type="hidden" id="id_producto" name="id_producto" value="<?php echo $id_producto; ?>">
													<input type="hidden" id="codigo_producto" name="codigo_producto" value="<?php echo $referencia; ?>">
													<input type="number" id="cantidad_pedir" name="cantidad_pedir" required min="1" max="<?php echo $stock; ?>">
													<input type="hidden" value="<?php echo $id_cliente;?>" name="id_usuario">
													<br><center> <i class="fa fa-shopping-cart"><input class="btn btn-outline-primary" type="submit" value="Agregar al Carrito"></i>
												</form></center></td>
							</tr>
				<?php
						}
					}
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
}
?>