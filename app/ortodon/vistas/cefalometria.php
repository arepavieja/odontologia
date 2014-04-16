<?php require '../../../cfg/base.php'; ?>
<?php
$parentesco_rows = $mhistoria->parentescoSelect();
$parientes_rows = $mhistoria->parienteSelect($cedrif);
?>
<script>
	load('app/ortodon/vistas/steiner.php','cedrif=<?php echo $cedrif ?>','.steiner')
	load('app/ortodon/vistas/legan.php','cedrif=<?php echo $cedrif ?>','.legan')
	load('app/ortodon/vistas/mcnamara.php','cedrif=<?php echo $cedrif ?>','.mcnamara')
	$(function(){
		$('.cerrardefecto10').click();
	})
</script>
<div class="widget-box">
	<div class="widget-header">
		<h4>Examen Cafalométrico</h4>
		<div class="widget-toolbar">
			<?php echo $fun->collapseWidget(10) ?>
			<?php echo $fun->reloadWidget('app/ortodon/vistas/cefalometria.php','&cedrif='.$cedrif,'#cefalometria'); ?>
			<?php echo $fun->navOrtodoncia(); ?>
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<div class="steiner"></div>
			<div class="legan"></div>
			<div class="mcnamara"></div>
		</div>
	</div>
</div>
