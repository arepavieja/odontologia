<?php 
require '../../../cfg/base.php';
$res = $cproced->procedInsert();
if($res==1) {
	echo $mproced->procedInsert();
} else {
	foreach($res as $r) {
		echo $r.'<br>';
	}
}
?>