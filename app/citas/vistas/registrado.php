<?php 
require '../../../cfg/base.php';
$datos = $mhistoria->datosPersonalesSelect($cedrif);
$fechagotodate = $ccitas->fechaCalendarAll($inicio);
$anio = $fechagotodate[3];
$mes = $ccitas->mesNumMin($fechagotodate[1]);
$diaa = $fechagotodate[2];
?>
<script>
	$(function(){
		$('.registrado').submit(function(e){
			e.preventDefault();
			$.post('app/citas/procesos/p.citas.insert.registrado.php',$('.registrado').serialize(),function(data){
				if(data==1) {
					load('app/citas/vistas/calendar.php','gotodate=1&anio=<?php echo $anio ?>&mes=<?php echo $mes ?>&diaa=<?php echo $diaa ?>','#calendar')					
					$('.cerrarmodal').click();
				} else {
					alerta('.msj','danger',data);
				}
			})
		})
	})	
</script>
<hr>
<div class="space-15"></div>
<div class="msj"></div>
<form action="" class="form-horizontal registrado" >
	<div class="form-group">
		<label for="" class="col-sm-3 control-label bolder">Cédula:</label>
		<div class="col-sm-8">
			<input type="text" class="form-control col-sm-12" value="<?php echo $cedrif ?>" readonly name="cedrif">
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-3 control-label bolder">Apellidos:</label>
		<div class="col-sm-8">
			<input type="text" class="form-control col-sm-12" value="<?php echo $datos[0]->pacien_nomraz ?>" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-3 control-label bolder">Etiqueta:</label>
		<div class="col-sm-8">
			<select name="etiqueta" id="" class="col-sm-12">
				<option value="label-info">Normal</option>
				<option value="label-danger">Urgente</option>
				<option value="label-success">Importante</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-3 control-label bolder">Entrada:</label>
		<div class="col-sm-8">
			<input type="text" class="form-control col-sm-12" value="<?php echo $ccitas->fechaCalendar($inicio) ?>" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="col-sm-3 control-label bolder">Salida:</label>
		<div class="col-sm-8">
			<input type="text" class="form-control col-sm-12" value="<?php echo $ccitas->fechaCalendar($fin) ?>" readonly>
		</div>
	</div>
	<div class="clearfix form-actions">
		<button class="btn btn-primary pull-right">Aceptar</button>
	</div>
	<div class="clearfix"></div>
	<input type="hidden" value="<?php echo $inicio ?>" name="inicio">
	<input type="hidden" value="<?php echo $fin ?>" name="fin">
	<input type="hidden" value="<?php echo $dia ?>" name="dia">
</form>
