<?php
require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos
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
        <?php include("includes/header1.php"); ?>
    </header>

    <section class="vh-100">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="well well-sm">
                        <form class="form-horizontal" method="post" action="validarregistro.php">
                            <fieldset>
                                <legend align="center" class="text-center header">Registrate</legend>
                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                    <div class="col-md-12">
                                        <input id="name" name="name" required pattern="[a-zA-Z ]{2,254}" type="text" placeholder="Ingrese Nombre" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-id-card bigicon"></i></span>
                                    <div class="col-md-12" class="caja">
                                        <select name="tipo_documento" id="tipo_documento">
                                            <option value="CC">Seleccione el Tipo de Documento</option>
                                            <option value="CC">Cedula de Ciudadania</option>
                                            <option value="TI">Tarjeta de Identidad</option>
                                            <option value="CE">Cedula de Extranjeria</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-address-card bigicon"></i></span>
                                    <div class="col-md-12">
                                        <input id="identificacion" name="identificacion" min="1" max="100000000000" type="number" placeholder="Ingrese su numero de Identificacion" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone bigicon"></i></span>
                                    <div class="col-md-12">
                                        <input id="celular_usuario" name="celular_usuario" type="number" placeholder="Ingrese su numero de Celular" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-home bigicon"></i></span>
                                    <div class="col-md-12">
                                        <input id="direccion" name="direccion" required type="text" placeholder="Ingrese Direccion de Residencia" class="form-control">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-road bigicon"></i></span><br>
                                        <select id="departamento" name="departamentos" required class="form-control">
                                            <option id="0">Selecionar departamento...</option>
                                            <?php
                                            $sql = $con->query("SELECT * FROM departamentos;");
                                            while ($response = mysqli_fetch_assoc($sql)) {
                                            ?>
                                                <option id="<?php echo $response["IDDEPARTAMENTO"]; ?>"><?php echo $response["NOMBREDEPARTAMENTO"]; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-road bigicon"></i></span><br>
                                        <select id="ciudad" name="ciudad" required disabled class="form-control">
                                            <option id="0">Seleccione una Ciudad...</option>
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
                                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope bigicon"></i></span>
                                    <div class="col-md-12">
                                        <input id="email" name="email" type="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" placeholder="Ingrese Email" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-lock bigicon"></i></span>
                                    <div class="col-md-12">
                                        <input id="password" name="password" type="password" placeholder="Ingrese Contraseña" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">Registrate</button>
                                    </div>
                                </div>
                                <center>
                                    <p>¿No estás Registrado? <a href="registrarse.php" class="link-info">Registrate Ahora</a></p>
                                    <p>¿Ya tienes una cuenta? <a href="index1.php" class="link-info">Ingresa Ahora</a></p>
                                </center>
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