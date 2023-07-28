<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

$marca = $_GET["id"];
$id_marca = base64_decode($marca);

$consulta = "UPDATE marcas SET estado_marca='0' WHERE id_marca='$id_marca';";

$resul = mysqli_query($con, $consulta);

if (!$resul) {
	echo "<script>alert('Error al actualizar el estado de la marca.');location.href =history.back();</script>";
} else {
	echo "<script>alert('Marca desactivada con exito.');location.href ='ver_marcas.php';</script>";
}
?>