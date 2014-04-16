<?php 
require '../../../cfg/base.php';
$proced_rows = $mproced->procedSelect();
?>
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Descripción</th>
			<th>Costo</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($proced_rows)>0) { ?>
			<?php foreach($proced_rows as $pr) { ?>
				<tr>
					<td><?php echo $pr->proced_des ?></td>
					<td><?php echo $pr->proced_prec ?></td>
					<td>
						<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
							<a class="green" href="#" onclick="modal('app/proced/vistas/proced.update.php','ide=<?php echo $pr->proced_ide ?>')">
								<i class="icon-pencil bigger-130"></i>
							</a>
							<a class="red" href="#" onclick="modal('app/proced/vistas/proced.delete.php','ide=<?php echo $pr->proced_ide ?>')">
								<i class="icon-trash bigger-130"></i>
							</a>
						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td colspan="3">No se encontraron registros</td>
			</tr>
		<?php } ?>
	</tbody>
</table>