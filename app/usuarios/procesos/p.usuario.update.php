<?php 
require '../../../cfg/base.php';
#$res = 1;
$res = $cusuarios->valUpdateUsuario();
if($res==1) {
	echo $musuarios->usuarioUpdate();
} else {
	foreach($res as $r) {
		echo ($r!=1) ? $r.'<br>' : null;
	}
}
?>