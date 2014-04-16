<?php require '../../../cfg/base.php'; ?>
<?php 
$diagnos = $mdiagnos->diagnosSelect();
/**
 * $dr array Diagnosticos Rows Guarda todos los diagnósticos hechos a un paciente.
 * @var [type]
 */
//$dr = $modonto->odontoSelectCedrif($cedrif);
//print_r($dr);
?>
<script>
	load('app/odonto/vistas/odonto.insert.php','cedrif=<?php echo $cedrif ?>','#odontoinsert');
	load('app/odonto/vistas/marcar.diagnostico.php','cedrif=<?php echo $cedrif ?>','.marcar-diagnostico')
	$(function(){$('.cerrardefecto9').click();})
</script>

<div class="widget-box">
	<div class="widget-header">
		<h4>Odontograma</h4>
		<div class="widget-toolbar">
			<?php echo $fun->collapseWidget(9) ?>
			<?php echo $fun->reloadWidget('app/odonto/vistas/odontograma.php','nav='.$nav.'&cedrif='.$cedrif,'#odontograma'); ?>
			<?php echo $fun->selectNav($nav); ?>
		</div>
	</div>
	<div class="widget-body clearfix">
		<div class="widget-main">			
			<!--
				* Seleccionar diagnóstico
			-->
			<!--
			<form action="" class="form-horizontal selectDiagnos" role="form">
				<div class="col-sm-8 col-md-offset-2">
					<div class="form-group">
						<label for="" class="col-sm-3 control-label bolder">Diagnóstico</label>
						<div class="col-sm-4">
							<select name="diagno" id="diagno" class="form-control">
								<option value="">--</option>
								<?php foreach($diagnos as $d) { ?>
									<option value="<?php echo $d->diagno_codigo ?>"><?php echo $d->diagno_descrip ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-sm-5">
							<div class="checkbox">
								<label>
        					<input class="ace" type="checkbox" id="otrolugar" name="tipo"></input>
        					<span class="lbl"> Procedimientos Anteriores</span>
    						</label>
							</div>
						</div>
					</div>
				</div>
			</form>
			-->
			<!--
				* Fin Seleccionar diagnóstico
			-->
			<div class="marcar-diagnostico"></div>
			<div id="odontoinsert"></div>
			<div class="clearfix"></div>
			<div class="space-10"></div>
			<div id="seleccionados"></div>
		</div> <!-- widget-main -->
	</div> <!-- FIN widget-body clearfix -->

