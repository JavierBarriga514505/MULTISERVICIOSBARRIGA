<?php
session_start();
unset($_SESSION['usuario']);
?>
<!DOCTYPE html>
<html>

<head>
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>

<body>
  <header>
    <style type="text/css">
      .bg-image-vertical {
        position: relative;
        overflow: hidden;
        background-repeat: no-repeat;
        background-position: right center;
        background-size: auto 100%;
      }

      .column {
        width: 100%;
      }

      @media (min-width: 600px) {
        .column {
          width: 50%;
        }
      }

      html {
        min-height: 100%;
        position: relative;
      }

      body {
        margin: 0;
        margin-bottom: 40px;
      }

      footer {
        background-color: black;
        position: absolute;
        bottom: 0;
        width: 100%;
        height: 40px;
        color: white;
      }
    </style>
    <?php include("includes/header1.php"); ?>
  </header>

  <section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 text-black">
          <br>
          <br>
          <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

            <form method="post" action="validacion.php" style="width: 23rem;">
              <br>
              <h3 class="fw-normal mb-3 pb-3" align="center" style="letter-spacing: 1px;">Ingresar</h3>

              <div class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control form-control-lg" />
                <label class="form-label" for="email">Correo Electronico</label>
              </div>

              <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control form-control-lg" />
                <label class="form-label" for="password">Contraseña</label>
              </div>

              <div class="pt-1 mb-4">
                <button class="btn btn-info btn-lg btn-block" type="submit">Ingresar</button>
              </div>

              <center>
                <p>¿No estás registrado? <a href="registrarse.php" class="link-info">Registrate Ahora</a></p>
                <p>¿Olvidaste tu contraseña? <a href="recuperar.php" class="link-info">Recupérala Ahora</a></p>
              </center>

            </form>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="images/tienda1.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
        </div>
      </div>
    </div>
  </section>
  <div class="footer">
    <?php include("includes/piedepagina.php"); ?>
  </div>
</body>
</html>