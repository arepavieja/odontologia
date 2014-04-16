<?php 
require '../../../cfg/base.php';
?>
<?php echo $fun->modalHeader('Crear Nueva Cita') ?>
<script>
	$(function(){
		$('#validarCedula').validate({
			errorElement: 'div',
			errorClass: 'help-inline',
			focusInvalid: true,
			rules: {
				ced: {
					required: true,
					maxlength: 9,
					minlength: 7,
					number: true
				}
			},
			messages: {
				ced: {
					required: "Indique cédula",
					maxlength: 'Número de cédula no válido',
					minlength: 'Número de cédula no válido',
					number: 'Debe indicar un valor numérico'
				}
			},
			invalidHandler: function (event, validator) { 
				$('.alert-danger', $('#validarCedula')).show();
			},			
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
			submitHandler: function (form) {
				nac = $('#nac').val();
				ced = $('#cedrif').val();
				cedrif = nac+''+ced;
				inicio = '<?php echo $inicio ?>';
				fin = '<?php echo $fin ?>';
				dia = '<?php echo $dia ?>';
				datos = 'inicio='+inicio+'&fin='+fin+'&dia='+dia+'&cedrif='+cedrif
				$.post('app/historia/procesos/p.cedula.buscar.php',$('.buscar-cedula').serialize(),function(data){
					if(data==1) {
						$.post('app/historia/procesos/p.cedula.existe.php','cedrif='+cedrif,function(data2){
							if(data2==1) {
								load('app/citas/vistas/registrado.php',datos,'#registro-cita');
							} else {
								load('app/citas/vistas/no.registrado.php',datos,'#registro-cita');
							}
						})
					} else {
						alerta('.msj','danger',data);
					}
				})
			},
			invalidHandler: function (form) {
				$('#historia').fadeOut(1);
			}
		})
	})	
</script>
<div class="modal-body">
	<div class="col-sm-10 col-md-offset-1">
		<form action="" class="form-inline buscar-cedula" role="form" id="validarCedula">
			<div class="form-group">
				<label class="col-sm-2"><strong>Cédula:</strong></label>
				<div class="col-sm-2">
					<select name="nac" id="nac" class="form-control">
						<option value="V">V</option>
						<option value="E">E</option>
					</select>
				</div>
				<div class="col-sm-7">
					<input autocomplete="off" id="cedrif" type="text" placeholder="Número de Cédula" name="ced" class="form-control">
				</div>
				<div class="col-sm-1">
					<button class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
				</div>
			</div>
		</form>	
		<div id="registro-cita"></div>
	</div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
	<button class="btn btn-default cerrarmodal" data-dismiss="modal" type="button" data-bb-handler="cancel">Cancelar</button>
</div>