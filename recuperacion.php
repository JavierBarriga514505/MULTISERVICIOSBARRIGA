<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
include_once("includes/functions.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST["email"])) {
    $email = $_POST["email"];
    /* El query valida si el usuario ingresado existe en la base de datos. Se utiliza la función htmlentities para evitar inyecciones SQL. */
    $dato = "SELECT *  FROM usuarios WHERE email= '" . $email . "'";
    $myusuario = mysqli_query($con, $dato);
    $nmyusuario = mysqli_num_rows($myusuario);
    //Si existe el usuario, validamos también la contraseña ingresada y el estado del usuario... 
    if ($nmyusuario == 1) {
      $sql = "SELECT * FROM usuarios WHERE  estado_usuario='1' and email = '" . $email . "' ";
      $myclave = mysqli_query($con, $sql);
      $nmyclave = mysqli_num_rows($myclave);
      //Si el usuario y clave ingresado son correctos (y el usuario está activo en la BD), creamos la sesión del mismo. 
      if ($nmyclave > 0) {
        session_start();

        while ($datos1 = mysqli_fetch_array($myclave)) {
          $usuario = $datos1['id_usuario'];
          $rol = $datos1['rol_usuario'];
          $emailsend = $datos1['email'];
          $nombre = $datos1['name'];
        }

        $passtemp = randomString();
        $hashpasstemp =  sha1($passtemp);

        $mail_asunto = "Recuperar contraseña, MULTISERVICIO BARRIGA";

        $mail_header = "From: mateus@mnm.team\r\n";
        $mail_header .= "MIME-Version: 1.0\r\n";
        $mail_header .= "Content-type: text/html; charset=iso-8859-1\r\n";

        $mail_msg = ' <html> <head> <title> Recuperar contraseña </title> </head> <body>
                    <p>Hola, <strong>' . $emailsend . '</strong>.</p>
                    <p>Se ha pedido una recuperación de contraseña a su cuenta: <strong>' . $emailsend . '</strong>.</p>
                    Se le notifica que su nueva contraseña temporal con la que deberá iniciar sesión es:<br>
                    <strong>' . $passtemp . '</strong><br><br>
                    Sugerimos que cambie su contraseña inmediatamente después de iniciar sesión.
                </body> </html> ';


        if (@mail($emailsend, $mail_asunto, $mail_msg, $mail_header)) {
          $query = $conn->query(" UPDATE usuarios SET password='$hashpasstemp' WHERE id_usuario='$usuario'; ");
          if ($query)
            echo "<script>alert('Se ha enviado una contraseña temporal a su correo electrónico de administrador. (Sugerimos que revise su carpeta de spam y que cambie su contraseña inmediatamente después.'); window.location.href=\"index1.php\"</script>";
          else
            echo "<script>alert('Algo no salió bien. Intente de nuevo.'); window.location.href=\"index1.php\"</script>";
        } else
          echo "<script>alert('No se logró enviar el correo electrónico. Contacte al administrador'); window.location.href=\"index1.php\"</script>";
      } else {
        echo "<script>alert('Usuario Inactivo.'); window.location.href=\"recuperar.php\"</script>";
      }
    } else {
      echo "<script>alert('Usuario inexistente.'); window.location.href=\"recuperar.php\"</script>";
    }
  }
}
