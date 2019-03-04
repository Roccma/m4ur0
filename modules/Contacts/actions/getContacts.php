<?php
class Contacts_getContacts_Action extends Vtiger_Action_Controller {

	function checkPermission(Vtiger_Request $request) {
	}

	public function process(Vtiger_Request $request) {
		global $log,$adb;

		$contactid = $request->get('contactid');
		
		$sql = "SELECT CONCAT(firstname, ' ', lastname) as contactname FROM vtiger_contactdetails INNER JOIN vtiger_crmentity ON contactid = crmid WHERE deleted = 0 order by firstname";
		$result = $adb->pquery($sql, array());

		$response = array();
		foreach ($result as $r) {
			$response[] = $r['contactname'];
		}

		echo json_encode($response);
	}
}
?>

