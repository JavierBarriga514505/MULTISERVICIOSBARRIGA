<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (!empty($_POST['idproducto']) && !empty($_POST['codigoproducto'])) {
		$id_producto = $_POST["idproducto"];
		$codigo = $_POST["codigoproducto"];
		$preciocompra = $_POST["pproveedor"];
		$preciopublico = $_POST["ppublico"];
		$cantidad1 = $_POST["cantidad"];
		$cantidad2 = $_POST["cantidadproducto"];
		$cantidad = $cantidad1 + $cantidad2;

		if ($preciocompra > $preciopublico) {
			echo "<script>alert('El precio al publico debe ser mayor a lo que se compro el producto');location.href =history.back();</script>";
		} else {
			$consulta1 = "INSERT INTO detalle_producto(id_producto,referencia_producto,precio_producto,precio_publico,cantidad_producto,fecha_producto,movimiento_producto) VALUES ('$id_producto','$codigo','$preciocompra','$preciopublico','$cantidad1',CURTIME(),'2')";
			$consulta2 = "INSERT INTO detalle_producto(id_producto,referencia_producto,precio_producto,precio_publico,cantidad_producto,fecha_producto,movimiento_producto) VALUES ('$id_producto','$codigo','$preciocompra','$preciopublico','$cantidad',CURTIME(),'1')";

			$resul1 = mysqli_query($con, $consulta2);
			$resul2 = mysqli_query($con, $consulta1);

			if (!$resul1 && !$resul2) {
				echo "<script>alert('Error al registrar el producto.');location.href =history.back();</script>";
			} else {
				echo "<script>alert('Producto Actualizado con exito.');location.href ='ver_producto.php';</script>";
			}

			if ($query) {
				echo "<script>alert('Stock Actualizado con Exito.');location.href ='actualizar_producto.php';</script>";
			}
		}
	} else {
		echo "<script>alert('Error al subir datos.');location.href =history.back();</script>";
	}
} else {
	echo "<script>alert('Error al subir datos.');location.href =history.back();</script>";
}
?>