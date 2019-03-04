<?php 

$actualizarCampos = true;

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("Reservations");

if($moduleInstance){
    // Schema Setup
	$blockInstance = Vtiger_Block::getInstance("LBL_Reservations_INFORMATION",$moduleInstance);

	/*$fieldInstance = Vtiger_Field::getInstance('trato', $moduleInstance);

	if($fieldInstance){
		$fieldInstance->delete();

		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'trato';
		$fieldInstance->label   = 'Trato';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'trato';
		$fieldInstance->columntype  = 'varchar(50)';
		$fieldInstance->uitype   = 15;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
		$fieldInstance->setPicklistValues(Array("Cliente", "Invitado", "Personal", "VIP", "TS Fijo", "TS Flotante", "TS Alq. Prop.", "TS Alq. Emp.", "TS Intercambio", "TS Puntos"));
	}*/

	$fieldInstance = Vtiger_Field::getInstance('imerial_week', $moduleInstance);

	if($fieldInstance)
		$fieldInstance->delete();

	$fieldInstance = Vtiger_Field::getInstance('imperial_week', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'imperial_week';
		$fieldInstance->label   = 'Imperial Week';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'imperial_week';
		$fieldInstance->columntype  = 'VARHCAR(150)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('bono', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'bono';
		$fieldInstance->label   = 'Bono';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'bono';
		$fieldInstance->columntype  = 'varchar(50)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('observaciones_contrato', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'observaciones_contrato';
		$fieldInstance->label   = 'Observaciones Contrato';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'observaciones_contrato';
		$fieldInstance->columntype  = 'varchar(1500)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('nacionalidad', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'nacionalidad';
		$fieldInstance->label   = 'Nacionalidad';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'nacionalidad';
		$fieldInstance->columntype  = 'varchar(50)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}


	$fieldInstance = Vtiger_Field::getInstance('apellido_primer_ocupante', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'apellido_primer_ocupante';
		$fieldInstance->label   = 'Apellido Primer Ocupante';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'apellido_primer_ocupante';
		$fieldInstance->columntype  = 'varchar(75)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('hora_venta', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'hora_venta';
		$fieldInstance->label   = 'Hora Venta';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'hora_venta';
		$fieldInstance->columntype  = 'varchar(30)';
		$fieldInstance->uitype   = 116;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('fecha_borrado', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'fecha_borrado';
		$fieldInstance->label   = 'Fecha de Borrado';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'fecha_borrado';
		$fieldInstance->columntype  = 'DATE';
		$fieldInstance->uitype   = 5;
		$fieldInstance->typeofdata  = 'D~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('club_fidelizacion', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'club_fidelizacion';
		$fieldInstance->label   = 'Club de Fidelización';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'club_fidelizacion';
		$fieldInstance->columntype  = 'varchar(5)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	echo "Ok";
}
?>