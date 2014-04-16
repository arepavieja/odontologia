<?php 
require '../../../cfg/base.php';
if(isset($_FILES['file_evo'])){
  $nombre = $_FILES['file_evo']['name'];
  $temp   = $_FILES['file_evo']['tmp_name'];
  $evol_ide = $_GET['evol_ide'];
  $res = $modonto->guardaFotosEvolucion($evol_ide,$nombre,$temp);
}
?>