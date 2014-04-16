
<?php 
require '../../../cfg/base.php';
?>
<script>
	load('app/examen/vistas/examen.lista.php','cedrif=<?php echo $cedrif ?>','#examanes-lista')
	$(function(){
		$('.examen-insert').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				examen: {
					required: true
				}
			},
			messages: {
				examen: {
					required: 'Debe indicar el examen'
				}
			},
			invalidHandler: function (event, validator) { 
				$('.alert-danger', $('.examen-insert')).show();
			},			
			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},
			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},
			submitHandler: function (form) {
				$.post('app/examen/procesos/p.examen.insert.php',$('.examen-insert').serialize(),function(data){
					if(data==1) {
						load('app/examen/vistas/examen.lista.php','cedrif=<?php echo $cedrif ?>','#examanes-lista');
						$('.examen-insert').each(function(){
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
	<form action="" class="clearfix well examen-insert">
		<div class="form-group">
			<label for="" class="control-label col-sm-12 bolder">
				Descripción:
			</label>
			<div class="col-sm-12">
				<textarea name="examen" class="col-sm-12" rows="10" style="resize:none" maxlength="255" ></textarea>
				<!--<input type="text" class="col-sm-12 form-control" name="examen">-->
			</div>
	
			<div class="clearfix"></div>
			<div class="space-10"></div>
			<div class="col-sm-8 col-md-offset-2">
				<button class="btn btn-primary">
					<i class="icon icon-ok"></i>
				</button>
                 <?php echo "|"; ?>
			     <button type="button" class="btn btn-primary" onclick="window.open('examenes-<?php echo $cedrif ?>')" class="btn btn-minier btn-white">Imprimir
				</button>
			</div>
		</div>
		<input type="hidden" name="cedrif" value="<?php echo $cedrif ?>">
	</form>
</div>
<div class="col-sm-8" id="examanes-lista">
	
</div>
<div class="clearfix"></div>