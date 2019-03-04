<?php
require_once('include/database/PearDatabase.php');
global $adb;
//consulta el mayor numero de la secuencia en el crontask
$sql = "SELECT MAX(sequence) as sequence FROM vtiger_cron_task";
$result = $adb->pquery($sql);
$fila = $result->fields;
//inserta la task utilizando el valor obtenido en la consulta anterior más uno para que quede en ultimo lugar
//solo funciona si la tarea no está insertada ya que no se puede repetir el name y handler en un registro
$sql = "INSERT INTO `vtiger_cron_task` (`name`, `handler_file`, `frequency`, `laststart`, `lastend`, `status`, `module`, `sequence`, `description`) VALUES ('CamposCalculados', 'CamposCalculados.php', 3600, NULL, NULL, 1, 'HelpDesk', ?, 'Actualizar el campo horas');";
$adb->pquery($sql, array($fila['sequence']+1));
echo "Listo";
?>