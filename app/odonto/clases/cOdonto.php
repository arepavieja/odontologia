<?php 
class cOdonto extends mOdonto {
	
	function validarDiagnostico($var_1) {
		if(empty($var_1)) {
			$rt = "Seleccione un diagnóstico para continuar";
		} else {
			$rt = 1;
		}
		return $rt;
	}

	function verificarDiagnostico() {
		$a = $this->validarDiagnostico($this->diagno);
		$a1 = ($a==1) ? 1 : $this->msj[] = $a;
		$rt = ($a1==1) ? 1 : $this->msj;
		return $rt;
	}

	function verificarProcedimiento() {
		$sql = "SELECT * FROM tbl_tratamiento WHERE diagcons_ide=? AND proced_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->diagcons);
		$res->bindParam(2,$this->diagproced);
		$res->execute();
		if($res->rowCount()>0) {
			$rt[] = 'Procedimiento ya asignado';
		} else {
			$rt = 1;
		}
		return $rt;
	}

	function estadoProcedimiento($var_1) {
		$valores = array(
				1=>'Ideal',
				2=>'<span class="text-info">Real</span>',
				3=>'<span class="text-success">Proc.</span>',
				4=>'<span class="text-error">Term.</span>'
			);

		return $valores[$var_1];
	}

	function estadoValor($var_1) {
		$rt = ($var_1==1) ? 2 : 1;
		return $rt;
	}

	function condicionProced($var_1,$var_2) {
		if($var_1==1) {
			$rt = 'N/A';
		} else {
			if($var_2==0) {
				$rt = '<span class="text-success">Proc.</span>';
			} else {
				$rt = '<span class="text-success">Term.</span>';
			}
		}
		return $rt;
	}

	/**
	 * Punto de Inflexión
	 */
	function dientes($cuadrante,$condicion,$inicial,$final) {
		$rt = 0;
		for($x=$inicial;$x<=$final;$x++) {
			$rt .= '<option value="'.$cuadrante.'-'.$condicion.'-'.$x.'">'.$x.'</option>';
		}	
		return $rt;
	}
	
	function dientesBack($cuadrante,$condicion,$inicial,$final) {
		$rt = 0;
		for($x=$inicial;$x>=$final;$x--) {
			$rt .= '<option value="'.$cuadrante.'-'.$condicion.'-'.$x.'">'.$x.'</option>';
		}	
		return $rt;
	}

	function dienteFinal($valores) {
		$expl = explode('-', $valores);
		$cua = $expl[0];
		$con = $expl[1];
		if ($cua==1 and $con==1) :
			$die = $expl[2]-1;
			$rt .= '<optgroup label="Cuadrante 1 (Perm)">';
			$rt .= $this->dientesBack(1,1,$die,11);
			$rt .= '</optgroup>';
			$rt .= '<optgroup label="Cuadrante 2 (Perm)">';
			$rt .= $this->dientes(2,1,21,28);
			$rt .= '</optgroup>';
		elseif ($cua==1 and $con==2) :
			$die = $expl[2]-1;
			$rt .= '<optgroup label="Cuadrante 1 (Temp)">';
			$rt .= $this->dientesBack(1,2,$die,51);
			$rt .= '</optgroup>';
			$rt .= '<optgroup label="Cuadrante 2 (Temp)">';
			$rt .= $this->dientes(2,2,61,65);
			$rt .= '</optgroup>';
		elseif ($cua==2 and $con==1) :
			$die = $expl[2]+1;
			$rt .= '<optgroup label="Cuadrante 2 (Perm)">';
			$rt .= $this->dientes(2,1,$die,28);
			$rt .= '</optgroup>';
		elseif ($cua==2 and $con==2) :
			$die = $expl[2]+1;
			$rt .= '<optgroup label="Cuadrante 2 (Temp)">';
			$rt .= $this->dientes(2,2,$die,65);
			$rt .= '</optgroup>';
		elseif ($cua==3 and $con==1) :
			$die = $expl[2]+1;
			$rt .= '<optgroup label="Cuadrante 3 (Perm)">';
			$rt .= $this->dientes(1,1,$die,38);
			$rt .= '</optgroup>';
		elseif ($cua==3 and $con==2) :
			$die = $expl[2]+1;
			$rt .= '<optgroup label="Cuadrante 3 (Temp)">';
			$rt .= $this->dientes(3,2,$die,75);
			$rt .= '</optgroup>';
		elseif ($cua==4 and $con==1) :
			$die = $expl[2]-1;
			$rt .= '<optgroup label="Cuadrante 4 (Perm)">';
			$rt .= $this->dientesBack(4,1,$die,41);
			$rt .= '</optgroup>';
			$rt .= '<optgroup label="Cuadrante 3 (Perm)">';
			$rt .= $this->dientes(1,1,31,38);
			$rt .= '</optgroup>';
		elseif ($cua==4 and $con==2) :
			$die = $expl[2]-1;
			$rt .= '<optgroup label="Cuadrante 4 (Temp)">';
			$rt .= $this->dientesBack(4,2,$die,81);
			$rt .= '</optgroup>';
			$rt .= '<optgroup label="Cuadrante 3 (Temp)">';
			$rt .= $this->dientes(3,2,71,75);
			$rt .= '</optgroup>';
		else :
			$rt .= 'Opciones no válidas';
		endif;
		return $rt;
	}

	function piezas($inicio,$fin,$parte) {
		$part = substr($parte, 1,2);
		if($inicio==$fin) {
			$rt = $part.'-'.$inicio;
		} else {
			$rt = 'De T-'.$inicio.' a T-'.$fin;
		}
		return $rt;
	}
}
?>