<?php 

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("SolicitudesReservas");

$blockInstance = Vtiger_Block::getInstance("LBL_SolicitudesReservas_INFORMATION",$moduleInstance);

$fieldInstance = Vtiger_Field::getInstance('rescreatedtime', $moduleInstance);
if(!$fieldInstance) {
	$fieldInstance = new Vtiger_Field();
	$fieldInstance->name   = 'rescreatedtime';
	$fieldInstance->label   = 'rescreatedtime';
	$fieldInstance->table   = $rescreatedtime->basetable;
	$fieldInstance->column   = 'timestamp';
	$fieldInstance->columntype  = 'date';
	$fieldInstance->uitype   = 5;/* es un autonumerico que va a ser la clave */
	$fieldInstance->typeofdata  = 'D~O';
	$fieldInstance->displaytype = 3;
	$blockInstance->addField($fieldInstance); 
}
/*else{
	$fieldInstance->delete();
}*/

$moduleInstance = Vtiger_Module::getInstance("RedimirDias");

$blockInstance = Vtiger_Block::getInstance("LBL_RedimirDias_INFORMATION",$moduleInstance);

$fieldInstance = Vtiger_Field::getInstance('redcreatedtime', $moduleInstance);
if(!$fieldInstance) {
	$fieldInstance = new Vtiger_Field();
	$fieldInstance->name   = 'redcreatedtime';
	$fieldInstance->label   = 'redcreatedtime';
	$fieldInstance->table   = $rescreatedtime->basetable;
	$fieldInstance->column   = 'redcreatedtime';
	$fieldInstance->columntype  = 'timestamp';
	$fieldInstance->uitype   = 5;/* es un autonumerico que va a ser la clave */
	$fieldInstance->typeofdata  = 'D~O';
	$fieldInstance->displaytype = 3;
	$blockInstance->addField($fieldInstance); 
}

$moduleInstance = Vtiger_Module::getInstance("Noticias");

$blockInstance = Vtiger_Block::getInstance("LBL_Noticias_INFORMATION",$moduleInstance);

$fieldInstance = Vtiger_Field::getInstance('notcreatedtime', $moduleInstance);
if(!$fieldInstance) {
	$fieldInstance = new Vtiger_Field();
	$fieldInstance->name   = 'notcreatedtime';
	$fieldInstance->label   = 'notcreatedtime';
	$fieldInstance->table   = $rescreatedtime->basetable;
	$fieldInstance->column   = 'notcreatedtime';
	$fieldInstance->columntype  = 'timestamp';
	$fieldInstance->uitype   = 5;/* es un autonumerico que va a ser la clave */
	$fieldInstance->typeofdata  = 'D~O';
	$fieldInstance->displaytype = 3;
	$blockInstance->addField($fieldInstance); 
}
/*else{
	$fieldInstance->delete();
}*/

echo "Ok";