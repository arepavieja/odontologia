<?php require '../../../cfg/base.php'; ?>
<script>
	$(function(){
		$('.date-picker').datepicker();

		$.mask.definitions['~']='[+-]';
		$('.phone').mask('0299-9999999');
		$('.celphone').mask('0499-9999999');

		$('.historia-insert').validate({
			errorElement: 'div',
			errorClass: 'help-inline',
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
					required: 'Indique apellidos y nombres'
				},
				edad: {
					required: 'Indique fecha de nacimiento'
				},
				correo: {
					email: 'Correo no válido'
				}
			},
			invalidHandler: function (event, validator) { 
				$('.alert-danger', $('.historia-insert')).show();
			},			
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
			submitHandler: function (form) {
				cedrif = $('#cedrifhistoria').val();
				$.post('app/historia/procesos/p.historia.insert.php',$('.historia-insert').serialize(),function(data){
					if(data==1) {
						load('app/historia/vistas/historia.php','cedrif='+cedrif,'#historia')
					} else {
						alerta('.msj1','danger',data);
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
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<div class="alert alert-info">El número de cédula no fue encontrado, Ingrese datos para registrar a la persona.</div>
			<form action="" role="form" class="historia-insert">
				<div class="msj1"></div>
				<div class="col-lg-12">
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Cédula de Identidad:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" disabled value="<?php echo $cedrif ?>">
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Apellidos y Nombres:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="nomraz">
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Fecha de Nacimiento:</label>
							<div class="col-sm-12">
								<input type="text" readonly autocomplete="off" class="col-sm-12 date-picker" data-date-format="yyyy-mm-dd" name="edad">
							</div>
						</div>	
					</div>
				</div>

				<div class="col-lg-12">
					<div class="col-sm-8">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Ocupación:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="ocupacion">
							</div>
						</div>	
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Sexo:</label>
							<div class="col-sm-6">
								<div class="radio">
									<label>
										<input class="ace" type="radio" name="sexo" value="M">
										<span class="lbl"> Masculino</span>
									</label>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="radio">
									<label>
										<input class="ace" type="radio" name="sexo" value="F">
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
								<input type="text" class="col-sm-12" name="direccion">
							</div>
						</div>	
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Teléfono:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12 phone" name="telefono">
							</div>
						</div>	
					</div>
				</div>

				<div class="col-lg-12">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">E-Mail:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="correo">
							</div>
						</div>	
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Celular:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12 celphone"  name="celular">
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
				<input type="hidden" name="cedrif" id="cedrifhistoria" value="<?php echo $cedrif ?>">
			</form>
		</div>
	</div>
</div>