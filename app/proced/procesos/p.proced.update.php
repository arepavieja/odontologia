<?php 
require '../../../cfg/base.php';
$res = $cproced->procedUpdate();
if($res==1) {
	echo $mproced->procedUpdate();
} else {
	foreach($res as $r) {
		echo $r.'<br>';
	}
}
?>