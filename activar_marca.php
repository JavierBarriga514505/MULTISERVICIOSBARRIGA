<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

$producto = $_GET["id"];
$id_producto = base64_decode($producto);

$consulta = "UPDATE marcas SET estado_marca='1' WHERE id_marca='$id_producto';";

$resul = mysqli_query($con, $consulta);

if (!$resul) {
	echo "<script>alert('Error al actualizar el estado de la marca.');location.href =history.back();</script>";
} else {
	echo "<script>alert('Marca activada con exito.');location.href ='ver_marcas.php';</script>";
}
?>