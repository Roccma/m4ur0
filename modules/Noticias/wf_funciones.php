<?php

require_once "include/events/VTEntityData.inc";
include_once('modules/Vtiger/models/Record.php');

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

	$sql = "UPDATE vtiger_noticias SET notcreatedtime = now() WHERE noticiasid = ?";
	$adb->pquery($sql, array($entityId));
}

?>