<?php
class CustomerPortal_getHoteles extends CustomerPortal_API_Abstract {

	function checkPermission(Vtiger_Request $request) {
	}

	public function process(CustomerPortal_API_Request $request) {
		global $adb, $log;

		//$log->debug("llegue aca mauro en el getHoteles 1");
		$sql = "SELECT DISTINCT(hotel) FROM vtiger_hotel ORDER BY hotel";

		$result = $adb->pquery($sql, array());

		$res = array();
		foreach ($result as $r) {
			$res[] = array('id' => $r['hotel'], 'name' => $r['hotel']);
		}

		$response = new CustomerPortal_API_Response();
		$response->setResult($res);
		return $response;
	}
}
?>

