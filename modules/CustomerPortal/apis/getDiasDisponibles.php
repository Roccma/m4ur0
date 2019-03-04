<?php
class CustomerPortal_getDiasDisponibles extends CustomerPortal_API_Abstract {

	function checkPermission(Vtiger_Request $request) {
	}

	public function process(CustomerPortal_API_Request $request) {
		global $adb, $log;

		$fechaDesde = $request->get('fechaDesde');
		$fechaHasta = $request->get('fechaHasta');
		$record = $request->get('record');

		$log->debug("mauro 1");

		$customerId = $this->getActiveCustomer()->id;
		$contacto = vtws_getWebserviceEntityId('Contacts', $customerId);

		$contacto_explode = explode("x", $contacto);
		$contacto = $contacto_explode[1];

		$log->debug("mauro 2");

		$log->debug($fechaDesde . " - " . $fechaHasta . " - " . $record . " - " . $contacto);
		
		$redfechacom = strtotime($fechaDesde);
		$redfechafin = strtotime($fechaHasta);
	
		$datediff = $redfechafin - $redfechacom;
		$diasdiff = round($datediff / (60 * 60 * 24)); 


		$sql = "SELECT SUM(resdias) AS resnochganada FROM vtiger_solicitudesreservas INNER JOIN vtiger_crmentity ON solicitudesreservasid = crmid WHERE rescontacto = ? AND resestado = 'Confirmada' AND deleted = 0";

		$result = $adb->pquery($sql, array($contacto));
		$resnochganada = $adb->query_result($result, 0, 'resnochganada');

		$resnochganada_explode = explode(".", $resnochganada / 30);
		$resnochganada = $resnochganada_explode[0];

		$log->debug("Mauro noches ganadas: " . $resnochganada);

		//Paso a obtener los días que ya usó

		$sql2 = "SELECT CASE WHEN SUM(reddias) IS NULL THEN 0 ELSE SUM(reddias) END AS reddias FROM vtiger_redimirdias INNER JOIN vtiger_crmentity ON redimirdiasid = crmid WHERE redcontacto = ? AND deleted = 0";

		if(!empty($record)){
			$sql2 .= " AND redimirdiasid <> " . $record;
		}

		$result2 = $adb->pquery($sql2, array($contacto));

		$reddias = $adb->query_result($result2, 0, 'reddias');

		$log->debug("Mauro dias: " . $reddias);

		//Voy a restar los dias generados menos los días usados para saber cuantos les queda al cliente para usar

		$log->debug("Mauro dias diferencias: " . $diasdiff . " - disponibles: " . ($resnochganada - $reddias));

		//$res = array();

		if($diasdiff <= ($resnochganada - $reddias)){
			$response = new CustomerPortal_API_Response();
			$response->setResult(array("result" => true, "message" => "ok"));
			return $response;
		}
		else{
			$response = new CustomerPortal_API_Response();
			$response->setResult(array("result" => false, "message" => "error"));
			return $response;
		}
		
		
	}
} 
?>

