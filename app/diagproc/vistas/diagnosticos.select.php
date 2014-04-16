<?php
require '../../../cfg/base.php'; 
$diagnosticos = $mdiagnos->diagnosSelect();
?>
<script>
	$(function(){
		$('#dianos').change(function(){
			diagno = $(this).val();
			$.post('app/diagproc/vistas/procedimientos.check.php','diagno='+diagno,function(data){
				$('#proced').fadeIn().html(data);
			})
		})
		$('.form_diagnos').submit(function(e){
			e.preventDefault();
			$.post('app/diagproc/vistas/procedimientos.check.php',$(this).serialize(),function(data){
				$('#proced').fadeIn().html(data);
			})
		})
	})
</script>
<form action="" class="form-horizontal form_diagnos">
	<div class="col-sm-8 col-sm-offset-2">
		<label for="" class="control-label col-sm-3 bolder">Seleccione Diagnóstico</label>
		<select name="diagno" id="dianos" class="col-sm-9">
			<option value="">--</option>
			<?php foreach($diagnosticos as $d) { ?>
				<option value="<?php echo $d->diagno_codigo ?>"><?php echo $d->diagno_descrip ?></option>
			<?php } ?>
		</select>
	</div>
</form>
<div class="clearfix"></div>
<div class="space-10"></div>
<div id="proced" class="" style="display:none"></div>
