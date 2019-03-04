<?php
include_once 'vtlib/Vtiger/Field.php';
include_once 'vtlib/Vtiger/Block.php';
include_once 'vtlib/Vtiger/Module.php';
include_once 'vtlib/Vtiger/Menu.php';
require_once('include/database/PearDatabase.php');
$module = Vtiger_Module::getInstance('HelpDesk');
//activa los logs
$Vtiger_Utils_Log = true;
//verifica que exista el módulo
if($module){
	global $adb;
	//elimina el picklistvalue 'En espera' 
    $sql = "DELETE FROM vtiger_ticketstatus WHERE ticketstatus='Wait For Response';";
    $adb->pquery($sql);
    //utilizamos el bloque ticket información
    $block = Vtiger_Block::getInstance('LBL_TICKET_INFORMATION', $module);
	$campo = Vtiger_Field::getInstance('ttsituacion', $module);
	//verifica no exista el campo.
	if (!$campo) {
		$campo = new Vtiger_Field();
		$campo->name = 'ttsituacion';
		$campo->label = 'ttsituacion';
		$campo->table = $module->basetable;
		$campo->column = 'ttsituacion';
		$campo->columntype = 'VARCHAR(75)';
		//campo de seleccion unica
		$campo->uitype = 15;
		$campo->typeofdata = 'V~O';
		$campo->displaytype = 1;
		// incluyo el campo en el bloque
		$block->addField($campo);
		$campo->setPicklistValues(array('Compensation', 'DAE', 'Financing', 'Welcome Call', 'MC Comment', 'Members Care', 'RCI', 'Referral Program', 'Rewards Program', 'TRC', 'Uncollectable Follow Up', 'Trading'));
	}else{
		//$campo->delete();
	}
	$campo = Vtiger_Field::getInstance('ttfechaultimagestion', $module);
	//verifica no exista el campo
	if (!$campo) {
		$campo = new Vtiger_Field();
		$campo->name = 'ttfechaultimagestion';
		$campo->label = 'ttfechaultimagestion';
		$campo->table = $module->basetable;
		$campo->column = 'ttfechaultimagestion';
		$campo->columntype = 'DATETIME';
		//Date
		$campo->uitype = 5;
		$campo->typeofdata = 'DT~O';
		$campo->displaytype = 2;
		// incluyo el campo en el bloque
		$block->addField($campo);
	}else{
		//$campo->delete();
	}
	echo "Listo";
}
?>