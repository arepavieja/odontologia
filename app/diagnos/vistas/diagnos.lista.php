<?php 
require '../../../cfg/base.php';
$diagnos_rows = $mdiagnos->diagnosSelect();
?>
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Descripción</th>
			<th>Color</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($diagnos_rows)>0) { ?>
			<?php foreach($diagnos_rows as $dr) { ?>
				<tr>
					<td><?php echo $dr->diagno_descrip ?></td>
					<td><div class="color" style='background:<?php echo $dr->diagno_color; ?>'></div></td>
					<td>
						<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
							<a class="green" href="#" onclick="modal('app/diagnos/vistas/diagnos.update.php','ide=<?php echo $dr->diagno_codigo ?>')">
								<i class="icon-pencil bigger-130"></i>
							</a>
							<a class="red" href="#" onclick="modal('app/diagnos/vistas/diagnos.delete.php','ide=<?php echo $dr->diagno_codigo ?>')">
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