<?php
class CustomerPortal_getDataSolicitudReserva extends CustomerPortal_API_Abstract {

	function checkPermission(Vtiger_Request $request) {
	}

	public function process(CustomerPortal_API_Request $request) {
		global $adb, $log;

		//$log->debug("llegue aca mauro en el getHoteles 1");
		$searchKey = $request->get('searchKey');

		$sql = "SELECT CONCAT(firstname, ' ', lastname) AS contacto, resestado, DATE_FORMAT(resfechacom, '%d/%m/%Y') AS resfechacom, DATE_FORMAT(resfechafin, '%d/%m/%Y') AS resfechafin, resdias, resnroconf, rescorreo, respasajeros, respasajero1, respasajero2, respasajero3, respasajero4, respasajero5, resnochganada, hotel, rescomentarios, CONCAT(u.first_name, ' ', u.last_name) AS smownername, contactid
			FROM vtiger_solicitudesreservas s 
			INNER JOIN vtiger_contactdetails c ON s.rescontacto = c.contactid
			INNER JOIN vtiger_crmentity crm ON s.solicitudesreservasid = crm.crmid
			INNER JOIN vtiger_users u ON crm.smownerid = u.id
			WHERE solicitudesreservasid = ?";

		$result = $adb->pquery($sql, array($searchKey));

		$res = array();
		foreach ($result as $r) {
			$res[] = array('contacto' => $r['contacto'],
							'resestado' => $r['resestado'],
							'resfechacom' => $r['resfechacom'],
							'resfechafin' => $r['resfechafin'],
							'resdias' => $r['resdias'],
							'resnroconf' => $r['resnroconf'],
							'rescorreo' => $r['rescorreo'],
							'respasajeros' => intval($r['respasajeros']),
							'respasajero1' => $r['respasajero1'],
							'respasajero2' => $r['respasajero2'],
							'respasajero3' => $r['respasajero3'],
							'respasajero4' => $r['respasajero4'],
							'respasajero5' => $r['respasajero5'],
							'resnochganada' => $r['resnochganada'],
							'hotel' => $r['hotel'],
							'rescomentarios' => $r['rescomentarios'],
							'smownername' => $r['smownername'],
							'contactid' => $r['contactid']);
		}

		$response = new CustomerPortal_API_Response();
		$response->setResult($res);
		return $response;
	}
}
?>

