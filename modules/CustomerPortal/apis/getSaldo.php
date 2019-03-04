<?php
class CustomerPortal_getSaldo extends CustomerPortal_API_Abstract {

	function checkPermission(Vtiger_Request $request) {
	}

	public function process(CustomerPortal_API_Request $request) {
		global $adb, $log;

		$customerId = $this->getActiveCustomer()->id;
		$contacto = vtws_getWebserviceEntityId('Contacts', $customerId);

		$contacto_explode = explode("x", $contacto);
		$contacto = $contacto_explode[1];

		
		$sql = "SELECT SUM(resdias) AS resnochganada FROM vtiger_solicitudesreservas INNER JOIN vtiger_crmentity ON solicitudesreservasid = crmid WHERE rescontacto = ? AND resestado = 'Confirmada' AND deleted = 0";

		$result = $adb->pquery($sql, array($contacto));
		$resnochganada = $adb->query_result($result, 0, 'resnochganada');

		$dias_reservas = $resnochganada;

		$resnochganada_explode = explode(".", $resnochganada / 30);
		$resnochganada = $resnochganada_explode[0];

		$dias_generados = $resnochganada;

		$log->debug("Mauro noches ganadas: " . $resnochganada);

		//Paso a obtener los días que ya usó

		$sql2 = "SELECT CASE WHEN SUM(reddias) IS NULL THEN 0 ELSE SUM(reddias) END AS reddias FROM vtiger_redimirdias INNER JOIN vtiger_crmentity ON redimirdiasid = crmid WHERE redcontacto = ? AND deleted = 0";


		$result2 = $adb->pquery($sql2, array($contacto));

		$reddias = $adb->query_result($result2, 0, 'reddias');

		$dias_utilizados = $reddias;
		$dias_saldo = $resnochganada - $reddias;

		$log->debug("Mauro dias: " . $reddias);
		
		$response = new CustomerPortal_API_Response();
		
		$response->setResult(array("dias_reservas" => $dias_reservas, "dias_generados" => $dias_generados, "dias_utilizados" => $dias_utilizados, "dias_saldo" => $dias_saldo));
		
		return $response;
		
		
	}
} 
?>

