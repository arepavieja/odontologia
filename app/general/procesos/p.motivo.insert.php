<?php 
require '../../../cfg/base.php';
$res = 1;
if($res==1) {
	echo $mgeneral->motivoConsultaUpdate();
} else {
	foreach($res as $r) {
		echo $r.'<br>';
	}
}
?>