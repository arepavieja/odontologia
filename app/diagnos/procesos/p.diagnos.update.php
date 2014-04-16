<?php 
require '../../../cfg/base.php';
$res = $cdiagnos->diagnoUpdate();
if($res==1) {
	echo $mdiagnos->diagnoUpdate();
} else {
	foreach($res as $r) {
		echo $r.'<br>';
	}
}
?>