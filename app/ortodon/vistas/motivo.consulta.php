<?php require '../../../cfg/base.php'; ?>
<?php
/**
  * @var $mr array motivos_rows
  */ 
$mr = $mgeneral->motivoConsultaSelect($cedrif);
?>
<script>
	$(function(){
		$('.cerrardefecto8').click();
		$('.motivo-consulta').submit(function(e){
			e.preventDefault();
			$.post('app/ortodon/procesos/p.motivo.insert.php',$(this).serialize(),function(data){
				if(data==1) {
					load('app/ortodon/vistas/motivo.consulta.php','cedrif='+cedrif,'#motivo-consulta')
					cerrarAlerta('.msj_3');
				} else {
					alerta('.msj_3','danger',data);
				}
			})
		})
	})
</script>
<div class="widget-box">
	<div class="widget-header">
		<h4>Motivo de Consulta y Anamnesis</h4>
		<div class="widget-toolbar">
			<?php echo $fun->collapseWidget(8) ?>
			<?php echo $fun->reloadWidget('app/ortodon/vistas/motivo.consulta.php','cedrif='.$cedrif,'#motivo-consulta'); ?>
			<?php echo $fun->navOrtodoncia(); ?>
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<form class="clearfix motivo-consulta" role="form">
				<div class="col-sm-10 col-md-offset-1">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Motivo:</label>
							<div class="col-sm-12">
								<textarea class="autosize-transition form-control" id="form-field-11" style="overflow: hidden; word-wrap: break-word; resize: none; height: 90px;" name="motivo"><?php echo (count($mr)>0) ? $mr[0]->anamnesis_moti_consul : null; ?></textarea>
							</div>
						</div>	
				</div>
			    <div class="space-24"> </div>
			    <div class="clearfix"></div>	
			    <div class="space-24"> </div>
			    <div class="clearfix"></div>	
				<div class="msj_3"></div>
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-bordered" style="width:80%;margin:0px auto">
						<thead>
							<tr>
								<th style="width:34%">Opción</th>
								<th class="center" style="width:8%">Si</th>
								<th class="center" style="width:8%">No</th>
								<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								<th style="width:34%">Opción</th>
								<th class="center" style="width:8%">Si</th>
								<th class="center" style="width:8%">No</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="vcenter">Tratamiento médico</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="tramed" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_trat_med) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="tramed" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_trat_med) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td rowspan="8" class="white">&nbsp;</td>
								<td class="vcenter">Traumas o accidentes</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="traacc" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_accident) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="traacc" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_accident) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>

							<tr>
								<td class="vcenter">Toma medicamentos</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="tommed" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_toma_medicame) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="tommed" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_toma_medicame) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Enfermedad cardíaca</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enfcar" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_enfermed_cardiaca) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enfcar" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_enfermed_cardiaca) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>

							<tr>
								<td class="vcenter">Cirugía</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="cir" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_cirugia) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="cir" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_cirugia) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Embarazo</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="emb" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_embarazo) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="emb" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_embarazo) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>

							<tr>
								<td class="vcenter">Alergia anestesia</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="aleane" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_alergia_anestesi) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="aleane" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_alergia_anestesi) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Diabetes</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="dia" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_diabetes) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="dia" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_diabetes) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>

							<tr>
								<td class="vcenter">Enfermedad respiratoria</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enfres" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_enfermed_respirat) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enfres" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_enfermed_respirat) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Enf. transmisión sexual</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enftrasex" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_transmis_sexual) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enftrasex" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_transmis_sexual) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>

							<tr>
								<td class="vcenter">Enfermedad Endrocrina</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enfend" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_enfermed_endroc) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enfend" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_enfermed_endroc) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Hipertensión arterial</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="hipart" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_hiperten_arterial) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="hipart" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_hiperten_arterial) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>

							<tr>
								<td class="vcenter">Respiración</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="res" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_respir) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="res" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_respir) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Masticación Unilateral</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="masuni" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_unilater) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="masuni" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_unilater) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>
							<tr>
								<td class="vcenter">Masticación Bilateral</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="masbil" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_bilatera) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="masbil" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_bilatera) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Higiene Oral</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="higora" value="1" <?php echo (count($mr)>0) ? $fun->checked(1,$mr[0]->anamnesis_higiene_oral) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="higora" value="0" <?php echo (count($mr)>0) ? $fun->checked(0,$mr[0]->anamnesis_higiene_oral) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>
							<tr>
								<td class="vcenter">Otro</td>
								<td colspan="2" class="vcenter" style="width:16%">
									<input type="text" name="otr" class="col-xs-12" value="<?php echo (count($mr)>0) ? $mr[0]->anamnesis_otra : null; ?>">
								</td>
								<td colspan="4"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="space-16"></div>
				<div class="col-xs-8 col-md-offset-2">
					<div class="form group">
						<label class="label-control col-xs-12 bolder">Observaciones</label>
						<div class="col-xs-12">
							<textarea class="autosize-transition form-control" id="form-field-11" style="overflow: hidden; word-wrap: break-word; resize: none; height: 152px;" name="obs"><?php echo (count($mr)>0) ? $mr[0]->anamnesis_obserb : null; ?></textarea>
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