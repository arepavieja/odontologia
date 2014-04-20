<?php 
class mProced {

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


	function procedInsert() {
		$sql = "INSERT INTO tbl_proced VALUES (nextval('tbl_proced_proced_ide_seq'::regclass),?,?,1,1,1)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->des);
		$res->bindParam(2,$this->pre);
		return ($res->execute()==1) ? 1 : print_r($res->errorInfo()); 
	}

	function procedSelect() {
		$sql = "SELECT * FROM tbl_proced ORDER BY proced_des ASC";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function procedSelectIde($ide) {
		$sql = "SELECT * FROM tbl_proced where proced_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$ide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function procedUpdate() {
		$sql = "UPDATE tbl_proced SET proced_des=?, proced_prec=?  where proced_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->des);
		$res->bindParam(2,$this->pre);
		$res->bindParam(3,$this->ide);
		return ($res->execute()==1) ? 1 : print_r($res->errorInfo()); 
	}

	function procedDelete() {
		$sql = "DELETE FROM tbl_proced where proced_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->ide);
		return ($res->execute()==1) ? 1 : print_r($res->errorInfo()); 
	}


} #class
?>