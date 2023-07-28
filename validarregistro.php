<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$direccion = $_POST['direccion'];
		$ciudad = $_POST['ciudad'];
		$tipo_documento = $_POST['tipo_documento'];
		$identificacion = $_POST['identificacion'];
		$celular_usuario = $_POST['celular_usuario'];
		$password = sha1($_POST['password']);
		$estado = "1";
		$sql1 = "SELECT * FROM usuarios WHERE email='$email' or numero_documento='$identificacion' ";
		$query1 = mysqli_query($con, $sql1);
		$query_check_user = mysqli_num_rows($query1);

		if ($query_check_user >= 1) {
			echo "<script>alert('El correo electronico o el numero de identificacion ya se encuentran registrados.');location.href =history.back();</script>";
		} else {
			if ($query_check_user <= 0) {

				$rol = "3";
				$sql = "INSERT INTO usuarios(name,tipo_documento,numero_documento,celular_usuario,email,password,direccion_usuario,IDCIUDAD,rol_usuario,estado_usuario,ultimo_ingreso) VALUES('$name','$tipo_documento','$identificacion','$celular_usuario','$email','$password','$direccion','$ciudad','$rol','1',CURTIME());";
				$query = mysqli_query($con, $sql);




				if ($query) {
					echo "<script>alert('Registro Exitoso.');location.href ='index1.php';</script>";
				}
			} else {
				echo "<script>alert('Error al subir los datos.');location.href =history.back();</script>";
			}
		}
	} else {
		echo "<script>alert('Error al subir datos.');location.href =history.back();</script>";
	}
}
?>