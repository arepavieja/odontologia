<?php 
class mExamen {

	protected $dbh,$con,$msj;

	function __clone() {

	} #clone

	function __construct() {
		$this->dbh = new Conexion();
		$this->con = $this->dbh->pgsql();
		$this->msj = array();
		if(isset($_POST)) {
			foreach($_POST as $indice=>$valor) {
				if(!is_array($valor)) {
					$this->$indice = strtoupper($valor);
				}
			}
		}
	} #construct

	function examenInsert() {
		$sql = "INSERT INTO tbl_examenes VALUES(nextval('tbl_examenes_exam_ide_seq'::regclass),?,?,0,now())";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->examen);
		$res->bindParam(2,$this->cedrif);
		$rt = ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}

	function examenSelectCedrif($cedrif) {
		$sql = "SELECT * FROM tbl_examenes WHERE pacien_cedrif=? ORDER BY exam_ide DESC";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function estatusUpdate() {
		$sql = "UPDATE tbl_examenes SET exam_est=? WHERE exam_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->exam_est);
		$res->bindParam(2,$this->exam_ide);
		$rt = ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}

	function estatusdelete() {
		$sql = "DELETE FROM tbl_examenes WHERE exam_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->exam_ide);
		$rt = ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}

	function examenSelectCedrifstatus($cedrif) {
		$sql = "SELECT * FROM tbl_examenes WHERE pacien_cedrif=? and exam_est=0 ORDER BY exam_ide DESC";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}


} #class
?>