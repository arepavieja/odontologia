<?php 
require '../../../cfg/base.php';
?>
<script>
	$(function(){
		$('.registrado').submit(function(e){
			e.preventDefault();
			$.post('app/citas/procesos/p.citas.delete.php',ide,function(data){
				if(data==1) {
					load('app/citas/vistas/calendar.php','','#calendar')
					$('.cerrarmodal').click();
				} else {
					alerta('.msj','danger',data);
				}
			})
		})
	})	
	function borrarCita(ide) {
		if(confirm('¿Realmente desea borrar la cita?')==true) {
			$.post('app/citas/procesos/p.citas.delete.php',ide,function(data){
				if(data==1) {
					load('app/citas/vistas/calendar.php','','#calendar')
				} else {
					alerta('.msj','danger',data);
				}
			})
		}
	}
</script>

<?php echo $fun->modalHeader('Crear Nueva Cita') ?>
<div class="modal-body">
	<form action="" class="form-horizontal registrado" >
		<div class="form-group">
			<label for="" class="col-sm-3 control-label bolder">Razón Social:</label>
			<div class="col-sm-8">
				<input type="text" class="form-control col-sm-12" value="<?php echo $titulo ?>" readonly>
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
				<input type="text" class="form-control col-sm-12" value="<?php echo ($fin!='null') ? $ccitas->fechaCalendar($fin) : null ?>" readonly>
			</div>
		</div>
		<div class="clearfix"></div>
		<input type="hidden" value="<?php echo $inicio ?>" name="entrada">
		<input type="hidden" value="<?php echo $fin ?>" name="salida">
		<input type="hidden" value="<?php echo $dia ?>" name="dia">
	</form>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
	<button class="btn btn-default cerrarmodal" data-dismiss="modal" type="button" data-bb-handler="cancel">Cerrar</button>
	<button class="btn btn-danger cerrarmodal" data-dismiss="modal" type="button" data-bb-handler="cancel" onclick="borrarCita('citas_ide=<?php echo $citas_ide ?>')">Cancelar Cita</button>
</div>