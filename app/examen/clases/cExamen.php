<?php 
class cExamen extends mExamen {
	function estatusExamen($val) {
		$rt = ($val==1) ? 'Realizado' : 'Pendiente';
		return $rt;
	}
	function estatusExamenNum($val) {
		$rt = ($val==1) ? 0 : 1;
		return $rt;
	}
}
?>