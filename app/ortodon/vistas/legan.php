<?php 
require '../../../cfg/base.php';
$legan = $mortodon->legan();
?>
<script>
	$(function(){
		$('.leganbtn').on('click',function(e){
			e.preventDefault();
			datos = $(this).parent().parent().serialize();
			$.post('app/ortodon/procesos/p.legan.insert.php',datos)
		})
	})
</script>
<h3 class="header smaller lighter green">Legan Blandos</h3>
<div class="col-sm-2 bolder well well-sm">Medida</div>
<div class="col-sm-2 bolder well well-sm">Puntos</div>
<div class="col-sm-1 bolder well well-sm">X</div>
<div class="col-sm-1 bolder well well-sm">SD</div>
<div class="col-sm-2 bolder well well-sm">Valor</div>
<div class="col-sm-3 bolder well well-sm">Diagnóstico</div>
<div class="col-sm-1"></div>
<div class="clearfix"></div>
	<?php foreach($legan as $l) : ?>
		<?php $val = $mortodon->selectLeganPaciente($l->legaide,$cedrif) ?>
		<form action="" class="legan">
			<div class="form-group col-sm-2 bolder ">
				<?php echo $l->legamedida ?>
			</div>
			<div class="form-group col-sm-2 bolder">
				<?php echo $l->legapuntos ?>
			</div>
			<div class="form-group col-sm-1 bolder">
				<?php echo $l->legax ?>
			</div>
			<div class="form-group col-sm-1 bolder">
				<?php echo $l->legasd ?>
			</div>
			<div class="form-group col-sm-2">
				<input type="text" class="form-control" name="normal" value="<?php echo (count($val)>0) ? $val[0]->lepavalor : null ?>">
			</div>
			<div class="form-group col-sm-3">
				<input type="text" class="form-control" name="diagno" value="<?php echo (count($val)>0) ? $val[0]->lepadiagno : null ?>">
			</div>
			<div class="form-group col-sm-1">
				<button class="btn btn-primary leganbtn" type="submit">
					<i class="fa fa-check"></i>
				</button>
			</div>
			<input type="hidden" name="legaide" value="<?php echo $l->legaide ?>">
			<input type="hidden" name="cedrif" value="<?php echo $cedrif ?>">
		</form>
		<div class="clearfix"></div>
	<?php endforeach; ?>
<div class="clearfix"></div>