<?php 

$actualizarCampos = true;

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("Reservations");

if($moduleInstance){
    // Schema Setup
	$blockInstance = Vtiger_Block::getInstance("LBL_Reservations_INFORMATION",$moduleInstance);

	$fieldInstance = Vtiger_Field::getInstance('tipofacturacion', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'tipofacturacion';
		$fieldInstance->label   = 'Tipo de Facturación estancia';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'tipofacturacion';
		$fieldInstance->columntype  = 'varchar(50)';
		$fieldInstance->uitype   = 15;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
		$fieldInstance->setPicklistValues(Array("Agencia", "Directo")); 
	}

	$fieldInstance = Vtiger_Field::getInstance('ttoo', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'ttoo';
		$fieldInstance->label   = 'Tour Operator';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'ttoo';
		$fieldInstance->columntype  = 'varchar(50)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('cliente', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'cliente';
		$fieldInstance->label   = 'Cliente';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'cliente';
		$fieldInstance->columntype  = 'varchar(500)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('estado', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'estado';
		$fieldInstance->label   = 'Estado';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'estado';
		$fieldInstance->columntype  = 'varchar(50)';
		$fieldInstance->uitype   = 15;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
		$fieldInstance->setPicklistValues(Array("Reserva", "Anulada", "Entrada", "Salida", "No Show")); 
	}

	$fieldInstance = Vtiger_Field::getInstance('tarifa', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'tarifa';
		$fieldInstance->label   = 'Tarifa';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'tarifa';
		$fieldInstance->columntype  = 'varchar(500)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('subtrato', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'subtrato';
		$fieldInstance->label   = 'SubTrato';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'subtrato';
		$fieldInstance->columntype  = 'varchar(150)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('coddingus', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'coddingus';
		$fieldInstance->label   = 'Código Dingus';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'coddingus';
		$fieldInstance->columntype  = 'varchar(150)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('salimpre', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'salimpre';
		$fieldInstance->label   = 'Salida imprevista';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'salimpre';
		$fieldInstance->columntype  = 'boolean';
		$fieldInstance->uitype   = 56;
		$fieldInstance->typeofdata  = 'C~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('cantadultos', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'cantadultos';
		$fieldInstance->label   = 'Cantidad de Adultos';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'cantadultos';
		$fieldInstance->columntype  = 'int';
		$fieldInstance->uitype   = 7;
		$fieldInstance->typeofdata  = 'NN~O~10,0';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('cantadol', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'cantadol';
		$fieldInstance->label   = 'Cantidad de Adolescentes';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'cantadol';
		$fieldInstance->columntype  = 'int';
		$fieldInstance->uitype   = 7;
		$fieldInstance->typeofdata  = 'NN~O~10,0';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('cantninos', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'cantninos';
		$fieldInstance->label   = 'Cantidad de Niños';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'cantninos';
		$fieldInstance->columntype  = 'int';
		$fieldInstance->uitype   = 7;
		$fieldInstance->typeofdata  = 'NN~O~10,0';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('cantcunas', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'cantcunas';
		$fieldInstance->label   = 'Cantidad de Cunas';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'cantcunas';
		$fieldInstance->columntype  = 'int';
		$fieldInstance->uitype   = 7;
		$fieldInstance->typeofdata  = 'NN~O~10,0';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('horllegada', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'horllegada';
		$fieldInstance->label   = 'Hora de llegada';
		$fieldInstance->table   = "vtiger_reservations";
		$fieldInstance->column   = 'horllegada';
		$fieldInstance->columntype  = 'varchar(150)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}


	$moduleContacts = Vtiger_Module::getInstance('Contacts');
	$moduleMembresias = Vtiger_Module::getInstance('Accounts');
	// Initialize all the tables required
	$moduleInstance->setRelatedList($moduleContacts, 'Contactos', Array('ADD','SELECT'),'get_related_list');
	$moduleInstance->setRelatedList($moduleMembresias, 'Membresías', Array('ADD','SELECT'),'get_dependents_list');

	echo "Ok";

} 


?>
	