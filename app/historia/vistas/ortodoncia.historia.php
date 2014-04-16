<?php 
require '../../../cfg/base.php'; 
$datospers_rows = $mhistoria->datosPersonalesSelect($cedrif);
?>
<script>
	$(function(){
		$('.fecha').datepicker();
		load('app/historia/vistas/ortodoncia.consulta.php','cedrif=<?php echo $cedrif ?>','#modulos')
		/**
		 * Cambiar el estatus del botón dependiendo de la opción seleccionada
		 * @return {[type]} [description]
		 */
		$('.nav-paciente button').click(function(){
			$('.modulos').removeClass('btn-success');
			$('.modulos').addClass('btn-purple');
			$(this).removeClass('btn-purple')
			$(this).addClass('btn-success');
		})
		/**
		 * Guardar la consulta
		 * @return {[type]} [description]
		 */
		$('.guardar-consulta').submit(function(e){
			e.preventDefault();
			$.post('app/historia/procesos/p.consulta.insert.php',$(this).serialize(),function(data){

			})
		})
	})	
</script>
<div class="pull-left" >
	<div class="foto pull-left" style="margin-right:132px" onclick="modal('app/historia/vistas/foto.update.php','cedrif=<?php echo $cedrif ?>')">
		<?php  $foto = (!empty($datospers_rows[0]->pacien_fot)) ? $datospers_rows[0]->pacien_fot : 'noFoto.png' ?>
		<img src="img/paciente/<?php echo $foto; ?>" alt="" valign="left" class="img-rounded" style="width:150px; height:150px">
	</div>
	<label for="" class="inline bolder" >N° de Historia:</label>
	<input class="input-small" type="text" disabled value="O-<?php echo sprintf('%03d',$datospers_rows[0]->pacien_letra_hist) ?>">
</div>
<div class="pull-right">
	<div class="btn-group nav-paciente">
		<button class="btn btn-sm btn-success modulos" onclick="load('app/historia/vistas/ortodoncia.consulta.php','cedrif=<?php echo $cedrif ?>','#modulos')">
			<i class="fa fa-user-md"></i> Consulta
		</button>
		<button class="btn btn-sm btn-purple modulos" onclick="load('app/examen/vistas/admin.php','cedrif=<?php echo $cedrif ?>','#modulos')">
			<i class="fa fa-camera-retro"></i> Exámenes
		</button>
		<button class="btn btn-sm btn-purple modulos" onclick="load('app/recipes/vistas/admin.php','cedrif=<?php echo $cedrif ?>','#modulos')">
			<i class="fa fa-medkit"></i> Récipes
		</button>
		<button class="btn btn-sm btn-purple modulos" onclick="load('app/radiogra/vistas/admin.php','cedrif=<?php echo $cedrif ?>','#modulos')">
			<i class="fa fa-hospital-o"></i> Radiografías
		</button>
	</div>
</div>
<div class="clearfix"></div>
<hr>
<div id="modulos"></div>