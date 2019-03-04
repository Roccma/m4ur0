<?php

class CustomerPortal_getContactsPortal extends CustomerPortal_API_Abstract {

	public function process(CustomerPortal_API_Request $request) {
		global $adb;

		$contactid = $request->get('contactid');
		
		$sql = "SELECT contactid, CONCAT(firstname, ' ', lastname) as contactname FROM vtiger_contactdetails INNER JOIN vtiger_crmentity ON contactid = crmid WHERE deleted = 0 order by firstname";
		$result = $adb->pquery($sql, array());

		$res = array();
		foreach ($result as $r) {
			$res[] = array("contactid" => $r['contactid'], "contactname" => $r['contactname']);
		}

		$response = new CustomerPortal_API_Response();
		$response->setResult($res);
		return $response;
	}
}

?>

