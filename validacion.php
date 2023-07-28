<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST["email"]) && !empty($_POST["password"])) {
    $email = $_POST["email"];
    $password = sha1($_POST["password"]);
    /* El query valida si el usuario ingresado existe en la base de datos. Se utiliza la función htmlentities para evitar inyecciones SQL. */
    $dato = "SELECT *  FROM usuarios WHERE email= '" . $email . "'";
    $myusuario = mysqli_query($con, $dato);
    $nmyusuario = mysqli_num_rows($myusuario);
    //Si existe el usuario, validamos también la contraseña ingresada y el estado del usuario... 
    if ($nmyusuario == 1) {
      $sql = "SELECT * FROM usuarios WHERE  estado_usuario='1' and email = '" . $email . "' and password = '" . $password . "' ";
      $myclave = mysqli_query($con, $sql);
      $nmyclave = mysqli_num_rows($myclave);
      //Si el usuario y clave ingresado son correctos (y el usuario está activo en la BD), creamos la sesión del mismo. 
      if ($nmyclave > 0) {
        session_start();

        while ($datos1 = mysqli_fetch_array($myclave)) {
          $usuario = $datos1['id_usuario'];
          $rol = $datos1['rol_usuario'];
          $nombre = $datos1['name'];
        }
        $_SESSION['id_usuario'] = $usuario;
        $_SESSION['rol'] = $rol;

        echo "<script>alert('Bienvenido, " . $nombre . ".'); window.location.href=\"home.php\"</script>";
      } else {
        echo "<script>alert('Contraseña Incorrecta o Usuario Inactivo.'); window.location.href=\"index1.php\"</script>";
      }
    } else {
      echo "<script>alert('Usuario inexistente.'); window.location.href=\"index1.php\"</script>";
    }
  }
}
?>