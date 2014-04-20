<?php 
require '../../../cfg/base.php';
$clientes_rows = $musuarios->getAll();
?>
<?php echo $fun->modalHeader('Crear Nueva Cita') ?>
<script>
	$(function(){
		$(".uno").chosen({
			no_results_text: "No hay resultados",
			max_selected_options: 1
		});
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
		<form action="" class="form-horizontal buscar-cedula col-sm-12" role="form" id="validarCedula">
<!--
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
-->
			<div class="form-group">
				<label for="" class="control-label col-sm-2 bolder">Buscar</label>
				<div class="col-sm-1">
					<select name="nac" id="nac" class="">
						<option value="V">V</option>
						<option value="E">E</option>
					</select>
				</div>
				<div class="col-sm-8">
					<select id="cedrif" class="uno form-control col-sm-12" data-placeholder="Seleccione" multiple="" name="ced">
						<option value=""></option>
						<?php foreach($clientes_rows as $r) { ?>
							<option value="<?php echo substr($r->pacien_cedrif,1) ?>"><?php echo $r->pacien_nro_histo.' - '.substr($r->pacien_cedrif,1).' - '.$r->pacien_nomraz ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-sm-1">
					<button class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
				</div>
			</div>
			<input type="hidden" id="cedrif2">
		</form>	
		<div id="registro-cita"></div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
	<button class="btn btn-default cerrarmodal" data-dismiss="modal" type="button" data-bb-handler="cancel">Cancelar</button>
</div>
<script>
	$(function(){
		$('.chosen-container-multi').attr('style','width:100%')
	})
</script>