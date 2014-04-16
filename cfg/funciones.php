<?php 
class Funciones {

	function up() {
		$var = '<a id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse" href="#">';
		$var .= '<i class="icon-double-angle-up icon-only bigger-110"></i>';
		$var .= '</a>';
		return $var;
	}

	function navGeneral() {
		$var = '<div class="btn-group">'
						.'<button class="btn btn-xs btn-light dropdown-toggle" data-toggle="dropdown">'
						.'<span class="icon-caret-down icon-only smaller-90"></span>'
						.'</button>'
						.'<ul class="dropdown-menu dropdown-purple">'
						.'<li><a href="#breadcrumbs"><i class="icon-home"></i> Inicio</a></li>'
						.'<li><a href="#datos-personales"><i class="fa fa-user"></i> Datos Personales</a></li>'
						.'<li><a href="#datos-pariente"><i class="icon-group"></i> Datos Pariente</a></li>'
						.'<li><a href="#motivo-consulta"><i class="fa fa-plus-square"></i> Motivo Consulta</a></li>'
						.'<li><a href="#historia-dental"><i class="fa fa-th-large"></i> Historia Dental</a></li>'
						.'<li><a href="#examen-intraoral"><i class="fa fa-hospital-o"></i> Examen Intraoral</a></li>'
						.'<li><a href="#plan-tratamiento"><i class="fa fa-copy"></i> Diagnóstico y Plan</a></li>'
						.'<li><a href="#odontograma"><i class="fa fa-table"></i> Odontograma</a></li>'
						.'</ul>'
						.'</div>';
		return $var;
	}

	function navOrtodoncia() {
		$var = '<div class="btn-group">'
						.'<button class="btn btn-xs btn-light dropdown-toggle" data-toggle="dropdown">'
						.'<span class="icon-caret-down icon-only smaller-90"></span>'
						.'</button>'
						.'<ul class="dropdown-menu dropdown-purple">'
						.'<li><a href="#breadcrumbs"><i class="icon-home"></i> Inicio</a></li>'
						.'<li><a href="#datos-personales"><i class="fa fa-user"></i> Datos Personales</a></li>'
						.'<li><a href="#datos-pariente"><i class="icon-group"></i> Datos Pariente</a></li>'
						.'<li><a href="#motivo-consulta"><i class="fa fa-plus-square"></i> Motivo Consulta</a></li>'
						.'<li><a href="#examen-extraoral"><i class="fa fa-hospital-o"></i> Examen Extraoral</a></li>'
						.'<li><a href="#examen-intraoral"><i class="fa fa-th-large"></i> Examen Intraoral</a></li>'
						.'<li><a href="#plan-tratamiento"><i class="fa fa-copy"></i> Diagnóstico y Plan</a></li>'
						.'<li><a href="#cefalometria"><i class="fa fa-columns"></i> Examen Cefalométrico</a></li>'
						.'<li><a href="#odontograma"><i class="fa fa-table"></i> Odontograma</a></li>'
						.'</ul>'
						.'</div>';
		return $var;
	}

	function selectNav($var) {
		if($var==2) {
			$rt = $this->navOrtodoncia();
		} else {
			$rt = $this->navGeneral();
		}
		return $rt;
	}

	function collapseWidget($valor) {
		$var = '<a data-action="collapse" href="#" class="cerrardefecto'.$valor.'">'
					.'<i class="icon-chevron-up"></i>'
					.'</a>';
		return $var;
	}

	function reloadWidget($param_url,$param_data,$param_capa) {
		$url  = "'".$param_url."'";
		$data = "'".$param_data."'";
		$capa = "'".$param_capa."'";
		$var 	= '<a data-action="reload" href="#" onclick="load('.$url.','.$data.','.$capa.')">'
						.'<i class="icon-refresh"></i>'
						.'</a>';
		return $var;
	}

	function modalHeader($title) {
		$var = '<div class="modal-header">'
					.'<button class="bootbox-close-button close" type="button" data-dismiss="modal">×</button>' 
					.'<h4 class="modal-title">'.$title.'</h4>'
					.'</div>';
		return $var;
	}
	function modalFooter($txtboton,$classboton) {
		$var = '<div class="modal-footer">'
				.'<button class="btn btn-default cerrarmodal" data-dismiss="modal" type="button" data-bb-handler="cancel">Cancelar</button>'
				.'<button class="btn btn-primary '.$classboton.'" type="button" data-bb-handler="confirm">'.$txtboton.'</button>'
				.'</div>';
		return $var;
	}

	function checked($val_1,$val_2) {
		$rt = (!strcmp($val_1,$val_2)) ? 'checked' : null;
		return $rt;
	}
	
	function selected($val_1,$val_2) {
		$rt = (!strcmp($val_1,$val_2)) ? 'selected' : null;
		return $rt;
	}

	function valueCampo() {

	}

	function fecha($fecha) {
		$fecha_1 = explode('-',$fecha);
		$rt = $fecha_1[2].'-'.$fecha_1[1].'-'.$fecha_1[0];
		return $rt;
	}

	function widthModal($ancho) {
		$modal = "<style>" 
							."@media screen and (min-width: 768px) {"
				  			.".modal-dialog {"
				    			."width: ".$ancho."%;"
	  						."}"
	  					."}"
	  				."</style>";
	  return $modal;
	}

}
?>