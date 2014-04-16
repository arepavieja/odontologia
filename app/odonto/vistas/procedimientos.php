<?php 
require '../../../cfg/base.php';
error_reporting(0);
$proced = $modonto->tratamientoDiagcons($diagno);
?>
<script>
	function borrarProcedimiento(ide) {
		if(confirm('¿Desea borrar el procedimiento?')==true) {
			$.post('app/odonto/procesos/p.procedimiento.delete.php',ide,function(data){
				if(data==1) {
					load('app/odonto/vistas/procedimientos.php','cedrif=<?php echo $cedrif ?>&des=<?php echo $des; ?>&diagno=<?php echo $diagno ?>','#procedimientos');
				} else {
					alert('No se puede borrar el elemento');
				}
			})
		}
	}
	function cambiarEstado(ide) {
		//if(confirm('¿Desea cambiar el estado?')==true) {
			$.post('app/odonto/procesos/p.procedimiento.update.php',ide,function(data){
				if(data==1) {
					load('app/odonto/vistas/procedimientos.php','cedrif=<?php echo $cedrif ?>&des=<?php echo $des; ?>&diagno=<?php echo $diagno ?>','#procedimientos');
				} else {
					alert('No se puede cambiar el estado');
				}
			})
		//}	
	}

</script>
<div class="table-header bolder"><?php echo $des ?></div>
<table class="table table-hover table-bordered table-striped">
	<thead>
		<tr>
			<th>Procedimiento</th>
			<th>Costo</th>
			<th>Estado</th>
			<th>Condición</th>
			<th style="width:100px">Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($proced)>0) { ?>
			<?php foreach($proced as $d) { ?>
				<tr>
					<td><?php echo $d->proced_des ?></td>
					<td><?php echo $d->precio ?></td>
					<td><?php echo $codonto->estadoProcedimiento($d->trat_est) ?></td>
					<td><?php echo $codonto->condicionProced($d->trat_est,$d->trat_status) ?></td>
					<td>
						<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
							<?php if($d->trat_status==0) { ?>
								<a class="red" href="#" onclick="borrarProcedimiento('trat_ide=<?php echo $d->trat_ide ?>'); return false;">
									<i class="icon-trash bigger-130"></i>
								</a>
								<a class="red" href="#" onclick="cambiarEstado('trat_ide=<?php echo $d->trat_ide ?>&estado=<?php echo $codonto->estadoValor($d->trat_est); ?>'); return false;">
									<i class="icon-exchange bigger-130"></i>
								</a>
							<?php } ?>
							<?php if($d->trat_est==2 and $d->trat_status==0) { ?>
								<a class="red" href="#" onclick="modal('app/odonto/vistas/evolucion.php','trat_ide=<?php echo $d->trat_ide ?>&des=<?php echo $des ?>&cedrif=<?php echo $cedrif ?>&diagno=<?php echo $diagno ?>&prec=<?php echo $d->precio ?>'); return false;">
									<i class="icon-cogs bigger-130"></i>
								</a>
							<?php } ?>
							<?php if($d->trat_est==2 and $d->trat_status==1) { ?>
								<a class="red" href="#" onclick="modal('app/odonto/vistas/evolucionVer.php','trat_ide=<?php echo $d->trat_ide ?>&des=<?php echo $des ?>&cedrif=<?php echo $cedrif ?>&diagno=<?php echo $diagno ?>&prec=<?php echo $d->precio ?>'); return false;">
									<i class="icon-cogs bigger-130"></i>
								</a>
							<?php } ?>
						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td colspan="4">No hay procedimientos registrados para este diagnóstico</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<div class="clearfix"></div>