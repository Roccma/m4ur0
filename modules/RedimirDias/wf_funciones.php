<?php

require_once "include/events/VTEntityData.inc";
include_once('modules/Vtiger/models/Record.php');

function wf_setDays($entity){
	global $log,$adb;
	$idExplode = explode("x",$entity->getId());
	$entityId = $idExplode[1];
	$resfechacom = strtotime($entity->get('redfechacom'));
	$resfechafin = strtotime($entity->get('redfechafin'));
	
	$datediff = $resfechafin - $resfechacom;
	$reddias = round($datediff / (60 * 60 * 24)); 

	$sql = "UPDATE vtiger_redimirdias SET reddias = ? WHERE redimirdiasid = ?";
	$adb->pquery($sql, array($reddias, $entityId));
}

function wf_setCreatedTime($entity){
	global $log,$adb;
	$idExplode = explode("x",$entity->getId());
	$entityId = $idExplode[1];
	
	/*$today = getdate();
	$dia = $today[mday];
	$mes = $today[mon];
	$anio = $today[year];*/

	$sql = "UPDATE vtiger_redimirdias SET redcreatedtime = now() WHERE redimirdiasid = ?";
	$adb->pquery($sql, array($entityId));
}

?>