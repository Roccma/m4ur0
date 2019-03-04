<?php

class Portal_getDiasDisponibles_API extends Portal_Default_API {

	public function process(Portal_Request $request) {
		//global $log;
		$fechaDesde = $request->get('fechaDesde');
		$fechaHasta = $request->get('fechaHasta');
		$record = $request->get('record');
		$response = new Portal_Response();
		$result = Vtiger_Connector::getInstance()->getDiasDisponibles($fechaDesde, $fechaHasta, $record);
		$response->setResult($result);
		return $response;
	}

}