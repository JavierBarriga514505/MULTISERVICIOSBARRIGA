<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$time = time();
$fecha = date("H:i:s", $time);

$fileInfo = PATHINFO($_FILES["image"]["name"]);

if (empty($_FILES["image"]["name"])) {
	$location = "";
} else {
	if ($fileInfo['extension'] == "jpg" or $fileInfo['extension'] == "png") {
		$newFilename = $fileInfo['filename'] . "_" . time() . "." . $fileInfo['extension'];
		move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $newFilename);
		$location = "uploads/" . $newFilename;
	} else {
		$location = "";
		echo "<script>alert('Error subiendo la imagen debe ser formato PNG O JPG.');location.href =history.back();</script>";
	}
}

$id_compra = $_POST["mensaje"];

$consulta = "UPDATE compras SET foto_recibo ='$location' WHERE id_compra='$id_compra';";
$resul = mysqli_query($con, $consulta);

if (!$resul) {
	echo "<script>alert('Error al registrar la imagen del producto.');location.href =history.back();</script>";
} else {
	echo "<script>alert('Imagen Actualizada con exito.');location.href ='ver_compras.php';</script>";
}
?>