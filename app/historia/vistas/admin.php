<?php 
$clientes_rows = $musuarios->getAll();
#print_r($clientes_rows);
?>
<script>
	$(function(){
		$(".uno").chosen({
			no_results_text: "No hay resultados",
			max_selected_options: 1
		});

		$('#cedrif_chosen .chosen-choices .search-field .default').keyup(function(){
			$('#cedrif2').val($(this).val())
		})

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
				if(ced==null) {
					ced = $('#cedrif2').val()
				} else {
					ced = $('#cedrif').val();
				}

				cedrif = nac+''+ced;
				$.post('app/historia/procesos/p.cedula.buscar.php','nac='+nac+'&ced='+ced,function(data){
					if(data==1) {
						$.post('app/historia/procesos/p.cedula.existe.php','cedrif='+cedrif,function(data2){
							if(data2==1) {
								$.post('app/historia/procesos/p.comprobar.historia.php','cedrif='+cedrif,function(data3){
									if(data3==1) {
										load('app/historia/vistas/historia.php','cedrif='+cedrif,'#historia')
									}
								})
							} else {
								load('app/historia/vistas/historia.insert.php','cedrif='+cedrif,'#historia');
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
<!-- HTML ################################ -->
<div id="breadcrumbs" class="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>
	<ul class="breadcrumb">
		<li><i class="icon-home home-icon"></i> <a href="#">Inicio</a></li>
		<li class="active"><i class="fa fa-ambulance"></i> <a href="#">Médico</a></li>
		<li class="active"> Historia General</li>
	</ul>
</div>
<div class="space-20"></div>
<div class="col-xs-3"></div>
<div class="col-xs-6 ">
	<div class="msj"></div>
	<form action="" class="buscar-cedula" role="form" id="validarCedula">
		<div class="form-group">
			
		</div>
		<!--<div class="form-group">
			<input autocomplete="off" id="cedrif" type="text" placeholder="Número de Cédula" name="ced">
		</div>-->

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
</div>
<div class="clearfix"></div>
<div class="space-10"></div>
<div id="historia"></div>	