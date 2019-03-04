<?php
class CustomerPortal_getDataRedimirDias extends CustomerPortal_API_Abstract {

	function checkPermission(Vtiger_Request $request) {
	}

	public function process(CustomerPortal_API_Request $request) {
		global $adb, $log;

		//$log->debug("llegue aca mauro en el getHoteles 1");
		$searchKey = $request->get('searchKey');

		$sql = "SELECT CONCAT(firstname, ' ', lastname) AS contacto, redestado, DATE_FORMAT(redfechacom, '%d/%m/%Y') AS redfechacom, DATE_FORMAT(redfechafin, '%d/%m/%Y') AS redfechafin, reddias, rednroconf, redcorreo, redpasajeros, redpasajero1, redpasajero2, redpasajero3, redpasajero4, redpasajero5, hotel, redcomentarios, CONCAT(u.first_name, ' ', u.last_name) AS smownername, contactid
			FROM vtiger_redimirdias r 
			INNER JOIN vtiger_contactdetails c ON r.redcontacto = c.contactid
			INNER JOIN vtiger_crmentity crm ON r.redimirdiasid = crm.crmid
			INNER JOIN vtiger_users u ON crm.smownerid = u.id
			WHERE redimirdiasid = ?";

		$result = $adb->pquery($sql, array($searchKey));

		$res = array();
		foreach ($result as $r) {
			$res[] = array('contacto' => $r['contacto'],
							'redestado' => $r['redestado'],
							'redfechacom' => $r['redfechacom'],
							'redfechafin' => $r['redfechafin'],
							'reddias' => $r['reddias'],
							'rednroconf' => $r['rednroconf'],
							'redcorreo' => $r['redcorreo'],
							'redpasajeros' => intval($r['redpasajeros']),
							'redpasajero1' => $r['redpasajero1'],
							'redpasajero2' => $r['redpasajero2'],
							'redpasajero3' => $r['redpasajero3'],
							'redpasajero4' => $r['redpasajero4'],
							'redpasajero5' => $r['redpasajero5'],
							'hotel' => $r['hotel'],
							'redcomentarios' => $r['redcomentarios'],
							'smownername' => $r['smownername'],
							'contactid' => $r['contactid']);
		}

		$response = new CustomerPortal_API_Response();
		$response->setResult($res);
		return $response;
	}
}
?>

