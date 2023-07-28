<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

$usuario = $_GET["id"];
$id_usuario = base64_decode($usuario);

$consulta = "UPDATE usuarios SET rol_usuario='1' WHERE id_usuario='$id_usuario';";

$resul = mysqli_query($con, $consulta);

if (!$resul) {
	echo "<script>alert('Error al actualizar el rol del usuario.');location.href =history.back();</script>";
} else {
	echo "<script>alert('Administrador asignado con exito.');location.href ='usuariostodos.php';</script>";
}
?>