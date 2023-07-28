<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

$producto = $_GET["id"];
$id_producto = base64_decode($producto);

$consulta = "UPDATE productos SET estado_producto='1' WHERE id_producto='$id_producto';";

$resul = mysqli_query($con, $consulta);

if (!$resul) {
	echo "<script>alert('Error al actualizar el estado del producto.');location.href =history.back();</script>";
} else {
	echo "<script>alert('Producto activado con exito.');location.href ='ver_producto.php';</script>";
}
?>