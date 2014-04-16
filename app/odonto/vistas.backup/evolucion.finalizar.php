<?php 
require '../../../cfg/base.php';
?>
<script>
	$(function(){
		$('.terminar-procedimiento').submit(function(e){
			e.preventDefault();
			$.post('app/odonto/procesos/p.procedimiento.finalizar.php',$(this).serialize(),function(data){
				$('.msj-finalizar').fadeOut(1);
				alert('El procedimiento ha sido finalizado');
				load('app/odonto/vistas/procedimientos.php','cedrif=<?php echo $cedrif ?>&des=<?php echo $des; ?>&diagno=<?php echo $diagno ?>','#procedimientos');
				$('.cerrarmodal').click();
			})
		})
	})
</script>
<div class="space-20"></div>
<div class="alert alert-danger text-center msj-finalizar">
	¿Realmente desea finalizar el procedimiento <?php echo $des ?>?
</div>
<form action="" class="terminar-procedimiento">
	<button class="btn btn-primary pull-right">Si, finalizar procedimiento</button>
	<input type="hidden" name="trat_ide" value="<?php echo $trat_ide ?>">
</form>
<div class="clearfix"></div>