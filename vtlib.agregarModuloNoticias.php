<?php 

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("Noticias");

if(!$moduleInstance){		
	$moduleInstance = new Vtiger_Module();
    $moduleInstance->name = "Noticias";
    $moduleInstance->parent = "Support";
    $moduleInstance->save();

    // Schema Setup
    $moduleInstance->initTables();
    mkdir("modules/Noticias");
}

if($moduleInstance){
    // Schema Setup
	$blockInstance = Vtiger_Block::getInstance("LBL_Noticias_INFORMATION",$moduleInstance);
	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_Noticias_INFORMATION";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('noticiaid', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'noticiaid';
			$fieldInstance->label   = 'Noticia ID';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'noticiaid';
			$fieldInstance->columntype  = 'varchar(19)';
			$fieldInstance->uitype   = 4;/* es un autonumerico que va a ser la clave */
			$fieldInstance->typeofdata  = 'V~O';
			$fieldInstance->displaytype = 3;
			$blockInstance->addField($fieldInstance); /* Creates the field and adds to block */
			$moduleInstance->setEntityIdentifier($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('notresumen', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'notresumen';
			$fieldInstance->label   = 'Resumen';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'notresumen';
			$fieldInstance->columntype  = 'varchar(500)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~M';
			$blockInstance->addField($fieldInstance); 
			
		}
		$notresumen = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('notnoticia', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'notnoticia';
			$fieldInstance->label   = 'Noticia';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'notnoticia';
			$fieldInstance->columntype  = 'varchar(3500)';
			$fieldInstance->uitype   = 19;
			$fieldInstance->typeofdata  = 'V~M';
			$blockInstance->addField($fieldInstance); 
			
		}

		$fieldInstance = Vtiger_Field::getInstance('notdesde', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'notdesde';
			$fieldInstance->label   = 'Desde';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'notdesde';
			$fieldInstance->columntype  = 'date';
			$fieldInstance->uitype   = 5;
			$fieldInstance->typeofdata  = 'D~O';
			$blockInstance->addField($fieldInstance); 
			
		}

		$notdesde = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('nothasta', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'nothasta';
			$fieldInstance->label   = 'Hasta';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'nothasta';
			$fieldInstance->columntype  = 'date';
			$fieldInstance->uitype   = 5;
			$fieldInstance->typeofdata  = 'D~O';
			$blockInstance->addField($fieldInstance); 
			
		}

		$nothasta = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('notidioma', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'notidioma';
			$fieldInstance->label   = 'Idioma';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'notidioma';
			$fieldInstance->columntype  = 'varchar(100)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("English", "Spanish", "French", "German", "Other"));
		}
		/*else{
			$fieldInstance->delete();
		}*/

		$notidioma = $fieldInstance;

		$fieldInstance = Vtiger_Field::getInstance('notorden', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'notorden';
			$fieldInstance->label   = 'Orden';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'notorden';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

		$notorden = $fieldInstance;		
		
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


		$moduleInstance = Vtiger_Module::getInstance("Noticias");

		Vtiger_Filter::deleteForModule($moduleInstance); // borra los filtros si existieran

		$filter1 = new Vtiger_Filter();
		$filter1->name = 'All';
		$filter1->isdefault = true;
		$moduleInstance->addFilter($filter1);
		// Add fields to the filter created
		$filter1->addField($notresumen)->addField($notdesde,1)->addField($nothasta, 2)->addField($notidioma, 3)->addField($notorden, 4);
		
		/*
		$moduleInstance->addLink("SIDEBARLINK", "Configurar api", "index.php?module=Instagram&view=Index");

		$moduleInstance->addLink("SIDEBARLINK", "Obtener datos", "index.php?module=Instagram&view=Feed");
		*/

		echo "Ok";

} 


?>
	