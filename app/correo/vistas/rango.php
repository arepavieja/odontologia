<script>
	$(function(){
		$('.fecha').datepicker();
		$('.enviar-correo-fecha').validate({
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
				$('.alert-danger', $('.enviar-correo-fecha')).show();
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
				$.post('app/correo/procesos/_enviar.rango.php',$('.enviar-correo-fecha').serialize(),function(data){
					//$('.modal').modal('hide');
					modal('app/correo/vistas/listaEnvios.php','datos='+data);
				})
			},
			invalidHandler: function (form) {
			}
		})
	})
</script>
<form action="" class="enviar-correo-fecha form-horizontal col-sm-8 col-sm-offset-2">
	<fieldset>
		<legend class="text-success">Por Rango de Fecha</legend>
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
				Desde:
			</label>
			<div class="col-sm-4">
				<input type="text" class="form-control fecha" name="desde" data-date-format="dd-mm-yyyy">
			</div>
			<label for="" class="col-sm-2 bolder">
				Hasta:
			</label>
			<div class="col-sm-4">
				<input type="text" class="form-control fecha" name="hasta" data-date-format="dd-mm-yyyy">
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
	</fieldset>
	<div class="clearfix"></div>
</form>