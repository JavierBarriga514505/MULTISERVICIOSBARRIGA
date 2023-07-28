<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos

session_start();

if (!empty($_POST['stock_producto']) && !empty($_POST['precio_producto']) && !empty($_POST['id_producto']) && !empty($_POST['codigo_producto'])  && !empty($_POST['cantidad_pedir'])) {
	$stock_producto = $_POST['stock_producto'];
	$precio_producto = $_POST['precio_producto'];
	$id_producto = $_POST['id_producto'];
	$codigo_producto = $_POST['codigo_producto'];
	$cantidad_pedir = $_POST['cantidad_pedir'];
	$id_usuario = $_SESSION['id_usuario'];
	$sql1 = "SELECT * FROM cart WHERE id_producto='$id_producto' and referencia_producto='$codigo_producto' and id_usuario='$id_usuario';";
	$query1 = mysqli_query($con, $sql1);
	$query_check_user = mysqli_num_rows($query1);

	if ($query_check_user >= 1) {
		echo "<script>alert('El producto ya se encuentra en el carrito. Si desea agregar mas cantidad de este producto, elimina el anterior y agregalo de nuevo al carrito.');location.href =history.back();</script>";
	} else {
		if ($query_check_user <= 0) {
			$sql = "INSERT INTO cart(id_producto,referencia_producto,precio_producto,cantidad_producto,id_usuario) VALUES('$id_producto','$codigo_producto','$precio_producto','$cantidad_pedir','$id_usuario');";
			$query = mysqli_query($con, $sql);

			if ($query) {
				echo "<script>alert('Producto Añadido al Carrito.');location.href ='ver_producto1.php';</script>";
			}
		} else {
			echo "<script>alert('Error al añadir el Producto.');location.href =history.back();</script>";
		}
	}
}
?>