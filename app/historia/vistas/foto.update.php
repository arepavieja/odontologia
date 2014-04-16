<?php 
require '../../../cfg/base.php';

?>

<script type="text/javascript">
	load('app/historia/vistas/foto.lista.php','cedrif=<?php echo $cedrif; ?>','#foto-paciente');
	jQuery(function($){
	//$('.dropzone').html('');
	try {
	  $(".dropzone").dropzone({
	    paramName: "file", // The name that will be used to transfer the file
	    maxFilesize: 10.0, // MB
	  	acceptedFiles: 'image/*', 
	  	url: 'app/historia/procesos/p.foto.update.php?cedrif=<?php echo $cedrif; ?>',
			addRemoveLinks : true,
			dictResponseError: '¡Error al cargar el archivo!',
			dictDefaultMessage: '',
			dictFallbackMessage: '',

			//change the previewTemplate to use Bootstrap progress bars

		  });
	  load('app/historia/vistas/foto.lista.php','cedrif=<?php echo $cedrif; ?>','#foto-paciente');
		} catch(e) {
		  alert('¡Dropzone no es compatible!');
		}			
	});
</script>
<?php echo $fun->modalHeader('Editar Foto de Paciente') ?>
<div class="modal-body" style="height:200px">
	<form action="" class="clearfix dropzone dz-clickable" style="height:130px">
		<div class="dz-default dz-message" style="display:none">
			<span  style="display:none"></span>
		</div>
		<div class="fallback" style="height:130px">
			<input name="file" type="file" multiple="" />
		</div>
		<div id="foto-paciente" style="z-index:100"></div>
	</form>
</div>
<div class="modal-footer">
	<button class="btn btn-default cerrarmodal" data-dismiss="modal" type="button" data-bb-handler="cancel">Aceptar y Cerrar</button>
</div>