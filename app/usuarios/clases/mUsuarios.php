<?php 
class mUsuarios {

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

	function comprobarSesion() {
		if(isset($_SESSION['usr'])) {
			$rt = 1;
		} else {
			$rt = 2;
		}
		return $rt;
	}

	function selectSubModulos() {
		$sql = "SELECT * from tbl_submodulos AS s 
		INNER JOIN tbl_modulos AS m ON s.modu_ide=m.modu_ide";
		$res = $this->con->prepare($sql);
		return ($res->execute()==true) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
	}

	function permisoSubmodulo($subm,$nivel) {
		$sql = "SELECT * FROM tbl_permisos WHERE subm_ide=? and nivusuario_codigo=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$subm);
		$res->bindParam(2,$nivel);
		return ($res->execute()==true) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
	}

	function iniciarSesion() {
		$sql = "SELECT * FROM tbl_usuario 
			WHERE 
				usuario_login=? and 
				usuario_clave=? and 
				usuario_status='1'";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->usr);
		$res->bindParam(2,$this->pwd);
		return ($res->execute()==true) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
	}

	function modulosUsuario() {
		$sql = "SELECT m.modu_des,m.modu_ide,m.modu_ico FROM tbl_permisos AS p 
			INNER JOIN tbl_submodulos AS s ON p.subm_ide=s.subm_ide
			INNER JOIN tbl_modulos AS m ON s.modu_ide=m.modu_ide
			WHERE p.perm_est=1 AND p.nivusuario_codigo=?
			GROUP BY m.modu_ide
			ORDER BY m.modu_ord ASC";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$_SESSION['niv']);
		return ($res->execute()==true) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
	}

	function subModulosUsuario($modu) {
		$sql = "SELECT s.subm_des, s.subm_ide, s.subm_ord, s.subm_ico FROM tbl_permisos AS p 
			INNER JOIN tbl_submodulos AS s ON p.subm_ide=s.subm_ide
			WHERE s.modu_ide=? AND p.perm_est=1 AND p.nivusuario_codigo=?
			ORDER BY s.subm_ord ASC";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$modu);
		$res->bindParam(2,$_SESSION['niv']);
		return ($res->execute()==true) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
	}

	function contenido($var) {
		$url = base64_decode($var);
		$sql = "SELECT * FROM tbl_permisos AS p 
			INNER JOIN tbl_submodulos AS sm ON p.subm_ide=sm.subm_ide
			WHERE sm.subm_ide=? AND p.perm_est=1 AND p.nivusuario_codigo=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$url);
		$res->bindParam(2,$_SESSION['niv']);
		return ($res->execute()==true) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
	}

	function selectUsuarios() {
		$sql = "SELECT * FROM tbl_usuario AS u 
		INNER JOIN tbl_pacien AS p ON u.pers_cedrif=p.pacien_cedrif
		INNER JOIN tbl_nivusuario AS n ON u.nivusuario_codigo=n.nivusuario_codigo
		WHERE u.usuario_status!='3'
		ORDER BY p.pacien_cedrif ASC";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function tiposDeUsuario() {
		$sql = "SELECT * FROM tbl_nivusuario";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function usuarioInsert() {
		$cedula = $this->nac.$this->cedula;
		$this->con->beginTransaction();
		$sql = "INSERT INTO tbl_pacien (pacien_cedrif,pacien_nomraz) VALUES (?,?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedula);
		$res->bindParam(2,$this->nomraz);
		$exe_1 = $res->execute();

		$sql = "INSERT INTO tbl_usuario VALUES (nextval('tbl_usuario_usuario_codigo_seq'::regclass),?,?,?,1,?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->tipo);
		$res->bindParam(2,$this->usuario);
		$res->bindParam(3,$this->clave);
		$res->bindParam(4,$cedula);
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

	function usuarioSelect($cedrif) {
		$sql = "SELECT * FROM tbl_usuario AS u 
		INNER JOIN tbl_pacien AS p ON u.pers_cedrif=p.pacien_cedrif
		INNER JOIN tbl_nivusuario AS n ON u.nivusuario_codigo=n.nivusuario_codigo
		WHERE p.pacien_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function usuarioUpdate() {
		$this->con->beginTransaction();
		$sql = "UPDATE tbl_pacien SET pacien_nomraz=? WHERE pacien_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->nomraz);
		$res->bindParam(2,$this->cedula);
		$exe_1 = $res->execute();
		$sql = "UPDATE tbl_usuario SET nivusuario_codigo=?, usuario_login=?, usuario_clave=? WHERE pers_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->tipo);
		$res->bindParam(2,$this->usuario);
		$res->bindParam(3,$this->clave);
		$res->bindParam(4,$this->cedula);
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

	function estadoUpdate() {
		$sql = "UPDATE tbl_usuario SET usuario_status=? WHERE pers_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->estado);
		$res->bindParam(2,$this->cedrif);
		return $res->execute();
	}

	function permisoUpdate() {
		$sql = "SELECT * FROM tbl_permisos WHERE subm_ide=? AND nivusuario_codigo=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->subm);
		$res->bindParam(2,$this->nivel);
		$res->execute();
		if($res->rowCount()>0) {
			$sql = "UPDATE tbl_permisos SET perm_est=? WHERE subm_ide=? AND nivusuario_codigo=?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->estado);
			$res->bindParam(2,$this->subm);
			$res->bindParam(3,$this->nivel);
			return ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		} else {
			$sql = "INSERT INTO tbl_permisos (subm_ide,nivusuario_codigo,perm_est) VALUES (?,?,?)";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->subm);{}
			$res->bindParam(2,$this->nivel);
			$res->bindParam(3,$this->estado);
			return ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		}
	}

	function getAll() {
		$sql = "SELECT * FROM tbl_pacien";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

} #class
?>