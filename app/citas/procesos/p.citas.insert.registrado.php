<?php 
require '../../../cfg/base.php';
$res = $ccitas->validaCalendarioAll();
if($res==1) {
	echo $mcitas->citaRegistrado();
} else {
	foreach($res as $r) {
		echo ($r!=1) ? $r."\n" : null;
	}
}
?>