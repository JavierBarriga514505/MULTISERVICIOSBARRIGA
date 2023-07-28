<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

$usuario = $_GET["id"];
$email = $_GET["email"];
$id_usuario = base64_decode($usuario);
$email = base64_decode($email);
$password = sha1($email);

$consulta = "UPDATE usuarios SET password='$password' WHERE id_usuario='$id_usuario';";

$resul = mysqli_query($con, $consulta);

if (!$resul) {
	echo "<script>alert('Error al actualizar el rol del usuario.');location.href = history.back();</script>";
} else {
	echo "<script>alert('La contraseña a sido restaurada con exito. Recordar que la nueva contraseña es el mismo Correo registrado por el usuario');location.href ='usuariostodos.php';</script>";
}
?>