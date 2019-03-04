<?php
class RedimirDias_getDiasDisponibles_Action extends Vtiger_Action_Controller {

	function checkPermission(Vtiger_Request $request) {
	}

	public function process(Vtiger_Request $request) {
		global $log,$adb;

		$log->debug("aca maurooo");

		$fechaDesde = $request->get('fechaDesde');
		$fechaHasta = $request->get('fechaHasta');
		$contacto = $request->get('contacto');
		$record = $request->get('record');

		$log->debug("mauro en el action: ");

		if($fechaDesde == 'undefined' || $fechaHasta == 'undefined' || empty($fechaDesde) || empty($fechaHasta)){
			echo json_encode(array("result" => false, "message" => "no_dates"));
			return;
		} 
		
		$redfechacom = strtotime($fechaDesde);
		$redfechafin = strtotime($fechaHasta);
	
		$datediff = $redfechafin - $redfechacom;
		$diasdiff = round($datediff / (60 * 60 * 24)); //Con esto obtengo los días que va a redimir

		//Ahora voy a obtener los días generados (sin contar los que ya usó que lo haré luego)

		//$sql = "SELECT SUM(resnochganada) AS resnochganada FROM vtiger_solicitudesreservas INNER JOIN vtiger_crmentity ON solicitudesreservasid = crmid WHERE rescontacto = ? AND deleted = 0";


		$sql = "SELECT SUM(resdias) AS resnochganada FROM vtiger_solicitudesreservas INNER JOIN vtiger_crmentity ON solicitudesreservasid = crmid WHERE rescontacto = ? AND resestado = 'Confirmada' AND deleted = 0";

		$result = $adb->pquery($sql, array($contacto));
		$resnochganada = $adb->query_result($result, 0, 'resnochganada');

		$resnochganada_explode = explode(".", $resnochganada / 30);
		$resnochganada = $resnochganada_explode[0];

		$log->debug("Mauro noches ganadas: " . $resnochganada);

		//Paso a obtener los días que ya usó

		$sql2 = "SELECT CASE WHEN SUM(reddias) IS NULL THEN 0 ELSE SUM(reddias) END AS reddias FROM vtiger_redimirdias INNER JOIN vtiger_crmentity ON redimirdiasid = crmid WHERE redcontacto = ? AND deleted = 0";

		if(!empty($record)){
			$sql2 .= " AND redimirdiasid <> " . $record;
		}

		$result2 = $adb->pquery($sql2, array($contacto));

		$reddias = $adb->query_result($result2, 0, 'reddias');

		$log->debug("Mauro dias: " . $dias);

		//Voy a restar los dias generados menos los días usados para saber cuantos les queda al cliente para usar

		$log->debug("Mauro dias diferencias: " . $diasdiff . " - disponibles: " . ($resnochganada - $reddias));

		if($diasdiff <= ($resnochganada - $reddias))
			echo json_encode(array("result" => true, "message" => "ok"));
		else
			echo json_encode(array("result" => false, "message" => "error"));
	}
}
?>

