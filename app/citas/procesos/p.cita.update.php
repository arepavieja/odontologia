<?php 
require '../../../cfg/base.php';
$res = $ccitas->validaCalendarioAll();
if($res==1) {
	echo $mcitas->citaUpdate();
} else {
	foreach($res as $r) {
		echo ($r!=1) ? $r."\n" : null;
	}
}
?>