<?php 
require '../../../cfg/base.php';
$diagnos = $modonto->odontoSelectCedrif($cedrif);
$otrol = $modonto->odontoSelectCedrifTipo1($cedrif);
?>
<script>
	load('app/odonto/vistas/procedimientos.php','cedula=<?php echo $cedrif ?>','#procedimientos')
	function borrarDiagno(ide) {
		if(confirm('¿Borrar el diagnóstico seleccionado?')==true) {
			$.post('app/odonto/procesos/p.diagnostico.borrar.php',ide,function(data){
				if(data==1) {
					load('app/odonto/vistas/odonto.insert.php','cedrif=<?php echo $cedrif ?>','#odontoinsert');
					load('app/odonto/vistas/diagnosticos.php','cedrif=<?php echo $cedrif ?>','#seleccionados');
				}
			})
		}
	}
</script>
<div class="space-20"></div>
<div class="col-sm-6">
	<div class="table-header">Diagnósticos 
		<span class="pull-right padding-r20">
			<button type="button" onclick="window.open('presupuesto-<?php echo $cedrif ?>')" class="btn btn-minier btn-info">Imprimir</button>
			<button type="button" class="btn btn-info btn-minier" onclick="load('app/odonto/vistas/procedimientosTodos.php','cedrif=<?php echo $cedrif ?>','#procedimientos')" class="btn btn-minier btn-white">Mostrar Todo</button>
		</span>
	</div>
	<table class="table table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>Pieza</th>
				<th>Diagnóstico</th>
				<th>Opciones</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($diagnos)>0) { ?>
				<?php foreach($diagnos as $d) { ?>
					<tr>
						<td><?php echo $codonto->piezas($d->diagcons_numero,$d->diagcons_fin,$d->diagcons_clase) ?></td>
						<td><?php echo $d->diagno_descrip ?></td>
						<td>
							<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
								<a class="red" href="#" onclick="borrarDiagno('diagno=<?php echo $d->diagcons_ide ?>'); return false">
									<i class="icon-trash bigger-130"></i> 

								</a>
								<a class="red" href="#" onclick="modal('app/odonto/vistas/procedimiento.insert.php','cedrif=<?php echo $cedrif ?>&des=<?php echo $codonto->piezas($d->diagcons_numero,$d->diagcons_fin,$d->diagcons_clase).' - '.$d->diagno_descrip ?>&diagcons=<?php echo $d->diagcons_ide ?>&diagno=<?php echo $d->diagno_codigo ?>'); return false;">
									<i class="fa fa-plus-square-o bigger-130"></i>
								</a>

								<a class="red" href="#" onclick="load('app/odonto/vistas/procedimientos.php','cedrif=<?php echo $cedrif ?>&des=<?php echo $codonto->piezas($d->diagcons_numero,$d->diagcons_fin,$d->diagcons_clase).' - '.$d->diagno_descrip ?>&diagno=<?php echo $d->diagcons_ide ?>','#procedimientos'); return false;">
									<i class="fa fa-sign-out bigger-130"></i>
								</a>
							</div>
						</td>
					</tr>
				<?php } ?>
			<?php } else { ?>
				<tr>
					<td colspan="4">No hay diagnósticos registrados</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>

	<div class="table-header">Procedimientos Anteriores
	</div>

	<table class="table table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th>Pieza</th>
				<th>Diagnóstico</th>
				<th>Opciones</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($otrol)>0) { ?>
				<?php foreach($otrol as $d) { ?>
					<tr>
						<td><?php echo $codonto->piezas($d->diagcons_numero,$d->diagcons_fin,$d->diagcons_clase) ?></td>
						<td><?php echo $d->diagno_descrip ?></td>
						<td>
							<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
								<a class="red" href="#" onclick="borrarDiagno('diagno=<?php echo $d->diagcons_ide ?>'); return false">
									<i class="icon-trash bigger-130"></i> 
								</a>
							</div>
						</td>
					</tr>
				<?php } ?>
			<?php } else { ?>
				<tr>
					<td colspan="4">No hay diagnósticos registrados en otro lugar</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>


</div>
<div class="col-sm-6">
	<div id="procedimientos"></div>
</div>
<div class="clearfix"></div>