<?php

require_once "include/events/VTEntityData.inc";
include_once('modules/Vtiger/models/Record.php');

function wf_setBirthday($entity){
	global $log,$adb;
	$idExplode = explode("x",$entity->getId());
	$entityId = $idExplode[1];
	$birthday = $entity->get('birthday');
	$log->debug("Birthday mauro: " . $birthday);
	$birthdayExplode = explode("-", $birthday);
	$currentYear = date('Y');
	$currentMonth = date('m');
	$currentDay = date('d');

	$age = $currentYear - $birthdayExplode[0];
	if($currentMonth < $birthdayExplode[1])
		$age -= 1;
	else if($currentMonth == $birthdayExplode[1]){
		if($currentDay < $birthdayExplode[2])
			$age -= 1;
	}

	$sql = "UPDATE vtiger_contactdetails SET age = ? WHERE contactid = ?";
	$adb->pquery($sql, array($age, $entityId));
}

function wf_verificarClienteActivo($entity){
	global $log,$adb;
	$idExplode = explode("x",$entity->getId());
	$entityId = $idExplode[1];
	$clienteactivo = $entity->get('clienteactivo');
	if($clienteactivo == "No"){
		$sql = "UPDATE vtiger_contactdetails SET emailoptout = 1 WHERE contactid = ?";
		$adb->pquery($sql, array($entityId));
	}
}

?>