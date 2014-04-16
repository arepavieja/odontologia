<?php 
require '../../../cfg/base.php';
$tipo_usua_rows = $musuarios->tiposDeUsuario();
$usua_row = $musuarios->usuarioSelect($cedrif);
?>
<script>
	$(function(){
		$('.update-insert').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
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
				$('.alert-danger', $('.update-insert')).show();
			},			
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
			submitHandler: function (form) {
				$.post('app/usuarios/procesos/p.usuario.update.php',$('.update-insert').serialize(),function(data){
					if(data==1){
						alerta('.msj','success','Registro actualizado correctamente');
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
	<form action="" class="form-horizontal update-insert">
		
		<div class="form-group">
			<label for="" class="control-label col-sm-4 bolder">Cédula de Identidad:</label>
			<div class="col-sm-6">
				<input type="text" class="form-control col-sm-12" name="cedula" value="<?php echo $usua_row[0]->pacien_cedrif; ?>" readonly>
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4 bolder">Apellidos y Nombres:</label>
			<div class="col-sm-7">
				<input type="text" class="form-control col-sm-7" name="nomraz" value="<?php echo $usua_row[0]->pacien_nomraz ?>">
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4 bolder">Nombre de Usuario:</label>
			<div class="col-sm-7">
				<input type="text" class="form-control col-sm-7" name="usuario" value="<?php echo $usua_row[0]->usuario_login ?>">
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4 bolder">Tipo de Usuario:</label>
			<div class="col-sm-7">
				<select name="tipo" id="" class="col-sm-12">
					<option value="">--</option>
					<?php foreach($tipo_usua_rows as $tur) { ?>
						<option value="<?php echo $tur->nivusuario_codigo ?>" <?php echo $fun->selected($tur->nivusuario_codigo,$usua_row[0]->nivusuario_codigo) ?>><?php echo $tur->nivusuario_descripcion ?></option>
					<?php } ?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4 bolder">Clave de Acceso:</label>
			<div class="col-sm-7">
				<input type="password" class="form-control col-sm-7" value="1234" name="clave" id="clave" value="<?php echo $usua_row[0]->usuario_clave ?>">
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label col-sm-4 bolder">Confirme Clave:</label>
			<div class="col-sm-7">
				<input type="password" class="form-control col-sm-7" value="1234" name="clave2" value="<?php echo $usua_row[0]->usuario_clave ?>">
			</div>
		</div>
		
		<div class="clearfix"></div>
		<div class="clearfix form-actions">
			<button class="btn btn-primary pull-right">Guardar</button>
			<button class="btn btn-default pull-right cerrarmodal" data-dismiss="modal" type="button" data-bb-handler="cancel">Cancelar</button>		
		</div>
		
	</form>
</div>