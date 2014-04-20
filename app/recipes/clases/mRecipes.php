<?php 
class mRecipes {

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

	function recipeInsert() {
		$sql = "INSERT INTO tbl_recipe VALUES(nextval('tbl_recipe_reci_ide_seq'::regclass),?,?,now(),?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->recipe);
		$res->bindParam(2,$this->indicacion);
		$res->bindParam(3,$this->cedrif);
		$rt = ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}

	function recipeSelectCedrif($cedrif) {
		$sql = "SELECT * FROM tbl_recipe WHERE pacien_cedrif=? ORDER BY reci_ide DESC";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}


	function recipeDelete() {
		$sql = "DELETE FROM tbl_recipe WHERE reci_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->reci_ide);
		$rt = ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}


} #class
?>