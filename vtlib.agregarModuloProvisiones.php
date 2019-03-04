<?php 

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("Provisions");

if(!$moduleInstance){		
	$moduleInstance = new Vtiger_Module();
    $moduleInstance->name = "Provisions";
    $moduleInstance->parent = "Sales";
    $moduleInstance->save();

    $moduleInstance->initTables();
    mkdir("modules/Provisions");
}

if($moduleInstance){
	$blockInstance = Vtiger_Block::getInstance("LBL_Provisions_INFORMATION",$moduleInstance);
	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_Provisions_INFORMATION";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('provisionid', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'provisionid';
			$fieldInstance->label   = 'provisionid';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'provisionid';
			$fieldInstance->columntype  = 'varchar(19)';
			$fieldInstance->uitype   = 4;/* es un autonumerico que va a ser la clave */
			$fieldInstance->typeofdata  = 'V~O';
			$fieldInstance->displaytype  = 3;
			$blockInstance->addField($fieldInstance); /* Creates the field and adds to block */
			$moduleInstance->setEntityIdentifier($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('prcuenta', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'prcuenta';
			$fieldInstance->label   = 'Membresía';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'prcuenta';
			$fieldInstance->columntype  = 'varchar(50)';
			$fieldInstance->uitype   = 10;
			$fieldInstance->typeofdata  = 'V~M';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setRelatedModules(Array("Accounts"));
		}

		$membresia = $fieldInstance;
		
		$fieldInstance = Vtiger_Field::getInstance('prcantidad', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'prcantidad';
			$fieldInstance->label   = 'Cantidad';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'prcantidad';
			$fieldInstance->columntype  = 'int(4)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
			
		}

		$cantidad = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('prprovision', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'prprovision';
			$fieldInstance->label   = 'Provisión';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'prprovision';
			$fieldInstance->columntype  = 'varchar(500)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			
		}

		$provision = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('prvalor', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'prvalor';
			$fieldInstance->label   = 'Valor';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'prvalor';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
			
		}

		$valor = $fieldInstance;

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
		$filter1->addField($membresia)->addField($cantidad,1)->addField($provision, 2)->addField($valor, 3);
		
		/*
		$moduleInstance->addLink("SIDEBARLINK", "Configurar api", "index.php?module=Instagram&view=Index");

		$moduleInstance->addLink("SIDEBARLINK", "Obtener datos", "index.php?module=Instagram&view=Feed");
		*/

		echo "Ok";

} 


?>
	