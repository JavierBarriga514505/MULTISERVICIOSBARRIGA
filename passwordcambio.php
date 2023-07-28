<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (!empty($_POST['password']) && !empty($_POST['password1']) && !empty($_POST['password2'])) {
		$id_usuario = $_SESSION['id_usuario'];
		$password = sha1($_POST['password']);
		$password1 = sha1($_POST['password1']);
		$password2 = sha1($_POST['password2']);
		$sql1 = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario' ";
		$query1 = mysqli_query($con, $sql1);
		while ($row = mysqli_fetch_array($query1)) {
			$contrasena = $row['password'];
		}

		if ($contrasena != $password) {
			echo "<script>alert('La contraseña anterior no es correcta.');location.href =history.back();</script>";
		} elseif ($password1 != $password2) {
			echo "<script>alert('La contraseñas nuevas no coinciden.');location.href =history.back();</script>";
		} else {
			$sql = "UPDATE usuarios SET password='$password1' WHERE id_usuario='$id_usuario';";
			$query = mysqli_query($con, $sql);

			if ($query) {
				echo "<script>alert('Exito en la actualizacion de la contraseña. Inicia Sesion Nuevamente');location.href ='logout.php';</script>";
			} else {
				echo "<script>alert('Error al actualizar los datos.');location.href =history.back();</script>";
			}
		}
	} else {
		echo "<script>alert('Error al recibir datos.');location.href =history.back();</script>";
	}
} else {
	echo "<script>alert('No se reciben datos.');location.href =history.back();</script>";
}
?>