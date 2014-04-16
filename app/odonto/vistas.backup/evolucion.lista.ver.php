<?php 
require '../../../cfg/base.php';
error_reporting(0);
$evol_lista = $modonto->listaEvoluciones($trat_ide);
?>
<div class="space-10"></div>
<table class="table table-bordered table-hover table-striped">
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Descripción</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($evol_lista)>0) { ?>
			<?php foreach($evol_lista as $el) { ?>
				<tr>
					<td><?php echo $el->evol_fec ?></td>
					<td><?php echo $el->evol_des ?></td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td colspan="2">No hay evoluaciones registradas</td>
			</tr>
		<?php } ?>
	</tbody>
</table>