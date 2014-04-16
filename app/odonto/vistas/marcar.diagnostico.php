<?php 
require '../../../cfg/base.php';
$diagno_rows = $modonto->traerDiagnosticos();
//print_r($diagno_rows);
?>
<script>
	$(function(){
		$('.chosen-select-diagno').chosen({no_results_text: "No hay resultados"});	
		$('#multiples-diagnos').on('click',function(){
			var estado = this.checked;
			if(estado==true) {
				$.post('app/odonto/vistas/diente.inicial.php',function(data){
					$('.diente-inicial').html(data)
				})
			} else {
				$('.diente-inicial,.diente-final').html('');
			}
		})
	})
</script>
<div class="col-sm-10 col-sm-offset-1">
	<form action="" class="formu">
		<div class="col-sm-12">
			<div class="form-group col-sm-7">
				<label for="" class="label-control bolder col-sm-12">
					Diagnóstico:
				</label>
				<div class="col-sm-12">
					<select data-placeholder="Seleccione un diagnóstico" id="diagnostico-value" class="chosen-select-diagno form-control" style="100%">
						<option value=""></option>
						<?php foreach($diagno_rows as $r) : ?>
							<option value="<?php echo $r->diagno_codigo ?>"><?php echo $r->diagno_descrip ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="form-group col-sm-3">
				<label for="" class="label-control col-sm-12">
					&nbsp;
				</label>
				<label class="middle">
					<input type="checkbox" class="ace" id="multiples-diagnos">
					<span class="lbl"> ¿Selección Multiple?</span>
				</label>
			</div>
			
			<div class="form-group col-sm-2">
				<label for="" class="label-control col-sm-12">
					&nbsp;
				</label>
				<label class="middle">
					<input type="checkbox" class="ace" id="otrolugar" name="tipo" value="0">
					<span class="lbl"> ¿Otro Lugar?</span>
				</label>
			</div>

		</div>
		<div class="col-sm-12">
			<div class="diente-inicial"></div>
		</div>
		<input type="hidden" id="cedrif-paciente" value="<?php echo $cedrif ?>">
	</form>
</div>
<div class="clearfix"></div>
<script>
	$(function(){
		$('.chosen-container-single').attr('style','width:100%')
	})
</script>