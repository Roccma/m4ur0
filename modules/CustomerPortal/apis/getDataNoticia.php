<?php
class CustomerPortal_getDataNoticia extends CustomerPortal_API_Abstract {

	function checkPermission(Vtiger_Request $request) {
	}

	public function process(CustomerPortal_API_Request $request) {
		global $adb, $log;

		//$log->debug("llegue aca mauro en el getHoteles 1");
		$searchKey = $request->get('searchKey');

		$sql = "SELECT notresumen, notnoticia, DATE_FORMAT(notdesde, '%d/%m/%Y') AS notdesde, DATE_FORMAT(nothasta, '%d/%m/%Y') AS nothasta
			FROM vtiger_noticias n 
			INNER JOIN vtiger_crmentity crm ON n.noticiasid = crm.crmid
			INNER JOIN vtiger_users u ON crm.smownerid = u.id
			WHERE noticiasid = ?";

		$result = $adb->pquery($sql, array($searchKey));

		$res = array();
		foreach ($result as $r) {
			$res[] = array('notresumen' => $r['notresumen'],
							'notnoticia' => $r['notnoticia'],
							'notdesde' => $r['notdesde'],
							'nothasta' => $r['nothasta']);
		}

		$response = new CustomerPortal_API_Response();
		$response->setResult($res);
		return $response;
	}
}
?>

