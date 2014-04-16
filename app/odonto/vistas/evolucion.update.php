<?php 
require '../../../cfg/base.php';
$evol = $modonto->evolucionSelectIde($evol_ide);
#print_r($evol);
?>
<script src="app/odonto/vistas/js/wysiwyg.js"></script>
<script type="text/javascript">
$('.date-picker').datepicker();
	<?php if(isset($msj) and $msj==1) { ?>
		alerta('.msj-registro','success','Registro agregado correctamente, puede agregar las fotos en el recuadro gris');
	<?php } ?>
	load('app/odonto/vistas/fotos.lista.php','evol_ide=<?php echo $evol_ide; ?>','#fotos-lista');
	jQuery(function($){

	try {
	  $(".dropzone").dropzone({
	    paramName: "file_evo", // The name that will be used to transfer the file
	    maxFilesize: 10.0, // MB
	  	acceptedFiles: 'image/*', 
	  	url: 'app/odonto/procesos/p.evolucion.imagen.insert.php?evol_ide=<?php echo $evol[0]->evol_ide; ?>',
			addRemoveLinks : true,
			dictResponseError: '¡Error al cargar el archivo!',
			dictDefaultMessage: '',
			dictFallbackMessage: '',

			//change the previewTemplate to use Bootstrap progress bars

		  });
		} catch(e) {
		  alert('¡Dropzone no es compatible!');
		}			

      $('.insert-evolucion').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				descripcion: {
					required: true						
				},
				abono: {
					required: true
				}
			},
			messages: {
				descripcion: {
					required: 'Debe indicar una descripción para la evaluación'	
				},
				abono: {
					required: 'Debe indicar el abono'	
				}
			},
			invalidHandler: function (event, validator) { 
				$('.alert-danger', $('.insert-evolucion')).show();
			},			
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
			submitHandler: function (form) {
				$.post('app/odonto/procesos/p.evolucion.update.php',$('.insert-evolucion').serialize()+'&descripcion='+$('#editor2').html(),function(data){
					if(data==1) {
						alerta('.msj-registro','success','Registro actualizado')
					} else {
						alerta('.msj-registro','danger','¡Error al modificar el registro!')
					}
					})
			},
			invalidHandler: function (form) {
			}
		})
	});


        // Cada vez que se pulse una tecla, controlamos que sea numerica
        $("#suma input").keypress(function(event) {
            //obtenemos la tecla pulsada
            var valueKey=String.fromCharCode(event.which);
            //obtenemos el valor ascii de la tecla pulsada
            var keycode=event.which;
            
            // Si NO pulsamos un numero, un punto, la tecla suprimir
            // la tecla backspace o el simobolo "-" (45), cancelamos la pulsacion
            if(valueKey.search('[0-9|\.]')!=0 && keycode!=8 && keycode!=46 && keycode!=45 && keycode!=13)
            {
                // anulamos la pulsacion de la tecla
                return false;
            }else{
            	
            }
        });
        
        // evento que se ejecuta cada vez que se suelte la tecla en cualquiera de
        // los tres inputs
        $("#suma input").keypress(function(event) {
           var keycode=event.which;
           calcular(keycode);    
        });
        // Calculamos la suma de los dos valores
        function calcular(valor3)
        {
            var valor1=$('#abono').val();
            var valor2=$('#precp').val();
            var total=(parseFloat(valor2)-parseFloat(valor1));
             //alert(total);
            //alert(total+' '+valor2);
            if (total<0 && valor3==13){   
                 alert("El abono no puede ser mayor al restante");
                 $("#restap").val(0);
                 $('#abono').val(null);
            }else{ 
               $("#restap").val(total);
            }
        }

           // Funcion para validar que el numero sea correcto, y para cambiar el color
        // del marco en caso de error
        function validarNumero(id)
        {
            if($.isNumeric($(id).val()))
            {
                $(id).css('border-color','#808080');
                return parseFloat($(id).val());
            }else if($(id).val()==""){
                $(id).css('border-color','#808080');
                return 0;
            }else{
                $(id).css('border-color','#f00');
                return 0;
            }
        }

</script>
<div class="space-10"></div>
<div class="msj-registro"></div>
<form class="insert-evolucion">
	<div class="form-group">
		<label for="" class="control-label col-sm-12 bolder">Evolución:</label>
		<div class="col-sm-12">
<!--
			<textarea id="" cols="30" rows="5" class="col-sm-12" style="resize:none" name="descripcion"><?php echo $evol[0]->evol_des ?></textarea>
-->
			<div class="wysiwyg-editor" id="editor2"><?php echo $evol[0]->evol_des ?></div>
			<div class="clearfix"></div>
			<div class="space-10"></div>
			<label for="" class="control-label col-sm-12 bolder">Fecha:</label>
            <div class="clearfix"></div>
			<div class="space-10"></div>
            <input type="text" readonly autocomplete="off" class="col-sm-12 date-picker" data-date-format="yyyy-mm-dd" name="evol_fec" value="<?php echo $evol[0]->evol_fec ?>">
      <div id='suma'>  
             <div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Costo:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" value="<?php echo $evol[0]->proced_prec ?>" name="precp" id="precp" readonly>
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Abono:</label>
							<div class="col-sm-12">
								  <input type="text" class="col-sm-12" name="abono" id="abono" value="<?php echo $evol[0]->evol_pago ?>" readonly>
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Resta:</label>
							<div class="col-sm-12">
								           <input type="text" class="col-sm-12" name="restap" id="restap" value="<?php echo $evol[0]->evol_falta ?>" readonly>
							</div>
						</div>	
					</div>
	  </div>
	  <div class="clearfix"></div>
	  <div class="space-10"></div>
			<button type="submit" class="btn btn-primary pull-right">Guardar Evolución</button>
		</div>			
	</div>
	<div class="clearfix"></div>
	

	<input type="hidden" name="evol_ide" value="<?php echo $evol[0]->evol_ide ?>">
</form>

<div class="clearfix"></div>
<div class="space-10"></div>
<label for="" class="control-label col-sm-12 bolder">Area para ingresar Fotos:</label>
<div class="clearfix"></div>
<form action="" class="clearfix dropzone dz-clickable" style="min-height:50px;background-color:#F7F7F7">
	<div class="dz-default dz-message" style="display:none">
		<div class="alert alert-info">Click Aquí para cargar imágenes</div>
	</div>
	<div class="fallback">
		<input name="file_evo" type="file" multiple="" />
	</div>
	<div id="fotos-lista" style="z-index:100"></div>
</form>
<div class="clearfix"></div>