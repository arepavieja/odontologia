<?php 
require '../../../cfg/base.php'; 
$rayo = $mradiogra->traerRayosIde($rayos_ide);
?>
<script>
	$(function(){
		$('.btn-modificar-rayos').click(function(e){
			$('.editar-rayos').submit();
		})
		$('.editar-rayos').submit(function(e){
			e.preventDefault();
			$.post('app/radiogra/procesos/p.rayos.update.php',$(this).serialize(),function(data){
				if(data==1) {
					alerta('.msj_3','success','Datos guardados correctamente');
					load('app/radiogra/vistas/rayos.lista.php','cedrif=<?php echo $rayo[0]->rayos_paciente; ?>','#rayosx');
				} else {
					alerta('.msj_3','danger',data);
				}
			})
		})
	})
</script>
<?php echo $fun->modalHeader('Editar Rayox-X') ?>
<div class="modal-body">
	<div class="bootbox-body">
		<form action="" role="form" class="clearfix form-horizontal editar-rayos">
			<div class="msj_3"></div>
			<div class="col-sm-12">				
				<div class="form-group">
					<label for="" class="control-label bolder col-sm-2">Panorámica</label>
					<div class="col-sm-10">
						<input type="text" class="form-control col-sm-12" name="pan" value="<?php echo $rayo[0]->rayos_pan ?>">
					</div>
				</div>
			</div>

			<div class="col-sm-12">				
				<div class="form-group">
					<label for="" class="control-label bolder col-sm-2">Cefálica</label>
					<div class="col-sm-10">
						<input type="text" class="form-control col-sm-12" name="cef" value="<?php echo $rayo[0]->rayos_cefa ?>">
					</div>
				</div>
			</div>

			<div class="col-sm-12">				
				<div class="form-group">
					<label for="" class="control-label bolder col-sm-2">Periapical</label>
					<div class="col-sm-10">
						<input type="text" class="form-control col-sm-12" name="per" value="<?php echo $rayo[0]->rayos_per ?>">
					</div>
				</div>
			</div>
			<input type="hidden" name="ide" value="<?php echo $rayo[0]->rayos_ide ?>">
		</form>
	</div>
</div>
<div class="clearfix"></div>
<?php echo $fun->modalFooter('Guardar Cambios','btn-modificar-rayos') ?>