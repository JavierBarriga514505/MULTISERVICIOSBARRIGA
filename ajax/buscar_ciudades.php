<?php
require_once("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
$options = '';
$sql = $con->query("SELECT * FROM ciudades WHERE departamentos_IDDEPARTAMENTO = " . $_GET["departamento"] . ";");
while ($response = mysqli_fetch_array($sql)) {
    echo '<option value="'.$response['IDCIUDAD'].'">'.$response['NOMBRECIUDAD'].'</option>';
}
?>