<?php include("includes/header.php"); ?>

<style type="text/css">
  .panel-heading {
    background-color: #12A066;
  }

  .panel {
    border-color: #12A066;
  }

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

<header class="masthead">
  <div class="container d-flex h-100 align-items-center">
    <div class="mx-auto text-center">
      <h2 class="mx-auto my-0 text-uppercase">Actualiza Informacion</h2>
    </div>
  </div><br>
</header>
<section class="vh-100">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="well well-sm">
          <form class="form-horizontal" method="post" action="passwordcambio.php">
            <fieldset>
              <legend align="center" class="text-center header">Actualizar Contraseña</legend>

              <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-lock bigicon"></i></span>
                <div class="col-md-12">
                  <input id="password" name="password" type="password" placeholder="Ingrese Contraseña Antigua" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-lock bigicon"></i></span>
                <div class="col-md-12">
                  <input id="password1" name="password1" type="password" placeholder="Ingrese Contraseña Nueva" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-lock bigicon"></i></span>
                <div class="col-md-12">
                  <input id="password2" name="password2" type="password" placeholder="Repita  Contraseña Nueva" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
                </div>
              </div>
            </fieldset>
          </form>

          <div class="panel-body">
          </div>

          <!-- Bootstrap core JS-->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
          <!-- Third party plugin JS-->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
          <!-- Core theme JS-->
          <script src="js/scripts.js"></script>
          <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

          </body>
          </html>