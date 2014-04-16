<script>
	$(function(){
		load('app/historia/vistas/datos.personales.php','nav=2&cedrif='+cedrif,'#datos-personales')
		load('app/historia/vistas/datos.pariente.php','nav=2&cedrif='+cedrif,'#datos-pariente')
		load('app/ortodon/vistas/motivo.consulta.php','cedrif='+cedrif,'#motivo-consulta')
		load('app/ortodon/vistas/examen.extraoral.php','cedrif='+cedrif,'#examen-extraoral')
		load('app/ortodon/vistas/examen.intraoral.php','cedrif='+cedrif,'#examen-intraoral')
		load('app/general/vistas/plan.tratamiento.php','nav=2&cedrif='+cedrif,'#plan-tratamiento')
		load('app/ortodon/vistas/cefalometria.php','cedrif='+cedrif,'#cefalometria')
		load('app/odonto/vistas/odontograma.php','nav=2&cedrif='+cedrif,'#odontograma')
		$('.nav-paciente button').click(function(){
			$('.modulos').removeClass('btn-success');
			$('.modulos').addClass('btn-purple');
			$(this).removeClass('btn-purple')
			$(this).addClass('btn-success');
		})
	})	
</script>
<div class="pull-left">
	<div class="btn-group nav-paciente">
		<button class="btn btn-sm btn-inverse dropdown-toggle" data-toggle="dropdown">Navegación
			<span class="icon-caret-down icon-only smaller-90"></span>
		</button>
		<ul class="dropdown-menu dropdown-purple">
			<li><a href="#datos-personales"><i class="fa fa-user"></i> Datos Personales</a></li>
			<li><a href="#datos-pariente"><i class="icon-group"></i> Datos Pariente</a></li>
			<li><a href="#motivo-consulta"><i class="fa fa-plus-square"></i> Motivo Consulta y Anamnesis</a></li>
			<li><a href="#examen-extraoral"><i class="fa fa-hospital-o"></i> Examen Extraoral</a></li>
			<li><a href="#examen-intraoral"><i class="fa fa-th-large"></i> Examen Intraoral</a></li>
			<li><a href="#plan-tratamiento"><i class="fa fa-th-large"></i> Diagnóstico y Plan</a></li>
			<li><a href="#cefalometria"><i class="fa fa-copy"></i> Examen Cefalométrico</a></li>
			<li><a href="#odontograma"><i class="fa fa-table"></i> Odontograma</a></li>
		</ul>
	</div>
</div>
<div class="clearfix"></div>
<div id="datos-personales"></div>
<div id="datos-pariente"></div>
<div id="motivo-consulta"></div>
<div id="examen-extraoral"></div>
<div id="examen-intraoral"></div>
<div id="plan-tratamiento"></div>
<div id="cefalometria"></div>
<div id="odontograma"  style="min-height:600px"></div>