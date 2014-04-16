
<?php 
require '../../../cfg/base.php';
?>
<script>
	load('app/recipes/vistas/recipe.lista.php','cedrif=<?php echo $cedrif ?>','#recipes-lista')
	$(function(){
		$('.recipe-insert').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				recipe: {
					required: true
				},
				indicacion: {
					required: true
				}
			},
			messages: {
				recipe: {
					required: 'Debe indicar el examen'
				},
				indicacion: {
					required: 'Debe escribir la indicación'
				}
			},
			invalidHandler: function (event, validator) { 
				$('.alert-danger', $('.recipe-insert')).show();
			},			
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
			submitHandler: function (form) {
				$.post('app/recipes/procesos/p.recipe.insert.php',$('.recipe-insert').serialize(),function(data){
					if(data==1) {
						load('app/recipes/vistas/recipe.lista.php','cedrif=<?php echo $cedrif ?>','#recipes-lista');
						$('.recipe-insert').each(function(){
							this.reset();
						})
					} else {
						alerta('.msj_1','danger',data);
					}
				})
			},
			invalidHandler: function (form) {
			}
		})
	})
</script>
<div class="col-sm-4">
	<div class="msj_1"></div>
	<form action="" class="clearfix well recipe-insert">
		<div class="form-group">
			<label for="" class="control-label col-sm-12 bolder">
				Medicamento:
			</label>
			<div class="col-sm-12">
				<input type="text" class="col-sm-12 form-control" name="recipe">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-12 bolder">
				Indicación:
			</label>
			<div class="col-sm-12">
				<textarea name="indicacion" class="col-sm-12" rows="10" style="resize:none"></textarea>
			</div>
		</div>
			<div class="clearfix"></div>
			<div class="space-10"></div>
			<div class="col-sm-8 col-md-offset-2">
				<button class="btn btn-primary">
					<i class="icon icon-ok"></i>
				</button>
			    <?php echo "|"; ?>
			     <button type="button" class="btn btn-primary" onclick="window.open('recipes-<?php echo $cedrif ?>')" class="btn btn-minier btn-white">Imprimir
				</button>

			</div>
		<input type="hidden" name="cedrif" value="<?php echo $cedrif ?>">
	</form>
</div>
<div class="col-sm-8" id="recipes-lista">
	
</div>
<div class="clearfix"></div>