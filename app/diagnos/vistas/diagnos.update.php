<?php  
require '../../../cfg/base.php';
$diagnos_rows = $mdiagnos->diagnosSelectIde($ide);
?>
<script>
	$(function(){
		$('.colorpicker2').colorpicker();
		$('.btn-modificar-diagno').click(function(){
			$.post('app/diagnos/procesos/p.diagnos.update.php',$('.modificar-diagnos').serialize(),function(data){
					if(data==1) {
						alerta('.mensaje1','success','Registro actualizado correctamente');
						load('app/diagnos/vistas/diagnos.lista.php','','.lista-diagnosticos');
						$('.cerrarmodal').click();
					} else {
						alerta('.mensaje1','danger',data);
					}
			})
		})
	})
</script>
<?php echo $fun->modalHeader('Editar Diagnóstico') ?>
<div class="modal-body">
	<div class="bootbox-body">
		<div class="col-xs-12">
			<div class="mensaje1"></div>
			<?php foreach($diagnos_rows as $dr) { ?>
				<form action="" class="modificar-diagnos" role="form">
					<div class="form-group">
						<label for="" class="control-label col-xs-12 bolder">Descripción</label>
						<div class="col-xs-12">
							<input type="text" name="des" class="col-xs-12" value="<?php echo $dr->diagno_descrip ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-xs-12 bolder">Color</label>
						<div class="col-xs-12">
							<div  class="bootstrap-colorpicker">
								<input name="col" type="text" class="col-xs-12 colorpicker2" value="<?php echo $dr->diagno_color ?>">
							</div>
						</div>
					</div>
					<input type="hidden" name="ide" value="<?php echo $dr->diagno_codigo ?>">
				</form>
			<?php } ?>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php echo $fun->modalFooter('Guardar Cambios','btn-modificar-diagno') ?>