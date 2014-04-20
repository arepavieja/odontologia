<?php 
class mCorreo {

	protected $dbh,$con,$msj,$mail;

	function __clone() {

	} #clone

	function __construct() {
		$this->dbh = new Conexion();
		$this->con = $this->dbh->pgsql();
		$this->mail = new PHPMailer();
		$this->msj = array();
		if(isset($_POST)) {
			foreach($_POST as $indice=>$valor) {
				if(!is_array($valor)) {
					$this->$indice = strtoupper($valor);
				}
			}
		}
	} #construct

	function enviar($destino,$cuerpo,$titulo) {
		$this->mail->IsSMTP();
		$this->mail->SMTPAuth = true;
		#$mail->SMTPSecure = 'tls';
		// ssl://smtp.gmail.com;
		// smtp.iutai.tec.ve
		$this->mail->Host =   "ssl://smtp.gmail.com"; 
		$this->mail->Username = "correo.en.gmail@gmail.com";
		$this->mail->Password = "clave"; 
		$this->mail->Port = 465;
		$this->mail->From = "correo.en.gmail@gmail.com";
		$this->mail->FromName = "ODONTO-ESTETICA Dra. Ambar Aldana";

		//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
		$this->mail->AddAddress($destino); // Esta es la dirección a donde enviamos
		$this->mail->IsHTML(true); // El correo se envía como HTML
		$this->mail->Subject = $titulo; // Este es el titulo del email.
		$body = $cuerpo;
		$this->mail->Body = $body; // Mensaje a enviar
		$exito = $this->mail->Send(); // Envía el correo.

		//También podríamos agregar simples verificaciones para saber si se envió:
		if($exito) :
			$rt = 1;
		else :
			$rt = 0;
		endif;
		return $rt;
	}

	function enviarRango() {
		$bien = null;
		$mal  = null;
		$sin  = null;
		$sql = "SELECT * FROM tbl_citas AS cit 
			INNER JOIN tbl_pacien AS pac ON cit.citas_per=pac.pacien_cedrif";
		$res = $this->con->prepare($sql);
		$res->execute();
		$rows = $res->fetchAll(PDO::FETCH_OBJ);
		foreach($rows as $r) :
			$fecha_explode = explode(' ',$r->citas_hen);
			$mes_letra     = $fecha_explode[1];
			$dia           = $fecha_explode[2];
			$ano           = $fecha_explode[3];
			$mes           = $this->letraMes($mes_letra);
			$fecha 				 = $dia.'-'.$mes.'-'.$ano;
			if($this->desde<=$fecha and $this->hasta>=$fecha) :
				if(isset($r->pacien_email)) :
					$rt = $this->enviar($r->pacien_email,$this->cuerpo,$this->titulo);
					if ($rt==1) :
						$bien[] = $r->pacien_email;
					else :
						$mal[]  = $r->pacien_email;
					endif;
				else :
					$sin[] = $r->pacien_nomraz;
				endif;
			endif;
		endforeach;
		$rt = array('bien'=>$bien, 'mal'=>$mal, 'sin'=>$sin);
		return $rt;
	}

	function letraMes($mes) {
		$meses = array(
				'JAN'=>'01',
				'FEB'=>'02',
				'MAR'=>'03',
				'APR'=>'04',
				'MAY'=>'05',
				'JUN'=>'06',
				'JUL'=>'07',
				'AUG'=>'08',
				'SEP'=>'09',
				'OCT'=>'10',
				'NOV'=>'11',
				'DEC'=>'12',
			);
		return $meses[$mes];
	}

	function enviarDestino() {
		$bien = null;
		$mal  = null;
		$sin  = null;
		foreach($_POST['para'] as $dest) :
			$explode_mail = explode('/', $dest);
			$r            = $explode_mail[0];
			$n            = $explode_mail[1];
			if($r!="") :
				$rt = $this->enviar($r,$this->cuerpo,$this->titulo);
				if ($rt==1) :
					$bien[] = $r;
				else :
					$mal[]  = $r;
				endif;
			else :
				$sin[] = $n;
			endif;
		endforeach;
		$rt = array('bien'=>$bien, 'mal'=>$mal, 'sin'=>$sin);
		return $rt;
	}
} #class
?>