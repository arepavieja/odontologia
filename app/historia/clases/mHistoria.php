<?php 
class mHistoria {

	protected $dbh,$con,$msj;

	function __clone() {

	} #clone

	function __construct() {
		$this->dbh = new Conexion();
		$this->con = $this->dbh->pgsql();
		$this->msj = array();
		if(isset($_POST)) {
			foreach($_POST as $indice=>$valor) {
				$this->$indice = strtoupper($valor);
			}
		}
	} #construct

	function historiaInsert() {
		$this->con->beginTransaction(); # Inicia la transacción
		$sql = "SELECT MAX(pacien_nro_histo) AS mayor from tbl_pacien";
		$res = $this->con->prepare($sql);
		$res->execute();
		$mayor = $res->fetchAll(PDO::FETCH_OBJ);
		$max = $mayor[0]->mayor+1;

		$sql = "INSERT INTO tbl_pacien VALUES (?,?,?,?,?,?,?,?,?,NULL,NULL,NULL,NULL,NULL,?,NULL,now())";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->cedrif);
		$res->bindParam(2,$this->nomraz);
		$res->bindParam(3,$this->direccion);
		$res->bindParam(4,$this->celular);
		$res->bindParam(5,$this->telefono);
		$res->bindParam(6,$this->sexo);
		$res->bindParam(7,$this->correo);
		$res->bindParam(8,$this->ocupacion);
		$res->bindParam(9,$this->edad);	
		$res->bindParam(10,$max);
		$exe1 = $res->execute();
		if($exe1==true) {
			$this->con->commit();
			$rt = 1;
		} else {
			$this->con->rollBack();
			$rt = print_r($res->errorInfo());
		}
		return $rt;
	}

	function ortodonciaHistoriaInsert() {
		$this->con->beginTransaction(); # Inicia la transacción
		$sql = "SELECT MAX(pacien_letra_hist) AS mayor from tbl_pacien";
		$res = $this->con->prepare($sql);
		$res->execute();
		$mayor = $res->fetchAll(PDO::FETCH_OBJ);
		$max = $mayor[0]->mayor+1;

		$sql = "INSERT INTO tbl_pacien VALUES (?,?,?,?,?,?,?,?,?,NULL,NULL,NULL,NULL,NULL,NULL,?,now())";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->cedrif);
		$res->bindParam(2,$this->nomraz);
		$res->bindParam(3,$this->direccion);
		$res->bindParam(4,$this->celular);
		$res->bindParam(5,$this->telefono);
		$res->bindParam(6,$this->sexo);
		$res->bindParam(7,$this->correo);
		$res->bindParam(8,$this->ocupacion);
		$res->bindParam(9,$this->edad);	
		$res->bindParam(10,$max);
		$exe1 = $res->execute();
		if($exe1==true) {
			$this->con->commit();
			$rt = 1;
		} else {
			$this->con->rollBack();
			$rt = print_r($res->errorInfo());
		}
		return $rt;
	}

	function historiaUpdate() {
		$sql = "UPDATE tbl_pacien SET pacien_nomraz=?, pacien_domicasa=?, pacien_movil1tlf=?, pacien_casatlf=?, pacien_sexo=?, pacien_email=?, pacien_ocupa=?, pacien_fechnac=?, pacien_fec_inic=?  WHERE pacien_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->nomraz);
		$res->bindParam(2,$this->direccion);
		$res->bindParam(3,$this->celular);
		$res->bindParam(4,$this->telefono);
		$res->bindParam(5,$this->sexo);
		$res->bindParam(6,$this->correo);
		$res->bindParam(7,$this->ocupacion);
		$res->bindParam(8,$this->edad);	
		$res->bindParam(9,$this->fecha_inicio);	
		$res->bindParam(10,$this->cedrif);
		$exe_1 = $res->execute();
		$rt = ($exe_1==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}

	function datosPersonalesSelect($cedrif) {
		$sql = "SELECT * FROM tbl_pacien WHERE pacien_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function parentescoSelect() {
		$sql = "SELECT * FROM tbl_parent";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function parienteSelect($cedrif) {
		$sql = "SELECT * FROM tbl_fami_pacien WHERE pacien_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function parienteUpdate() {
		$tot = $this->parienteSelect($this->cedrif);
		if(count($tot)>0) {
			$sql = "UPDATE tbl_fami_pacien SET fami_pacien_cedrif=?, fami_pacien_nomb=?, fami_pacien_movil=?, fami_pacien_tlfcasa=?, fami_pacien_ocupa=?, fami_pacien_fecnac=?, fami_pacien_paren=?, fami_pacien_dir=? WHERE pacien_cedrif=?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->cedula);
			$res->bindParam(2,$this->nomraz);
			$res->bindParam(3,$this->celular);
			$res->bindParam(4,$this->telefono);
			$res->bindParam(5,$this->ocupacion);
			$res->bindParam(6,$this->fecnac);
			$res->bindParam(7,$this->parentesco);
			$res->bindParam(8,$this->direccion);
			$res->bindParam(9,$this->cedrif);
			$exe_1 = $res->execute();
		} else {
			$sql = "INSERT INTO tbl_fami_pacien VALUES (?,?,?,?,?,?,?,?,?)";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->cedrif);
			$res->bindParam(2,$this->cedula);
			$res->bindParam(3,$this->nomraz);
			$res->bindParam(4,$this->celular);
			$res->bindParam(5,$this->telefono);
			$res->bindParam(6,$this->ocupacion);
			$res->bindParam(7,$this->fecnac);
			$res->bindParam(8,$this->parentesco);	
			$res->bindParam(9,$this->direccion);	
			$exe_1 = $res->execute();
		}
		$rt = ($exe_1==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}

	function ortodonciaComprobarHistoria() {
		$persona = $this->datosPersonalesSelect($this->cedrif);
		if($persona[0]->pacien_letra_hist=="") {
			$sql = "SELECT MAX(pacien_letra_hist) AS mayor from tbl_pacien";
			$res = $this->con->prepare($sql);
			$res->execute();
			$mayor = $res->fetchAll(PDO::FETCH_OBJ);
			$max = $mayor[0]->mayor+1;

			$sql = "UPDATE tbl_pacien SET pacien_letra_hist=? WHERE pacien_cedrif=?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$max);
			$res->bindParam(2,$this->cedrif);
			$rt = ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		} else {
			$rt = 1;
		}
		return $rt;
	}

	function comprobarHistoria() {
		$persona = $this->datosPersonalesSelect($this->cedrif);
		if($persona[0]->pacien_nro_histo=="") {
			$sql = "SELECT MAX(pacien_nro_histo) AS mayor from tbl_pacien";
			$res = $this->con->prepare($sql);
			$res->execute();
			$mayor = $res->fetchAll(PDO::FETCH_OBJ);
			$max = $mayor[0]->mayor+1;

			$sql = "UPDATE tbl_pacien SET pacien_nro_histo=? WHERE pacien_cedrif=?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$max);
			$res->bindParam(2,$this->cedrif);
			$rt = ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		} else {
			$rt = 1;
		}
		return $rt;
	}

	function fotoUpdate($cedula,$nombre,$temp) {
		$destino = '../../../img/paciente/';
		$nom = str_replace(' ', '', $nombre);
		if(move_uploaded_file($temp, $destino.$nom)) {
			$sql = "UPDATE tbl_pacien SET pacien_fot=? WHERE pacien_cedrif=?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$nom);
			$res->bindParam(2,$cedula);
			return $res->execute();
		}
	}



} #class
?>