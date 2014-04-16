<?php 
class mRadiogra {

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

	function guardaRayosX($paciente,$nombre,$descripcion,$temp) {
		$destino = '../../../img/rayosx/';
		$nom = str_replace(' ', '', $nombre);
		if(move_uploaded_file($temp, $destino.$nom)) {
			$sql = "INSERT INTO tbl_rayos VALUES(nextval('tbl_rayos_rayos_ide_seq'::regclass),?,?,?,NULL,NULL,NULL)";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$paciente);
			$res->bindParam(2,$nom);
			$res->bindParam(3,$descripcion);
			return $res->execute();
		}
	}

	function traerRayos($cedrif) {
		$sql = "SELECT * from tbl_rayos where rayos_paciente=? ORDER BY rayos_ide DESC";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function traerRayosIde($ide) {
		$sql = "SELECT * from tbl_rayos where rayos_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$ide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function rayoUpdate() {
		$sql = "UPDATE tbl_rayos SET rayos_pan=?, rayos_cefa=?, rayos_per=? WHERE rayos_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->pan);
		$res->bindParam(2,$this->cef);
		$res->bindParam(3,$this->per);
		$res->bindParam(4,$this->ide);
		return ($res->execute()==true) ? 1 : '¡Error al cargar la información';
	}

	function rayosDelete() {
		$sql = "DELETE FROM tbl_rayos WHERE rayos_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->rayos_ide);
		return ($res->execute()==true) ? 1 : '¡Error al eliminar la imagen';
	}
} #class
?>