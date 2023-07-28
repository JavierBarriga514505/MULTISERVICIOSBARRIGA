<?php
function randomString() {
	$cadena = "";
	$opc = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz";
	for ($i = 0; $i <= 16; $i++)
		$cadena .= substr($opc, rand(0, strlen($opc)), 1);
	return $cadena;
}
function curarVar($var) {
    $variable = $var;
    $variable = trim($variable);
    $variable = strip_tags($variable);
    $variable = htmlspecialchars($variable);
    return $variable;
}
?>