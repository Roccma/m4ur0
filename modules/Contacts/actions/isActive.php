<?php
class Contacts_isActive_Action extends Vtiger_Action_Controller {

	function checkPermission(Vtiger_Request $request) {
	}

	public function process(Vtiger_Request $request) {
		global $log,$adb;

		$contactid = $request->get('contactid');
		
		$sql = "SELECT clienteactivo FROM vtiger_contactdetails WHERE contactid = ?";
		$result = $adb->pquery($sql, array($contactid));

		foreach ($result as $r) {
			$clienteactivo = $r['clienteactivo'];
		}

		$value = $clienteactivo == "No" ? 0 : 1;

		echo json_encode(array("clienteactivo" => $value));
	}
}
?>

