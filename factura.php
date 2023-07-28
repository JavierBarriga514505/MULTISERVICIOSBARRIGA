<?php // se genera el recibo de copmpra del usuario para que el mismo pague en el punto de venta o pueda realizar su transaccion mediante pago electronico.
session_start();
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos

$mensaje = $_GET["mensaje"];
$id_usuario = $_SESSION['id_usuario'];

$sqlFactura = $con->query("SELECT * FROM compras WHERE id_compra = " . $mensaje . ";");
$responseFactura = mysqli_fetch_assoc($sqlFactura);
$sqlUsuario = $con->query("SELECT * FROM usuarios WHERE id_usuario = " . $id_usuario . ";");
$responseUsuario = mysqli_fetch_assoc($sqlUsuario);
?>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <style>
    @media print {
      html {
        zoom: 50%;
      }

      [type="button"],
      [type="submit"],
      [type="reset"] {
        display: none;
      }

      .oculto {
        display: none !important;
      }

      hr {
        border: 4px dotted blue;
        width: 50%;
      }
    }
  </style>
  <title>Recibo # <?= $responseFactura["id_compra"]; ?></title>
</head>

<body>
  </div>
  <div id="app" class="col-12">
    <center>
      <div id="printbutton">
        <h2>Recibo de Cobro # <?= $responseFactura["id_compra"]; ?></h2>
        <div class="row my-3">
          <div class="col-10">
            <h1>Paga con tu codigo QR en Nequi</h1>
          </div>
          <!-- img src="images/qr.png" width="200" height="200" /-->
          <div class="row">
            <img class="col-6" src="images/nequipago.png" width="300" height="300" />
            <img class="col-6" src="images/codigo.jpg" width="300" height="300" />
            <h1>Valor a pagar: $<?= $responseFactura["total"]; ?></h1>
          </div><br>
          <script src="https://checkout.epayco.co/checkout.js" class="epayco-button" data-epayco-external="false" data-epayco-key="a11a4e134e0a692d4cedc9f584f9b9ee" data-epayco-amount="<?= $responseFactura["total"]; ?>" data-epayco-name="Factura # <?= $responseFactura["id_compra"]; ?> de <?= $responseUsuario["name"]; ?>" data-epayco-description="Factura # <?= $responseFactura["id_compra"]; ?> de <?= $responseUsuario["name"]; ?>" data-epayco-currency="cop" data-epayco-country="co" data-epayco-lang="es" data-epayco-test="true" data-epayco-invoice="<?= $responseFactura["id_compra"]; ?>" data-epayco-button="images/btn-pay.png" data-epayco-response="https://multiserviciobarriga.000webhostapp.com/pay-done.php" data-epayco-autoclick="false" data-epayco-email-billing="<?= $responseUsuario["email"]; ?>" data-epayco-name-billing="<?= $responseUsuario["name"]; ?>" data-epayco-type-doc-billing="<?= $responseUsuario["tipo_documento"]; ?>" data-epayco-number-doc-billing="<?= $responseUsuario["numero_documento"]; ?>" data-epayco-mobilephone-billing="<?= $responseUsuario["celular_usuario"]; ?>" data-epayco-address-billing="<?= $responseUsuario["direccion_usuario"]; ?>"></script>
        </div><br>
      </div>
      <input type="button" value="Imprimir" class="printbutton"> <a href="ver_compras.php"><input type="button" value="Volver"></button></a>
      <script>
        document.querySelectorAll('.printbutton').forEach(function(element) {
          element.addEventListener('click', function() {
            print();
          });
        });
      </script>
    </center>
</body>

</html>