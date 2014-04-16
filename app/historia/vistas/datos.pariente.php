<?php require '../../../cfg/base.php'; ?>
<?php
$parentesco_rows = $mhistoria->parentescoSelect();
$parientes_rows = $mhistoria->parienteSelect($cedrif);
?>
<script>
	$(function(){
		$('.cerrardefecto2').click();
		$('.fecha').datepicker();
		$.mask.definitions['~']='[+-]';
		$('.phone').mask('0299-9999999');
		$('.celphone').mask('0499-9999999');

		$('.datos-pariente').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				cedula: {
					required: true,
					maxlength: 9,
					minlength: 6,
					number: true
				},
				nomraz: {
					required: true
				},
				fecnac: {
					required: true
				},
				parentesco: {
					required: true
				}
			},
			messages: {
				cedula: {
					required: 'Indique cédula',
					maxlength: 'Cédula no válida',
					minlength: 'Cédula no válida',
					number: 'Cédula debe ser numérica'
				},
				nomraz: {
					required: 'Indique apellidos y nombres'
				},
				fecnac: {
					required: 'Indique fecha de nacimiento'
				},
				parentesco: {
					required: 'Indique parentesco'
				}
			},
			invalidHandler: function (event, validator) { 
				$('.alert-danger', $('.datos-pariente')).show();
			},			
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
			submitHandler: function (form) {
				$.post('app/historia/procesos/p.pariente.insert.php',$('.datos-pariente').serialize(),function(data){
					if(data==1) {
						alerta('.msj_2','success','Datos guardados correctamente');
						setTimeout("load('app/historia/vistas/datos.pariente.php','nav=<?php echo $nav ?>&cedrif=<?php echo $cedrif ?>','#datos-pariente')" , 2000 );
					} else {
						alerta('.msj_2','danger',data);
					}
				})
			},
			invalidHandler: function (form) {
			}
		})
	})
</script>
<div class="widget-box">
	<div class="widget-header">
		<h4>Datos del Representante, Acudente o persona a llamar en caso de emergencia</h4>
		<div class="widget-toolbar">
			<?php echo $fun->collapseWidget(2) ?>
			<?php echo $fun->reloadWidget('app/historia/vistas/datos.pariente.php','nav='.$nav.'&cedrif='.$cedrif,'#datos-pariente'); ?>
			<?php echo $fun->selectNav($nav); ?>
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<form action="" role="form" class="datos-pariente">
				<div class="msj_2"></div>
				<div class="col-lg-12">
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Cédula:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12 cedula" name="cedula" value="<?php echo (count($parientes_rows)>0) ? $parientes_rows[0]->fami_pacien_cedrif : null ?>">
							</div>
						</div>	
					</div>

					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Apellidos y Nombres:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="nomraz" value="<?php echo (count($parientes_rows)>0) ? $parientes_rows[0]->fami_pacien_nomb : null ?>">
							</div>
						</div>	
					</div>

					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Fecha de Nacimiento:</label>
							<div class="col-sm-12">
								<input type="text" readonly autocomplete="off" class="col-sm-12 fecha" name="fecnac" data-date-format="yyyy-mm-dd" value="<?php echo (count($parientes_rows)>0) ? $parientes_rows[0]->fami_pacien_fecnac : null ?>">
							</div>
						</div>	
					</div>
				</div>

				<div class="col-lg-12">
					<div class="col-sm-8">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Ocupación:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="ocupacion" value="<?php echo (count($parientes_rows)>0) ? $parientes_rows[0]->fami_pacien_ocupa : null ?>">
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Parentesco:</label>
							<div class="col-sm-6">
								<select name="parentesco" id="" class="form-control col-sm-12">
									<option value="">--</option>
									<?php foreach($parentesco_rows as $pr) { ?>
										<option value="<?php echo $pr->parent_ide ?>" <?php echo (count($parientes_rows)>0) ? $fun->selected($pr->parent_ide,$parientes_rows[0]->fami_pacien_paren) : null ?>><?php echo $pr->parent_des ?></option>
									<?php } ?>
								</select>
							</div>
						</div>	
					</div>
				</div>

				<div class="col-lg-12">
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Dirección:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="direccion" value="<?php echo (count($parientes_rows)>0) ? $parientes_rows[0]->fami_pacien_dir : null ?>">
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-md-12">Teléfono:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12 phone" name="telefono" value="<?php echo (count($parientes_rows)>0) ? $parientes_rows[0]->fami_pacien_tlfcasa : null ?>">
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Celular:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12 celphone" name="celular" value="<?php echo (count($parientes_rows)>0) ? $parientes_rows[0]->fami_pacien_movil : null ?>">
							</div>
						</div>	
					</div>
				</div>

				<div class="clearfix"></div>
				<div class=" clearfix form-actions">
					<div class="col-xs-2 col-md-offset-10">
						<button class="btn btn-primary"><i class="icon-ok bigger-110"></i> Guardar Cambios</button>
					</div>
				</div>
				<input type="hidden" name="cedrif" value="<?php echo $cedrif; ?>">
			</form>
		</div>
	</div>
</div>
