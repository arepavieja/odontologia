<?php

require '../../../cfg/base.php';
require_once("../../../lib/dompdf/dompdf_config.inc.php");
/**
 * Datos del paciente
 * @var [type]
 */
$dp = $mhistoria->datosPersonalesSelect($_GET['cedrif']);
/**
 * Datos de Examenes
 * @var [type]
 */
$rows_hist = $mexamen->examenSelectCedrifstatus($_GET['cedrif']);


$cabecera = ''.
'<div class="logo_reporte"> <img src="../../../img/logo.jpg" alt="" align="left"> </div>'.
'<div class="fecha"> FECHA:'.date("d-m-Y").'</div>'.
'<table class="tabla1">'.
  '<tr>'.
    '<td><span class="titulo_segundario">NOMBRE:</span>'.$dp[0]->pacien_nomraz.'</td>'.
    '<td><span class="titulo_segundario">C&Eacute;DULA:</span>'.$dp[0]->pacien_cedrif.'</td>'.
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
'<title>Examenes</title>'.
  '<div id="contenido">'.
  ''.$cabecera.'';

$html .= ''.
'<h1><span class="titulo">EXAMEN CLINICO O VALORACION CLINICA </span></h1>'.
'<table class="tabla2">'.
	'<tr>'.
		'<th>FECHA</th>'.
		'<th>DESCRIPCI&Oacute;N</th>'.
	'</tr>';
		if(count($rows_hist)>0) {
			foreach($rows_hist as $r) {
			$date = date_create($r->exam_fec);
            $date2=date_format($date, 'd-m-Y');	
$html .=	''.		
				'<tr>'.
					'<td width="65">'.$date2.'</td>'.
					'<td>'.$r->exam_des.'</td>'.
				'</tr>';
			}
		} else {
$html .=	''.
			'<tr>'.
				'<td colspan="2">No hay ex&aacute;menes pendientes por Realizar</td>'.
			'</tr>';
		}
$html .=	''.
'</table>';

$dompdf = new DOMPDF();
$dompdf->set_paper("letter","portrait"); 
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("examenes_".$dp[0]->pacien_cedrif.".pdf");

?>