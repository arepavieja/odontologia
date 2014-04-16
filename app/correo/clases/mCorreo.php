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
				$this->$indice = strtoupper($valor);
			}
		}
	} #construct

	function enviar($destino,$cuerpo,$titulo) {
		$this->mail->IsSMTP();
		$this->mail->SMTPAuth = true;
		#$mail->SMTPSecure = 'tls';
		$this->mail->Host =   "smtp.iutai.tec.ve"; //"ssl://smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com
		$this->mail->Username = "sistemas@.iutai.tec.ve"; // Correo completo a utilizar
		$this->mail->Password = "iut123456"; // Contraseña
		$this->mail->Port = 25; // Puerto a utilizar
		//Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc.
		$this->mail->From = "sistemas@iutai.tec.ve"; // Desde donde enviamos (Para mostrar)
		$this->mail->FromName = "Correo";

		//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
		$this->mail->AddAddress($destino); // Esta es la dirección a donde enviamos
		$this->mail->IsHTML(true); // El correo se envía como HTML
		$this->mail->Subject = $titulo; // Este es el titulo del email.
		$body = $cuerpo;
		$this->mail->Body = $body; // Mensaje a enviar
		$exito = $this->mail->Send(); // Envía el correo.

		//También podríamos agregar simples verificaciones para saber si se envió:
		if($exito){
		return 'El correo fue enviado correctamente.';
		}else{
		return 'Hubo un inconveniente. Contacta a un administrador.';
		}
	}
} #class
?>