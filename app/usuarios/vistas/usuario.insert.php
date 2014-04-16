<?php 
require '../../../cfg/base.php';
$tipo_usua_rows = $musuarios->tiposDeUsuario();
?>
<script>
	$(function(){
		$('.usuario-insert').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				cedula: {
					required: true,
					number: true,
					minlength: 7,
					maxlength: 9
				},
				nomraz: {
					required: true
				},
				usuario: {
					required: true
				},
				tipo: {
					required: true
				},
				clave: {
					required: true
				},
				clave2: {
					required: true,
					equalTo: "#clave"
				}
			},
			messages: {
				cedula: {
					required: 'Debe indicar la cédula',
					number: 'Debe ser numérico',
					minlength: 'Debe ser mayor a 7 caracteres',
					maxlength: 'Debe ser menor a 9 caracteres'
				},
				nomraz: {
					required: 'Debe indicar el nombre'
				},
				usuario: {
					required: 'Indique su nombre de usuario'
				},
				tipo: {
					required: 'Seleccione un tipo de usuario'
				},
				clave: {
					required: 'La clave es obligatoria'
				},
				clave2: {
					required: 'La confirmación es obligatoria',
					equalTo: "Las claves no coinciden"
				}
			},
			invalidHandler: function (event, validator) { 
				$('.alert-danger', $('.usuario-insert')).show();
			},			
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
			submitHandler: function (form) {
				$.post('app/usuarios/procesos/p.usuario.insert.php',$('.usuario-insert').serialize(),function(data){
					if(data==1){
						alerta('.msj','success','Registro Guardado correctamente');
						load('app/usuarios/vistas/lista.php','','#lista');
						setTimeout("$('.cerrarmodal').click()",2000);
					} else {
						alerta('.msj','danger',data);
					}
				})
			},
			invalidHandler: function (form) {
			}
		})
	})
</script>
<?php echo $fun->modalHeader('Crear Nuevo Usuario') ?>
<div class="modal-body">
	<div class="msj"></div>
	<form action="" class="form-horizontal usuario-insert">
		
		<div class="form-group">
			<label for="" class="control-label col-sm-4 bolder">Cédula de Identidad:</label>
			<div class="col-sm-1">
				<select name="nac" id="">
					<option value="V">V</option>
					<option value="E">E</option>
				</select>
			</div>
			<div class="col-sm-6">
				<input type="text" class="form-control col-sm-7" name="cedula">
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4 bolder">Apellidos y Nombres:</label>
			<div class="col-sm-7">
				<input type="text" class="form-control col-sm-7" name="nomraz">
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4 bolder">Nombre de Usuario:</label>
			<div class="col-sm-7">
				<input type="text" class="form-control col-sm-7" name="usuario">
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4 bolder">Tipo de Usuario:</label>
			<div class="col-sm-7">
				<select name="tipo" id="" class="col-sm-12">
					<option value="">--</option>
					<?php foreach($tipo_usua_rows as $tur) { ?>
						<option value="<?php echo $tur->nivusuario_codigo ?>"><?php echo $tur->nivusuario_descripcion ?></option>
					<?php } ?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4 bolder">Clave de Acceso:</label>
			<div class="col-sm-7">
				<input type="password" class="form-control col-sm-7" value="1234" name="clave" id="clave">
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4 bolder">Confirme Clave:</label>
			<div class="col-sm-7">
				<input type="password" class="form-control col-sm-7" value="1234" name="clave2">
			</div>
		</div>
		
		<div class="clearfix"></div>
		<div class="clearfix form-actions">
			<button class="btn btn-primary pull-right">Guardar</button>
			<button class="btn btn-default pull-right cerrarmodal" data-dismiss="modal" type="button" data-bb-handler="cancel">Cancelar</button>		
		</div>
		
	</form>
</div>