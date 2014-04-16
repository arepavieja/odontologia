<?php 
require '../../../cfg/base.php';
//$rayos = $mradiogra->traerRayos($cedrif);
?>
<script type="text/javascript">
	load('app/radiogra/vistas/rayos.lista.php','cedrif=<?php echo $cedrif; ?>','#rayosx');
	jQuery(function($){
	
	try {
	  $(".dropzone").dropzone({
	    paramName: "file", // The name that will be used to transfer the file
	    maxFilesize: 10.0, // MB
	  	acceptedFiles: 'image/*', 
	  	url: 'app/radiogra/procesos/p.imagen.insert.php?cedrif=<?php echo $cedrif; ?>',
			addRemoveLinks : true,
			dictResponseError: '¡Error al cargar el archivo!',
			dictDefaultMessage: 'sd',
			dictFallbackMessage: 'sd',

			//change the previewTemplate to use Bootstrap progress bars

		  });
		} catch(e) {
		  alert('¡Dropzone no es compatible!');
		}			
	});
</script>

	<form action="" class="clearfix dropzone dz-clickable">
		<div class="dz-default dz-message" style="display:none">
			<span></span>
		</div>
		<div class="fallback">
			<input name="file" type="file" multiple="" />
		</div>
		<div id="rayosx" style="z-index:100"></div>
	</form>

