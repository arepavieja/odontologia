<?php 
require '../../../cfg/base.php';
  $evolmax = $modonto->evolucionSelectmax($trat_ide);
?>
<script type="text/javascript">
	jQuery(function($){		
		$.mask.definitions['~']='[+-]';
		$('.date-picker').datepicker();
		//$('.input-mask-eyescript').mask('99999.99');

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
				$.post('app/odonto/procesos/p.evolucion.insert.php',$('.insert-evolucion').serialize(),function(data){
					if(!isNaN(data)) {
						load('app/odonto/vistas/evolucion.update.php','msj=1&evol_ide='+data,'.evolucion');
					} else {
						alert(data);
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
            
            //alert(keycode);
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

<form class="insert-evolucion">
	<div class="form-group">
		<label for="" class="control-label col-sm-12 bolder">Evolución:</label>
		<div class="col-sm-10">
			<textarea id="" cols="30" rows="5" class="col-sm-10" style="resize:none" name="descripcion"></textarea>
			<div class="clearfix"></div>
			<div class="space-10"></div>
			<label for="" class="control-label col-sm-10 bolder">Fecha:</label>
            <input type="text" readonly autocomplete="off" class="col-sm-10 date-picker" data-date-format="yyyy-mm-dd" name="evol_fec" value="<?php echo date("Y-m-d"); ?>">
			<div class="clearfix"></div>
			<div class="space-10"></div>
      <div id='suma'>  
             <div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Saldo:</label>
							<div class="col-sm-12">
							<?php if(empty($evolmax[0]->total)){ ?>	
								<input type="text" class="col-sm-12" value="<?php echo $prec ?>" name="precp" id="precp" readonly>
							<?php }else{?>	
								<input type="text" class="col-sm-12" value="<?php echo $evolmax[0]->evol_falta; ?>" name="precp" id="precp" readonly>                            
                            <?php } ?>	
							</div>

						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Abono:</label>
							<div class="col-sm-12">
								            <input type="text" class="col-sm-12" name="abono" id="abono">
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Resta:</label>
							<div class="col-sm-12">
								           <input type="text" class="col-sm-12" name="restap" id="restap">
							</div>
						</div>	
					</div>
	  </div>
	 </div>
	</div>
	  <div class="clearfix"></div>
	  <div class="space-10"></div>
	<button type="submit" class="btn btn-primary pull-right">Agregar Evolución</button>
	<div class="clearfix"></div>
	<input type="hidden" name="trat_ide" value="<?php echo $trat_ide ?>">
</form>
<div class="clearfix"></div>
