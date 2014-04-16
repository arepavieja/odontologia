<?php 
require '../../../cfg/base.php';
$res = 1;
if($res==1) {
	echo $modonto->guardarEvolucion();
} else {
	foreach($res as $r) {
		echo $r."\n";
	}
}
?>