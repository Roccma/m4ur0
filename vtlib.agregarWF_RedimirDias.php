<?php
$Vtiger_Utils_Log = true;

include_once('vtlib/Vtiger/Menu.php');
include_once('vtlib/Vtiger/Module.php');

require_once 'include/utils/utils.php';
require 'modules/com_vtiger_workflow/VTEntityMethodManager.inc';

global $db;
if(empty($db));
	$db = PearDatabase::getInstance();
	
$emm = new VTEntityMethodManager($db);
$emm->addEntityMethod("RedimirDias", "wf_setDays", "modules/RedimirDias/wf_funciones.php", "wf_setDays");

echo "OK";
echo '</body></html>';

?>
