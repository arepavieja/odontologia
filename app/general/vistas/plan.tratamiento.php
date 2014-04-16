<?php 
require '../../../cfg/base.php';
$diagplan = $mgeneral->selectDiagPlan($cedrif);
?>

<script>
	$(function(){
		$('.cerrardefecto11').click();
		$('.plantrata').submit(function(e){
			e.preventDefault();
			$.post('app/general/procesos/p.plantratamiento.insert.php', $(this).serialize());
		})
	})
</script>

<div class="widget-box">
	<div class="widget-header">
		<h4>Diagnóstico y Plan de Tratamiento</h4>
		<div class="widget-toolbar">
			<?php echo $fun->collapseWidget(11) ?>
			<?php echo $fun->reloadWidget('app/general/vistas/plan.tratamiento.php','nav='.$nav.'&cedrif='.$cedrif,'#plan-tratamiento') ?>
			<?php echo $fun->navGeneral($nav); ?>
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<form action="" class="plantrata">
				<div class="form-group col-sm-6">
					<label for="" class="control-label bolder col-sm-12">
						Diagnóstico
					</label>
					<div class="col-sm-12">
						<textarea name="diagno" id="" cols="30" rows="10" class="form-control" style="resize: none"><?php echo (count($diagplan)>0) ? $diagplan[0]->dipldiagno : null ?></textarea>
					</div>
				</div>

				<div class="form-group col-sm-6">
					<label for="" class="control-label bolder col-sm-12">
						Plan de Tratamiento
					</label>
					<div class="col-sm-12">
						<textarea name="plan" id="" cols="30" rows="10" class="form-control" style="resize: none"><?php echo (count($diagplan)>0) ? $diagplan[0]->diplplantr : null ?></textarea>
					</div>
				</div>
				<div class="form-actions clearfix">
					<button class="btn btn-primary pull-right">
						<i class="fa fa-check"> Guardar Cambios</i>
					</button>
				</div>
				<input type="hidden" name="cedrif" value="<?php echo $cedrif ?>">
			</form>
			<div class="clearfix"></div>
		</div>
	</div>
</div>