<?php 
require '../../../cfg/base.php';
?>
<script>
	$(function(){
		$('.chosen-select').chosen({no_results_text: "No hay resultados"});
		/**
	 * Click en el botón Ok, se usa para enviar un rango de dientes
	 */
		$('#ok-multiple').on('click',function(){
			var diagnostico = $('#diagnostico-value').val();
			var clase       = '';
			var numerosplit = $('#dienteinicial').val().split('-');
			var numero      = numerosplit[2];
			var finsplit    = $('#dientefinal').val().split('-');
			var fin         = finsplit[2];
			var paciente    = $('#cedrif-paciente').val();
			var tipo 				= $('#otrolugar').val();
			var datos       = 'numero='+numero+'&clase='+clase+'&diagnostico='+diagnostico+'&fin='+fin+'&paciente='+paciente+'&tipo='+tipo;
			if(diagnostico!="") {
				$.post('app/odonto/procesos/p.insert.diagnostico.php',datos,function(data){
					if(data==1) {
						load('app/odonto/vistas/odonto.insert.php','cedrif='+paciente,'#odontoinsert');
						load('app/odonto/vistas/marcar.diagnostico.php','cedrif='+paciente,'.marcar-diagnostico')
					} else {
						alert(data);
					}
				})
			} else {
				alert('Debe seleccionar un diagnóstico')
			}
		})
	})
</script>
<div class="form-group col-sm-5">
	<div class="col-sm-12">
		<select data-placeholder="Indique diente final" class="chosen-select final form-control" style="width:100%" id="dientefinal">
			<?php echo $codonto->dienteFinal($dienteinicial) ?>
		</select>
	</div>
</div>
<div class="form-group col-sm-2">
	<button class="btn btn-primary" type="button" id="ok-multiple"><i class="fa fa-check"></i></button>
</div>