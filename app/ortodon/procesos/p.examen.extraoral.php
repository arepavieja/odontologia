<?php 
require '../../../cfg/base.php';
$res = 1;
if($res==1) {
	echo $mortodon->examenExtraoralUpdate();
} else {
	foreach($res as $r) {
		echo $r.'<br>';
	}
}
?>