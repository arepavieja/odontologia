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
$rows_hist = $mrecipes->recipeSelectCedrif($_GET['cedrif']);

$cabecera = ''.
'<div class="logo_reporte"></div>'.
'<div></<div>'.
'<table class="tabla4">'.
'<tr>'.
   '<td style="width:30%; padding-right:40px">'.

    '<td><span class="titulo"></span></td>'.
    '<td><span class="titulo"></span></td>'.
  '</tr>'.
  '<tr>'.
    '<td><span class="titulo"></span></td>'.
    '<td><span class="titulo"></span></td>'.
  '</tr>'.
'</table>'.
'<table style="width:100%">'.
		'<tr>'.
			'<td style="width:30%; padding-right:40px">'.
				'<table class="tabla3">'.
					'<tr>'.
						 '<td><span class="titulo">Cedula:</span>'.$dp[0]->pacien_cedrif.'</td>'.
					'</tr>'.
					'<tr>'.
                      '<td><span class="titulo">Nombre y Apellido:</span>'.$dp[0]->pacien_nomraz.'</td>'.
                    '</tr>'.
				'</table>'.
			'</td>'.
			'<td style="width:30%; padding-left:40px">'.
				'<table class="tabla3">'.
					'<tr>'.
						 '<td><span class="titulo">Cedula:</span>'.$dp[0]->pacien_cedrif.'</td>'.
					'</tr>'.
					'<tr>'.
                      '<td><span class="titulo">Nombre y Apellido:</span>'.$dp[0]->pacien_nomraz.'</td>'.
                    '</tr>'.
				'</table>'.
			'</td>'.
		'</tr>'.
	'</table>';





$html = ''.
'<meta charset="utf-8">'.
'<link href="../../../css/print.css" type="text/css" rel="stylesheet">'.
'<title>Recipes</title>'.
'<div id="contenido">'.
''.$cabecera.'';

$html .= ''.
	'<table style="width:100%">'.
		'<tr>'.
			'<td style="width:30%; padding-right:40px">'.
				'<table class="tabla3">'.
					'<tr>'.
						'<th></th>'.
						'<th></th>'.
					'</tr>';
					if(count($rows_hist)>0) {
						foreach($rows_hist as $r) {
							$html .= ''.
							'<tr>'.
								'<td>'.$r->reci_fec.'</td>'.
								'<td>'.$r->reci_med.'</td>'.
							'</tr>';
						}
					} else {
						$html .= ''.
						'<tr>'.
							'<td colspan="2">No hay medicamentos asignados</td>'.
						'</tr>';
					}
				$html .= ''.
				'</table>'.
			'</td>'.
			'<td style="width:30%; padding-left:40px">'.
			
				'<table class="tabla3">'.
					'<tr>'.
					    '<th>  </th>'.
						'<th></th>'.
					'</tr>';
					if(count($rows_hist)>0) {
						foreach($rows_hist as $r) {
							$html .= ''.
							'<tr>'.
								'<td style="text-align:left;padding: 0 0 0 10px;">'.$r->reci_ind.'</td>'.
							'</tr>';
						}
					} else {
						$html .= ''.
						'<tr>'.
							'<td colspan="2">No hay medicamentos asignados</td>'.
						'</tr>';
					}
				$html .= ''.
				'</table>'.
			'</td>'.
		'</tr>'.
	'</table>'.
'</div>';

//echo $html;
$dompdf = new DOMPDF();
$dompdf->set_paper("letter","landscape"); 
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("recipes_".$dp[0]->pacien_cedrif.".pdf");

?>