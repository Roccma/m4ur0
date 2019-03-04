<?php
class Reservations_getHoteles_Action extends Vtiger_Action_Controller {

	function checkPermission(Vtiger_Request $request) {
	}

	public function process(Vtiger_Request $request) {
		global $log,$adb;
		
		$sql = "SELECT DISTINCT(hotel) FROM vtiger_hotel ORDER BY hotel";

		$result = $adb->pquery($sql, array());

		$response = array();
		foreach ($result as $r) {
			$response[] = $r['hotel'];
		}

		echo json_encode($response);
	}
}
?>

