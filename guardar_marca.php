<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

$nombremarca = $_POST["nombremarca"];

$sql1 = "SELECT * FROM marcas WHERE nombre_marca='$nombremarca'";
$query1 = mysqli_query($con, $sql1);
$query_check_user = mysqli_num_rows($query1);

if ($query_check_user >= 1) {
	echo "<script>alert('El nombre de la marca ya se encuetra registrado.');location.href =history.back();</script>";
} else {

	$consulta = "INSERT INTO marcas(nombre_marca) VALUES ('$nombremarca');";

	$resul = mysqli_query($con, $consulta);

	if (!$resul) {
		echo "<script>alert('Error al registrar el producto.');location.href =history.back();</script>";
	} else {
		echo "<script>alert('Marca Registrada con exito.');location.href ='ver_marcas.php';</script>";
	}
}
?>