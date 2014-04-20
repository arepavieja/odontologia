<?php 
class mDiagproc {

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

	function diagProcDiagnos($diagno,$proced) {
		$sql = "SELECT * FROM tbl_diagproc WHERE diagno_codigo=? AND proced_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$diagno);
		$res->bindParam(2,$proced);
		$res->execute();
		$total = $res->rowCount();
		if($total>0) {
			$valor = $res->fetchAll(PDO::FETCH_OBJ);
			$rt = ($valor[0]->diagproc_est==1) ? 1 : 0;
		} else {
			$rt = 0;
		}
		return $rt;
	}

	function diagProcInsert() {
		$exe_1 = 1;
		for($x = 0; $x < $this->total; $x++) {
			$procedimiento = $_POST['procedimiento'.$x.''];
			$valor_procedimiento = $_POST['valor_procedimiento'.$x.''];
			$sql = "SELECT * FROM tbl_diagproc WHERE diagno_codigo=? AND proced_ide=?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->diagno);
			$res->bindParam(2,$procedimiento);
			$res->execute();
			$tot = $res->rowCount();
			$rows = $res->fetchAll(PDO::FETCH_OBJ);
			if($tot>0) {
				$sql = "UPDATE tbl_diagproc SET diagproc_est=? WHERE diagno_codigo=? AND proced_ide=?";
				$res = $this->con->prepare($sql);
				$res->bindParam(1,$valor_procedimiento);
				$res->bindParam(2,$this->diagno);
				$res->bindParam(3,$procedimiento);
				$exe_1 = $res->execute();
			} else {
				if($valor_procedimiento==1) {
					$sql = "INSERT INTO tbl_diagproc VALUES(nextval('tbl_diagproc_tbl_diagproc_ide_seq'::regclass),?,?,1)";
					$res = $this->con->prepare($sql);
					$res->bindParam(1,$this->diagno);
					$res->bindParam(2,$procedimiento);
					$exe_1 = $res->execute();
				}
			}
		}
		$rt = ($exe_1==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}


} #class
?>