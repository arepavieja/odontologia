<?php 

class cUsuarios extends mUsuarios {

	function propUsua($var) {
		$estado = ($var==1) ? 'Activo' : 'Inactivo';
		$valor  = ($var==1) ? '0' : '1';
		$boton  = ($var==1) ? 'Denegar' : 'Permitir';
		$class  = ($var==1) ? 'btn-danger' : 'btn-success';
		$rt     = array('estado'=>$estado, 'valor'=>$valor, 'boton'=>$boton, 'class'=>$class);
		return $rt;
	}

	function cedula($nac,$ced) {
		$cedula = $nac.$ced;
		$sql = "SELECT pacien_cedrif FROM tbl_pacien WHERE pacien_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedula);
		$res->execute();
		if($res->rowCount()>0) {
			$rt = "Cédula ya registrada";
		} else {
			$rt = 1;
		}
		return $rt;
	}

	function usuario($usua) {
		$sql = "SELECT usuario_login FROM tbl_usuario WHERE usuario_login=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$usua);
		$res->execute();
		if($res->rowCount()>0) {
			$rt = "Usuario ya registrado";
		} else {
			$rt = 1;
		}
		return $rt;
	}

	function cedulaUpdate($ced) {
		$sql = "SELECT pacien_cedrif FROM tbl_pacien WHERE pacien_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedula);
		$res->execute();
		if($res->rowCount()>1) {
			$rt = "Cédula ya registrada";
		} else {
			$rt = 1;
		}
		return $rt;
	}

	function cusuarioUpdate($usua) {
		$sql = "SELECT usuario_login FROM tbl_usuario WHERE usuario_login=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$usua);
		$res->execute();
		if($res->rowCount()>1) {
			$rt = "Usuario ya registrado";
		} else {
			$rt = 1;
		}
		return $rt;
	}

	function valRegistroUsuario() {
		$a = $this->cedula($this->nac,$this->cedula);
		$b = $this->usuario($this->usuario);
		$a1 = ($a==1) ? 1 : $this->msj[] = $a;
		$b1 = ($b==1) ? 1 : $this->msj[] = $b;
		$rt = ($a1==1 and $b1==1) ? 1 : $this->msj;
		return $rt;
	}

	function valUpdateUsuario() {
		$a = $this->cedulaUpdate($this->cedula);
		$b = $this->cusuarioUpdate($this->usuario);
		$a1 = ($a==1) ? 1 : $this->msj[] = $a;
		$b1 = ($b==1) ? 1 : $this->msj[] = $b;
		$rt = ($a1==1 and $b1==1) ? 1 : $this->msj;
		return $rt;
	}

}
?>