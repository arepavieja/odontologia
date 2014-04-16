<?php 
require '../../../cfg/base.php';
$datospers_rows = $mhistoria->datosPersonalesSelect($cedrif);
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
</script>
<?php if(count($datospers_rows)>0) { ?>
	<?php foreach($datospers_rows as $r) { ?>
		<div class="row-fluid">
			<ul class="ace-thumbnails">
				<li>
					<a href="img/paciente/<?php echo $r->pacien_fot ?>" data-rel="colorbox"  title="<?php echo $r->pacien_cedrif ?> <br> <?php echo $r->pacien_nomraz ?>">
						<img alt="img/paciente/<?php echo $r->pacien_fot ?>" style="width:150px;height:150px" src="img/paciente/<?php echo $r->pacien_fot ?>" />
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
					</div>
				</li>
			</ul>
		</div>
	<?php } ?>
<?php } ?>