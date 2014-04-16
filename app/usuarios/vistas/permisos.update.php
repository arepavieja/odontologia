<?php 
require '../../../cfg/base.php';

?>
<script>
	load('app/usuarios/vistas/lista.permisos.php','nivel=<?php echo $nivel ?>','#listaPermisos')
</script>
<?php echo $fun->modalHeader('Actualizar Permisos de Grupo') ?>
<div class="modal-body">
	<div class="msj"></div>
	<div id="listaPermisos"></div>
</div>
<div class="modal-footer">
	<button class="btn btn-default cerrarmodal" data-dismiss="modal" type="button" data-bb-handler="cancel">Aceptar</button>
</div>