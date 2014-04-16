<?php  
require '../../../cfg/base.php';
$proced_rows = $mproced->procedSelectIde($ide);
?>
<script>
	$(function(){
		$('.btn-eliminar-proced').click(function(){
			$.post('app/proced/procesos/p.proced.delete.php',$('.eliminar-proced').serialize(),function(data){
					if(data==1) {
						load('app/proced/vistas/proced.lista.php','','.lista-procedimientos')
						$('.cerrarmodal').click();
					} else {
						alerta('.mensaje1','danger',data);
					}
			})
		})
	})
</script>
<?php echo $fun->modalHeader('Borrar Procedimiento') ?>
<div class="modal-body">
	<div class="bootbox-body">
		<div class="col-xs-12">
			<div class="mensaje1"></div>
			<?php foreach($proced_rows as $dr) { ?>
				<form action="" class="eliminar-proced" role="form">
					¿Realmente desea borrar el procedimiento seleccionado?
					<input type="hidden" name="ide" value="<?php echo $dr->proced_ide ?>">
				</form>
			<?php } ?>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php echo $fun->modalFooter('Si, continuar','btn-eliminar-proced') ?>