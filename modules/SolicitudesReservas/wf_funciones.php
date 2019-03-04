<?php

require_once "include/events/VTEntityData.inc";
include_once('modules/Vtiger/models/Record.php');

function wf_setDays($entity){
	global $log,$adb;
	$idExplode = explode("x",$entity->getId());
	$entityId = $idExplode[1];
	$resfechacom = strtotime($entity->get('resfechacom'));
	$resfechafin = strtotime($entity->get('resfechafin'));
	$resestado = $entity->get('resestado');

	$datediff = $resfechafin - $resfechacom;
	$resdias = round($datediff / (60 * 60 * 24)); 

	$sql = "UPDATE vtiger_solicitudesreservas SET resdias = ? WHERE solicitudesreservasid = ?";
	$adb->pquery($sql, array($resdias, $entityId));
	
	if($resestado == 'Confirmada'){	
		

		$noches_ganadas_explode = explode('.', $resdias / 30);
		$noches_ganadas = $noches_ganadas_explode[0];

		$sql = "UPDATE vtiger_solicitudesreservas SET resnochganada = ? WHERE solicitudesreservasid = ?";
		$adb->pquery($sql, array($noches_ganadas, $entityId));

	}
}

function wf_setCreatedTime($entity){
	global $log,$adb;
	$idExplode = explode("x",$entity->getId());
	$entityId = $idExplode[1];
	
	/*$today = getdate();
	$dia = $today[mday];
	$mes = $today[mon];
	$anio = $today[year];

	$hora = $today[hours];
	$minutos = $today[minutes];
	$segundos = $today[seconds];*/
	//$anio . "-" . $mes . "-" . $dia . " " . $hora . ":" . $minutos . ":" . $segundos, 

	$sql = "UPDATE vtiger_solicitudesreservas SET rescreatedtime = now() WHERE solicitudesreservasid = ?";
	$adb->pquery($sql, array($entityId));
}

?>