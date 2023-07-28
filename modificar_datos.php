<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
$usuario = $_GET["id"];
$id_usuario = base64_decode($usuario);

$consulta = "SELECT * FROM usuarios WHERE id_usuario='$id_usuario';";

$resul = mysqli_query($con, $consulta);

while ($row = mysqli_fetch_array($resul)) {
    $email = $row['email'];
    $celular_usuario = $row['celular_usuario'];
    $direccion_usuario = $row['direccion_usuario'];
    $id_ciudad = $row['IDCIUDAD'];
    $sql3 = "SELECT * FROM departamentos, ciudades WHERE departamentos.IDDEPARTAMENTO=ciudades.departamentos_IDDEPARTAMENTO and ciudades.IDCIUDAD='$id_ciudad';";
    $query1 = mysqli_query($con, $sql3);
    while ($row1 = mysqli_fetch_assoc($query1)) {
        $ciudad1 = $row1['NOMBRECIUDAD'] . " - " . $row1['NOMBREDEPARTAMENTO'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <style type="text/css">
            #footer {
                width: 100%;
                height: 205px;
            }

            .bg-image-vertical {
                position: relative;
                overflow: hidden;
                background-repeat: no-repeat;
                background-position: right center;
                background-size: auto 100%;
            }

            @media (min-width: 1025px) {
                .h-custom-2 {
                    height: 100%;
                }

                .vcenter * {
                    vertical-align: middle;
                    display: inline-block;
                }
            }

            select {
                background: transparent;
                border: none;
                font-size: 14px;
                height: 30px;
                padding: 5px;
                width: 100%;
            }

            .caja::after {
                content: "\025be";
                display: table-cell;
                text-align: center;
                padding-top: 7px;
                width: 30px;
                height: 30px;
                background-color: #d9d9d9;
                position: absolute;
                top: 0;
                right: 0px;
                pointer-events: none;
            }
        </style>
        <?php include("includes/header.php"); ?>
    </header>

    <section class="vh-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="well well-sm">
                        <form class="form-horizontal" method="post" action="actualizarusuario.php">
                            <fieldset>
                                <legend align="center" class="text-center header">Actualizar Datos</legend>

                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone bigicon"> Celular</i></span>
                                    <div class="col-md-12">
                                        <input id="celular_usuario" name="celular_usuario" value="<?php echo $celular_usuario ?>" type="number" placeholder="Ingrese su numero de Celular" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-home bigicon"> Direccion </i></span>
                                    <div class="col-md-12">
                                        <input id="direccion" name="direccion" value="<?php echo $direccion_usuario;  ?>" required type="text" placeholder="Ingrese Direccion de Residencia" class="form-control">
                                        <input id="ciudadantigua" name="ciudadantigua" value="<?php echo $id_ciudad;  ?>" required type="hidden" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-search bigicon"></i></span>
                                    <div class="col-md-12">
                                        <p> Ciudad Actual : <?php echo $ciudad1; ?> </p>
                                        <p> Si no desea actualizarla no seleccione ninguna </p>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-road bigicon"> Departamento</i></span><br>
                                        <select id="departamento" name="departamentos" required class="form-control">
                                            <option id="0">Selecionar departamento...</option>
                                            <?php
                                            $sql6 = $con->query("SELECT * FROM departamentos;");
                                            while ($response = mysqli_fetch_assoc($sql6)) {
                                            ?>
                                                <option id="<?php echo $response["IDDEPARTAMENTO"]; ?>"><?php echo $response["NOMBREDEPARTAMENTO"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-road bigicon"> Ciudad</i></span><br>
                                        <select id="ciudad" name="ciudad" required disabled class="form-control">
                                            <option id="0" value="0">Seleccione una Ciudad...</option>
                                        </select>
                                    </div>
                                    <script>
                                        $('#departamento').on('change', function() {
                                            $('#ciudad').html("");
                                            $('#ciudad').prop("disabled", false);
                                            var options = '<option id="1">Seleccionar ciudad...</option>';
                                            $.ajax({
                                                url: 'ajax/buscar_ciudades.php',
                                                data: {
                                                    departamento: $('#departamento').find('option:selected').attr('id')
                                                },
                                                cache: false,
                                                success: function(data) {
                                                    options = options + data;
                                                    $('#ciudad').html(options);
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope bigicon"> Correo</i></span>
                                    <div class="col-md-12">
                                        <input id="email" name="email" value="<?php echo $email; ?>" type="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" placeholder="Ingrese Email" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>