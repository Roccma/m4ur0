<?php
require_once('include/database/PearDatabase.php');
//instancio la conexion de bd
$conexion = PearDatabase::getInstance();
/*
Consulto las incidencias que no estan cerradas y tampoco borradas
Se retorna el id de la incidencia y la diferencia de horas obtenidas luego de realizar la operación
para obtener la diferencia de minutos entre la fecha de creacion y una fecha por parametros, esto dividido 60 para obtener las horas más exactas que utilizando 'HOUR'
*/
$sql = "SELECT tt.ticketid as id, (TIMESTAMPDIFF(MINUTE, createdtime, ?)/60) as horas from vtiger_troubletickets tt, vtiger_crmentity crm where crm.crmid = tt.ticketid and tt.status <> 'Closed' and crm.deleted = 0";
//Se crea un date ya que la hora de la base de datos puede que no corresponda con la hora del servidor
$result = $conexion->pquery($sql, array(date('Y-m-d H:i:s')));
//por cada tupla modifica el campo hours de las incidencias
foreach ($result as $value) {
	$conexion->pquery('UPDATE vtiger_troubletickets set hours = ? where ticketid = ?', array(number_format($value['horas'], 2, '.', ''), $value['id']));
}
/*
Consulto los ultimos cambios de las incidencias que no esten cerradas ni borradas
*/
$sql = "SELECT crmid as id, max(vmb.changedon) as ultimagestion from vtiger_modtracker_basic vmb where vmb.crmid in (SELECT tt.ticketid from vtiger_troubletickets tt, vtiger_crmentity crm where crm.crmid = tt.ticketid and tt.status <> 'Closed' and crm.deleted = 0) group by vmb.crmid";
$result = $conexion->pquery($sql);
//por cada tupla encontrada modifico el campo fecha ultima gestion
foreach ($result as $value) {
	$conexion->pquery('UPDATE vtiger_troubletickets set 
    ttfechaultimagestion = ? where ticketid = ?', array($value['ultimagestion'], $value['id']));
}
//luego de modificar la fecha de ultima gestion
/*
consulto todas las incidencias no cerradas ni borradas
obtengo la diferencia en dias entre la fecha de creacion y la ultima fecha de gestion
*/
$sql = "SELECT tt.ticketid as id, TIMESTAMPDIFF(DAY, createdtime, tt.ttfechaultimagestion) as dias from vtiger_troubletickets tt, vtiger_crmentity crm where crm.crmid = tt.ticketid and tt.status <> 'Closed' and crm.deleted = 0";
$result = $conexion->pquery($sql);
//por cada tupla se agrega al campo dias la diferencia obtenida en la consulta anterior
foreach ($result as $value) {
	$conexion->pquery('UPDATE vtiger_troubletickets set days = ? where ticketid = ?', array(number_format($value['dias'], 2, '.', ''), $value['id']));
}

/*
Consulto los ultimos cambios en las oportunidades
*/
//and not p.sales_stage LIKE 'Closed%'
$sql = "SELECT crmid as id, max(vmb.changedon) as ultimagestion from vtiger_modtracker_basic vmb where vmb.crmid in (SELECT p.potentialid from vtiger_potential p, vtiger_crmentity crm where crm.crmid = p.potentialid and crm.deleted = 0) group by vmb.crmid";
$result = $conexion->pquery($sql);
//por cada tupla encontrada modifico el campo fecha ultima gestion
foreach ($result as $value) {
	$conexion->pquery('UPDATE vtiger_potential set 
    opfechaultimagestion = ? where potentialid = ?', array($value['ultimagestion'], $value['id']));
}
//luego de modificar la fecha de ultima gestion
/*
consulto todas las oportunidades no cerradas ni borradas
obtengo la diferencia en dias entre la fecha de creacion y la ultima fecha de gestion
*/
$sql = "SELECT p.potentialid as id, (TIMESTAMPDIFF(HOUR, createdtime, p.opfechaultimagestion)/24) as dias from vtiger_potential p, vtiger_crmentity crm where crm.crmid = p.potentialid and crm.deleted = 0";
$result = $conexion->pquery($sql);
//por cada tupla se agrega al campo dias la diferencia obtenida en la consulta anterior
foreach ($result as $value) {
	var_dump($value);
	$conexion->pquery('UPDATE vtiger_potential set optiempo = ? where potentialid = ?', array(number_format($value['dias'], 2, '.', ''), $value['id']));
}
?>
