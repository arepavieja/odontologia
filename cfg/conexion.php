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

	/*function phpMailer($destino,$cuerpo) {
		$this->mail = new PHPMailer();
		$this->mail->IsSMTP();
		$this->mail->SMTPAuth = true;
		#$mail->SMTPSecure = 'tls';
		$this->mail->Host = "ssl://smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com
		$this->mail->Username = "publio.quintero@gmail.com"; // Correo completo a utilizar
		$this->mail->Password = "servinet511!!!"; // Contraseña
		$this->mail->Port = 465; // Puerto a utilizar
		//Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc.
		$this->mail->From = "publio.quintero@gmail.com"; // Desde donde enviamos (Para mostrar)
		$this->mail->FromName = "Nombre";

		//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
		$this->mail->AddAddress($destino); // Esta es la dirección a donde enviamos
		$this->mail->IsHTML(true); // El correo se envía como HTML
		$this->mail->Subject = 'Titulo'; // Este es el titulo del email.
		$body = $cuerpo;
		$this->mail->Body = $body; // Mensaje a enviar
		$exito = $this->mail->Send(); // Envía el correo.

		//También podríamos agregar simples verificaciones para saber si se envió:
		if($exito){
		return 'El correo fue enviado correctamente.';
		}else{
		return 'Hubo un inconveniente. Contacta a un administrador.';
		}
	}*/

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
