<?php 
class mOrtodon {

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
			$sql = "UPDATE tbl_anamnesis SET anamnesis_trat_med=?, anamnesis_accident=?, anamnesis_toma_medicame=?, anamnesis_cirugia=?, anamnesis_alergia_anestesi=?, anamnesis_diabetes=?, anamnesis_enfermed_respirat=?, anamnesis_hiperten_arterial=?, anamnesis_enfermed_cardiaca=?, anamnesis_embarazo=?, anamnesis_transmis_sexual=?, anamnesis_otra=?, anamnesis_obserb=?, anamnesis_unilater=?, anamnesis_bilatera=?, anamnesis_higiene_oral=?, anamnesis_enfermed_endroc=?, anamnesis_respir=?, anamnesis_moti_consul=? WHERE pacien_cedrif=?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->tramed);
			$res->bindParam(2,$this->traacc);
			$res->bindParam(3,$this->tommed);
			$res->bindParam(4,$this->cir);
			$res->bindParam(5,$this->aleane);
			$res->bindParam(6,$this->dia);
			$res->bindParam(7,$this->enfres);
			$res->bindParam(8,$this->hipart);
			$res->bindParam(9,$this->enfcar);
			$res->bindParam(10,$this->emb);
			$res->bindParam(11,$this->enftrasex);
			$res->bindParam(12,$this->otr);
			$res->bindParam(13,$this->obs);
			$res->bindParam(14,$this->masuni);
			$res->bindParam(15,$this->masbil);
			$res->bindParam(16,$this->higora);
			$res->bindParam(17,$this->enfend);
			$res->bindParam(18,$this->res);
			$res->bindParam(19,$this->motivo);			
			$res->bindParam(20,$this->cedrif);
			$exe_1 = $res->execute();
		} else {
			$sql = "INSERT INTO tbl_anamnesis VALUES(?,?,?,?,?,?,NULL,?,?,?,?,?,NULL,NULL,?,?,?,?,?,?,NULL,?,?,?)";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->cedrif);
			$res->bindParam(2,$this->tramed);
			$res->bindParam(3,$this->traacc);
			$res->bindParam(4,$this->tommed);
			$res->bindParam(5,$this->cir);
			$res->bindParam(6,$this->aleane);
			$res->bindParam(7,$this->dia);
			$res->bindParam(8,$this->enfres);
			$res->bindParam(9,$this->hipart);
			$res->bindParam(10,$this->enfcar);
			$res->bindParam(11,$this->emb);
			$res->bindParam(12,$this->enftrasex);
			$res->bindParam(13,$this->otr);
			$res->bindParam(14,$this->obs);
			$res->bindParam(15,$this->masuni);
			$res->bindParam(16,$this->masbil);
			$res->bindParam(17,$this->higora);
			$res->bindParam(18,$this->enfend);
			$res->bindParam(19,$this->res);
			$res->bindParam(20,$this->motivo);						
			$exe_1 = $res->execute();
		}
		$rt = ($exe_1==true) ? : print_r($res->errorInfo());
		return $rt;
	}

	function examenExtraOralSelect($cedrif) {
		$sql = "SELECT * FROM tbl_extoral_o WHERE pacien_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchALl(PDO::FETCH_OBJ);
	}

	function examenExtraoralUpdate() {
		$tot = $this->examenExtraOralSelect($this->cedrif);
		if(count($tot)>0) {
			$sql = "UPDATE tbl_extoral_o SET 
				extoral_o_perfil             = ?,
				extoral_o_analis_ter_sub     = ?,
				extoral_o_analis_ter_med     = ?,
				extoral_o_analis_ter_inf     = ?,
				extoral_o_labio_sup_proqueli = ?,
				extoral_o_labio_sup_retroque = ?,
				extoral_o_labio_sup_normal   = ?,
				extoral_o_labio_inf_proqueli = ?,
				extoral_o_labio_inf_retroque = ?,
				extoral_o_labio_inf_normal   = ?,
				extoral_o_arc_sonr_const     = ?,
				extoral_o_arc_sonr_noconst   = ?,
				extoral_o_tip_sonr_normal    = ?,
				extoral_o_tip_sonr_gingi     = ?,
				extoral_o_tip_sonr_senil     = ?,
				extoral_o_lin_med_faci_con   = ?,
				extoral_o_lin_med_faci_nocon = ?,
				extoral_o_anal_fron          = ?,
				extoral_o_selle_labial       = ?, 
				extoral_o_maxi               = ?,
				extoral_o_mandi              = ?
			  WHERE 
			  pacien_cedrif 				 = ?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->per);
			$res->bindParam(2,$this->anatersup);
			$res->bindParam(3,$this->anatermed);
			$res->bindParam(4,$this->anaterinf);
			$res->bindParam(5,$this->labsuppro);
			$res->bindParam(6,$this->labsupret);
			$res->bindParam(7,$this->labsupnor);
			$res->bindParam(8,$this->labinfpro);
			$res->bindParam(9,$this->labinfret);
			$res->bindParam(10,$this->labinfnor);
			$res->bindParam(11,$this->arcsoncon);
			$res->bindParam(12,$this->arcsonnoc);
			$res->bindParam(13,$this->tipsonnor);
			$res->bindParam(14,$this->tipsongin);
			$res->bindParam(15,$this->tipsonsen);
			$res->bindParam(16,$this->linmedfaccoi);
			$res->bindParam(17,$this->linmedfacnoc);
			$res->bindParam(18,$this->anafro);
			$res->bindParam(19,$this->sellab);
			$res->bindParam(20,$this->max);
			$res->bindParam(21,$this->man);
			$res->bindParam(22,$this->cedrif);
			$exe_1 = $res->execute();
		} else {
			$sql = "INSERT INTO tbl_extoral_o VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->cedrif);
			$res->bindParam(2,$this->per);
			$res->bindParam(3,$this->anatersup);
			$res->bindParam(4,$this->anatermed);
			$res->bindParam(5,$this->anaterinf);
			$res->bindParam(6,$this->labsuppro);
			$res->bindParam(7,$this->labsupret);
			$res->bindParam(8,$this->labsupnor);
			$res->bindParam(9,$this->labinfpro);
			$res->bindParam(10,$this->labinfret);
			$res->bindParam(11,$this->labinfnor);
			$res->bindParam(12,$this->arcsoncon);
			$res->bindParam(13,$this->arcsonnoc);
			$res->bindParam(14,$this->tipsonnor);
			$res->bindParam(15,$this->tipsongin);
			$res->bindParam(16,$this->tipsonsen);
			$res->bindParam(17,$this->linmedfaccoi);
			$res->bindParam(18,$this->linmedfacnoc);
			$res->bindParam(19,$this->anafro);
			$res->bindParam(20,$this->sellab);
			$res->bindParam(21,$this->max);
			$res->bindParam(22,$this->man);
			$exe_1 = $res->execute();
		}
		$rt = ($exe_1==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}

	function examenIntraOralSelect($cedrif) {
		$sql = "SELECT * FROM tbl_intoral_o WHERE pacien_cedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$cedrif);
		$res->execute();
		return $res->fetchALl(PDO::FETCH_OBJ);
	}

	function examenIntraOralUpdate() {
		$tot = $this->examenIntraOralSelect($this->cedrif);
		if(count($tot)>0) {
			$sql = "UPDATE tbl_intoral_o SET
				intoral_of_linmed   = ?,
				intoral_of_plaocl   = ?,
				intoral_of_mal      = ?,
				intoral_of_overjet  = ?,
				intoral_of_overbite = ?,
				intoral_of_son      = ?,
				intoral_of_otr      = ?,
				intoral_od_clacan   = ?,
				intoral_od_clamol   = ?,
				intoral_od_mal      = ?,
				intoral_od_overjet  = ?,
				intoral_od_overbite = ?,
				intoral_od_curspe   = ?,
				intoral_od_otr      = ?,
				intoral_oi_clacan   = ?,
				intoral_oi_clamol   = ?,
				intoral_oi_mal      = ?,
				intoral_oi_overjet  = ?,
				intoral_oi_overbite = ?,
				intoral_oi_curspe   = ?,
				intoral_oi_otr      = ?
			  WHERE
			  pacien_cedrif = ?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->oflinmed);
			$res->bindParam(2,$this->ofplaocl);
			$res->bindParam(3,$this->ofmal);
			$res->bindParam(4,$this->ofoverjet);
			$res->bindParam(5,$this->ofoverbite);
			$res->bindParam(6,$this->ofson);
			$res->bindParam(7,$this->ofotr);
			$res->bindParam(8,$this->odclacan);
			$res->bindParam(9,$this->odclamol);
			$res->bindParam(10,$this->odmal);
			$res->bindParam(11,$this->odoverjet);
			$res->bindParam(12,$this->odoverbite);
			$res->bindParam(13,$this->odcurspe);
			$res->bindParam(14,$this->odotr);
			$res->bindParam(15,$this->oiclacan);
			$res->bindParam(16,$this->oiclamol);
			$res->bindParam(17,$this->oimal);
			$res->bindParam(18,$this->oioverjet);
			$res->bindParam(19,$this->oioverbite);
			$res->bindParam(20,$this->oicurspe);
			$res->bindParam(21,$this->oiotr);
			$res->bindParam(22,$this->cedrif);
			$exe_1 = $res->execute();
		} else {
			$sql = "INSERT INTO tbl_intoral_o VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->cedrif);
			$res->bindParam(2,$this->oflinmed);
			$res->bindParam(3,$this->ofplaocl);
			$res->bindParam(4,$this->ofmal);
			$res->bindParam(5,$this->ofoverjet);
			$res->bindParam(6,$this->ofoverbite);
			$res->bindParam(7,$this->ofson);
			$res->bindParam(8,$this->ofotr);
			$res->bindParam(9,$this->odclacan);
			$res->bindParam(10,$this->odclamol);
			$res->bindParam(11,$this->odmal);
			$res->bindParam(12,$this->odoverjet);
			$res->bindParam(13,$this->odoverbite);
			$res->bindParam(14,$this->odcurspe);
			$res->bindParam(15,$this->odotr);
			$res->bindParam(16,$this->oiclacan);
			$res->bindParam(17,$this->oiclamol);
			$res->bindParam(18,$this->oimal);
			$res->bindParam(19,$this->oioverjet);
			$res->bindParam(20,$this->oioverbite);
			$res->bindParam(21,$this->oicurspe);
			$res->bindParam(22,$this->oiotr);
			$exe_1 = $res->execute();
		}
		$rt = ($exe_1==true) ? 1 : print_r($res->errorInfo());
		return $rt;
	}

	function steiner() {
		$sql = "SELECT * FROM tbl_steiner ORDER BY steiide";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function selectSteinerPaciente($steiide, $cedrif) {
		$sql = "SELECT * FROM tbl_steinerpacien 
			WHERE steiide=? AND paciencedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$steiide);
		$res->bindParam(2,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function steinerInsert() {
		$tot = $this->selectSteinerPaciente($this->steiide,$this->cedrif);
		if(count($tot)>0) {
			$sql = "UPDATE tbl_steinerpacien SET stpavalor=?, stpadiagno=? 
				WHERE steiide=? AND paciencedrif=?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->normal);
			$res->bindParam(2,$this->diagno);
			$res->bindParam(3,$this->steiide);
			$res->bindParam(4,$this->cedrif);
			$res->execute();
		} else {
			$sql = "INSERT INTO tbl_steinerpacien (steiide, stpavalor, stpadiagno, paciencedrif) VALUES (?,?,?,?)";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->steiide);
			$res->bindParam(2,$this->normal);
			$res->bindParam(3,$this->diagno);
			$res->bindParam(4,$this->cedrif);
			$res->execute();
		}
	}
/**
 * LEGAN
 * @return [type] [description]
 */
	function legan() {
		$sql = "SELECT * FROM tbl_legan ORDER BY legaide";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function selectLeganPaciente($legaide, $cedrif) {
		$sql = "SELECT * FROM tbl_leganpacien 
			WHERE legaide=? AND paciencedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$legaide);
		$res->bindParam(2,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function leganInsert() {
		$tot = $this->selectLeganPaciente($this->legaide,$this->cedrif);
		if(count($tot)>0) {
			$sql = "UPDATE tbl_leganpacien SET lepavalor=?, lepadiagno=? 
				WHERE legaide=? AND paciencedrif=?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->normal);
			$res->bindParam(2,$this->diagno);
			$res->bindParam(3,$this->legaide);
			$res->bindParam(4,$this->cedrif);
			$res->execute();
		} else {
			$sql = "INSERT INTO tbl_leganpacien (legaide, lepavalor, lepadiagno, paciencedrif) VALUES (?,?,?,?)";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->legaide);
			$res->bindParam(2,$this->normal);
			$res->bindParam(3,$this->diagno);
			$res->bindParam(4,$this->cedrif);
			$res->execute();
		}
	}
	
/**
 * MCNAMARA
 * @return [type] [description]
 */
	function mcnamara() {
		$sql = "SELECT * FROM tbl_mcnamara ORDER BY mcnaide";
		$res = $this->con->prepare($sql);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function selectMcnamaraPaciente($mcnaide, $cedrif) {
		$sql = "SELECT * FROM tbl_mcnamarapacien 
			WHERE mcnaide=? AND paciencedrif=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$mcnaide);
		$res->bindParam(2,$cedrif);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function mcnamaraInsert() {
		$tot = $this->selectMcnamaraPaciente($this->mcnaide,$this->cedrif);
		if(count($tot)>0) {
			$sql = "UPDATE tbl_mcnamarapacien SET mcpavalor=?, mcpadiagno=? 
				WHERE mcnaide=? AND paciencedrif=?";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->normal);
			$res->bindParam(2,$this->diagno);
			$res->bindParam(3,$this->mcnaide);
			$res->bindParam(4,$this->cedrif);
			$res->execute();
		} else {
			$sql = "INSERT INTO tbl_mcnamarapacien (mcnaide, mcpavalor, mcpadiagno, paciencedrif) VALUES (?,?,?,?)";
			$res = $this->con->prepare($sql);
			$res->bindParam(1,$this->mcnaide);
			$res->bindParam(2,$this->normal);
			$res->bindParam(3,$this->diagno);
			$res->bindParam(4,$this->cedrif);
			$res->execute();
		}
	}

} #class
?>