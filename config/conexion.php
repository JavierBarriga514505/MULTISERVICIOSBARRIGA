<?php
    $con = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	date_default_timezone_set('America/Bogota');
    if(!$con){
        die("Imposible conectarse: " . mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: " . mysqli_connect_errno() . " : " . mysqli_connect_error());
    }
?>
