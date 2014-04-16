<?php 
require '../../../cfg/base.php';
$tot = $mhistoria->datosPersonalesSelect($cedrif);
echo (count($tot)>0) ? 1 : 0;
?>