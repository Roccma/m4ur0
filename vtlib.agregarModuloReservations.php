<?php 

$actualizarCampos = true;

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("Reservations");

if(!$moduleInstance){		
	$moduleInstance = new Vtiger_Module();
    $moduleInstance->name = "Reservations";
    $moduleInstance->parent = "Sales";
    $moduleInstance->save();

    // Schema Setup
    $moduleInstance->initTables();
    mkdir("modules/Reservations");
}

if($moduleInstance){
    // Schema Setup
	$blockInstance = Vtiger_Block::getInstance("LBL_Reservations_INFORMATION",$moduleInstance);
	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_Reservations_INFORMATION";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('reservaid', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'reservaid';
			$fieldInstance->label   = 'reservaid';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'reservaid';
			$fieldInstance->columntype  = 'varchar(19)';
			$fieldInstance->uitype   = 4;/* es un autonumerico que va a ser la clave */
			$fieldInstance->typeofdata  = 'V~M';
			$blockInstance->addField($fieldInstance); /* Creates the field and adds to block */
			$moduleInstance->setEntityIdentifier($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('hotel', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'hotel';
			$fieldInstance->label   = 'Hotel';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'hotel';
			$fieldInstance->columntype  = 'varchar(50)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~M';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("SIRMX")); 
		}

		$hotel = $fieldInstance;
		
		$fieldInstance = Vtiger_Field::getInstance('anio', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'anio';
			$fieldInstance->label   = 'Año';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'anio';
			$fieldInstance->columntype  = 'int(4)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~M~10,0';
			$blockInstance->addField($fieldInstance);
			
		}

		$anio = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('reserva', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'reserva';
			$fieldInstance->label   = 'Reserva';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'reserva';
			$fieldInstance->columntype  = 'int(10)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~M~10,0';
			$blockInstance->addField($fieldInstance);
			
		}

		$reserva = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('desglose', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'desglose';
			$fieldInstance->label   = 'Desglose';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'desglose';
			$fieldInstance->columntype  = 'int(3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
			
		}

		$desglose = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('fecha_venta', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'fecha_venta';
			$fieldInstance->label   = 'Fecha de venta';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'fecha_venta';
			$fieldInstance->columntype  = 'DATE';
			$fieldInstance->uitype   = 5;
			$fieldInstance->typeofdata  = 'D~O';
			$blockInstance->addField($fieldInstance);
			
		}

		$fecha_venta = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('agencia', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'agencia';
			$fieldInstance->label   = 'Agencia';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'agencia';
			$fieldInstance->columntype  = 'VARCHAR(150)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}


		$fieldInstance = Vtiger_Field::getInstance('fecha_entrada', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'fecha_entrada';
			$fieldInstance->label   = 'Fecha de entrada';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'fecha_entrada';
			$fieldInstance->columntype  = 'DATE';
			$fieldInstance->uitype   = 5;
			$fieldInstance->typeofdata  = 'D~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('fecha_salida', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'fecha_salida';
			$fieldInstance->label   = 'Fecha de salida';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'fecha_salida';
			$fieldInstance->columntype  = 'DATE';
			$fieldInstance->uitype   = 5;
			$fieldInstance->typeofdata  = 'D~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('noches', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'noches';
			$fieldInstance->label   = 'Noches';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'noches';
			$fieldInstance->columntype  = 'int(3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('trato', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'trato';
			$fieldInstance->label   = 'Trato';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'trato';
			$fieldInstance->columntype  = 'VARCHAR(250)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('habuso', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'habuso';
			$fieldInstance->label   = 'Habitación Uso';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'habuso';
			$fieldInstance->columntype  = 'boolean';
			$fieldInstance->uitype   = 56;
			$fieldInstance->typeofdata  = 'C~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('habfac', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'habfac';
			$fieldInstance->label   = 'Habitación facturó';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'habfac';
			$fieldInstance->columntype  = 'boolean';
			$fieldInstance->uitype   = 56;
			$fieldInstance->typeofdata  = 'C~O';
			$blockInstance->addField($fieldInstance);
		}

		echo "aca";

		$fieldInstance = Vtiger_Field::getInstance('membresia', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'membresia';
			$fieldInstance->label   = 'Membresia';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'membresia';
			$fieldInstance->columntype  = 'VARHCAR(50)';
			$fieldInstance->uitype   = 10;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setRelatedModules(Array("Accounts"));
		}
		else{
			$fieldInstance->delete();
		}

		$fieldInstance = Vtiger_Field::getInstance('promocod', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'promocod';
			$fieldInstance->label   = 'Promocod';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'promocod';
			$fieldInstance->columntype  = 'VARHCAR(150)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}
		else{
			$fieldInstance->delete();
		}

		$fieldInstance = Vtiger_Field::getInstance('imerial_week', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'imerial_week';
			$fieldInstance->label   = 'ImerialWeek';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'imerial_week';
			$fieldInstance->columntype  = 'VARHCAR(150)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}
		else{
			$fieldInstance->delete();
		}

		$fieldInstance = Vtiger_Field::getInstance('contactos', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'contactos';
			$fieldInstance->label   = 'Contactos';
			$fieldInstance->table   = "vtiger_reservations";
			$fieldInstance->column   = 'contactos';
			$fieldInstance->columntype  = 'VARHCAR(1500)';
			$fieldInstance->uitype   = 33;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}
		else{
			$fieldInstance->delete();
		}
		
		
		// Campos comunes recomendados

        //Campo assigned_user_id
        $assigneduserid = Vtiger_Field::getInstance("assigned_user_id",$moduleInstance);
        
        if(!$assigneduserid){ //Si no existe crea el campo assigned_user_id
        	$assigneduserid = new Vtiger_Field();
	        $assigneduserid->name = "assigned_user_id";
	        $assigneduserid->label = "Assigned To";
	        $assigneduserid->table = "vtiger_crmentity";
	        $assigneduserid->column = "smownerid";
	        $assigneduserid->uitype = 53;
	        $assigneduserid->typeofdata = "V~M";
	        $blockInstance->addField($assigneduserid); //Agrega el campo al bloque
        }

        //Campo CreatedTime
        $createdtime = Vtiger_Field::getInstance("CreatedTime",$moduleInstance);
        
        if(!$createdtime){ //Si no existe crea el campo CreatedTime
	        $createdtime = new Vtiger_Field();
	        $createdtime->name = "CreatedTime";
	        $createdtime->label= "Created Time";
	        $createdtime->table = "vtiger_crmentity";
	        $createdtime->column = "createdtime";
	        $createdtime->uitype = 70;
	        $createdtime->typeofdata = "T~O";
	        $createdtime->displaytype= 2;
	        $blockInstance->addField($createdtime);//Agrega el campo al bloque
        }

        //Campo ModifiedTime
		$modifiedtime = Vtiger_Field::getInstance("ModifiedTime",$moduleInstance);

		if(!$modifiedtime){	//Si no existe crea el campo ModifiedTime
			$modifiedtime = new Vtiger_Field();
	        $modifiedtime->name = "ModifiedTime";
	        $modifiedtime->label= "Modified Time";
	        $modifiedtime->table = "vtiger_crmentity";
	        $modifiedtime->column = "modifiedtime";
	        $modifiedtime->uitype = 70;
	        $modifiedtime->typeofdata = "T~O";
			$modifiedtime->displaytype= 2;
	        $blockInstance->addField($modifiedtime);
		}

		/** Set sharing access of this module */
		$moduleInstance->setDefaultSharing('Public'); 

		/** Enable and Disable available tools */
		$moduleInstance->enableTools(Array('Import', 'Export'));
		$moduleInstance->disableTools('Merge');

		$moduleInstance->initWebservice();

		Vtiger_Filter::deleteForModule($moduleInstance); // borra los filtros si existieran
		$filter1 = new Vtiger_Filter();
		$filter1->name = 'All';
		$filter1->isdefault = true;
		$moduleInstance->addFilter($filter1);
		// Add fields to the filter created
		$filter1->addField($hotel)->addField($anio,1)->addField($reserva, 2)->addField($desglose, 3)->addField($fecha_venta, 4);

		echo "Agregando related list de Instagram a Contacts...<br>";

		
		/*
		$moduleInstance->addLink("SIDEBARLINK", "Configurar api", "index.php?module=Instagram&view=Index");

		$moduleInstance->addLink("SIDEBARLINK", "Obtener datos", "index.php?module=Instagram&view=Feed");
		*/

		echo "Ok";

} 


?>
	