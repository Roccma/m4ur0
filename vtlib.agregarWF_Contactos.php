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
$emm->addEntityMethod("Contacts", "wf_setBirthday2", "modules/Contacts/WF_Funciones.php", "wf_setBirthday");
$emm->addEntityMethod("Contacts", "wf_verificarClienteActivo", "modules/Contacts/WF_Funciones.php", "wf_verificarClienteActivo");

echo "OK";
echo '</body></html>';

?>
