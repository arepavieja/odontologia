<?php 
require '../../../cfg/base.php';
$proced = $modonto->tratamientoDiagcons($diagcons);
//print_r($_POST);
?>
<script>
	function borrarProcedimiento2(ide) {
		if(confirm('¿Desea borrar el procedimiento?')==true) {
			$.post('app/odonto/procesos/p.procedimiento.delete.php',ide,function(data){
				if(data==1) {
					load('app/odonto/vistas/procedimiento.lista.php','cedrif=<?php echo $cedrif ?>&des=<?php echo $des; ?>&diagcons=<?php echo $diagcons ?>','#proced-lista');
					load('app/odonto/vistas/procedimientos.php','cedrif=<?php echo $cedrif ?>&des=<?php echo $des; ?>&diagno=<?php echo $diagcons ?>','#procedimientos');
				} else {
					alert('No se puede borrar el elemento');
				}
			})
		}
	}
	function cambiarEstado2(ide) {
		//if(confirm('¿Desea cambiar el estado?')==true) {
			$.post('app/odonto/procesos/p.procedimiento.update.php',ide,function(data){
				if(data==1) {
					load('app/odonto/vistas/procedimiento.lista.php','cedrif=<?php echo $cedrif ?>&des=<?php echo $des; ?>&diagcons=<?php echo $diagcons ?>','#proced-lista');
					load('app/odonto/vistas/procedimientos.php','cedrif=<?php echo $cedrif ?>&des=<?php echo $des; ?>&diagno=<?php echo $diagcons ?>','#procedimientos');
				} else {
					alert('No se puede cambiar el estado');
				}
			})
		//}	
	}
</script>
<table class="table table-hover table-bordered table-striped" style="width:90%;margin:0px auto">
	<thead>
		<tr>
			<th>Procedimiento</th>
			<th>Costo</th>
			<th>Estado</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($proced)>0) { ?>
			<?php foreach($proced as $d) { ?>
				<tr>
					<td><?php echo $d->proced_des ?></td>
					<td><?php echo $d->precio ?></td>
					<td><?php echo $codonto->estadoProcedimiento($d->trat_est) ?></td>
					<td>
						<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
							<a class="red" href="#" onclick="borrarProcedimiento2('trat_ide=<?php echo $d->trat_ide ?>'); return false;">
								<i class="icon-trash bigger-130"></i>
							</a>
							<a class="red" href="#" onclick="cambiarEstado2('trat_ide=<?php echo $d->trat_ide ?>&estado=<?php echo $codonto->estadoValor($d->trat_est); ?>'); return false;">
								<i class="icon-exchange bigger-130"></i>
							</a>
						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td colspan="3">No hay procedimientos registrados para este diagnóstico</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<div class="space-24"></div>