<?php 
require '../../../cfg/base.php';
$odtgrm = json_encode($modonto->diagnosticosMedico($cedrif));
?>
<script src="app/odonto/vistas/js/ver.odontograma.js"></script>
<script>
	var odtgrm = <?php echo $odtgrm; ?>;
	crearOdontograma(odtgrm);
	load('app/odonto/vistas/diagnosticos.php','cedrif=<?php echo $cedrif; ?>','#seleccionados');
	$(function(){
		otrolugar = 0;
		$('#otrolugar').on('click', function() {
			var estado = this.checked;
			if(estado==true) {
				otrolugar = 1;
			} else {
				otrolugar = 0;
			}
		})
	})
</script>
<div class="content-odonto">
	<div class="odontograma">
<!-- CUADRANTE N° 1 ############################################ -->
		<div class="cuadrante1">
			<?php for($x=11;$x<=18;$x++) { ?>
				<div class="cuadros right c-<?php echo $x; ?>">
					<div class="diagcua"></div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=51;$x<=55;$x++) { ?>
				<div class="cuadros right c-<?php echo $x; ?>">
					<div class="diagcua"></div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=11;$x<=18;$x++) { ?>
				<div class="numeros right c-<?php echo $x; ?>">
					<div class="diagnum"></div><?php echo $x ?>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=11;$x<=18;$x++) { ?>
				<div class="diente right c-<?php echo $x; ?>">
					<div class="diag"></div>
					<img src="img/cono.png" class="cono" alt="">
					<div class="muela c-<?php echo $x; ?>">
						<div class="V T"></div>
						<div class="M T"></div>
						<div class="O T"></div>
						<div class="D T"></div>
						<div class="P T"></div>
						<div class="diag-muela"></div>
					</div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=51;$x<=55;$x++) { ?>
				<div class="diente right c-<?php echo $x; ?>">
					<div class="diag"></div>
					<img src="img/cono.png" class="cono" alt="">
					<div class="muela c-<?php echo $x; ?>">
						<div class="V T"></div>
						<div class="M T"></div>
						<div class="O T"></div>
						<div class="D T"></div>
						<div class="P T"></div>
						<div class="diag-muela"></div>
					</div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=51;$x<=55;$x++) { ?>
				<div class="numeros right c-<?php echo $x; ?>">
					<div class="diagnum"></div><?php echo $x ?>
				</div>
			<?php } ?>
		</div>
<!-- CUADRANTE N° 2 ############################################ -->
		<div class="cuadrante2">
			<?php for($x=21;$x<=28;$x++) { ?>
				<div class="cuadros c-<?php echo $x; ?>">
					<div class="diagcua"></div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=61;$x<=65;$x++) { ?>
				<div class="cuadros c-<?php echo $x; ?>">
					<div class="diagcua"></div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=21;$x<=28;$x++) { ?>
				<div class="numeros c-<?php echo $x; ?>">
					<div class="diagnum"></div><?php echo $x ?>
				</div>
			<?php } ?>
			<?php for($x=21;$x<=28;$x++) { ?>
				<div class="diente left c-<?php echo $x; ?>">
					<div class="diag"></div>
					<img src="img/cono.png" class="cono" alt="">
					<div class="muela c-<?php echo $x; ?>">
						<div class="V T"></div>
						<div class="M T"></div>
						<div class="O T"></div>
						<div class="D T"></div>
						<div class="P T"></div>
						<div class="diag-muela"></div>
					</div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=61;$x<=65;$x++) { ?>
				<div class="diente left c-<?php echo $x; ?>">
					<div class="diag"></div>
					<img src="img/cono.png" class="cono" alt="">
					<div class="muela c-<?php echo $x; ?>">
						<div class="V T"></div>
						<div class="M T"></div>
						<div class="O T"></div>
						<div class="D T"></div>
						<div class="P T"></div>		
						<div class="diag-muela"></div>			
					</div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=61;$x<=65;$x++) { ?>
				<div class="numeros c-<?php echo $x; ?>">
					<div class="diagnum"></div><?php echo $x ?></div>
			<?php } ?>
		</div>
<!-- CUADRANTE N° 3 ############################################ -->
		<div class="cuadrante4">
			<?php for($x=81;$x<=85;$x++) { ?>
				<div class="numeros right c-<?php echo $x; ?>">
					<div class="diagnum"></div><?php echo $x ?>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=81;$x<=85;$x++) { ?>
				<div class="diente right c-<?php echo $x; ?>">
					<div class="muela c-<?php echo $x; ?>">
						<div class="V T"></div>
						<div class="M T"></div>
						<div class="O T"></div>
						<div class="D T"></div>
						<div class="P T"></div>	
						<div class="diag-muela"></div>				
					</div>
					<img src="img/cono2.png" class="cono" alt="">
					<div class="diag"></div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=41;$x<=48;$x++) { ?>
				<div class="diente right c-<?php echo $x; ?>">
					<div class="muela c-<?php echo $x; ?>">
						<div class="V T"></div>
						<div class="M T"></div>
						<div class="O T"></div>
						<div class="D T"></div>
						<div class="P T"></div>
						<div class="diag-muela"></div>
					</div>
					<img src="img/cono2.png" class="cono" alt="">
					<div class="diag"></div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=41;$x<=48;$x++) { ?>
				<div class="numeros right c-<?php echo $x; ?>">
					<div class="diagnum"></div><?php echo $x ?>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=81;$x<=85;$x++) { ?>
				<div class="cuadros right c-<?php echo $x; ?>">
					<div class="diagcua"></div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=41;$x<=48;$x++) { ?>
				<div class="cuadros right c-<?php echo $x; ?>">
					<div class="diagcua"></div>
				</div>
			<?php } ?>
		</div>
<!-- CUADRANTE N° 4 ############################################ -->
		<div class="cuadrante3">
			<?php for($x=71;$x<=75;$x++) { ?>
				<div class="numeros c-<?php echo $x; ?>">
					<div class="diagnum"></div><?php echo $x ?>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=71;$x<=75;$x++) { ?>
				<div class="diente left c-<?php echo $x; ?>">
					<div class="muela c-<?php echo $x; ?>">
						<div class="V T"></div>
						<div class="M T"></div>
						<div class="O T"></div>
						<div class="D T"></div>
						<div class="P T"></div>		
						<div class="diag-muela"></div>				
					</div>
					<img src="img/cono2.png" class="cono" alt="">
					<div class="diag"></div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=31;$x<=38;$x++) { ?>
				<div class="diente left c-<?php echo $x; ?>">
					<div class="muela c-<?php echo $x; ?>">
						<div class="V T"></div>
						<div class="M T"></div>
						<div class="O T"></div>
						<div class="D T"></div>
						<div class="P T"></div>
						<div class="diag-muela"></div>
					</div>
					<img src="img/cono2.png" class="cono" alt="">
					<div class="diag"></div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=31;$x<=38;$x++) { ?>
				<div class="numeros c-<?php echo $x; ?>">
					<div class="diagnum"></div><?php echo $x ?>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=71;$x<=75;$x++) { ?>
				<div class="cuadros c-<?php echo $x; ?>">
					<div class="diagcua"></div>
				</div>
			<?php } ?>
			<div class="clearfix"></div>
			<?php for($x=31;$x<=38;$x++) { ?>
				<div class="cuadros c-<?php echo $x; ?>">
					<div class="diagcua"></div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>