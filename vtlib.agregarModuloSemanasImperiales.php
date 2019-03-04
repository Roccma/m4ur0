<?php 

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("SemanasImperiales");

if(!$moduleInstance){		
	$moduleInstance = new Vtiger_Module();
    $moduleInstance->name = "SemanasImperiales";
    $moduleInstance->parent = "Sales";
    $moduleInstance->save();

    $moduleInstance->initTables();
    mkdir("modules/SemanasImperiales");
}

if($moduleInstance){
	$blockInstance = Vtiger_Block::getInstance("LBL_SemanasImperiales_INFORMATION",$moduleInstance);
	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_SemanasImperiales_INFORMATION";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('semanaimperialid', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'semanaimperialid';
			$fieldInstance->label   = 'semanaimperialid';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'semanaimperialid';
			$fieldInstance->columntype  = 'varchar(19)';
			$fieldInstance->uitype   = 4;/* es un autonumerico que va a ser la clave */
			$fieldInstance->typeofdata  = 'V~O';
			$fieldInstance->displaytype  = 3;
			$blockInstance->addField($fieldInstance); /* Creates the field and adds to block */
			$moduleInstance->setEntityIdentifier($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('iwcuenta', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'iwcuenta';
			$fieldInstance->label   = 'Membresía';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'iwcuenta';
			$fieldInstance->columntype  = 'varchar(50)';
			$fieldInstance->uitype   = 10;
			$fieldInstance->typeofdata  = 'V~M';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setRelatedModules(Array("Accounts"));
		}

		$membresia = $fieldInstance;
		
		$fieldInstance = Vtiger_Field::getInstance('iwtipo', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'iwtipo';
			$fieldInstance->label   = 'Tipo';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'iwtipo';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
			
		}

		$tipo = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('iwadultos', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'iwadultos';
			$fieldInstance->label   = 'Adultos';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'iwadultos';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
			
		}

		$adultos = $fieldInstance;


		$fieldInstance = Vtiger_Field::getInstance('iwmenores', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'iwmenores';
			$fieldInstance->label   = 'Menores';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'iwmenores';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
			
		}

		$menores = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('iwnoches', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'iwnoches';
			$fieldInstance->label   = 'Noches';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'iwnoches';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
			
		}

		$noches = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('iwvacaciones', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'iwvacaciones';
			$fieldInstance->label   = 'Vacaciones';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'iwvacaciones';
			$fieldInstance->columntype  = 'boolean';
			$fieldInstance->uitype   = 56;
			$fieldInstance->typeofdata  = 'C~O';
			$blockInstance->addField($fieldInstance);
			
		}

		$vacaciones = $fieldInstance;
		

		$fieldInstance = Vtiger_Field::getInstance('iwvalor', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'iwvalor';
			$fieldInstance->label   = 'Valor';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'iwvalor';
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
		$filter1->addField($membresia)->addField($tipo,1)->addField($adultos, 2)->addField($menores, 3)->addField($noches, 4)->addField($valor, 5);
		
		/*
		$moduleInstance->addLink("SIDEBARLINK", "Configurar api", "index.php?module=Instagram&view=Index");

		$moduleInstance->addLink("SIDEBARLINK", "Obtener datos", "index.php?module=Instagram&view=Feed");
		*/

		echo "Ok";

} 


?>
	