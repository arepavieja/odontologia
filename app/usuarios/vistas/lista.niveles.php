<?php 
require '../../../cfg/base.php';
$usua_rows = $musuarios->tiposDeUsuario();
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
			<th>Código</th>
			<th>Descripción</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($usua_rows as $ur) { ?>
			<tr>
				<td><?php echo $ur->nivusuario_codigo; ?></td>
				<td><?php echo strtoupper($ur->nivusuario_descripcion); ?></td>
				<td>
					<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
						<a class="green" href="#" onclick="modal('app/usuarios/vistas/permisos.update.php','nivel=<?php echo $ur->nivusuario_codigo ?>');return false">
							<i class="fa fa-wrench bigger-130"></i>
						</a>
						<!--<a class="red" href="#" onclick="borrarUsuario('estado=3&cedrif=<?php echo $ur->pers_cedrif ?>')">
							<i class="icon-trash bigger-130"></i>
						</a>-->
					</div>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>