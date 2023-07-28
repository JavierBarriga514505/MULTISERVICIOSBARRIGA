<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

$categoria = $_GET["id"];
$id_categoria = base64_decode($categoria);


$consulta = "UPDATE categorias SET estado_categoria='0' WHERE id_categoria='$id_categoria';";

$resul = mysqli_query($con, $consulta);

if (!$resul) {
	echo "<script>alert('Error al actualizar el estado de la categoria.');location.href =history.back();</script>";
} else {
	echo "<script>alert('Categoria desactivada con exito.');location.href ='ver_categorias.php';</script>";
}
?>