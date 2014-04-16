<?php 
require '../../../cfg/base.php';
$res = $codonto->verificarProcedimiento();
if($res==1) {
	echo $modonto->procedimientoInsert();
} else {
	foreach($res as $r) {
		echo ($r!=1) ? $r."\n" : null;
	}
}
?>