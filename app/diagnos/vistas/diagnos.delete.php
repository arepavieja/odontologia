<?php  
require '../../../cfg/base.php';
$diagnos_rows = $mdiagnos->diagnosSelectIde($ide);
?>
<script>
	$(function(){
		$('.btn-eliminar-diagno').click(function(){
			$.post('app/diagnos/procesos/p.diagnos.delete.php',$('.eliminar-diagnos').serialize(),function(data){
					if(data==1) {
						load('app/diagnos/vistas/diagnos.lista.php','','.lista-diagnosticos');
						$('.cerrarmodal').click();
					} else {
						alerta('.mensaje1','danger',data);
					}
			})
		})
	})
</script>
<?php echo $fun->modalHeader('Borrar Diagnóstico') ?>
<div class="modal-body">
	<div class="bootbox-body">
		<div class="col-xs-12">
			<div class="mensaje1"></div>
			<?php foreach($diagnos_rows as $dr) { ?>
				<form action="" class="eliminar-diagnos" role="form">
					¿Realmente desea borrar el elemento seleccionado?
					<input type="hidden" name="ide" value="<?php echo $dr->diagno_codigo ?>">
				</form>
			<?php } ?>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php echo $fun->modalFooter('Si, continuar','btn-eliminar-diagno') ?>