<?php 
require '../../../cfg/base.php';
$perm_rows = $musuarios->selectSubModulos();
?>
<script>
	function cambiarPermiso(ide) {
		$.post('app/usuarios/procesos/permiso.update.php',ide,function(data){
			if(data==1) {
				load('app/usuarios/vistas/lista.permisos.php','nivel=<?php echo $nivel ?>','#listaPermisos');
			}
		})
	}
</script>
<table class="table table-bordered table-hover table-striped">
	<thead>
		<tr>
			<th>Módulo</th>
			<th>Submódulo</th>
			<th>Estado</th>
			<th>Acción</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($perm_rows as $pr) { ?>
			<?php $perm = $musuarios->permisoSubmodulo($pr->subm_ide,$nivel) ?>
			<?php $propPerm = (count($perm)>0) ? $cusuarios->propUsua($perm[0]->perm_est) : $cusuarios->propUsua(0) ?>
			<tr>
				<td><?php echo $pr->modu_des ?></td>
				<td><?php echo $pr->subm_des ?></td>
				<td><?php echo $propPerm['estado'] ?></td>
				<td>
					<button class="btn btn-xs <?php echo $propPerm['class'] ?>" onclick="cambiarPermiso('estado=<?php echo $propPerm['valor'] ?>&subm=<?php echo $pr->subm_ide ?>&nivel=<?php echo $nivel ?>')"><?php echo $propPerm['boton'] ?></button>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>