<?php require '../../../cfg/base.php'; ?>
<?php 
/**
 * @var $ei Examen intraoral Row.
 */
$ei = $mgeneral->examenIntraoralSelect($cedrif);
?>
<script>
	$(function(){
		$('.cerrardefecto3').click();
		$('.examen-intraoral').submit(function(e){
			e.preventDefault();
			$.post('app/general/procesos/p.examen.intraoral.insert.php',$(this).serialize(),function(data){
				if(data==1) {
					load('app/general/vistas/examen.intraoral.php', 'cedrif=<?php echo $cedrif ?>', '#examen-intraoral');
				} else {
					alerta('.msj_5','danger',data);
				}
			})
		})
	})
</script>
<div class="widget-box">
	<div class="widget-header">
		<h4>Examen Intraoral</h4>
		<div class="widget-toolbar">
			<?php echo $fun->collapseWidget(3); ?>
			<?php echo $fun->reloadWidget('app/general/vistas/examen.intraoral.php', 'cedrif='.$cedrif, '#examen-intraoral'); ?>
			<?php echo $fun->navGeneral(); ?>
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<form class="examen-intraoral" role="form">
				<div class="msj_5"></div>
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-bordered" style="width:80%;margin:0px auto">
						<thead>
							<tr>
								<th>Opción</th>
								<th class="center">N</th>
								<th class="center">A</th>
								<th class="center">N/A</th>
								<th></th>
								<th>Opción</th>
								<th class="center">Si</th>
								<th class="center">No</th>
								<th class="center">N/A</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="vcenter">Paladar</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="pal" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_paladar) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="pal" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_paladar) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="pal" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_paladar) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td rowspan="10"></td>
								<td class="vcenter">Cambios color</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="camcol" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_cambios_color) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="camcol" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_cambios_color) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="camcol" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_cambios_color) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>

							</tr>

							<tr>
								<td class="vcenter">Amígdalas</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="ami" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_amigdalas) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="ami" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_amigdalas) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="ami" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_amigdalas) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Anom. Forma</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="anofor" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_anom_forma) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="anofor" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_anom_forma) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="anofor" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_anom_forma) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>

							<tr>
								<td class="vcenter">Carrillos</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="car" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_carrillo) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="car" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_carrillo) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="car" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_carrillo) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Anom. Tamaño</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="anotam" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_anom_tamano) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="anotam" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_anom_tamano) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="anotam" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_anom_tamano) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>

							<tr>
								<td class="vcenter">Labios</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="lab" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_labios) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="lab" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_labios) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="lab" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_labios) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Patología pulpar</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="patpul" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_patologi_pulpar) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="patpul" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_patologi_pulpar) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="patpul" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_patologi_pulpar) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>

							<tr>
								<td class="vcenter">Atm</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="atm" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_atm) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="atm" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_atm) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="atm" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_atm) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Fracturas</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="fra" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_fractur) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>

								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="fra" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_fractur) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="fra" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_fractur) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>


							<tr>
								<td class="vcenter">Oclusión</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="ocl" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_oclusion) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>

								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="ocl" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_oclusion) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>

								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="ocl" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_oclusion) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">P. Blanda</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="pbla" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_p_blanda) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="pbla" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_p_blanda) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="pbla" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_p_blanda) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>

							<tr>
								<td class="vcenter">Rebordes Alveolares</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="rebalv" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_rebordes_alveolar) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="rebalv" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_rebordes_alveolar) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="rebalv" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_rebordes_alveolar) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">P. calcificada</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="pcal" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_p_calcific) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="pcal" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_p_calcific) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="pcal" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_p_calcific) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>


							<tr>
								<td class="vcenter">Lengua</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="len" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_lengua) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="len" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_lengua) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="len" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_lengua) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Enf. Perio</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enfper" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_enf_perio) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enfper" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_enf_perio) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enfper" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_enf_perio) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>


							<tr>
								<td class="vcenter">Piso de boca</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="pisboc" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_piso_boca) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="pisboc" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_piso_boca) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="pisboc" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_piso_boca) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Gingivitis</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="gin" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_gingiv) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="gin" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_gingiv) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="gin" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_gingiv) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>


							<tr>
								<td class="vcenter">Encías</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enc" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_encias) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enc" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_encias) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="enc" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_encias) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="vcenter">Bols per.</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="bolper" value="1" <?php echo (count($ei)>0) ? $fun->checked(1,$ei[0]->intraoral_bolsa_per) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="bolper" value="0" <?php echo (count($ei)>0) ? $fun->checked(0,$ei[0]->intraoral_bolsa_per) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
								<td class="">
									<div class="radio">
										<label>
											<input class="ace" type="radio" name="bolper" value="2" <?php echo (count($ei)>0) ? $fun->checked(2,$ei[0]->intraoral_bolsa_per) : null; ?>>
											<span class="lbl"></span>
										</label>
									</div>
								</td>
							</tr>							
						</tbody>
					</table>
				</div>

				<div class="space-16"></div>
				<div class="col-xs-12">
					<div class="form-group">		
						<div class="col-lg-12">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="" class="control-label bolder col-sm-12">Porcentaje placa:</label>
									<div class="col-sm-12">
										<input type="text" class="col-sm-12" name="porpla" value="<?php echo (count($ei)>0) ? $ei[0]->intraoral_porcen_placa : null ?>">
									</div>
								</div>	
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="" class="control-label bolder col-md-12">Dx periodontal:</label>
									<div class="col-sm-12">
										<input type="text" class="col-sm-12" name="dxper" value="<?php echo (count($ei)>0) ? $ei[0]->intraoral_dx_periodon : null ?>">
									</div>
								</div>	
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="space-10"></div>
				
				<div class="form group col-xs-12">
					<label class="label-control col-xs-12 bolder">Observaciones</label>
					<div class="col-xs-12">
						<textarea class="autosize-transition form-control" id="form-field-11" style="overflow: hidden; word-wrap: break-word; resize: none; height: 152px;" name="obs"><?php echo (count($ei)>0) ? $ei[0]->intraoral_obserb : null ?></textarea>
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