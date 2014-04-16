<?php require '../../../cfg/base.php'; ?>
<?php
/**
  * @var $eeo array examen extraoral
  */ 
$exo = $mortodon->examenExtraOralSelect($cedrif);
?>
<script>
	$(function(){
		$('.cerrardefecto6').click();
		$('.examen-extraoral').submit(function(e){
			e.preventDefault();
			$.post('app/ortodon/procesos/p.examen.extraoral.php',$(this).serialize(),function(data){
				if(data==1) {
					load('app/ortodon/vistas/examen.extraoral.php','cedrif=<?php echo $cedrif ?>','#examen-extraoral')
					cerrarAlerta('.msj_3');
				} else {
					alerta('.msj_4','danger',data);
				}
			})
		})
	})
</script>
<div class="widget-box">
	<div class="widget-header">
		<h4>Exámen Extraoral</h4>
		<div class="widget-toolbar">
			<?php echo $fun->collapseWidget(6) ?>
			<?php echo $fun->reloadWidget('app/ortodon/vistas/examen.extraoral.php','cedrif='.$cedrif,'#examen-extraoral'); ?>
			<?php echo $fun->navOrtodoncia(); ?>
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<form action="" class="clearfix examen-extraoral ">
				<div class="msj_4"></div>
				<div class="col-sm-12">
					<div class="form-group">
						<label for="" class="control-label col-sm-1 bolder">Perfil</label>
						<div class="col-sm-11">
							<input type="text" class="col-sm-12" name="per" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_perfil : null; ?>">
						</div>
					</div>
				</div>
				
				<div class="col-sm-12">
					<div class="form-group">
						<div class="col-sm-12">
							<h5 class="bolder text-info">Análisis de Tercios</h5>
						</div>
						<div class="col-sm-4">
							<label for="" class="control-label bolder col-sm-12">Sup</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="anatersup" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_analis_ter_sub : null; ?>">
							</div>
						</div>
						<div class="col-sm-4">
							<label for="" class="control-label bolder col-sm-12">Med</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="anatermed" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_analis_ter_med : null; ?>">
							</div>
						</div>
						<div class="col-sm-4">
							<label for="" class="control-label bolder col-sm-12">Inf</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="anaterinf" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_analis_ter_inf : null; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="form-group">
						<div class="col-sm-12">
							<h5 class="bolder text-info">Labio Superior</h5>
						</div>
						<div class="col-sm-4">
							<label for="" class="control-label bolder col-sm-12">Proquelia</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="labsuppro" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_labio_sup_proqueli : null; ?>">
							</div>
						</div>
						<div class="col-sm-4">
							<label for="" class="control-label bolder col-sm-12">Retroquelia</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="labsupret" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_labio_sup_retroque : null; ?>">
							</div>
						</div>
						<div class="col-sm-4">
							<label for="" class="control-label bolder col-sm-12">Normal</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="labsupnor" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_labio_sup_normal : null; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="form-group">
						<div class="col-sm-12">
							<h5 class="bolder text-info">Labio Inferior</h5>
						</div>
						<div class="col-sm-4">
							<label for="" class="control-label bolder col-sm-12">Proquelia</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="labinfpro" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_labio_inf_proqueli : null; ?>">
							</div>
						</div>
						<div class="col-sm-4">
							<label for="" class="control-label bolder col-sm-12">Retroquelia</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="labinfret" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_labio_inf_retroque : null; ?>">
							</div>
						</div>
						<div class="col-sm-4">
							<label for="" class="control-label bolder col-sm-12">Normal</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="labinfnor" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_labio_inf_normal : null; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="form-group">
						<div class="col-sm-12">
							<h5 class="bolder text-info">Arco de Sonrisa</h5>
						</div>
						<div class="col-sm-6">
							<label for="" class="control-label bolder col-sm-12">Consonante</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="arcsoncon" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_arc_sonr_const : null; ?>">
							</div>
						</div>
						<div class="col-sm-6">
							<label for="" class="control-label bolder col-sm-12">No consonante</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="arcsonnoc" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_arc_sonr_noconst : null; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="form-group">
						<div class="col-sm-12">
							<h5 class="bolder text-info">Tipo de sonrisa</h5>
						</div>
						<div class="col-sm-4">
							<label for="" class="control-label bolder col-sm-12">Normal</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="tipsonnor" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_tip_sonr_normal : null; ?>">
							</div>
						</div>
						<div class="col-sm-4">
							<label for="" class="control-label bolder col-sm-12">Ginginal</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="tipsongin" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_tip_sonr_gingi : null; ?>">
							</div>
						</div>
						<div class="col-sm-4">
							<label for="" class="control-label bolder col-sm-12">Senil o baja</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="tipsonsen" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_tip_sonr_senil : null; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">			
					<div class="col-sm-12">
						<h5 class="bolder text-info">Línea media facial</h5>
					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<label for="" class="control-label bolder col-sm-12">Coincidente</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="linmedfaccoi" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_lin_med_faci_con : null; ?>">
							</div>
						</div>
						<div class="col-sm-6">
							<label for="" class="control-label bolder col-sm-12">No Coincidente</label>
							<div class="col-sm-12">
								<input type="text" class="col-sm-12" name="linmedfacnoc" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_lin_med_faci_nocon : null; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="col-sm-12 control-label bolder">Análisis frontal</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="anafro" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_anal_fron : null; ?>">
							</div>
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="col-sm-12 control-label bolder">Selle labial</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="sellab" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_selle_labial : null; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="col-sm-12 control-label bolder">Maxilar</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="max" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_maxi : null; ?>">
							</div>
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="form-group">
							<label for="" class="col-sm-12 control-label bolder">Mandíbula</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="man" value="<?php echo (count($exo)>0) ? $exo[0]->extoral_o_mandi : null; ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="clearfix form-actions">
					<div class="col-xs-2 col-md-offset-10">
						<button class="btn btn-primary"><i class="icon-ok bigger-110"></i> Guardar Cambios</button>
					</div>
				</div>
				<input type="hidden" name="cedrif" value="<?php echo $cedrif ?>">
			</form>
		</div>
	</div>