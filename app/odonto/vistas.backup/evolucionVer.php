<?php 
require '../../../cfg/base.php';
echo $fun->widthModal(50);
?>
<script>
	load('app/odonto/vistas/evolucion.lista.ver.php','trat_ide=<?php echo $trat_ide ?>','.evolucion')
</script>
<?php echo $fun->modalHeader('Evolución del Paciente: '.$des) ?>
<div class="modal-body">
	<div class="btn-group pull-right">
		<button type="button" class="btn btn-purple" onclick="load('app/odonto/vistas/evolucion.lista.ver.php','des=<?php echo $des ?>&trat_ide=<?php echo $trat_ide ?>&cedrif=<?php echo $cedrif ?>&diagno=<?php echo $diagno ?>&prec=<?php echo $prec ?>','.evolucion')">Histórico de Evoluciones</button>
	</div>
	<div class="clearfix"></div>
	<div class="evolucion"></div>
</div>
<div class="modal-footer">
	<button class="btn btn-default cerrarmodal" data-dismiss="modal" type="button" data-bb-handler="cancel">Aceptar y Cerrar</button>
</div>