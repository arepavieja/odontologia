<?php 
require '../../../cfg/base.php';
$reg = $mcorreo->enviarRango();
echo '<h3 class="alert alert-success"><i class="fa fa-check fa-lg green"></i> Enviados Correctamente</h3>';
if (is_array($reg['bien']) and count($reg['bien'])>1) {
	echo '<ul class="list-inline">';
	foreach($reg['bien'] as $b) {
		echo '<li>'.$b.'</li>';
	}
	echo '</ul>';
} else {
	echo 'No se ha enviados ningún mensaje';
}
echo '<h3  class="alert alert-danger"><i class="fa fa-times fa-lg red"></i> No enviados</h3>';
if (is_array($reg['mal']) and count($reg['mal'])>1) {
	echo '<ul class="list-inline">';
	foreach($reg['mal'] as $b) {
		echo '<li>'.$b.'</li>';
	}
	echo '</ul>';
} else {
	echo 'No hay problema, todos los correos fueron enviados';
}
echo '<h3 class="alert alert-warning"><i class="fa fa-exclamation fa-lg orange"></i> Personas sin correo</h3>';
if (is_array($reg['sin']) and count($reg['sin'])>1) {
	echo '<ul class="list-inline">';
	foreach($reg['sin'] as $b) {
		echo '<li>'.$b.'</li>';
	}
	echo '</ul>';
} else {
	echo 'No hay problema, todos los destinatarios tiene cuenta de correo.';
}
?>