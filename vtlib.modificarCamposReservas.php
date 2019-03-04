<?php 


include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("Reservations");

if($moduleInstance){
    // Schema Setup
	$blockInstance = Vtiger_Block::getInstance("LBL_Reservations_INFORMATION",$moduleInstance);

	$fieldInstance = Vtiger_Field::getInstance('habuso', $moduleInstance);

	if( $fieldInstance ){
		$fieldInstance->delete();
	}
	else{
		$fieldInstance = Vtiger_Field::getInstance('habuso', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'habuso';
			$fieldInstance->label   = 'Tipo de Habitación Uso';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'habuso';
			$fieldInstance->columntype  = 'VARCHAR(150)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}
	}

	$fieldInstance = Vtiger_Field::getInstance('habfac', $moduleInstance);

	if( $fieldInstance ){
		$fieldInstance->delete();
	}
	else{
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'habfac';
			$fieldInstance->label   = 'Tipo de Habitación Factura';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'habfac';
			$fieldInstance->columntype  = 'VARCHAR(150)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}
	}

	$fieldInstance = Vtiger_Field::getInstance('imerial_week', $moduleInstance);

	if( $fieldInstance ){
		$fieldInstance->delete();
	}

	echo "Ok";
}

?>