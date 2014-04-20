<?php 
class mGeneral{

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

	function motivoConsultaSelect($cedrif) {
		$sql = "SELECT * FROM tbl_anamnesis WHERE pacien_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchALl(PDO::FETCH_OBJ);
	}

	function motivoConsultaUpdate() {
		$tot = $this->motivoConsultaSelect($this->cedrif);
		if(count($tot)>0) {
			$sql = "UPDATE tbl_anamnesis SET anamnesis_trat_med=?, anamnesis_accident=?, anamnesis_toma_medicame=?, anamnesis_cirugia=?, anamnesis_alergia_anestesi=?, anamnesis_hemorrag=?, anamnesis_diabetes=?, anamnesis_enfermed_respirat=?, anamnesis_hiperten_arterial=?, anamnesis_enfermed_cardiaca=?, anamnesis_embarazo=?, anamnesis_asma=?, anamnesis_consume_cigarri=?, anamnesis_transmis_sexual=?, anamnesis_otra=?, anamnesis_obserb=?, anamnesis_consume_alcoh=?, anamnesis_moti_consul=? WHERE pacien_cedrif=?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->tramed);
			$res->bindParam(2,$this->traacc);
			$res->bindParam(3,$this->tommed);
			$res->bindParam(4,$this->cir);
			$res->bindParam(5,$this->aleane);
			$res->bindParam(6,$this->hem);
			$res->bindParam(7,$this->dia);
			$res->bindParam(8,$this->enfres);
			$res->bindParam(9,$this->hipart);
			$res->bindParam(10,$this->enfcar);
			$res->bindParam(11,$this->emb);
			$res->bindParam(12,$this->asm);
			$res->bindParam(13,$this->concig);
			$res->bindParam(14,$this->enftrasex);
			$res->bindParam(15,$this->otr);
			$res->bindParam(16,$this->obs);
			$res->bindParam(17,$this->conalc);
			$res->bindParam(18,$this->motivo);
			$res->bindParam(19,$this->cedrif);
			$exe_1 = $res->execute();
		} else {
			$sql = "INSERT INTO tbl_anamnesis VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NULL,NULL,NULL,?,NULL,NULL,?)";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->cedrif);
			$res->bindParam(2,$this->tramed);
			$res->bindParam(3,$this->traacc);
			$res->bindParam(4,$this->tommed);
			$res->bindParam(5,$this->cir);
			$res->bindParam(6,$this->aleane);
			$res->bindParam(7,$this->hem);
			$res->bindParam(8,$this->dia);
			$res->bindParam(9,$this->enfres);
			$res->bindParam(10,$this->hipart);
			$res->bindParam(11,$this->enfcar);
			$res->bindParam(12,$this->emb);
			$res->bindParam(13,$this->asm);
			$res->bindParam(14,$this->concig);
			$res->bindParam(15,$this->enftrasex);
			$res->bindParam(16,$this->otr);
			$res->bindParam(17,$this->obs);
			$res->bindParam(18,$this->conalc);
			$res->bindParam(19,$this->motivo);
			$exe_1 = $res->execute();
		}
		$rt = ($exe_1==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}

	function historiaDentalUpdate() {
		$sql = "UPDATE tbl_pacien SET pacien_ult_visit=?, pacien_frec_cepill=?, pacien_sedal_otro=?, pacien_camb_cepill=? WHERE pacien_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$this->ulvisodo);
		$res->bindParam(2,$this->frecep);
		$res->bindParam(3,$this->sdebp);
		$res->bindParam(4,$this->camcep);
		$res->bindParam(5,$this->cedrif);
		$rt = ($res->execute()==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}

	function examenIntraoralSelect($cedrif) {
		$sql = "SELECT * FROM tbl_intraoral WHERE pacien_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchALl(PDO::FETCH_OBJ);
	}

	function examenIntraoralInsert() {
		$tot = $this->examenIntraoralSelect($this->cedrif);
		if(count($tot)>0) {
			$sql = "UPDATE tbl_intraoral SET intraoral_paladar=?, intraoral_oclusion=?, intraoral_cambios_color=?, intraoral_p_blanda=?, intraoral_amigdalas=?, intraoral_rebordes_alveolar=?, intraoral_anom_forma=?, intraoral_p_calcific=?, intraoral_carrillo=?, intraoral_lengua=?, intraoral_anom_tamano=?, intraoral_enf_perio=?, intraoral_labios=?, intraoral_piso_boca=?, intraoral_patologi_pulpar=?, intraoral_atm=?, intraoral_encias=?, intraoral_fractur=?, intraoral_bolsa_per=?, intraoral_porcen_placa=?, intraoral_dx_periodon=?, intraoral_obserb=?, intraoral_gingiv=? WHERE pacien_cedrif=?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->pal);
			$res->bindParam(2,$this->ocl);
			$res->bindParam(3,$this->camcol);
			$res->bindParam(4,$this->pbla);
			$res->bindParam(5,$this->ami);
			$res->bindParam(6,$this->rebalv);
			$res->bindParam(7,$this->anofor);
			$res->bindParam(8,$this->pcal);
			$res->bindParam(9,$this->car);
			$res->bindParam(10,$this->len);
			$res->bindParam(11,$this->anotam);
			$res->bindParam(12,$this->enfper);
			$res->bindParam(13,$this->lab);
			$res->bindParam(14,$this->pisboc);
			$res->bindParam(15,$this->patpul);
			$res->bindParam(16,$this->atm);
			$res->bindParam(17,$this->enc);
			$res->bindParam(18,$this->fra);
			$res->bindParam(19,$this->bolper);
			$res->bindParam(20,$this->porpla);
			$res->bindParam(21,$this->dxper);
			$res->bindParam(22,$this->obs);
			$res->bindParam(23,$this->gin);
			$res->bindParam(24,$this->cedrif);
			$exe_1 = $res->execute();
		} else {
			$sql = "INSERT INTO tbl_intraoral VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->cedrif);
			$res->bindParam(2,$this->pal);
			$res->bindParam(3,$this->ocl);
			$res->bindParam(4,$this->camcol);
			$res->bindParam(5,$this->pbla);
			$res->bindParam(6,$this->ami);
			$res->bindParam(7,$this->rebalv);
			$res->bindParam(8,$this->anofor);
			$res->bindParam(9,$this->pcal);
			$res->bindParam(10,$this->car);
			$res->bindParam(11,$this->len);
			$res->bindParam(12,$this->anotam);
			$res->bindParam(13,$this->enfper);
			$res->bindParam(14,$this->lab);
			$res->bindParam(15,$this->pisboc);
			$res->bindParam(16,$this->patpul);
			$res->bindParam(17,$this->atm);
			$res->bindParam(18,$this->enc);
			$res->bindParam(19,$this->fra);
			$res->bindParam(20,$this->bolper);
			$res->bindParam(21,$this->porpla);
			$res->bindParam(22,$this->dxper);
			$res->bindParam(23,$this->obs);
			$res->bindParam(24,$this->gin);
			$exe_1 = $res->execute();
		}
		$rt = ($exe_1==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}

	function selectDiagPlan($cedrif) {
		$sql = "SELECT * FROM tbl_diagplan WHERE paciencedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function insertDiagPlan() {
		$tot = $this->selectDiagPlan($this->cedrif);
		if(count($tot)>0) {
			$sql = "UPDATE tbl_diagplan SET dipldiagno=?, diplplantr=? WHERE paciencedrif=?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->diagno);
			$res->bindParam(2,$this->plan);
			$res->bindParam(3,$this->cedrif);
			$res->execute();
		} else {
			$sql = "INSERT INTO tbl_diagplan (paciencedrif, dipldiagno, diplplantr) VALUES (?,?,?)";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->cedrif);
			$res->bindParam(2,$this->diagno);
			$res->bindParam(3,$this->plan);
			$res->execute();
		}
	}
 


} #class
?>