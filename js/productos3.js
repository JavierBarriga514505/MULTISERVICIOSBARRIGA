		$(document).ready(function(){
			load(1);
		});

		function load(page){
			var q= $("#q").val();
			var id_usuario= $("#id_usuario").val();
			var nombre_usuario= $("#nombre_usuario").val();
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'./ajax/buscar_productos3.php?action=ajax&page='+page+'&q='+q+'&id_usuario='+id_usuario+'&nombre_usuario='+nombre_usuario,
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./images/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
		}
