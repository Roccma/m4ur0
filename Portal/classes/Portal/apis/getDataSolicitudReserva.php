<?php

class Portal_getDataSolicitudReserva_API extends Portal_Default_API {

	public function process(Portal_Request $request) {
		//global $log;
		$query = $request->get('query');
		$response = new Portal_Response();
		$result = Vtiger_Connector::getInstance()->getDataSolicitudReserva($query);
		$response->setResult($result);
		return $response;
	}

}