<?php 
require '../../../cfg/base.php';
$rayos = $mradiogra->traerRayos($cedrif);
?>
<script type="text/javascript">
	jQuery(function($) {
		var colorbox_params = {
			reposition:true,
			scalePhotos:true,
			scrolling:false,
			previous:'<i class="icon-arrow-left"></i>',
			next:'<i class="icon-arrow-right"></i>',
			close:'&times;',
			current:'{current} of {total}',
			maxWidth:'70%',
			maxHeight:'70%',
			onOpen:function(){
				document.body.style.overflow = 'hidden';
			},
			onClosed:function(){
				document.body.style.overflow = 'auto';
			},
			onComplete:function(){
				$.colorbox.resize();
			}
		};

		$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
		$("#cboxLoadingGraphic").append("<i class='icon-spinner orange'></i>");//let's add a custom loading icon

	/**$(window).on('resize.colorbox', function() {
	try {
	//this function has been changed in recent versions of colorbox, so it won't work
	$.fn.colorbox.load();//to redraw the current frame
	} catch(e){}
	});*/
	})
	function borrarImagen(ide) {
		if(confirm('¿Realmente desea borrar la imagen seleccionada?')==true) {
			$.post('app/radiogra/procesos/p.rayos.delete.php',ide,function(data){
				load('app/radiogra/vistas/rayos.lista.php','cedrif=<?php echo $cedrif; ?>','#rayosx');
			})
		}
	}
</script>
<?php if(count($rayos)>0) { ?>
	<?php foreach($rayos as $r) { ?>
		<div class="row-fluid">
			<ul class="ace-thumbnails">
				<li>
					<a href="img/rayosx/<?php echo $r->rayos_ruta ?>" data-rel="colorbox"  title="<?php echo $r->rayos_pan." " ?> <?php echo $r->rayos_cefa." " ?> <br> <?php echo $r->rayos_per." " ?>">
						<img alt="img/rayosx/<?php echo $r->rayos_ruta ?>" style="width:150px;height:150px" src="img/rayosx/<?php echo $r->rayos_ruta ?>" />
						<div class="text">
							<div class="inner"></div>
						</div>
					</a>

					<div class="tools tools-bottom">
						<!-- <a href="#">
							<i class="icon-link"></i>
						</a>

						<a href="#">
							<i class="icon-paper-clip"></i>
						</a>
						-->
						<a href="#" onclick="modal('app/radiogra/vistas/rayos.update.php','rayos_ide=<?php echo $r->rayos_ide ?>')">
							<i class="icon-pencil"></i>
						</a> 

						<a href="#" onclick="borrarImagen('rayos_ide=<?php echo $r->rayos_ide ?>')">
							<i class="icon-remove red"></i>
						</a>
					</div>
				</li>
			</ul>
		</div>
	<?php } ?>
<?php } ?>