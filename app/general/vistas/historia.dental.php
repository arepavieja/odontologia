<?php require '../../../cfg/base.php'; ?>
<?php 
/**
 * @var $dp_row array Datos Personales
 */
$dp_row = $mhistoria->datosPersonalesSelect($cedrif);
?>
<script>
	$(function(){
		$('.cerrardefecto4').click();
		$('.fecha').datepicker();
		$('.historia-dental').submit(function(e){
			e.preventDefault();
			$.post('app/general/procesos/p.historia.dental.insert.php',$(this).serialize(),function(data){
				if(data==1) {
					load('app/general/vistas/historia.dental.php','cedrif='+cedrif,'#historia-dental')
					cerrarAlerta('.msj_4');
				} else {
					alerta('.msj_4','danger',data);
				}
			})
		})
	})
</script>
<div class="widget-box">
	<div class="widget-header">
		<h4>Historia Dental</h4>
		<div class="widget-toolbar">
			<?php echo $fun->collapseWidget(4) ?>
			<?php echo $fun->reloadWidget('app/general/vistas/historia.dental.php','cedrif='.$cedrif,'#historia-dental') ?>
			<?php echo $fun->navGeneral(); ?>
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<form action="" role="form" class="historia-dental">
				<div class="msj_4"></div>
				<div class="col-lg-12">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Ultima visita al odontólogo:</label>
							<div class="col-sm-12">
								<input type="text" readonly class="col-sm-12 fecha" data-date-format="yyyy-mm-dd" name="ulvisodo" value="<?php echo $dp_row[0]->pacien_ult_visit ?>">
							</div>
						</div>	
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Frecuencia de cepillado:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="frecep" value="<?php echo $dp_row[0]->pacien_frec_cepill ?>">
							</div>
						</div>	
					</div>
				</div>

				<div class="col-lg-12">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Seda dental, enjuague bucal, palillos:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="sdebp" value="<?php echo $dp_row[0]->pacien_sedal_otro ?>">
							</div>
						</div>	
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Cambio de Cepillo:</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="camcep" value="<?php echo $dp_row[0]->pacien_camb_cepill ?>">
							</div>
						</div>	
					</div>
				</div>

				<div class="clearfix"></div>
				<div class=" clearfix form-actions">
					<div class="col-xs-2 col-md-offset-10">
						<button class="btn btn-primary"><i class="icon-ok bigger-110"></i> Guardar Cambios</button>
					</div>
				</div>
				<input type="hidden" name="cedrif" value="<?php echo $cedrif ?>">
			</form>
		</div>
	</div>
</div>