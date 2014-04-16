<?php require '../../../cfg/base.php'; ?>
<?php 
/**
 * $eio array Examen intra oral
 */
$eio = $mortodon->examenIntraOralSelect($cedrif);
?>
<script>
	$(function(){
		$('.cerrardefecto7').click();
		$('.examen-intraoral').submit(function(e){
			e.preventDefault();
			$.post('app/ortodon/procesos/p.examen.intraoral.php',$(this).serialize(),function(data){
				if(data==1) {
					load('app/ortodon/vistas/examen.intraoral.php','cedrif=<?php echo $cedrif ?>','#examen-intraoral')
					cerrarAlerta('.msj_5');
				} else {
					alerta('.msj_5','danger',data);
				}
			})
		})
	})
</script>
<div class="widget-box">
	<div class="widget-header">
		<h4>Exámen Intraoral</h4>
		<div class="widget-toolbar">
			<?php echo $fun->collapseWidget(7) ?>
			<?php echo $fun->reloadWidget('app/ortodon/vistas/examen.intraoral.php','cedrif='.$cedrif,'#examen-intraoral'); ?>
			<?php echo $fun->navOrtodoncia(); ?>
		</div>
	</div>
	<div class="widget-body">
		<div class="widget-main">
			<form action="" role="form" class="clearfix examen-intraoral">
				<div class="msj_5"></div>
				<div class="col-sm-12">
					<div class="col-sm-4"><h3 class="text-danger">Oclusión de frente</h3></div>
					<div class="col-sm-4"><h3 class="text-success">Oclusión Derecha</h3></div>
					<div class="col-sm-4"><h3 class="text-info">Oclusión Izquierda</h3></div>
				</div>
				<div class="col-sm-12">				
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Línea Media</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="oflinmed" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_of_linmed : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Clase Canina</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="odclacan" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_od_clacan : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Clase Canina</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="oiclacan" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_oi_clacan : null; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">				
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Plano oclusal</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="ofplaocl" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_of_plaocl : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Clase Molar</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="odclamol" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_od_clamol : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Clase Molar</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="oiclamol" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_oi_clamol : null; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">				
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Malposición</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="ofmal" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_of_mal : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Malposición</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="odmal" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_od_mal : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Malposición</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="oimal" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_oi_mal : null; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">				
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Overjet</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="ofoverjet" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_of_overjet : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Overjet</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="odoverjet" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_od_overjet : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Overjet</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="oioverjet" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_oi_overjet : null; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">				
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Overbite</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="ofoverbite" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_of_overbite : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Overbite</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="odoverbite" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_od_overbite : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Overbite</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="oioverbite" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_oi_overbite : null; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">				
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Sonrisa</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="ofson" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_of_son : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Curva de Spee</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="odcurspe" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_od_curspe : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Curva de Spee</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="oicurspe" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_oi_curspe : null; ?>">
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-12">				
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Otros</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="ofotr" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_of_otr : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Otros</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="odotr" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_od_otr : null; ?>">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="" class="control-label bolder col-sm-12">Otros</label>
							<div class="col-sm-12">
								<input type="text" class="form-control col-sm-12" name="oiotr" value="<?php echo (count($eio)>0) ? $eio[0]->intoral_oi_otr : null; ?>">
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