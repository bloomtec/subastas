<?php
class Subasta extends AppModel {
	var $name = 'Subasta';
	var $displayField = 'nombre';
	var $validate = array('tipo_subasta_id' => array('numeric' => array('rule' => array('numeric'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), 'notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), 'nombre' => array('notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), 'descripcion' => array('notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), 'imagen_path' => array('notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), 'valor' => array('notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), 'numeric' => array('rule' => array('numeric'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), 'umbral_minimo_creditos' => array('numeric' => array('rule' => array('numeric'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), 'notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), 'cantidad_creditos_puja' => array('numeric' => array('rule' => array('numeric'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), 'notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), 'precio' => array('numeric' => array('rule' => array('numeric'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), 'notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), 'aumento_precio' => array('numeric' => array('rule' => array('numeric'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), 'notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), 'duracion_inicial' => array('notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), 'aumento_duracion' => array('notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), 'dias_espera' => array('numeric' => array('rule' => array('numeric'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), 'notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), 'posicion_en_cola' => array('numeric' => array('rule' => array('numeric'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), 'notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), 'estados_subasta_id' => array('numeric' => array('rule' => array('numeric'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), 'notempty' => array('rule' => array('notempty'),
	//'message' => 'Your custom message here',
	//'allowEmpty' => false,
	//'required' => false,
	//'last' => false, // Stop validation after this rule
	//'on' => 'create', // Limit validation to 'create' or 'update' operations
	), ), );
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasOne = array('Venta' => array('className' => 'Venta', 'foreignKey' => 'subasta_id', 'conditions' => '', 'fields' => '', 'order' => ''));
	var $belongsTo = array('TipoSubasta' => array('className' => 'TipoSubasta', 'foreignKey' => 'tipo_subasta_id', 'conditions' => '', 'fields' => '', 'order' => ''), 'EstadosSubasta' => array('className' => 'EstadosSubasta', 'foreignKey' => 'estados_subasta_id', 'conditions' => '', 'fields' => '', 'order' => ''));
	var $hasMany = array('Oferta' => array('className' => 'Oferta', 'foreignKey' => 'subasta_id', 'dependent' => false, 'conditions' => '', 'fields' => '', 'order' => '', 'limit' => '', 'offset' => '', 'exclusive' => '', 'finderQuery' => '', 'counterQuery' => ''));

	function afterFind($results) {
		$serverTimestamp = time() + 2;
		$serverDate = date("Y-m-d H:i:s", $serverTimestamp);
		
		foreach($results as $key => $val) {
			
			if(isset($val['Subasta']['id'])) {
				$endDate = date($val['Subasta']['fecha_de_venta']);
				$endDateTime = new DateTime($endDate);
				$endDateTimeStamp = $endDateTime -> format('U');
				$faltanteTimeStamp = $endDateTimeStamp - $serverTimestamp;
				
				/*
				 $horasDiferencia=$faltanteTimeStamp/ 1000 / 60 / 60;
				 $horasDiferenciaRound=floor($horasDiferencia);
				 $minutosDiferencia=$faltanteTimeStamp /1000 /60 - (60 * $horasDiferenciaRound);
				 $minutosDiferenciaRound=floor($minutosDiferencia);
				 $segundosDiferencia=$faltanteTimeStamp/ 1000 - (60 *$minutosDiferenciaRound);
				 $segundosDifrenciaRound=floor($segundosDiferencia);
				 */

				if(!empty($endDate)) {
					$horas = $this -> getDateDifference($serverDate, $endDate, 'h');
					$minutos = $this -> getDateDifference($serverDate, $endDate, 'm');
					$segundos = $this -> getDateDifference($serverDate, $endDate, 's');
					$cronometro = $this -> getDateDifference($serverDate, $endDate, 'a');
					$results[$key]['Subasta']['faltante_timestamp'] = $faltanteTimeStamp;
					$results[$key]['Subasta']['contador_string'] = $cronometro["hours"] . ":" . $cronometro["minutes"] . ":" . $cronometro["seconds"];
					$results[$key]['Subasta']['server_timestamp'] = $serverTimestamp;
					$results[$key]['Subasta']['end_time_stamp'] = $endDateTimeStamp;
					$results[$key]['Subasta']['systime'] = date("Y-m-d H:i:s", $serverTimestamp);
				}

			}

		}

		return $results;
	}

	function getDateDifference($dateFrom, $dateTo, $unit ='d') {
		$difference = null;

		$dateFromElements = split(' ', $dateFrom);
		$dateToElements = split(' ', $dateTo);

		$dateFromDateElements = split('-', $dateFromElements[0]);
		$dateFromTimeElements = split(':', $dateFromElements[1]);
		$dateToDateElements = split('-', $dateToElements[0]);
		$dateToTimeElements = split(':', $dateToElements[1]);

		// Get unix timestamp for both dates

		$date1 = mktime((int)$dateFromTimeElements[0], (int)$dateFromTimeElements[1], (int)$dateFromTimeElements[2], (int)$dateFromDateElements[1], (int)$dateFromDateElements[0], (int)$dateFromDateElements[2]);
		$date2 = mktime((int)$dateToTimeElements[0], (int)$dateToTimeElements[1], (int)$dateToTimeElements[2], (int)$dateToDateElements[1], (int)$dateToDateElements[0], (int)$dateToDateElements[2]);

		if($date1 > $date2) {
			return null;
		}

		$diff = $date2 - $date1;

		$days = 0;
		$hours = 0;
		$minutes = 0;
		$seconds = 0;

		if($diff % 86400 <= 0) // there are 86,400 seconds in a day
		{
			$days = $diff / 86400;
		}

		if($diff % 86400 > 0) {
			$rest = ($diff % 86400);
			$days = ($diff - $rest) / 86400;

			if($rest % 3600 > 0) {
				$rest1 = ($rest % 3600);
				$hours = ($rest - $rest1) / 3600;

				if($rest1 % 60 > 0) {
					$rest2 = ($rest1 % 60);
					$minutes = ($rest1 - $rest2) / 60;
					$seconds = $rest2;
				} else {
					$minutes = $rest1 / 60;
				}
			} else {
				$hours = $rest / 3600;
			}
		}

		switch($unit) {
			case 'd' :

			case 'D' :
				$partialDays = 0;

				$partialDays += ($seconds / 86400);
				$partialDays += ($minutes / 1440);
				$partialDays += ($hours / 24);

				$difference = $days + $partialDays;

				break;

			case 'h' :

			case 'H' :
				$partialHours = 0;

				$partialHours += ($seconds / 3600);
				$partialHours += ($minutes / 60);

				$difference = $hours + ($days * 24) + $partialHours;

				break;

			case 'm' :

			case 'M' :
				$partialMinutes = 0;

				$partialMinutes += ($seconds / 60);

				$difference = $minutes + ($days * 1440) + ($hours * 60) + $partialMinutes;

				break;

			case 's' :

			case 'S' :
				$difference = $seconds + ($days * 86400) + ($hours * 3600) + ($minutes * 60);

				break;

			case 'a' :

			case 'A' :
				if(strlen($hours) == 1)
					$hours = "0" . $hours;
				if(strlen($minutes) == 1)
					$minutes = "0" . $minutes;
				if(strlen($seconds) == 1)
					$seconds = "0" . $seconds;
				if(empty($hours))
					$hours = "--";
				if(empty($minutes))
					$minutes = "--";
				if(empty($seconds))
					$seconds = "--";
				$difference = array("days" => $days, "hours" => $hours, "minutes" => $minutes, "seconds" => $seconds);

				break;
		}

		return $difference;
	}

}
?>