<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);
session_start();
$id_usuario = $_SESSION['id_usuario'];

$producto = $_GET["id"];
$id_producto = base64_decode($producto);

$consulta = "DELETE FROM cart WHERE id_carrito='$id_producto' and id_usuario='$id_usuario';";
$resul = mysqli_query($con, $consulta);

if (!$resul) {
	echo "<script>alert('Error al eliminar el producto del carrito.');location.href =history.back();</script>";
} else {
	echo "<script>alert('Producto eliminado del carrito con exito.');location.href ='carrito.php';</script>";
}
?>