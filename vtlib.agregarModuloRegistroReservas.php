<?php 

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("SolicitudesReservas");

if(!$moduleInstance){		
	$moduleInstance = new Vtiger_Module();
    $moduleInstance->name = "SolicitudesReservas";
    $moduleInstance->parent = "Sales";
    $moduleInstance->save();

    // Schema Setup
    $moduleInstance->initTables();
    mkdir("modules/SolicitudesReservas");
}

if($moduleInstance){
    // Schema Setup
	$blockInstance = Vtiger_Block::getInstance("LBL_SolicitudesReservas_INFORMATION",$moduleInstance);
	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_SolicitudesReservas_INFORMATION";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('solicitudreservaid', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'solicitudreservaid';
			$fieldInstance->label   = 'Solicitud Reserva ID';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'solicitudreservaid';
			$fieldInstance->columntype  = 'varchar(19)';
			$fieldInstance->uitype   = 4;/* es un autonumerico que va a ser la clave */
			$fieldInstance->typeofdata  = 'V~M';
			$blockInstance->addField($fieldInstance); /* Creates the field and adds to block */
			$moduleInstance->setEntityIdentifier($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('rescontacto', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'rescontacto';
			$fieldInstance->label   = 'Contacto';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'rescontacto';
			$fieldInstance->columntype  = 'varchar(50)';
			$fieldInstance->uitype   = 10;
			$fieldInstance->typeofdata  = 'V~M';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setRelatedModules(Array("Contacts")); 
			
		}
		$rescontacto = $fieldInstance;
		
		$fieldInstance = Vtiger_Field::getInstance('resestado', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'resestado';
			$fieldInstance->label   = 'Estado';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'resestado';
			$fieldInstance->columntype  = 'varchar(25)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("Pendiente", "Confirmada"));

		}	
		$resestado = $fieldInstance;	

		$fieldInstance = Vtiger_Field::getInstance('resfechacom', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'resfechacom';
			$fieldInstance->label   = 'Fecha de Comienzo';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'resfechacom';
			$fieldInstance->columntype  = 'DATE';
			$fieldInstance->uitype   = 5;
			$fieldInstance->typeofdata  = 'D~O';
			$blockInstance->addField($fieldInstance);
			
		}
		$resfechacom = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('resfechafin', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'resfechafin';
			$fieldInstance->label   = 'Fecha de Fin';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'resfechafin';
			$fieldInstance->columntype  = 'DATE';
			$fieldInstance->uitype   = 5;
			$fieldInstance->typeofdata  = 'D~O';
			$blockInstance->addField($fieldInstance);
			
		}
		$resfechafin = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('resdias', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'resdias';
			$fieldInstance->label   = 'Días';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'resdias';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->displaytype = 2;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('rescorreo', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'rescorreo';
			$fieldInstance->label   = 'Correo electrónico';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'rescorreo';
			$fieldInstance->columntype  = 'VARCHAR(500)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			
		}
		$rescorreo = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('resnroconf', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'resnroconf';
			$fieldInstance->label   = 'Número de Confirmación';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'resnroconf';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('respasajeros', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'respasajeros';
			$fieldInstance->label   = 'Cantidad de Pasajeros';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'respasajeros';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('respasajero1', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'respasajero1';
			$fieldInstance->label   = 'Pasajero 1';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'respasajero1';
			$fieldInstance->columntype  = 'varchar(110)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			//$fieldInstance->setRelatedModules(Array("Contacts")); 
		}

		$fieldInstance = Vtiger_Field::getInstance('respasajero2', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'respasajero2';
			$fieldInstance->label   = 'Pasajero 2';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'respasajero2';
			$fieldInstance->columntype  = 'varchar(110)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			//$fieldInstance->setRelatedModules(Array("Contacts")); 
		}

		$fieldInstance = Vtiger_Field::getInstance('respasajero3', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'respasajero3';
			$fieldInstance->label   = 'Pasajero 3';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'respasajero3';
			$fieldInstance->columntype  = 'varchar(110)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			//$fieldInstance->setRelatedModules(Array("Contacts")); 
		}

		$fieldInstance = Vtiger_Field::getInstance('respasajero4', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'respasajero4';
			$fieldInstance->label   = 'Pasajero 4';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'respasajero4';
			$fieldInstance->columntype  = 'varchar(110)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			//$fieldInstance->setRelatedModules(Array("Contacts")); 
		}

		$fieldInstance = Vtiger_Field::getInstance('respasajero5', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'respasajero5';
			$fieldInstance->label   = 'Pasajero 5';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'respasajero5';
			$fieldInstance->columntype  = 'varchar(110)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			//$fieldInstance->setRelatedModules(Array("Contacts")); 
		}

		$fieldInstance = Vtiger_Field::getInstance('hotel', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'hotel';
			$fieldInstance->label   = 'Hotel';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'hotel';
			$fieldInstance->columntype  = 'varchar(50)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("SIRMX")); 
		}

		$fieldInstance = Vtiger_Field::getInstance('rescomentarios', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'rescomentarios';
			$fieldInstance->label   = 'Comentarios';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'rescomentarios';
			$fieldInstance->columntype  = 'varchar(1000)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("SIRMX")); 
		}
		
		$fieldInstance = Vtiger_Field::getInstance('resnochganada', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'resnochganada';
			$fieldInstance->label   = 'Cantidad de noches ganadas';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'resnochganada';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

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


		$moduleInstance = Vtiger_Module::getInstance("SolicitudesReservas");

		Vtiger_Filter::deleteForModule($moduleInstance); // borra los filtros si existieran

		$filter1 = new Vtiger_Filter();
		$filter1->name = 'All';
		$filter1->isdefault = true;
		$moduleInstance->addFilter($filter1);
		// Add fields to the filter created
		$filter1->addField($rescontacto)->addField($resestado,1)->addField($resfechacom, 2)->addField($resfechafin, 3)->addField($rescorreo, 4);

		echo "Agregando related list de Instagram a Contacts...<br>";

		
		/*
		$moduleInstance->addLink("SIDEBARLINK", "Configurar api", "index.php?module=Instagram&view=Index");

		$moduleInstance->addLink("SIDEBARLINK", "Obtener datos", "index.php?module=Instagram&view=Feed");
		*/

		echo "Ok";

} 


?>
	