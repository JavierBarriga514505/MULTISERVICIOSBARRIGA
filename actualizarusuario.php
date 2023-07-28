<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!empty($_POST['celular_usuario']) && !empty($_POST['direccion']) && !empty($_POST['ciudadantigua']) && !empty($_POST['email'])) {
		$email = $_POST['email'];
		$id_usuario = $_SESSION['id_usuario'];
		$direccion = $_POST['direccion'];
		$ciudadantigua = $_POST['ciudadantigua'];
		$ciudad = $_POST['ciudad'];
		$celular_usuario = $_POST['celular_usuario'];
		if ($ciudad == '0') {
			$ciudadfinal = $ciudadantigua;
		} else {
			$ciudadfinal = $ciudad;
		}
		$sql = "UPDATE usuarios SET celular_usuario='$celular_usuario', email='$email',direccion_usuario='$direccion', IDCIUDAD='$ciudadfinal' WHERE id_usuario='$id_usuario';";
		$query = mysqli_query($con, $sql);

		if ($query) {
			echo "<script>alert('Exito de la actualizacion de datos.');location.href =history.back();</script>";
		} else {
			echo "<script>alert('Error al actualizar los datos.');location.href =history.back();</script>";
		}
	} elseif (empty($_POST['ciudad'])) {
		$ciudad = '0';
		$email = $_POST['email'];
		$id_usuario = $_SESSION['id_usuario'];
		$direccion = $_POST['direccion'];
		$ciudadantigua = $_POST['ciudadantigua'];
		$celular_usuario = $_POST['celular_usuario'];
		if ($ciudad == '0') {
			$ciudadfinal = $ciudadantigua;
		} else {
			$ciudadfinal = $ciudad;
		}
		$sql = "UPDATE usuarios SET celular_usuario='$celular_usuario', email='$email',direccion_usuario='$direccion', IDCIUDAD='$ciudadfinal' WHERE id_usuario='$id_usuario';";
		$query = mysqli_query($con, $sql);

		if ($query) {
			echo "<script>alert('Exito de la actualizacion de datos.');location.href =history.back();</script>";
		} else {
			echo "<script>alert('Error al actualizar los datos.');location.href =history.back();</script>";
		}
	} else {
		echo "<script>alert('Error al recibir datos.');location.href =history.back();</script>";
	}
} else {
	echo "<script>alert('Error al completar datos.');location.href =history.back();</script>";
}
?>