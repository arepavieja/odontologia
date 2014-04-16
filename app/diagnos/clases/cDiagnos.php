<?php 
class cDiagnos extends mDiagnos {
	
	function desInsert($var) {		
		if(empty($var)) {
			$rt = "Debe indicar la descripción";
		} else {
			if($this->dbh->compara('tbl_diagno','diagno_descrip',$var)>0) {
				$rt = "Diagnóstico ya registrado";
			} else {
				$rt = 1;
			}
		}
		return $rt;
	}
	function colInsert($var) {
		if(empty($var)) {
			$rt = "Debe indicar un color";
		} else {
			if($this->dbh->compara('tbl_diagno','diagno_color',$var)>0) {
				$rt = "Color ya registrado";
			} else {
				$rt = 1;
			}
		}
		return $rt;
	}

	function diagnoInsert() {
		$a = $this->desInsert($this->des);
		$b = $this->colInsert($this->col);
		$aa = ($a==1) ? 1 : $this->msj[] = $a;
		$bb = ($b==1) ? 1 : $this->msj[] = $b;
		$rt = ($aa==1 and $bb==1) ? 1 : $this->msj;
		return $rt;
	}

	function desUpdate($var,$var2) {		
		if(empty($var)) {
			$rt = "Debe indicar la descripción";
		} else {
			if($this->dbh->comparaUpdate('tbl_diagno','diagno_descrip','diagno_codigo',$var,$var2)>0) {
				$rt = "Diagnóstico ya registrado";
			} else {
				$rt = 1;
			}
		}
		return $rt;
	}
	function colUpdate($var,$var2) {
		if(empty($var)) {
			$rt = "Debe indicar un color";
		} else {
			if($this->dbh->comparaUpdate('tbl_diagno','diagno_color','diagno_codigo',$var,$var2)>0) {
				$rt = "Color ya registrado";
			} else {
				$rt = 1;
			}
		}
		return $rt;
	}

	function diagnoUpdate() {
		$a = $this->desUpdate($this->des,$this->ide);
		$b = $this->colUpdate($this->col,$this->ide);
		$aa = ($a==1) ? 1 : $this->msj[] = $a;
		$bb = ($b==1) ? 1 : $this->msj[] = $b;
		$rt = ($aa==1 and $bb==1) ? 1 : $this->msj;
		return $rt;
	}

}
?>