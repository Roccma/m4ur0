<?php
class Noticias_getLanguages_Action extends Vtiger_Action_Controller {

	function checkPermission(Vtiger_Request $request) {
	}

	public function process(Vtiger_Request $request) {
		global $log,$adb;

		$log->debug("aca maurooo");

		$sql = "SELECT idioma FROM vtiger_idioma";

		$result = $adb->pquery($sql, array());
		
		foreach ($result as $r) {
			$languages[] = $r;
		}

		echo json_encode($languages);
	}
}
?>

