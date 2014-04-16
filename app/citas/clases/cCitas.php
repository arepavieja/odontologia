<?php 
class cCitas extends mCitas {
	
	function dia($dia) {
		$day = array(
				'Mon'=>'Lun',
				'Tue'=>'Mar',
				'Wed'=>'Mié',
				'Thu'=>'Jue',
				'Fri'=>'Vie',
				'Sat'=>'Sáb',
				'Sun'=>'Dom'
			);
		return $day[$dia];
	}

	function mes($mes) {
		$month = array(
				'Jan'=>'Ene',
				'Feb'=>'Feb',
				'Mar'=>'Mar',
				'Apr'=>'Abr',
				'May'=>'May',
				'Jun'=>'Jun',
				'Jul'=>'Jul',
				'Aug'=>'Ago',
				'Sep'=>'Sep',
				'Oct'=>'Oct',
				'Nov'=>'Nov',
				'Dec'=>'Dic',
			);
		return $month[$mes];
	}

	function mesNum($mes) {
		$month = array(
				'JAN'=>'1',
				'FEB'=>'2',
				'MAR'=>'3',
				'APR'=>'4',
				'MAY'=>'5',
				'JUN'=>'6',
				'JUL'=>'7',
				'AUG'=>'8',
				'SEP'=>'9',
				'OCT'=>'10',
				'NOV'=>'11',
				'DEC'=>'12',
			);
		return $month[$mes];
	}

	function mesNumMin($mes) {
		$month = array(
				'Jan'=>'1',
				'Feb'=>'2',
				'Mar'=>'3',
				'Apr'=>'4',
				'May'=>'5',
				'Jun'=>'6',
				'Jul'=>'7',
				'Aug'=>'8',
				'Sep'=>'9',
				'Oct'=>'10',
				'Nov'=>'11',
				'Dec'=>'12',
			);
		return $month[$mes];
	}

	function fechaCalendar($fecha) {
		$expl = explode(' ',$fecha);
		$armando = $this->dia($expl[0]).' '.$expl[2].' '.$this->mes($expl[1]).' - '.$expl[4];
		return $armando;
	}

	function fechaCalendarAll($fecha) {
		$expl = explode(' ',$fecha);
		return $expl;
	}

	function fechaValidar($fecha) {
		$expl = explode(' ',$fecha);
		$armando = $expl[3].'-'.$this->mesNum($expl[1]).'-'.$expl[2];
		return $armando;
	}

	function validarCalendario($inicio) {
		$fecini = $this->fechaValidar($inicio);
		$fecact = date('Y-m-d');
		if($fecini<$fecact) {
			$rt = "La fecha de cita no puede ser menor a la fecha actual";
		} else {
			$rt = 1;
		}
		return $rt;
	}

	function validaCalendarioAll() {
		$a = $this->validarCalendario($this->inicio);
		$a1 = ($a==1) ? 1 : $this->msj[] = $a;
		$rt = ($a1==1) ? 1 : $this->msj;
		return $rt;
	}

}
?>