<?php 
require '../../../cfg/base.php';
?>
<script>
	$(function(){
		$('.chosen-select').chosen({no_results_text: "No hay resultados"});
		$('.inicial').change(function(){
			$.post('app/odonto/vistas/diente.final.php','dienteinicial='+$(this).val(),function(data){
				$('.diente-final').html(data);
			})
		})
	})
</script>
<div class="form-group col-sm-5">
	<div class="col-sm-12">
		<select data-placeholder="Indique diente inicial" class="chosen-select inicial form-control" style="width:100%" name="dienteinicial" id="dienteinicial">
			<option value=""></option>
			<optgroup label="Cuadrante 1 (Perm)">
				<?php echo $codonto->dientesBack(1,1,18,11) ?>
			</optgroup>
			<optgroup label="Cuadrante 2 (Perm)">
				<?php echo $codonto->dientes(2,1,21,28) ?>
			</optgroup>
			<optgroup label="Cuadrante 3 (Perm)">
				<?php echo $codonto->dientes(3,1,31,38) ?>
			</optgroup>
			<optgroup label="Cuadrante 4 (Perm)">
				<?php echo $codonto->dientesBack(4,1,48,41) ?>
			</optgroup>
			<optgroup label="Cuadrante 1 (Temp)">
				<?php echo $codonto->dientesBack(1,2,55,51) ?>
			</optgroup>
			<optgroup label="Cuadrante 2 (Temp)">
				<?php echo $codonto->dientes(2,2,61,65) ?>
			</optgroup>
			<optgroup label="Cuadrante 3 (Temp)">
				<?php echo $codonto->dientes(3,2,71,75) ?>
			</optgroup>
			<optgroup label="Cuadrante 4 (Temp)">
				<?php echo $codonto->dientesBack(4,2,85,81) ?>
			</optgroup>
		</select>
	</div>
</div>
<div class="diente-final"></div>
