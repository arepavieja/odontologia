<?php 
require '../../../cfg/base.php';
$res = 1;
if($res==1) {
	echo $modonto->guardarDiagnostico();
} else {
	foreach($res as $r) :
		echo ($r!=1) ? $r."\n" : null;
	endforeach;
}
?>