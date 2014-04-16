<?php 
require '../../../cfg/base.php';
$proced = $modonto->procedDiagno($diagno); 
//print_r($_POST);
?>
<script>
	load('app/odonto/vistas/procedimiento.lista.php','cedrif=<?php echo $cedrif ?>&des=<?php echo $des ?>&diagcons=<?php echo $diagcons ?>','#proced-lista');
	$(function(){
		$('.diagproced').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				diagproced: {
					required: true
				}
			},
			messages: {
				diagproced: {
					required: 'Indique el procedimiento'
				}
			},
			invalidHandler: function (event, validator) { 
				$('.alert-danger', $('.diagproced')).show();
			},			
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
			submitHandler: function (form) {
				$.post('app/odonto/procesos/p.procedimiento.insert.php',$('.diagproced').serialize(),function(data){
					if(data==1) {
						load('app/odonto/vistas/procedimiento.lista.php','cedrif=<?php echo $cedrif ?>&des=<?php echo $des ?>&diagcons=<?php echo $diagcons ?>','#proced-lista');
						load('app/odonto/vistas/procedimientos.php','cedrif=<?php echo $cedrif ?>&des=<?php echo $des; ?>&diagno=<?php echo $diagcons ?>','#procedimientos');
						$('.msj_20').fadeOut();
					} else {
						alerta('.msj_20','danger',data);
					}
				})
			},
			invalidHandler: function (form) {
			}
		})
	})
</script>
<?php echo $fun->modalHeader('Agregar Procedimiento para: '.$des) ?>
<form action="" role="form" class="form-horizontal diagproced">
	<div class="modal-body">
		<div class="msj_20"></div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3">Procedimiento:</label>
			<div class="col-sm-9">
				<select name="diagproced" id="" class="col-sm-12">
					<option value="">--</option>
					<?php if(count($proced)>0) { ?>
						<?php foreach($proced as $p) { ?>
							<option value="<?php echo $p->proced_ide ?>"><?php echo $p->proced_des; ?></option>
						<?php } ?>
					<?php } ?>
				</select>
			</div>
		</div>
		<input type="hidden" name="diagcons" value="<?php echo $diagcons ?>">	
	</div>

	<div class="modal-footer">
		<button class="btn btn-default cerrarmodal" data-dismiss="modal" type="button" data-bb-handler="cancel">Cancelar</button>
		<button class="btn btn-primary" type="submit" data-bb-handler="confirm">Guardar Cambios</button>
	</div>
</form>
<div class="space-10"></div>
<div id="proced-lista"></div>
