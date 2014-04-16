<?php 
require '../../../cfg/base.php';
$usua_rows = $musuarios->selectUsuarios();
?>
<script>
	function cambiarEstado(ide) {
		if(confirm('¿Cambiar el estado de usuario?')==true) {
			$.post('app/usuarios/procesos/estado.update.php',ide,function(data){
				if(data==1) {
					load('app/usuarios/vistas/lista.php','','#lista');
				}
			})
		}
	}
	function borrarUsuario(ide) {
		if(confirm('¿Borrar usuario?')==true) {
			$.post('app/usuarios/procesos/estado.update.php',ide,function(data){
				if(data==1) {
					load('app/usuarios/vistas/lista.php','','#lista');
				}
			})
		}
	}
</script>
<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>Cédula</th>
			<th>Apellidos y Nombres</th>
			<th>Usuario</th>
			<th>Tipo</th>
			<th>Estado</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($usua_rows as $ur) { ?>
			<?php $propUsua = $cusuarios->propUsua($ur->usuario_status); ?>
			<tr>
				<td><?php echo $ur->pers_cedrif; ?></td>
				<td><?php echo $ur->pacien_nomraz; ?></td>
				<td><?php echo $ur->usuario_login; ?></td>
				<td><?php echo strtoupper($ur->nivusuario_descripcion); ?></td>
				<td><?php echo $propUsua['estado'] ?></td>
				<td>
					<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
						<a class="purple" href="#" onclick="modal('app/usuarios/vistas/usuario.update.php','cedrif=<?php echo $ur->pers_cedrif ?>');return false">
							<i class="icon-pencil bigger-130"></i>
						</a>
						<a class="blue" href="#" onclick="cambiarEstado('estado=<?php echo $propUsua['valor'] ?>&cedrif=<?php echo $ur->pers_cedrif ?>')">
							<i class="fa fa-exchange bigger-130"></i>
						</a>
						<a class="red" href="#" onclick="borrarUsuario('estado=3&cedrif=<?php echo $ur->pers_cedrif ?>')">
							<i class="icon-trash bigger-130"></i>
						</a>
					</div>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>