<?php 
require '../../../cfg/base.php';
$res = $cdiagnos->diagnoInsert();
if($res==1) {
	echo $mdiagnos->diagnoInsert();
} else {
	foreach($res as $r) {
		echo $r.'<br>';
	}
}
?>