<?php 
require '../../../cfg/base.php';
$res = $codonto->verificarDiagnostico();
if($res==1) {
	echo $modonto->dienteTodoInsert();
} else {
	foreach($res as $r) {
		echo $r."\n";
	}
}
?>