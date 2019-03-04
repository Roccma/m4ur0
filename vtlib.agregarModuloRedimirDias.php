<?php 

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("RedimirDias");

if(!$moduleInstance){		
	$moduleInstance = new Vtiger_Module();
    $moduleInstance->name = "RedimirDias";
    $moduleInstance->parent = "Sales";
    $moduleInstance->save();

    // Schema Setup
    $moduleInstance->initTables();
    mkdir("modules/RedimirDias");
}

if($moduleInstance){
    // Schema Setup
	$blockInstance = Vtiger_Block::getInstance("LBL_RedimirDias_INFORMATION",$moduleInstance);
	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_RedimirDias_INFORMATION";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('redimirdiaid', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'redimirdiaid';
			$fieldInstance->label   = 'Redimir Días ID';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'redimirdiaid';
			$fieldInstance->columntype  = 'varchar(19)';
			$fieldInstance->uitype   = 4;/* es un autonumerico que va a ser la clave */
			$fieldInstance->typeofdata  = 'V~M';
			$fieldInstance->displaytype = 3;
			$blockInstance->addField($fieldInstance); /* Creates the field and adds to block */
			$moduleInstance->setEntityIdentifier($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('redcontacto', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'redcontacto';
			$fieldInstance->label   = 'Contacto';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'redcontacto';
			$fieldInstance->columntype  = 'varchar(50)';
			$fieldInstance->uitype   = 10;
			$fieldInstance->typeofdata  = 'V~M';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setRelatedModules(Array("Contacts")); 
			
		}
		$redcontacto = $fieldInstance;
		
		$fieldInstance = Vtiger_Field::getInstance('redestado', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'redestado';
			$fieldInstance->label   = 'Estado';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'redestado';
			$fieldInstance->columntype  = 'varchar(25)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("Pendiente", "Confirmada"));

		}	
		$redestado = $fieldInstance;	

		$fieldInstance = Vtiger_Field::getInstance('redfechacom', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'redfechacom';
			$fieldInstance->label   = 'Fecha de Comienzo';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'redfechacom';
			$fieldInstance->columntype  = 'DATE';
			$fieldInstance->uitype   = 5;
			$fieldInstance->typeofdata  = 'D~O';
			$blockInstance->addField($fieldInstance);
			
		}
		$redfechacom = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('redfechafin', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'redfechafin';
			$fieldInstance->label   = 'Fecha de Fin';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'redfechafin';
			$fieldInstance->columntype  = 'DATE';
			$fieldInstance->uitype   = 5;
			$fieldInstance->typeofdata  = 'D~O';
			$blockInstance->addField($fieldInstance);
			
		}
		$redfechafin = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('reddias', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'reddias';
			$fieldInstance->label   = 'Días';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'reddias';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->displaytype = 2;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('redcorreo', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'redcorreo';
			$fieldInstance->label   = 'Correo electrónico';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'redcorreo';
			$fieldInstance->columntype  = 'VARCHAR(500)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			
		}
		$redcorreo = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('rednroconf', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'rednroconf';
			$fieldInstance->label   = 'Número de Confirmación';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'rednroconf';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('redpasajeros', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'redpasajeros';
			$fieldInstance->label   = 'Cantidad de Pasajeros';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'redpasajeros';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('redpasajero1', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'redpasajero1';
			$fieldInstance->label   = 'Pasajero 1';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'redpasajero1';
			$fieldInstance->columntype  = 'varchar(110)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			//$fieldInstance->setRelatedModules(Array("Contacts")); 
		}

		$fieldInstance = Vtiger_Field::getInstance('redpasajero2', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'redpasajero2';
			$fieldInstance->label   = 'Pasajero 2';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'redpasajero2';
			$fieldInstance->columntype  = 'varchar(110)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			//$fieldInstance->setRelatedModules(Array("Contacts")); 
		}

		$fieldInstance = Vtiger_Field::getInstance('redpasajero3', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'redpasajero3';
			$fieldInstance->label   = 'Pasajero 3';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'redpasajero3';
			$fieldInstance->columntype  = 'varchar(110)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			//$fieldInstance->setRelatedModules(Array("Contacts")); 
		}

		$fieldInstance = Vtiger_Field::getInstance('redpasajero4', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'redpasajero4';
			$fieldInstance->label   = 'Pasajero 4';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'redpasajero4';
			$fieldInstance->columntype  = 'varchar(110)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			//$fieldInstance->setRelatedModules(Array("Contacts")); 
		}

		$fieldInstance = Vtiger_Field::getInstance('redpasajero5', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'redpasajero5';
			$fieldInstance->label   = 'Pasajero 5';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'redpasajero5';
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

		$fieldInstance = Vtiger_Field::getInstance('redcomentarios', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'redcomentarios';
			$fieldInstance->label   = 'Comentarios';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'redcomentarios';
			$fieldInstance->columntype  = 'varchar(1000)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("SIRMX")); 
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


		$moduleInstance = Vtiger_Module::getInstance("RedimirDias");

		Vtiger_Filter::deleteForModule($moduleInstance);

		$filter1 = new Vtiger_Filter();
		$filter1->name = 'All';
		$filter1->isdefault = true;
		$moduleInstance->addFilter($filter1);
		// Add fields to the filter created
		$filter1->addField($redcontacto)->addField($redestado,1)->addField($redfechacom, 2)->addField($redfechafin, 3)->addField($redcorreo, 4);

		echo "Agregando related list de Instagram a Contacts...<br>";

		
		/*
		$moduleInstance->addLink("SIDEBARLINK", "Configurar api", "index.php?module=Instagram&view=Index");

		$moduleInstance->addLink("SIDEBARLINK", "Obtener datos", "index.php?module=Instagram&view=Feed");
		*/

		echo "Ok";

} 


?>
	