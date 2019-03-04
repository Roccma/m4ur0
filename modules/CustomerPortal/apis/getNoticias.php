<?php
class CustomerPortal_getNoticias extends CustomerPortal_API_Abstract {

	function checkPermission(Vtiger_Request $request) {
	}

	public function process(CustomerPortal_API_Request $request) {
		global $adb, $log;

		$language = $request->get('language');

		$log->debug("language mauro: " . $language);

		$sql = "SELECT noticiasid, notresumen,notnoticia, notcreatedtime FROM vtiger_noticias WHERE notdesde <= CURDATE() AND nothasta >= CURDATE() AND notidioma = ? ORDER BY notorden ASC;";

		$result = $adb->pquery($sql, array($language));
		//$res = array();
		foreach ($result as $r) {
			$createdtime = new DateTime($r['notcreatedtime']);							
			$createdtime->modify('-2 hours');
			$createdtime = $createdtime->format('d/m/Y H:i:s');
			$res[] = array("noticiasid" => $r['noticiasid'],
						"notresumen" => $r['notresumen'],
						"notnoticia" => $r['notnoticia'],
						"notcreatedtime" => $createdtime);
		}

		$response = new CustomerPortal_API_Response();
		$response->setResult($res);
		return $response;
		
		
	}
} 
?>

