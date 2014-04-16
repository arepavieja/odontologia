<?php 
require '../../../cfg/base.php';
/**
 * Récipes rows
 * @var array
 */
$rr = $mrecipes->recipeSelectCedrif($cedrif);
?>

<!-- Javascript #######################################-->

<script>
	function borrarRecipe(ide) {
		$.post('app/recipes/procesos/p.recipe.delete.php',ide,function(data){
			if(data==1) {
				load('app/recipes/vistas/recipe.lista.php','cedrif=<?php echo $cedrif ?>','#recipes-lista');
			} else {
				alerta('.msj_2','danger',data);
			}
		})
	}
</script>

<!-- HTML #############################################-->

<div class="msj_2"></div>
<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>Fecha</th>
			<th>Récipe</th>
			<th>Indicación</th>
			<th>Opción</th>
		</tr>
	</thead>
	<tbody>
		<?php if(count($rr)>0) { ?>
			<?php foreach($rr as $r) { ?>
				<tr>
					<td><?php echo $fun->fecha($r->reci_fec); ?></td>
					<td><?php echo $r->reci_med ?></td>
					<td><?php echo $r->reci_ind; ?></td>
					<td>
						<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
							<a class="red" href="#"  onclick="borrarRecipe('reci_ide=<?php echo $r->reci_ide; ?>')">
								<i class="icon-trash bigger-130"></i>
							</a>
						</div>
					</td>
				</tr>
			<?php } ?>
		<?php } else { ?>
			<tr>
				<td colspan="4">No hay récipes registrados</td>
			</tr>
		<?php } ?>
	</tbody>
</table>