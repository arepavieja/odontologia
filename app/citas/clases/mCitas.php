<?php 
class mCitas {

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

	function citaNoregistrado() {
		$this->con->beginTransaction(); # Inicia la transacción
		$sql = "INSERT INTO tbl_pacien (pacien_cedrif,pacien_nomraz,pacien_fechnac) VALUES (?,?,?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->cedrif);
		$res->bindParam(2,$this->nomraz);
		$res->bindParam(3,$this->fecnac);	
		$exe_1 = $res->execute();

		$sql = "INSERT INTO tbl_citas VALUES(nextval('tbl_citas_citas_ide_seq'::regclass),?,?,?,?,?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->cedrif);
		$res->bindParam(2,$this->inicio);
		$res->bindParam(3,$this->fin);	
		$res->bindParam(4,$this->dia);
		$res->bindParam(5,$this->etiqueta);
		$exe_2 = $res->execute();

		if($exe_1==true and $exe_2==true) {
			$this->con->commit();
			$rt = 1;
		} else {
			$this->con->rollBack();
			$rt = print_r($res->errorInfo());
		}
		return $rt;
	}

	function citaRegistrado() {
		$sql = "INSERT INTO tbl_citas VALUES(nextval('tbl_citas_citas_ide_seq'::regclass),?,?,?,?,?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->cedrif);
		$res->bindParam(2,$this->inicio);
		$res->bindParam(3,$this->fin);	
		$res->bindParam(4,$this->dia);
		$res->bindParam(5,$this->etiqueta);
		return $res->execute();
	}

	function citasSelect() {
		$sql = "SELECT * FROM tbl_citas AS c 
			INNER JOIN tbl_pacien AS p on c.citas_per=p.pacien_cedrif";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function citaDelete() {
		$sql = "DELETE FROM tbl_citas WHERE citas_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->citas_ide);
		return $res->execute();
	}

	function citaUpdate() {
		$sql = "UPDATE tbl_citas SET citas_hen=?, citas_hsa=?, citas_dia=? WHERE citas_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->inicio);
		$res->bindParam(2,$this->fin);
		$res->bindParam(3,$this->dia);
		$res->bindParam(4,$this->citas_ide);
		return ($res->execute()==true) ? 1 : print_r($res->errorInfo());
	}


} #class
?>