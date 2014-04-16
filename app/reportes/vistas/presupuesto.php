<?php 
require '../../../cfg/base.php';
require_once("../../../lib/dompdf/dompdf_config.inc.php");
/**
 * Datos del paciente
 * @var [type]
 */
$dp = $mhistoria->datosPersonalesSelect($_GET['cedrif']);
/**
 * Tratamiento ideal
 * @var [type]
 */
$ti = $mreportes->tratIdeal($_GET['cedrif']);
/**
 * Tratamiento Real
 * @var [type]
 */
$tr = $mreportes->tratReal($_GET['cedrif']);
//<img src="../../../img/logo.jpg" alt="" align="left">-->
$cabecera = ''.
'<div class="logo_reporte"> <img src="../../../img/logo.jpg" alt="" align="left"> </div>'.
'<div class="fecha"><span class="titulo_segundario">FECHA DEL PRESUPUESTO:'.date("d-m-Y").'</span> </<div>'.
'<table class="tabla1">'.
  '<tr>'.
    '<td><span class="titulo_segundario">CEDULA:</span>'.$dp[0]->pacien_cedrif.'</td>'.
    '<td><span class="titulo_segundario">NOMBRE y APELLIDO:</span>'.$dp[0]->pacien_nomraz.'</td>'.
  '</tr>'.
  '<tr>'.
    '<td><span class="titulo_segundario">DIRECCI&Oacute;N:</span>'.$dp[0]->pacien_domicasa.'</td>'.
    '<td><span class="titulo_segundario">TEL&Eacute;FONO:</span>'.$dp[0]->pacien_movil1tlf.'</td>'.
  '</tr>'.
'</table>';

$pie = ''.


$html = ''.
'<meta charset="utf-8">'.
'<link href="../../../css/print.css" type="text/css" rel="stylesheet">'.
'<title>Presupuesto</title>'.
  '<div id="contenido">'.
  ''.$cabecera.''.
  '<h1><span class="titulo">Presupuesto Tratamiento Ideal</span> </h1>'.
  '<table class="tabla2">'.
    '<tr>'.
      '<th><span class="titulo_segundario">PROCEDIMIENTO</span></th>'.
      '<th><span class="titulo_segundario">PIEZAS</span></th>'.
      '<th><span class="titulo_segundario">CANTIDAD</span></th>'.
      '<th><span class="titulo_segundario">PRECIO UNIT.</span></th>'.
      '<th><span class="titulo_segundario">TOTAL Bs.</span></th>'.
    '</tr>';
    foreach($ti as $ir) {
      $nro_proce=$ir->proced_ide;

      if ($nro_proce=='75'){
                $cant_proce='24';
                $prec_unit=$ir->precio/24;
                $prec_total=$ir->precio;
        
          }else{
                $cant_proce='1';
                $prec_unit=$ir->precio;   
                $prec_total=$ir->precio;
          }

      $html .= ''.
      '<tr>'.
        '<td>'.$ir->descrip_procedi.'</td>'.
        '<td>'.$ir->diente.'-'.$ir->parte_diente.'</td>'.
        '<td>'.$cant_proce.'</td>'.
        '<td>'.$prec_unit.'</td>'.
        '<td>'.$prec_total.'</td>'.
      '</tr>';
    }
$html .= ''.
    '<tr>'.
      '<th colspan="4" class="izq"><span class="titulo_segundario">TOTAL PRESUPUESTO TRATAMIENTO IDEAL Bs.</span></th>'.
      '<td>'.$mreportes->totalTratamientoIdeal($_GET['cedrif']).'</td>'.
    '</tr>'.        
  '</table>'.
  '<div class="salto"></div>'. #Salto de página
  ''.$cabecera.''.
  '<h1><span class="titulo">Presupuesto Tratamiento Real</span></h1>'.
  '<table class="tabla2">'.
    '<tr>'.
      '<th><span class="titulo_segundario">PROCEDIMIENTO</span></th>'.
      '<th><span class="titulo_segundario">PIEZAS</span></th>'.
      '<th><span class="titulo_segundario">CANTIDAD</span></th>'.
      '<th><span class="titulo_segundario">PRECIO UNIT.</span></th>'.
      '<th><span class="titulo_segundario">TOTAL Bs.</span></th>'.
    '</tr>';
    foreach($tr as $tr2) {
      $nro_proce=$tr2->proced_ide;
          
          if ($nro_proce=='75'){
                $cant_proce='24';
                $prec_unit=$tr2->precio/24;
                $prec_total=$tr2->precio;
        
          }else{
                $cant_proce='1';
                $prec_unit=$tr2->precio;   
                $prec_total=$tr2->precio;
          }

      $html .= ''.
     '<tr>'.
        '<td>'.$tr2->descrip_procedi.'</td>'.
        '<td>'.$tr2->diente.'-'.$ir->parte_diente.'</td>'.
        '<td>'.$cant_proce.'</td>'.
        '<td>'.$prec_unit.'</td>'.
        '<td>'.$prec_total.'</td>'.
      '</tr>';
    }
$html .= ''.
    '<tr>'.
      '<th colspan="4" class="izq"><span class="titulo_segundario">TOTAL PRESUPUESTO TRATAMIENTO REAL Bs.</span></th>'.
      '<td>'.$mreportes->totalTratamientoReal($_GET['cedrif']).'</td>'.
    '</tr>'. 
  '</table>'.
'</div>'; #Fin contenido
//echo $html;
$dompdf = new DOMPDF();
$dompdf->set_paper("letter","portrait"); 
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("presupuesto_".$dp[0]->pers_cedrif.".pdf");
?>