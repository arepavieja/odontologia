<?php 
require '../../../cfg/base.php';
$clientes_rows = $musuarios->getAll();
?>
<script>
	$(function(){
		$(".uno").chosen({
			no_results_text: "No hay resultados"
		});
		$('.enviar-correo-destino').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				destino: {
					email: true,
					required: true,
				},
				cuerpo: {
					required: true
				},
				titulo: {
					required: true
				}
			},
			messages: {
				destino: {
					email: 'Correo no válido',
					required: 'Obligatorio',
				},
				cuerpo: {
					required: 'Obligatorio'
				},
				titulo: {
					required: 'Obligatorio'
				}
			},
			invalidHandler: function (event, validator) { 
				$('.alert-danger', $('.enviar-correo-destino')).show();
			},			
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
			submitHandler: function (form) {
				modal('cargando.php','');
				$.post('app/correo/procesos/_enviar.destino.php',$('.enviar-correo-destino').serialize(),function(data){
					modal('app/correo/vistas/listaEnvios.php','datos='+data);
				})
			},
			invalidHandler: function (form) {
			}
		})
	})
</script>
<form action="" class="enviar-correo-destino form-horizontal col-sm-8 col-sm-offset-2">
	<fieldset>
		<legend class="text-success">Por Destinatario</legend>
		<div class="form-group">
			<label for="" class="col-sm-2 bolder">
				Título:
			</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="titulo">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-2 bolder">
				Para:
			</label>
			<div class="col-sm-10">
				<select class="uno form-control col-sm-12" data-placeholder="Buscar por cédula, nombre o correo" multiple name="para[]">
					<option value=""></option>
					<?php foreach($clientes_rows as $r) { ?>
						<option value="<?php echo $r->pacien_email.'/'.$r->pacien_nomraz ?>">
							 <?php echo $r->pacien_nomraz ?> <?php echo $r->pacien_cedrif ?> <?php echo $r->pacien_email ?>
						</option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-2 bolder">
				Mensaje:
			</label>
			<div class="col-sm-10">
				<textarea class="form-control" name="cuerpo" rows="10"></textarea>
			</div>
		</div>
		
		<div class="form-actions clearfix">
			<button class="btn btn-primary pull-right" type="submit">
				Click para enviar Correo
			</button>
		</div>
		<div class="clearfix"></div>
	</fieldset>
</form>