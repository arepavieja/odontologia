<?php 
class mDiagnos {

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


	function diagnoInsert() {
		$sql = "INSERT INTO tbl_diagno VALUES (nextval('tbl_diagno_cod_diagn_seq'::regclass),?,?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->des);
		$res->bindParam(2,$this->col);
		return ($res->execute()==1) ? 1 : print_r($res->errorInfo()); 
	}

	function diagnosSelect() {
		$sql = "SELECT * FROM tbl_diagno ORDER BY diagno_descrip ASC";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function diagnosSelectIde($ide) {
		$sql = "SELECT * FROM tbl_diagno where diagno_codigo=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$ide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function diagnoUpdate() {
		$sql = "UPDATE tbl_diagno SET diagno_descrip=?, diagno_color=?  where diagno_codigo=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->des);
		$res->bindParam(2,$this->col);
		$res->bindParam(3,$this->ide);
		return ($res->execute()==1) ? 1 : print_r($res->errorInfo()); 
	}

	function diagnoDelete() {
		$sql = "DELETE FROM tbl_diagno where diagno_codigo=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->ide);
		return ($res->execute()==1) ? 1 : print_r($res->errorInfo()); 
	}

	


} #class
?>