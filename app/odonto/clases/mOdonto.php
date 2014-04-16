<?php 
class mOdonto {

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

	function dienteTodoInsert() {
		$sql = "INSERT INTO tbl_diagcons VALUES(nextval('tbl_diagcons_diagcons_ide_seq'::regclass),?,?,?,?,?,?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->diagno);
		$res->bindParam(2,$this->cedrif);
		$res->bindParam(3,$this->diente);
		$res->bindParam(4,$this->parte);
		$res->bindParam(5,$this->grupo);
		$res->bindParam(6,$this->otrolugar);
		$rt = ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	} #dienteTodoInsert

	/**
	 * Para mostrar todos los diagnósticos en el odontograma
	 * @param  [type] $cedrif [description]
	 * @return [type]         [description]
	 */
	function odontoSelectCedrifOdonto($cedrif) {
		$sql = "SELECT * FROM tbl_diagcons AS dc
			INNER JOIN tbl_diagno AS d ON dc.diagno_codigo=d.diagno_codigo
			WHERE pacien_cedula=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	} #odontoSelectCedrif

	/**
	 * Mostrar en la tabla de diagnósticos realizados por la clínica
	 * @param  [type] $cedrif [description]
	 * @return [type]         [description]
	 */
	function odontoSelectCedrif($cedrif) {
		$sql = "SELECT * FROM tbl_diagcons AS dc
			INNER JOIN tbl_diagno AS d ON dc.diagcons_diagnostico=d.diagno_codigo
			WHERE dc.diagcons_paciente=? AND dc.diagcons_tipo=0";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	} #odontoSelectCedrif

	/**
	 * Diagnósticos realizados en otro lugar
	 * @param  [type] $cedrif [description]
	 * @return [type]         [description]
	 */
	function odontoSelectCedrifTipo1($cedrif) {
		$sql = "SELECT * FROM tbl_diagcons AS dc
			INNER JOIN tbl_diagno AS d ON dc.diagcons_diagnostico=d.diagno_codigo
			WHERE dc.diagcons_paciente=? AND dc.diagcons_tipo=1";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	} #odontoSelectCedrifTipo1

	function tratamientoDiagcons($diagcons) {
		$sql = "SELECT *, tra.proced_prec AS precio FROM tbl_tratamiento AS tra 
			INNER JOIN tbl_diagcons AS d ON tra.diagcons_ide=d.diagcons_ide
			INNER JOIN tbl_proced AS p ON tra.proced_ide=p.proced_ide
			WHERE tra.diagcons_ide=? ORDER BY tra.trat_ide ASC";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$diagcons);
		return ($res->execute()==true) ? $res->fetchAll(PDO::FETCH_OBJ) : print_r($res->errorInfo());
	}

	function diagnosticoDelete() {
		$sql = "DELETE FROM tbl_diagcons WHERE diagcons_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->diagno);
		return $res->execute();
	}

    function evolucionDelete() {
      //Busco la evolucion que se vaa borrar

		$sql = "SELECT evol_pago FROM tbl_evolucion WHERE evol_ide=?";
		$res = $this->con->prepare($sql);
	    $res->bindParam(1,$this->evol_ide);
		$res->execute();
		$devolu = $res->fetchAll(PDO::FETCH_OBJ);
		$valdevolu = $devolu[0]->evol_pago;
		
		$sql = "DELETE FROM tbl_evolucion WHERE evol_ide=?";
		$res = $this->con->prepare($sql);
	    $res->bindParam(1,$this->evol_ide);
		$res->execute();

        $sql = "SELECT evol_ide as total,proced_prec,evol_pago,evol_falta,trat_ide FROM tbl_evolucion
        where evol_ide = (select max(evol_ide) from tbl_evolucion where trat_ide=?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->trat_ide);
		$res->execute();
		$total = $res->rowCount();
		
		if($total>0) {

			$evolmax2=$res->fetchAll(PDO::FETCH_OBJ);
		    $evolmax3=$evolmax2[0]->total;
	        
	        $sql = "UPDATE tbl_evolucion set evol_falta=(evol_falta+?) WHERE evol_ide=?";
			$res = $this->con->prepare($sql);
	        $res->bindParam(1,$valdevolu);
			$res->bindParam(2,$evolmax3);
			return ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		} else {
			return 1;
		}
	}

	function procedDiagno($diagno) {
		$sql = "SELECT * FROM tbl_diagproc AS dp 
			INNER JOIN tbl_proced as p ON dp.proced_ide=p.proced_ide
			WHERE dp.diagno_codigo=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$diagno);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function procedimientoInsert() {
		$sql = "SELECT * FROM tbl_proced WHERE proced_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->diagproced);
		$res->execute();
		$tot = $res->fetchAll(PDO::FETCH_OBJ);

		$sql = "INSERT INTO tbl_tratamiento VALUES(nextval('tbl_tratamiento_trat_ide_seq'::regclass),?,?,?,1,0)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->diagcons);
		$res->bindParam(2,$this->diagproced);
		$res->bindParam(3,$tot[0]->proced_prec);
		return $res->execute();
	}

	function procedimientoDelete() {
		$sql = "DELETE FROM tbl_tratamiento WHERE trat_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->trat_ide);
		return $res->execute();
	}

	function procedimientoUpdate() {
		$sql = "UPDATE tbl_tratamiento SET trat_est=? WHERE trat_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->estado);
		$res->bindParam(2,$this->trat_ide);
		return $res->execute();
	}

	function guardarEvolucion() {
		$sql = "INSERT INTO tbl_evolucion VALUES(nextval('tbl_evolucion_evol_ide_seq'::regclass),?,?,?,?,?,?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->descripcion);
		$res->bindParam(2,$this->evol_fec);
		$res->bindParam(3,$this->trat_ide);
		$res->bindParam(4,$this->precp);
		$res->bindParam(5,$this->abono);
		$res->bindParam(6,$this->restap);
		return ($res->execute()==true) ? $this->con->lastInsertId('tbl_evolucion_evol_ide_seq') : print_r($res->errorInfo());	
	}

	function guardaFotosEvolucion($evol_ide,$nombre,$temp) {
		$destino = '../../../img/evolucion/';
		$nom = str_replace(' ', '', $nombre);
		if(move_uploaded_file($temp, $destino.$nom)) {
			$sql = "INSERT INTO tbl_evolfotos VALUES(nextval('tbl_evolfotos_evfo_ide_seq'::regclass),?,?,now())";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$evol_ide);
			$res->bindParam(2,$nom);
			return ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		}
	}

    function evolucionSelectIde($evol_ide) {
		$sql = "SELECT * from tbl_evolucion WHERE evol_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$evol_ide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

function evolucionSelectmax($trat_ide) {
		$sql = "SELECT evol_ide as total,proced_prec,evol_pago,evol_falta,trat_ide FROM tbl_evolucion
        where evol_ide = (select max(evol_ide) from tbl_evolucion where trat_ide=?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$trat_ide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}


	function evolucionFotosSelectIde($evol_ide) {
		$sql = "SELECT * from tbl_evolfotos WHERE evol_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$evol_ide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function traerFotos($evol_ide) {
		$sql = "SELECT * from tbl_evolfotos WHERE evol_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$evol_ide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function fotosDelete() {
		$sql = "DELETE FROM tbl_evolfotos WHERE evfo_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->evfo_ide);
		return $res->execute();
	}

	function updateEvolucion() {
		$sql = "UPDATE tbl_evolucion SET evol_des=?, evol_fec=? WHERE evol_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->descripcion);
		$res->bindParam(2,$this->evol_fec);		
		$res->bindParam(3,$this->evol_ide);
		return $res->execute();
	}

	function listaEvoluciones($trat_ide) {
		$sql = "SELECT * FROM tbl_evolucion WHERE trat_ide=? ORDER BY evol_ide ASC";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$trat_ide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function finalizarProcedimiento() {
		$sql = "UPDATE tbl_tratamiento SET trat_status=1 WHERE trat_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->trat_ide);
		return $res->execute();
	}

	function procedimientosTodos($cedrif) {
		$sql = "SELECT *, tr.proced_prec AS precio FROM tbl_tratamiento AS tr 
			INNER JOIN tbl_diagcons AS dc ON tr.diagcons_ide=dc.diagcons_ide
			INNER JOIN tbl_proced AS p ON tr.proced_ide=p.proced_ide
			INNER JOIN tbl_diagno AS d ON dc.diagcons_diagnostico=d.diagno_codigo
			WHERE dc.diagcons_paciente=?
			ORDER BY tr.trat_est, tr.trat_status";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}


	/**
	 * Punto de Inflexión
	 */
	
	function diagnosticosMedico($cedrif) {
			$sql = "SELECT
				*
			FROM
				tbl_diagcons AS dc
			INNER JOIN tbl_diagno AS di ON dc.diagcons_diagnostico = di.diagno_codigo
			INNER JOIN tbl_usuario AS pe ON dc.diagcons_medico = pe.usuario_codigo
			WHERE
				dc.diagcons_paciente = ?
			AND dc.diagcons_medico = ?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->bindParam(2,$_SESSION['usr']);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function traerDiagnosticos() {
    $sql = "SELECT * FROM tbl_diagno  order by diagno_descrip asc";
    //$sql = "SELECT * from tbl_diagno order by diagno_descrip";
    $res = $this->con->prepare($sql);
    $res->execute();
    return $res->fetchAll(PDO::FETCH_OBJ);
  }

  function guardarDiagnostico() {
		$sql = "INSERT INTO tbl_diagcons
			(
				diagcons_numero,
				diagcons_clase,
				diagcons_diagnostico,
				diagcons_fin,
				diagcons_paciente,
				diagcons_medico,
				diagcons_fecha,
				diagcons_hora,
				diagcons_tipo
			) 
			VALUES (?, ?, ?, ?, ?, ?, now(), now(),?)";
		$res = $this->con->prepare($sql);
		$res->bindParam(1, $this->numero);
		$res->bindParam(2, $this->clase);
		$res->bindParam(3, $this->diagnostico);
		$res->bindParam(4, $this->fin);
		$res->bindParam(5, $this->paciente);
		$res->bindParam(6, $_SESSION['usr']);
		$res->bindParam(7, $this->tipo);
		$rt = ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}

	function traerFotosEvolucion($trat_ide) {
		$sql = "SELECT * FROM tbl_evolfotos AS ev
			INNER JOIN tbl_evolucion AS e ON ev.evol_ide=e.evol_ide
			INNER JOIN tbl_tratamiento AS t ON e.trat_ide=t.trat_ide
			WHERE t.trat_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$trat_ide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

} #class
?>