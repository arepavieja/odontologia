<?php 
require '../../../cfg/base.php';
error_reporting(0);
$evol_lista = $modonto->listaEvoluciones($trat_ide);
?>
<script>
	function borrarEvolucion(ide) {
			if(confirm('¿Desea borrar la evolucion?')==true) {
			$.post('app/odonto/procesos/p.evolucion.borrar.php',ide,function(data){
				if(data==1) {
					//alert(data);
					load('app/odonto/vistas/evolucion.lista.php','trat_ide=<?php echo $trat_ide ?>','.evolucion');
				} else {
					//alert('No se puede borrar el elemento');
					alert(data);
				}
			})
		}
	}
</script>
<div class="space-10"></div>
<table class="table table-bordered table-hover table-striped">
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Descripción</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($evol_lista)>0) { ?>
			<?php foreach($evol_lista as $el) { ?>
				<tr>
					<td><?php echo $el->evol_fec ?></td>
					<td><?php echo $el->evol_des ?></td>
					<td>
						<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
							<a class="green" href="#" onclick="load('app/odonto/vistas/evolucion.update.php','msj=0&evol_ide=<?php echo $el->evol_ide ?>','.evolucion'); return false;">
								<i class="icon-edit bigger-130"></i>
							</a>
						    <a class="green" href="#" onclick="borrarEvolucion('evol_ide=<?php echo $el->evol_ide ?>&trat_ide=<?php echo $el->trat_ide ?>'); return false">		    
							    <i class="icon-trash bigger-130"></i> 
						    </a>
						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td colspan="3">No hay evoluaciones registradas</td>
			</tr>
		<?php } ?>
	</tbody>
</table>