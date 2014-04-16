<?php 
require '../../../cfg/base.php';
if(isset($_FILES['file'])){
    $nombre = $_FILES['file']['name'];
    $temp   = $_FILES['file']['tmp_name'];
    $cedula = $_GET['cedrif'];
    $descripcion = "Probando";
    $res = $mradiogra->guardaRayosX($cedula,$nombre,$descripcion,$temp);
}
?>