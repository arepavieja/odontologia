<?php 
require '../../../cfg/base.php';
$res = 1;
if($res==1) {
	echo $modonto->updateEvolucion();
} else {
	foreach($res as $r) {
		echo $r."\n";
	}
}
?>