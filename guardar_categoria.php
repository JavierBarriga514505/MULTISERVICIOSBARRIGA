<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

$nombrecategoria = $_POST["nombrecategoria"];

$sql1 = "SELECT * FROM categorias WHERE nombre_categoria='$nombrecategoria'";
$query1 = mysqli_query($con, $sql1);
$query_check_user = mysqli_num_rows($query1);

if ($query_check_user >= 1) {
	echo "<script>alert('El nombre de la categoria ya se encuetra registrado.');location.href =history.back();</script>";
} else {
	$consulta = "INSERT INTO categorias(nombre_categoria) VALUES ('$nombrecategoria');";

	$resul = mysqli_query($con, $consulta);
	if (!$resul) {
		echo "<script>alert('Error al registrar la categoria.');location.href =history.back();</script>";
	} else {
		echo "<script>alert('Categoria Registrada con exito.');location.href ='ver_categorias.php';</script>";
	}
}
?>