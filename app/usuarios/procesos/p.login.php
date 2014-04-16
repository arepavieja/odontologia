<?php 
require '../../../cfg/base.php';
$res = $musuarios->iniciarSesion();
if(count($res)>0) {
	$_SESSION = array(
			'usr'=>$res[0]->usuario_codigo,
			'niv'=>$res[0]->nivusuario_codigo,
			'nom'=>$res[0]->usuario_login
		);
	echo 1;
} else {
	echo 'Usuario o clave no váldos';
}
?>