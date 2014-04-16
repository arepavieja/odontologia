<?php 
require '../../../cfg/base.php';
$steiner = $mortodon->steiner();
?>
<script>
	$(function(){
		$('.steinerbtn').on('click',function(e){
			e.preventDefault();
			datos = $(this).parent().parent().serialize();
			$.post('app/ortodon/procesos/p.steiner.insert.php',datos)
		})
	})
</script>
<h3 class="header smaller lighter green">Steiner</h3>
<div class="col-sm-3 bolder well well-sm">Medida</div>
<div class="col-sm-2 bolder well well-sm">Normal</div>
<div class="col-sm-3 bolder well well-sm">Paciente</div>
<div class="col-sm-3 bolder well well-sm">Diagnóstico</div>
<div class="col-sm-1"></div>
<div class="clearfix"></div>
	<?php foreach($steiner as $s) : ?>
		<?php $val = $mortodon->selectSteinerPaciente($s->steiide,$cedrif) ?>
		<form action="" class="steiner">
			<div class="form-group col-sm-3 bolder ">
				<?php echo $s->steimedida ?>
			</div>
			<div class="form-group col-sm-2 bolder">
				<?php echo $s->steinormal ?>
			</div>
			<div class="form-group col-sm-3">
				<input type="text" class="form-control" name="normal" value="<?php echo (count($val)>0) ? $val[0]->stpavalor : null ?>">
			</div>
			<div class="form-group col-sm-3">
				<input type="text" class="form-control" name="diagno" value="<?php echo (count($val)>0) ? $val[0]->stpadiagno : null ?>">
			</div>
			<div class="form-group col-sm-1">
				<button class="btn btn-primary steinerbtn" type="submit">
					<i class="fa fa-check"></i>
				</button>
			</div>
			<input type="hidden" name="steiide" value="<?php echo $s->steiide ?>">
			<input type="hidden" name="cedrif" value="<?php echo $cedrif ?>">
		</form>
		<div class="clearfix"></div>
	<?php endforeach; ?>
<div class="clearfix"></div>