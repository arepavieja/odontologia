<script>
	$(function(){
		$('.enviar-correo').validate({
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
				$('.alert-danger', $('.enviar-correo')).show();
			},			
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
			submitHandler: function (form) {
				$.post('app/correo/procesos/_enviar.php',$('.enviar-correo').serialize(),function(data){
					alert(data);
				})
			},
			invalidHandler: function (form) {
			}
		})
	})
</script>
<div id="breadcrumbs" class="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>
	<ul class="breadcrumb">
		<li><i class="icon-home home-icon"></i> <a href="">Inicio</a></li>
		<li class="active"><i class="fa fa-ambulance"></i> <a href="">Médico</a></li>
		<li class="active"> Historia Pacientes</li>
	</ul>
</div>
<div class="space-10"></div>
<form action="" class="enviar-correo form-horizontal col-sm-8 col-sm-offset-2">
	<div class="form-group">
		<label for="" class="col-sm-3 bolder">
			Título:
		</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="titulo">
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-3 bolder">
			Destino:
		</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="destino">
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-3 bolder">
			Mensaje:
		</label>
		<div class="col-sm-9">
			<textarea class="form-control" name="cuerpo"></textarea>
		</div>
	</div>
	
	<div class="form-actions clearfix">
		<button class="btn btn-primary pull-right" type="submit">
			Click para enviar Correo
		</button>
	</div>
	<div class="clearfix"></div>
</form>
<div class="clearfix"></div>