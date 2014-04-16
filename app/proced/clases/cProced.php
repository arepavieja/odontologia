<?php 
class cProced extends mProced {
	
	function desInsert($var) {		
		if(empty($var)) {
			$rt = "Debe indicar la descripción";
		} else {
			if($this->dbh->compara('tbl_proced','proced_des',$var)>0) {
				$rt = "Procedimiento ya registrado";
			} else {
				$rt = 1;
			}
		}
		return $rt;
	}
	function preInsert($var) {
		if(empty($var)) {
			$rt = "Debe indicar el costo";
		} else {
			if(!is_numeric($var)) {
				$rt = "El costo debe ser numérico";
			} else {
				$rt = 1;
			}
		}
		return $rt;
	}

	function procedInsert() {
		$a = $this->desInsert($this->des);
		$b = $this->preInsert($this->pre);
		$aa = ($a==1) ? 1 : $this->msj[] = $a;
		$bb = ($b==1) ? 1 : $this->msj[] = $b;
		$rt = ($aa==1 and $bb==1) ? 1 : $this->msj;
		return $rt;
	}

	function desUpdate($var,$var2) {		
		if(empty($var)) {
			$rt = "Debe indicar la descripción";
		} else {
			if($this->dbh->comparaUpdate('tbl_proced','proced_des','proced_ide',$var,$var2)>0) {
				$rt = "Procedimiento ya registrado";
			} else {
				$rt = 1;
			}
		}
		return $rt;
	}

	function procedUpdate() {
		$a = $this->desUpdate($this->des,$this->ide);
		$b = $this->preInsert($this->pre);
		$aa = ($a==1) ? 1 : $this->msj[] = $a;
		$bb = ($b==1) ? 1 : $this->msj[] = $b;
		$rt = ($aa==1 and $bb==1) ? 1 : $this->msj;
		return $rt;
	}

}
?>