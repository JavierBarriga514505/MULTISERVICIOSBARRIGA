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
		echo "<script>alert('Error subiendo la imagen. Debe ser formato PNG O JPG.');location.href =history.back();</script>";
	}
}

$usuario = $_POST["usuario"];
$codigo = $_POST["codigoproducto"];
$nombreproducto = $_POST["nombreproducto"];
$descripcion = $_POST["descripcion"];
$preciocompra = $_POST["preciocompra"];
$preciopublico = $_POST["preciopublico"];
$marca = $_POST["marca"];
$categoria = $_POST["categoria"];
$cantidad = $_POST["cantidad"];
$sql1 = "SELECT * FROM productos WHERE codigo_producto='$codigo' and id_marca='$marca' ";
$query1 = mysqli_query($con, $sql1);
$query_check_user = mysqli_num_rows($query1);

if ($query_check_user >= 1) {
	echo "<script>alert('El Codigo del Producto ya se encuentra registrado.');location.href =history.back();</script>";
} else {
	$sql2 = "SELECT * FROM productos;";
	$query2 = mysqli_query($con, $sql2);
	$contar = mysqli_num_rows($query2);
	$id_producto = $contar + '1';


	$consulta = "INSERT INTO productos(id_producto,codigo_producto,nombre_producto,descripcion_producto,id_marca,id_categoria,fecha_agregado,id_usuario,estado_producto,foto_producto) VALUES ('$id_producto','$codigo','$nombreproducto','$descripcion','$marca','$categoria',CURTIME(),'$usuario','1','$location')";
	$consulta1 = "INSERT INTO detalle_producto(id_producto,referencia_producto,precio_producto,precio_publico,cantidad_producto,fecha_producto,movimiento_producto) VALUES ('$id_producto','$codigo','$preciocompra','$preciopublico','$cantidad',CURTIME(),'2')";
	$consulta2 = "INSERT INTO detalle_producto(id_producto,referencia_producto,precio_producto,precio_publico,cantidad_producto,fecha_producto,movimiento_producto) VALUES ('$id_producto','$codigo','$preciocompra','$preciopublico','$cantidad',CURTIME(),'1')";

	$resul = mysqli_query($con, $consulta);
	$resul1 = mysqli_query($con, $consulta2);
	$resul2 = mysqli_query($con, $consulta1);


	if (!$resul && !$resul1 && !$resul2) {
		echo "<script>alert('Error al registrar el producto.');location.href =history.back();</script>";
	} else {
		echo "<script>alert('Producto Registrado con exito.');location.href ='ver_producto.php';</script>";
	}
}
?>