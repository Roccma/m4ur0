<?php

class Portal_getSaldo_API extends Portal_Default_API {

	public function process(Portal_Request $request) {
		//global $log;
		$response = new Portal_Response();
		$result = Vtiger_Connector::getInstance()->getSaldo();
		$response->setResult($result);
		return $response;
	}

}