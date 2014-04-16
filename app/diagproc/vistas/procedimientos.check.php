<?php 
require '../../../cfg/base.php';
$proced = $mproced->procedSelect();
?>
<script>
	$(function(){
		/**
		 * Marcar o desmarcar todos los checkbox
		 * @return {[boolean]} [Valor del checkbox principal]
		 */
		$('.todos').click(function(){
			marcado = $(this).prop('checked');
			if(marcado==true) {
				$('.check_proced').prop('checked',true);
				$('.valor_procedimiento').val('1');
			} else {
				$('.check_proced').prop('checked',false);
				$('.valor_procedimiento').val('0');
			}
		})
		/**
		 * Marcar el checkbox desde la fila
		 * @return {[boolean]} [valor del checkbox]
		 */
		$('.trcheck').click(function(){
			trmarc = $(this).children().children('.check_proced').prop('checked');
			if(trmarc==false) {
				$(this).children().children('.check_proced').prop('checked',true);
				$(this).children().children('.valor_procedimiento').val('1')
			} else {
				$(this).children().children('.check_proced').prop('checked',false);
				$(this).children().children('.valor_procedimiento').val('0')
			}
		})
		/**
		 * Enviar el formulario
		 * @type {String}
		 */
		$('.diagno-proced').submit(function(e){
			e.preventDefault();
			$.post('app/diagproc/procesos/p.diagnoproced.insert.php',$(this).serialize(),function(data){
				if(data==1) {
					alerta('.msj_1','success','Cambios guardados correctamente');
					setTimeOut($('.form_diagnos').submit(),2000);
				} else {
					alerta('.msj_1','danger',data);
				}
				
			})
		})
	})
</script>
<div class="msj_1"></div>
<form action="" class="diagno-proced">
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr>
				<th><input type="checkbox" class="todos"></th>
				<th>Procedimiento</th>
				<th>Costo</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($proced as $pi=>$p) { ?>
				<?php $check = $mdiagproc->diagProcDiagnos($diagno,$p->proced_ide); ?>
				<tr class="trcheck">
					<td>
						<input type="checkbox" class="check_proced" <?php echo $fun->checked($check,1) ?>>
						<input type="hidden" name="procedimiento<?php echo $pi; ?>" value="<?php echo $p->proced_ide ?>">
						<input type="hidden" name="valor_procedimiento<?php echo $pi; ?>" class="valor_procedimiento" value="<?php echo $check ?>">
					</td>
					<td><?php echo $p->proced_des ?></td>
					<td><?php echo $p->proced_prec ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<div class="clearfix"></div>
	<div class=" clearfix form-actions">
		<div class="col-xs-2 col-md-offset-10">
			<button class="btn btn-primary"><i class="icon-ok bigger-110"></i> Guardar Cambios</button>
		</div>
	</div>
	<input type="hidden" name="total" value="<?php echo count($proced) ?>">
	<input type="hidden" name="diagno" value="<?php echo $diagno ?>">
</form>