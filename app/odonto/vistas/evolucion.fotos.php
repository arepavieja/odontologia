<?php 
require '../../../cfg/base.php';
$rayos = $modonto->traerFotosEvolucion($trat_ide);
//print_r($rayos)
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
	function borrarFoto(ide) {
		if(confirm('¿Realmente desea borrar la imagen seleccionada?')==true) {
			$.post('app/odonto/procesos/p.fotos.delete.php',ide,function(data){
				load('app/odonto/vistas/evolucion.fotos.php','des=<?php echo $des ?>&trat_ide=<?php echo $trat_ide ?>&cedrif=<?php echo $cedrif ?>&diagno=<?php echo $diagno ?>&prec=<?php echo $prec ?>','.evolucion')
			})
		}
	}
</script>
<div class="space-10"></div>
<?php if(count($rayos)>0) { ?>
	<?php foreach($rayos as $r) { ?>
		<div class="row-fluid">
			<ul class="ace-thumbnails">
				<li>
					<a href="img/evolucion/<?php echo $r->evfo_ruta ?>" data-rel="colorbox"  title="<?php echo $r->evfo_fec ?>">
						<img alt="img/evolucion/<?php echo $r->evfo_ruta ?>" style="width:150px;height:150px" src="img/evolucion/<?php echo $r->evfo_ruta ?>" />
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

						<a href="#" onclick="borrarFoto('evfo_ide=<?php echo $r->evfo_ide ?>'); return false;">
							<i class="icon-remove red"></i>
						</a>
					</div>
				</li>
			</ul>
		</div>
	<?php } ?>
<?php } ?>
<div class="clearfix"></div>