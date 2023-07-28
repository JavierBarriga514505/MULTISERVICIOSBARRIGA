<?php require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

$compra = $_GET["id"];
$id_compra = base64_decode($compra);


$consulta = "UPDATE compras SET estado='3' WHERE id_compra='$id_compra';";

$resul = mysqli_query($con, $consulta);

if (!$resul) {
	echo "<script>alert('Error al actualizar el estado de la compra.');location.href =history.back();</script>";
} else {
	echo "<script>alert('Compra Cancelada con exito.');location.href ='verventas.php';</script>";
}
?>