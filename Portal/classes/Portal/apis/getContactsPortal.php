<?php

class Portal_getContactsPortal_API extends Portal_Default_API {

	public function process(Portal_Request $request) {
		$response = new Portal_Response();
		$result = Vtiger_Connector::getInstance()->getContactsPortal();
		$response->setResult($result);
		return $response;
	}

}