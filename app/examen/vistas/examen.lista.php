<?php 
require '../../../cfg/base.php';
/**
 * Examenes rows
 * @var array
 */
$er = $mexamen->examenSelectCedrif($cedrif);
?>

<!-- Javascript #######################################-->

<script>
	function estatusExamen(ide) {
		$.post('app/examen/procesos/p.estatus.update.php',ide,function(data){
			if(data==1) {
				load('app/examen/vistas/examen.lista.php','cedrif=<?php echo $cedrif ?>','#examanes-lista');
			} else {
				alerta('.msj_2','danger',data);
			}
		})
	}
	function borrarExamen(ide) {
		$.post('app/examen/procesos/p.estatus.delete.php',ide,function(data){
			if(data==1) {
				load('app/examen/vistas/examen.lista.php','cedrif=<?php echo $cedrif ?>','#examanes-lista');
			} else {
				alerta('.msj_2','danger',data);
			}
		})
	}
</script>

<!-- HTML #############################################-->

<div class="msj_2"></div>
<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Examen</th>
			<th>Estatus</th>
			<th>Opción</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($er)>0) { ?>
			<?php foreach($er as $e) { ?>
				<tr>
					<td><?php echo $fun->fecha($e->exam_fec); ?></td>
					<td><?php echo $e->exam_des ?></td>
					<td><?php echo $cexamen->estatusExamen($e->exam_est); ?></td>
					<td>
						<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
							<a class="blue" href="#" onclick="estatusExamen('exam_ide=<?php echo $e->exam_ide; ?>&exam_est=<?php echo $cexamen->estatusExamenNum($e->exam_est) ?>')">
								<i class="icon-exchange bigger-130"></i>
							</a>
							<a class="red" href="#"  onclick="borrarExamen('exam_ide=<?php echo $e->exam_ide; ?>')">
								<i class="icon-trash bigger-130"></i>
							</a>
						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td colspan="4">No hay examenes registrados</td>
			</tr>
		<?php } ?>
	</tbody>
</table>