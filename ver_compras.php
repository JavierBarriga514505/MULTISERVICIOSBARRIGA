<?php include("includes/header.php"); ?>

<style type="text/css">
	.panel-heading {
		background-color: #12A066;
	}

	.panel {
		border-color: #12A066;
	}
</style>

<header class="masthead">
	<div class="container d-flex h-100 align-items-center">
		<div class="mx-auto text-center">
			<h2 class="mx-auto my-0 text-uppercase">Ver Mis Compras</h2>
		</div>
	</div><br>
</header>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="well well-sm">
				<h4><i class='glyphicon glyphicon-search'></i> Buscar Compras</h4>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" id="datos_cotizacion">
					<div class="form-group row">
						<label for="q" class="col-md-2 control-label">Código o nombre</label>
						<div class="col-md-7">
							<input type="text" class="form-control" id="q" placeholder="Código o valor de la compra" onkeyup='load(1);'>
						</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-success" onclick='load(1);'>
								<span class="glyphicon glyphicon-search"></span> Buscar</button>
							<span id="loader"></span>
						</div>

					</div>
				</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->
			</div>
		</div>
	</div>
	<!-- Bootstrap core JS-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Third party plugin JS-->
	<script type="text/javascript" src="js/compras.js"></script>
	</body>
	</html>