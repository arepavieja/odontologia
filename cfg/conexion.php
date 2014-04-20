<?php 
class Conexion {
	private $host,$dbname,$driver,$usr,$pwd,$con;

	function __clone() {

	}

	function pgsql() {
		$this->driver = 'pgsql';
		$this->host   = 'localhost';
		$this->dbname = 'bdodontologia';
		$this->usr    = 'bdodontologia';
		$this->pwd    = 'qwe123';
		try {
			$this->con = new PDO($this->driver.':host='.$this->host.';dbname='.$this->dbname, $this->usr,$this->pwd);
			return $this->con;
		} catch (PDOExeception $m) {
			$m->getMessage('Error');
		}
	}

	function compara($tabla,$campo,$valor) {
		$con = $this->pgsql();
		$sql = "SELECT ".$campo." FROM ".$tabla." WHERE ".$campo."=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$valor);
		$res->execute();
		return $res->rowCount();
	}

	function comparaUpdate($tabla,$campo,$campo2,$valor,$valor2) {
		$con = $this->pgsql();
		$sql = "SELECT ".$campo.", ".$campo2." FROM ".$tabla." WHERE ".$campo."=? AND ".$campo2."!=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$valor);
		$res->bindParam(2,$valor2);
		$res->execute();
		return $res->rowCount();
	}


}
?>
