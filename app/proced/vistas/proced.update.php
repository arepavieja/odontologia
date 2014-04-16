<?php  
require '../../../cfg/base.php';
$proced_rows = $mproced->procedSelectIde($ide);
?>
<script>
	$(function(){
		$('.btn-modificar-proced').click(function(){
			$.post('app/proced/procesos/p.proced.update.php',$('.modificar-proced').serialize(),function(data){
					if(data==1) {
						alerta('.mensaje1','success','Registro actualizado correctamente');
						load('app/proced/vistas/proced.lista.php','','.lista-procedimientos')
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
			<?php foreach($proced_rows as $pr) { ?>
				<form action="" class="modificar-proced" role="form">
					<div class="form-group">
						<label for="" class="control-label col-xs-12 bolder">Descripción</label>
						<div class="col-xs-12">
							<input type="text" name="des" class="col-xs-12" value="<?php echo $pr->proced_des ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="" class="control-label col-xs-12 bolder">Costo</label>
						<div class="col-xs-12">
							<input name="pre" type="text" class="col-xs-12" value="<?php echo $pr->proced_prec ?>">
						</div>
					</div>
					<input type="hidden" name="ide" value="<?php echo $pr->proced_ide ?>">
				</form>
			<?php } ?>
		</div>
	</div>
</div>
<div class="clearfix"></div>
<?php echo $fun->modalFooter('Guardar Cambios','btn-modificar-proced') ?>