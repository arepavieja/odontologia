<?php 
class mReportes {

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

	function tratIdeal($cedrif) {
		$sql = "SELECT a.trat_ide, a.diagcons_ide, a.proced_ide, a.proced_prec as precio, a.trat_est as estado,b.pacien_cedula, 
		        b.diagcons_dien as diente, b.diagcons_parte as parte_diente,c.proced_des as descrip_procedi
		        FROM tbl_tratamiento as a inner join tbl_diagcons as b ON a.diagcons_ide=b.diagcons_ide
		        inner join tbl_proced as c ON  a.proced_ide=c.proced_ide where b.pacien_cedula=? and a.trat_status=0";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function tratReal($cedrif) {
		$sql = "SELECT a.trat_ide, a.diagcons_ide, a.proced_ide, a.proced_prec as precio, a.trat_est as estado,b.pacien_cedula, 
		        b.diagcons_dien as diente, b.diagcons_parte as parte_diente,c.proced_des as descrip_procedi
		        FROM tbl_tratamiento as a inner join tbl_diagcons as b ON a.diagcons_ide=b.diagcons_ide
		        inner join tbl_proced as c ON  a.proced_ide=c.proced_ide where b.pacien_cedula=? and a.trat_est=2 and a.trat_status=0";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);	
	}

	function totalTratamientoIdeal($cedrif) {
$sql = "SELECT  sum(a.proced_prec) as total,b.pacien_cedula
        FROM tbl_tratamiento as a inner join tbl_diagcons as b ON a.diagcons_ide=b.diagcons_ide
        where b.pacien_cedula=? and a.trat_status=0
        group by b.pacien_cedula";		
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		$total = $res->fetchAll(PDO::FETCH_OBJ);
		return $total[0]->total;
	}

	function totalTratamientoReal($cedrif) {
$sql = "SELECT  sum(a.proced_prec) as total,b.pacien_cedula
        FROM tbl_tratamiento as a inner join tbl_diagcons as b ON a.diagcons_ide=b.diagcons_ide
        where b.pacien_cedula=? and a.trat_est=2 and a.trat_status=0
        group by b.pacien_cedula";		
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		$total = $res->fetchAll(PDO::FETCH_OBJ);
		return $total[0]->total;
	}

} #class
?>