
<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
session_start();
$_SESSION["id_usuario"];
$sql = "UPDATE usuarios SET ultimo_ingreso = CURTIME() WHERE id_usuario ='" . $_SESSION["id_usuario"] . "';";
$actualizar = mysqli_query($con, $sql);
unset($_SESSION["id:usuario"]);

session_destroy();
header("Location: index1.php");
exit;
?>