<script>
	load('app/diagnos/vistas/diagnos.lista.php','','.lista-diagnosticos')
	$(function(){
		$('.colorpicker0').colorpicker();
		$('.guardar-diagnos').submit(function(e){
			e.preventDefault();
			$.post('app/diagnos/procesos/p.diagnos.insert.php',$(this).serialize(),function(data){
					if(data==1) {
						alerta('.mensaje','success','Registro guardado correctamente');
						load('app/diagnos/vistas/diagnos.lista.php','','.lista-diagnosticos');
						$('.guardar-diagnos').each(function(){
							this.reset();
						})
					} else {
						alerta('.mensaje','danger',data);
					}
			})
		})
	})
</script>
<!-- HTML ################################## -->
<div id="breadcrumbs" class="breadcrumbs">
	<script type="text/javascript">
	try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
	</script>
	<ul class="breadcrumb">
		<li><i class="icon-home home-icon"></i> <a href="">Inicio</a></li>
		<li class="active"><i class="fa fa-cogs"></i> <a href="">Configuración</a></li>
		<li class="active"> Diagnósticos</li>
	</ul>
</div>
<div class="cleafix"></div>
<div class="space-10"></div>
<div class="col-xs-4 well">
	<div class="mensaje"></div>
	<form action="" class="guardar-diagnos" role="form">
		<div class="form-group">
			<label for="" class="control-label col-xs-12 bolder">Descripción</label>
			<div class="col-xs-12">
				<input type="text" name="des" class="col-xs-12">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-xs-12 bolder">Color</label>
			<div class="col-xs-12">
				<div  class="bootstrap-colorpicker">
					<input id="" name="col" type="text" class="col-xs-12 colorpicker0">
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class=" clearfix form-actions">
			<div class="col-xs-12">
				<button class="btn btn-primary btn-block"><i class="icon-ok bigger-110"></i> Guardar Cambios</button>
			</div>
		</div>
	</form>
</div>

<div class="col-xs-8 lista-diagnosticos">
	
</div>
<div class="clearfix"></div>