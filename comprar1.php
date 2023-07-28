<?php // se hace la transaccion de compra por parte del administrador en el punto de venta fisico a un cliente
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);
session_start(); //Inicia la sesion para el usuario

if (!empty($_POST['id'])) {
	$id_usuario = $_POST['id_usuario'];
	$variable = $_POST['id'];
	
	if ($variable = 1) {
		$sql33 = "SELECT COUNT(*) total FROM cart WHERE id_usuario='$id_usuario';";
		$query33 = mysqli_query($con, $sql33);
		$fila3 = mysqli_fetch_assoc($query33);
		$totalregistro3 = $fila3['total'];
		if ($totalregistro3 <= 0) {
			echo "<script>alert('Error: El carrito esta vacio.');location.href =history.back();</script>";
		}

		$sql = "SELECT * FROM  cart WHERE id_usuario='$id_usuario';";
		$query = mysqli_query($con, $sql);
		while ($row = mysqli_fetch_array($query)) {
			$referencia = $row['referencia_producto'];
			$id_producto = $row['id_producto'];
			$precio_producto = $row['precio_producto'];
			$cantidad_producto = $row['cantidad_producto'];
			$id_carrito = $row['id_carrito'];
			$total = $cantidad_producto * $precio_producto;

			$sql2 = "SELECT COUNT(*) total FROM compras";
			$query2 = mysqli_query($con, $sql2);
			$fila = mysqli_fetch_assoc($query2);
			$totalregistro = $fila['total'] + 1;
			$nn = "SELECT SUM(cantidad_producto*precio_producto) as mtotal FROM cart WHERE id_usuario='$id_usuario'";
			$resultado1 = mysqli_query($con, $nn);
			$row66 =  mysqli_fetch_assoc($resultado1);
			$totalsuma = $row66['mtotal'];
			

			$sql0 = "select * from detalle_producto where id_producto = '" . $id_producto . "' and referencia_producto='" . $referencia . "' and movimiento_producto='1' order by fecha_producto DESC LIMIT 1";
			$query0 = mysqli_query($con, $sql0);
			while ($row0 = mysqli_fetch_array($query0)) {
				$stock = $row0['cantidad_producto'];
				$stocktotal = $stock - $cantidad_producto;
				$precio_productopro = $row0['precio_producto'];
				if ($cantidad_producto > $stock) {
					echo "<script>alert('Error: El stock del producto se ha agotado.');location.href =history.back();</script>";
				} else {

					$sql2 = "INSERT INTO compras(id_usuario,total,fecha,estado,foto_recibo,tipo_compra) VALUES('$id_usuario','$totalsuma',CURTIME(),'1','uploads/noimage.jpeg','Fisico');";
					$sql3 = "INSERT INTO detalle_compra(id_compra,id_producto,referencia_producto,precio_individual_producto,cantidad_prod,total_prod) VALUES('$totalregistro','$id_producto','$referencia','$precio_producto','$cantidad_producto','$total')";
					$consulta1 = "INSERT INTO detalle_producto(id_producto,referencia_producto,precio_producto,precio_publico,cantidad_producto,fecha_producto,movimiento_producto) VALUES ('$id_producto','$referencia','$precio_productopro','$precio_producto','$cantidad_producto',CURTIME(),'3')";
					$consulta2 = "INSERT INTO detalle_producto(id_producto,referencia_producto,precio_producto,precio_publico,cantidad_producto,fecha_producto,movimiento_producto) VALUES ('$id_producto','$referencia','$precio_productopro','$precio_producto','$stocktotal',CURTIME(),'1')";
					$consulta = "DELETE FROM cart WHERE id_usuario='$id_usuario';";

					$query3 = mysqli_query($con, $sql3);
					$query4 = mysqli_query($con, $consulta2);
					$query5 = mysqli_query($con, $consulta1);
				}
			}
		}
		$query2 = mysqli_query($con, $sql2);
		$resul = mysqli_query($con, $consulta);

		if ($query2 && $query3) {
				echo "<script>alert('Se ha generado la transaccion correctamente.');window.location.href = 'factura1.php?mensaje='+encodeURIComponent($totalregistro)+'&usuario='+encodeURIComponent($id_usuario);</script>";
			unset($variable);
			$variable = 0;
		} else {
			echo "<script>alert('Error: Insertar datos.');location.href =history.back();</script>";
		}
	} else {
		echo "<script>alert('Ya se ha hecho la transaccion.');location.href ='carrito1.php';</script>";
	}
} else {
	echo "<script>alert('Error al subir datos.');location.href =history.back();</script>";
}
?>