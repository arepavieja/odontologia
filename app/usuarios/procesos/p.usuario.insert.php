<?php 
require '../../../cfg/base.php';
#$res = 1;
$res = $cusuarios->valRegistroUsuario();
if($res==1) {
	echo $musuarios->usuarioInsert();
} else {
	foreach($res as $r) {
		echo ($r!=1) ? $r.'<br>' : null;
	}
}
?>