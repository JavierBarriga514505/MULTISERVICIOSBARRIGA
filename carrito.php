	<!DOCTYPE html>
<html>

<head>
    <title>Carrito</title>
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
		<?php 
	$id_usuario= $_SESSION['id_usuario'];
	$sql7="SELECT * FROM  usuarios WHERE id_usuario='$id_usuario';";
		$query7 = mysqli_query($con, $sql7);
						while ($row=mysqli_fetch_array($query7)){
							$nombre=$row['name'];
							$tipo_documento=$row['tipo_documento'];
							$numero_documento=$row['numero_documento'];
							$celular_usuario=$row['celular_usuario'];
							$email=$row['email'];
							$direccion_usuario=$row['direccion_usuario'];
							$id_ciudad=$row['IDCIUDAD'];
						 $sql8="SELECT * FROM departamentos, ciudades WHERE departamentos.IDDEPARTAMENTO=ciudades.departamentos_IDDEPARTAMENTO and ciudades.IDCIUDAD='$id_ciudad';";
		$query8 = mysqli_query($con, $sql8);
		while ($row8=mysqli_fetch_assoc($query8)){
			$ciudad1=$row8['NOMBRECIUDAD']." - " .$row8['NOMBREDEPARTAMENTO'];}}

 ?>
  <header class="masthead">
            <div class="container d-flex h-100 align-items-center">
                <div class="mx-auto text-center">
                    <h2 class="mx-auto my-0 text-uppercase">Carrito de Compras</h2>
                </div>
            </div><br>
        </header>
		  <div class="container">
                <div class="row">
				  <div class="col-md-12">
					<div class="well well-sm">

			<h4><i class='glyphicon glyphicon-search'></i>Ver Productos en Carrito</h4> 
			</div>	

			<?php 	
		
		?>
		<div class="panel-body">
		
<div class="table-responsive">
			  <table class="table">
			  <center><tr>
					<th>Código</th>
					<th>Producto</th>
					<th>Precio Unidad</th>
					<th>Cantidad Solicitada</th>
					<th>Marca</th>
					<th>Categoria</th>
					<th>Total</th>
					<th >Eliminar del Carrito</th>
	
			 <form class="form-horizontal" method="POST" action="comprar.php">
               		<?php 
					// ver todos los productos que se han agregado a un usuario en su carrito con la posibilidad de eliminarlo
				$id_usuario= $_SESSION['id_usuario'];
				$sql="SELECT * FROM  cart WHERE id_usuario='$id_usuario';";
		$query = mysqli_query($con, $sql);
						while ($row=mysqli_fetch_array($query)){
					
					$referencia=$row['referencia_producto'];
					$id_producto=$row['id_producto'];
					$precio_producto=$row['precio_producto'];
					$cantidad_producto=$row['cantidad_producto'];
					$id_carrito=$row['id_carrito'];
		
		$sql1="select * from productos where id_producto='".$id_producto."' and codigo_producto='".$referencia."'";
		$query1 = mysqli_query($con, $sql1);
		
					while ($row1=mysqli_fetch_array($query1)){
						$id_marca=$row1['id_marca'];
						$id_categoria=$row1['id_categoria'];
						
		$sql2="select * from marcas, categorias where marcas.id_marca='".$id_marca."' and categorias.id_categoria='".$id_categoria."'";
		$query2 = mysqli_query($con, $sql2);
		
					while ($row2=mysqli_fetch_array($query2)){					
					
					?>
			  
                          
						  <tr>
						  <td>  <img src="<?php echo $row1['foto_producto']?>" width="50" height="!00"></td>
						    <td><?php echo $row1['nombre_producto']?></td>
							  <td><?php $precio_publico=$row['precio_producto'];echo  number_format($precio_producto)?> </td>
							    <td><?php echo $cantidadproducto=$row['cantidad_producto']?></td>
								 <td><?php echo $row2['nombre_marca']?></td>
						 <td><?php echo $row2['nombre_categoria']?></td>
						<td><?php echo number_format($total=$cantidad_producto*$precio_producto);?></td>
								 <td><a href="eliminar_carrito.php?id=<?php echo base64_encode($id_carrito)?>"><button type="button" class="btn btn-light" > <i class="fa fa-ban bigicon"><br>Eliminar</i></button></a></td>
        		
						<?php }}}?>  </tr>
						  </table>	  
						  </div>    
					 <input id="id" name="id" type="hidden" value="1" class="form-control">
                          
						</div>
                    </div>
                </div>
		<center><input class="btn btn-primary" type="submit" value="Comprar"></td>
		</center>		
                          
	                   
             <legend align="center" class="text-center header">¿Deseas que tu producto sea enviado a otra parte del pais?</legend>
				<p> Si tu respuesta es si, selecciona SI y llena los datos del formulario.</p>
				<div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-id-card bigicon"></i></span>
                            <div class="col-md-12" class="caja">
							
                                <select name="envio" id="envio">
							<option value="NO">Seleccione si desea enviar o no tu producto a otro municipio del pais</option>
							<option value="SI">Si, deseo enviarlo a otra parte del pais</option>
							<option value="NO">No, paso por el producto al establecimiento</option>
							</select>  </div>
                        </div>	
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-12">
                                <input id="name" name="name" required pattern="[a-zA-Z ]{2,254}" value="<?php echo $nombre; ?>" type="text" placeholder="Ingrese Nombre" class="form-control">
                            </div>
                        </div>
						  <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-id-card bigicon"></i></span>
                            <div class="col-md-12" class="caja">
							
                                <select name="tipo_documento" required id="tipo_documento" value="<?php echo $tipo_documento ?>">
							<option value="CC">Seleccione el Tipo de Documento</option>
							<option value="CC">Cedula de Ciudadania</option>
							<option value="TI">Tarjeta de Identidad</option>
							<option value="CE">Cedula de Extranjeria</option>
							</select>  </div>
                        </div>				
						
						  <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-address-card bigicon"></i></span>
                            <div class="col-md-12">
                                <input id="identificacion" required name="identificacion" value="<?php echo $numero_documento ?>" type="number" placeholder="Ingrese su numero de Identificacion" class="form-control">
                            </div>
                        </div>				
						
						  <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone bigicon"></i></span>
                            <div class="col-md-12">
                                <input id="celular" name="celular" required value="<?php echo $celular_usuario ?>" type="number" placeholder="Ingrese su numero de Celular" class="form-control">
                            </div>
                        </div>	
						
						
				<div class="form-group">
                                    <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-search bigicon"></i></span>
                                    <div class="col-md-12">
                                <p> Ciudad Actual : <?php echo $ciudad1;?> </p>
								
<input type="hidden" value="<?php echo $id_ciudad;?>" name="ciudad">
								                                    </div></div>  
                                  
											<div class="row form-group">
                                                          
						  <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-map bigicon"> Direccion: </i></span>
                            <div class="col-md-12">
                                <input id="direccion" name="direccion" value="<?php echo $direccion_usuario;?>" required  type="text" placeholder="Ingrese direccion de Residencia" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope bigicon"></i></span>
                            <div class="col-md-12">
                                <input id="email" name="email" type="email" required value="<?php echo $email?>" placeholder="Ingrese Email" class="form-control">
                            </div>
                        </div>

                                     
   </div>  
                                
			</form>
 <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
</body>

</html>