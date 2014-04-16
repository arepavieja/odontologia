<?php 
require '../../../cfg/base.php';
$mcnamara = $mortodon->mcnamara();
?>
<script>
	$(function(){
		$('.mcnamarabtn').on('click',function(e){
			e.preventDefault();
			datos = $(this).parent().parent().serialize();
			$.post('app/ortodon/procesos/p.mcnamara.insert.php',datos)
		})
	})
</script>
<h3 class="header smaller lighter green">Análisis de Mcnamara</h3>
<!-- Primera Línea -->
<div class="col-sm-1 bolder well well-sm">Edad</div>
<div class="col-sm-3 bolder well well-sm">Mujeres
</div>
<div class="col-sm-3 bolder well well-sm">Hombres
</div>
<div class="col-sm-2 bolder well well-sm">Valor</div>
<div class="col-sm-2 bolder well well-sm">Diagnóstico</div>
<div class="col-sm-1"></div> 
<div class="clearfix"></div>
<div class="col-sm-1">&nbsp;</div>
<div class="col-sm-3">
	<div class="col-sm-2 bolder well well-sm">6</div>
	<div class="col-sm-2 bolder well well-sm">9</div>
	<div class="col-sm-2 bolder well well-sm">12</div>
	<div class="col-sm-2 bolder well well-sm">14</div>
	<div class="col-sm-2 bolder well well-sm">16</div>
	<div class="col-sm-2 bolder well well-sm">18</div>
</div>
<div class="col-sm-3">
	<div class="col-sm-2 bolder well well-sm">6</div>
	<div class="col-sm-2 bolder well well-sm">9</div>
	<div class="col-sm-2 bolder well well-sm">12</div>
	<div class="col-sm-2 bolder well well-sm">14</div>
	<div class="col-sm-2 bolder well well-sm">16</div>
	<div class="col-sm-2 bolder well well-sm">18</div>
</div>
<div class="col-sm-2m">&nbsp;</div>
<div class="col-sm-2m">&nbsp;</div>
<div class="col-sm-1"></div> 
<div class="clearfix"></div>
<?php foreach($mcnamara as $m) : ?>
	<?php $val = $mortodon->selectMcnamaraPaciente($m->mcnaide,$cedrif) ?>
	<form action="" class="">
		<div class="form-group col-sm-1 bolder ">
			<?php echo $m->mcnaedad ?>
		</div>
		<div class="form-group col-sm-3 bolder">
			<div class="col-sm-2"><?php echo $m->mcnam6 ?></div>
			<div class="col-sm-2"><?php echo $m->mcnam9 ?></div>
			<div class="col-sm-2"><?php echo $m->mcnam12 ?></div>
			<div class="col-sm-2"><?php echo $m->mcnam14 ?></div>
			<div class="col-sm-2"><?php echo $m->mcnam16 ?></div>
			<div class="col-sm-2"><?php echo $m->mcnam18 ?></div>
		</div>
		<div class="form-group col-sm-3 bolder">
			<div class="col-sm-2"><?php echo $m->mcnah6 ?></div>
			<div class="col-sm-2"><?php echo $m->mcnah9 ?></div>
			<div class="col-sm-2"><?php echo $m->mcnah12 ?></div>
			<div class="col-sm-2"><?php echo $m->mcnah14 ?></div>
			<div class="col-sm-2"><?php echo $m->mcnah16 ?></div>
			<div class="col-sm-2"><?php echo $m->mcnah18 ?></div>
		</div>
		<div class="form-group col-sm-2">
			<input type="text" class="form-control" name="normal" value="<?php echo (count($val)>0) ? $val[0]->mcpavalor : null ?>">
		</div>
		<div class="form-group col-sm-2">
			<input type="text" class="form-control" name="diagno" value="<?php echo (count($val)>0) ? $val[0]->mcpadiagno : null ?>">
		</div>
		<div class="form-group col-sm-1">
			<button class="btn btn-primary mcnamarabtn" type="submit">
				<i class="fa fa-check"></i>
			</button>
		</div>
		<input type="hidden" name="mcnaide" value="<?php echo $m->mcnaide ?>">
		<input type="hidden" name="cedrif" value="<?php echo $cedrif ?>">
	</form>
	<div class="clearfix"></div>
<?php endforeach; ?>
<div class="clearfix"></div>