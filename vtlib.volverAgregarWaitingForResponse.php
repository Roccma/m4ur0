<?php
require_once('include/database/PearDatabase.php');
$conexion = PearDatabase::getInstance();
//suma uno al ultimo id ingresado de ticketstatus
$sql = "UPDATE vtiger_ticketstatus_seq SET id=id+1;";
$result = $conexion->pquery($sql);
//suma uno al ultimo id ingresado de picklistvalue
$sql = "UPDATE vtiger_picklistvalues_seq SET id=id+1;";
$result = $conexion->pquery($sql);
//ingresa el estado 'Wait for response' o 'En espera'
$sql = "INSERT INTO `vtiger_ticketstatus` (`ticketstatus_id`, `ticketstatus`, `presence`, `picklist_valueid`, `sortorderid`, `color`) VALUES ((SELECT id FROM vtiger_ticketstatus_seq), 'Wait For Response', 0, (SELECT id FROM vtiger_picklistvalues_seq), 2, NULL);";
$result = $conexion->pquery($sql);
echo 'Listo';
?>