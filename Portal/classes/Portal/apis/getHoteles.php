<?php

class Portal_getHoteles_API extends Portal_Default_API {

	public function process(Portal_Request $request) {
		//global $log;
		$response = new Portal_Response();
		$result = Vtiger_Connector::getInstance()->getHoteles();
		$response->setResult($result);
		return $response;
	}

}