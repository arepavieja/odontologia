<?php 
require '../../../cfg/base.php'; 
$datospers_rows = $mhistoria->datosPersonalesSelect($cedrif);
?>
<script>
	$(function(){
		$('.cerrardefecto1').click();
		$('.fecha').datepicker();
		$('.datos-personales').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				nomraz: {
					required: true
				},
				edad: {
					required: true
				},
				correo: {
					email: true
				}
			},
			messages: {
				nomraz: {
					required: 'Indique nombre'
				},
				edad: {
					required: 'Indique fecha de nacimiento'
				},
				correo: {
					email: 'Correo no válido'
				}
			},
			invalidHandler: function (event, validator) { 
				$('.alert-danger', $('.datos-personales')).show();
			},			
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
			submitHandler: function (form) {
				$.post('app/historia/procesos/p.historia.update.php',$('.datos-personales').serialize(),function(data){
					if(data==1) {
						alerta('.msj_1','success','Datos guardados correctamente');
						setTimeout("load('app/historia/vistas/datos.personales.php','nav=<?php echo $nav ?>&cedrif=<?php echo $cedrif ?>','#datos-personales')" , 2000 );
					} else {
						alerta('.msj_1','danger',data);
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
		<h4>Datos Personales</h4>
		<div class="widget-toolbar">
			<?php echo $fun->collapseWidget(1) ?>
			<?php echo $fun->reloadWidget('app/historia/vistas/datos.personales.php','nav='.$nav.'&cedrif='.$cedrif,'#datos-personales'); ?>
			<?php echo $fun->selectNav($nav); ?>
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<form action="" role="form" class="datos-personales">
				<div class="msj_1"></div>
				<div class="col-lg-12">
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Fecha de inicio:</label>
		                  <div class="col-sm-12">   
		                    <input type="text" readonly autocomplete="off" class="col-sm-6 fecha" data-date-format="yyyy-mm-dd"  name="fecha_inicio"  <?php if(!empty($datospers_rows[0]->pacien_fec_inic)){ ?> value="<?php echo $datospers_rows[0]->pacien_fec_inic ?>" <?php }else{ ?>value="<?php echo date("Y-m-d"); ?>" <?php } ?> > 
					      </div>	
					    </div>	
					</div>	
					 <div class="space-24"> </div>
					 <div class="clearfix"></div>		
					<div class="col-sm-4">
						<div class="form-group">		
							<label for="" class="control-label bolder col-sm-12">Cédula:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="cedrif" readonly value="<?php echo $datospers_rows[0]->pacien_cedrif ?>">
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Apellidos y Nombres:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="nomraz" value="<?php echo $datospers_rows[0]->pacien_nomraz ?>">
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Fecha de Nacimiento:</label>
							<div class="col-sm-12">
								<input type="text" readonly autocomplete="off" class="col-sm-12 fecha" data-date-format="yyyy-mm-dd"  name="edad" value="<?php echo $datospers_rows[0]->pacien_fechnac ?>">
							</div>
						</div>	
					</div>
				</div>

				<div class="col-lg-12">
					<div class="col-sm-8">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Ocupación:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="ocupacion" value="<?php echo $datospers_rows[0]->pacien_ocupa ?>">
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Sexo:</label>
							<div class="col-sm-6">
								<div class="radio">
									<label>
										<input class="ace" type="radio" name="sexo" value="M" <?php echo $fun->checked('M',$datospers_rows[0]->pacien_sexo) ?>>
										<span class="lbl"> Masculino</span>
									</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="radio">
									<label>
										<input class="ace" type="radio" name="sexo" value="F" <?php echo $fun->checked('F',$datospers_rows[0]->pacien_sexo) ?>>
										<span class="lbl"> Femenino</span>
									</label>
								</div>
							</div>
						</div>	
					</div>
				</div>

				<div class="col-lg-12">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Dirección:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="direccion" value="<?php echo $datospers_rows[0]->pacien_domicasa ?>">
							</div>
						</div>	
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Teléfono:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12 phone" name="telefono" value="<?php echo $datospers_rows[0]->pacien_casatlf ?>">
							</div>
						</div>	
					</div>
				</div>

				<div class="col-lg-12">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">E-Mail:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12 mail" name="correo" value="<?php echo $datospers_rows[0]->pacien_email ?>">
							</div>
						</div>	
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Celular:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12 celphone" name="celular" value="<?php echo $datospers_rows[0]->pacien_movil1tlf ?>">
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
			</form>
		</div>
	</div>
</div>
