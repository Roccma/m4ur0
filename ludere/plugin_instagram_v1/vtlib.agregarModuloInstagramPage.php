<?php 

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("InstagramPage");

if(!$moduleInstance){		
	$moduleInstance = new Vtiger_Module();
    $moduleInstance->name = "InstagramPage";
    $moduleInstance->parent = "Analytics";
    $moduleInstance->save();

    // Schema Setup
    $moduleInstance->initTables();
    mkdir("modules/InstagramPage");
}

if($moduleInstance){
	$blockInstance = Vtiger_Block::getInstance("LBL_InstagramPage_INFORMATION",$moduleInstance);
	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_InstagramPage_INFORMATION";
		$moduleInstance->addBlock($blockInstance); 
	}
	
		$igpid = Vtiger_Field::getInstance('igpid', $moduleInstance);
 
		if(!$igpid) {
			$igpid = new Vtiger_Field();
			$igpid->name   = 'igpid';
			$igpid->label   = 'igpid';
			$igpid->table   = $moduleInstance->basetable;
			$igpid->column   = 'igpid';
			$igpid->columntype  = 'varchar(19)';
			$igpid->uitype   = 4;/* es un autonumerico que va a ser la clave */
			$igpid->typeofdata  = 'V~M';
			$blockInstance->addField($igpid); /* Creates the field and adds to block */
			$moduleInstance->setEntityIdentifier($igpid);
		}

		$igpage_id = Vtiger_Field::getInstance('igpage_id',$moduleInstance); 

		if(!$igpage_id){
			$igpage_id = new Vtiger_Field();
	        $igpage_id->name = 'igpage_id';
	        $igpage_id->label = $igpage_id->name;
	        $igpage_id->uitype = 1; //Tipo Varchar
	        $igpage_id->column = $igpage_id->name;
	        $igpage_id->table = $moduleInstance->basetable;
	        $igpage_id->columntype = 'VARCHAR(50)';
	        $igpage_id->typeofdata = 'V~M';
	        $blockInstance->addField($igpage_id); //Agrega el campo al bloque

		}

		$igppage_name = Vtiger_Field::getInstance('igppage_name',$moduleInstance); 

		if(!$igppage_name){
			$igppage_name = new Vtiger_Field();
	        $igppage_name->name = 'igppage_name';
	        $igppage_name->label = $igppage_name->name;
	        $igppage_name->uitype = 1; //Tipo Varchar
	        $igppage_name->column = $igppage_name->name;
	        $igppage_name->table = $moduleInstance->basetable;
	        $igppage_name->columntype = 'VARCHAR(100)';
	        $igppage_name->typeofdata = 'V~M';
	        $blockInstance->addField($igppage_name); //Agrega el campo al bloque

		}

		$igptoken_date =  Vtiger_Field::getInstance("igptoken_date",$moduleInstance);
		if(!$igptoken_date){
			$igptoken_date = new Vtiger_Field();
         	$igptoken_date->name = "igptoken_date";
         	$igptoken_date->label = "igptoken_date";
         	$igptoken_date->uitype = 5;
	     	$igptoken_date->typeofdata = "D~O";
	     	$igptoken_date->table = $moduleInstance->basetable;
	     	$igptoken_date->column = "igptoken_date";
	     	$igptoken_date->columntype = "date";
	     	$igptoken_date->quickcreate = 1; 	     	
	     	$igptoken_date->masseditable = 1; 
	     	$igptoken_date->displaytype = 1; 
	     	$igptoken_date->presence = 2;
			$blockInstance->addField($igptoken_date);
		}

		$igpaccess_token = Vtiger_Field::getInstance('igpaccess_token',$moduleInstance); 

		if(!$igpaccess_token){
			$igpaccess_token = new Vtiger_Field();
	        $igpaccess_token->name = 'igpaccess_token';
	        $igpaccess_token->label = $igpaccess_token->name;
	        $igpaccess_token->uitype = 1; //Tipo Varchar
	        $igpaccess_token->column = $igpaccess_token->name;
	        $igpaccess_token->table = $moduleInstance->basetable;
	        $igpaccess_token->columntype = 'VARCHAR(200)';
	        $igpaccess_token->typeofdata = 'V~M';
	        $blockInstance->addField($igpaccess_token); //Agrega el campo al bloque

		}

		$igpactive =  Vtiger_Field::getInstance("igpactive",$moduleInstance);
		
		if(!$igpactive){
			$igpactive = new Vtiger_Field();
         	$igpactive->name = "igpactive";
         	$igpactive->label = "igpactive";
         	$igpactive->uitype = 56;
	     	$igpactive->typeofdata = "C~O";
	     	$igpactive->table = $moduleInstance->basetable;
	     	$igpactive->column = "igpactive";
	     	$igpactive->columntype = "varchar(3)";
	     	$igpactive->quickcreate = 1; 
	     	
	     	$igpactive->masseditable = 2; 
	     	$igpactive->displaytype = 1; 
	     	$igpactive->presence = 1;
			$blockInstance->addField($igpactive);
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
		$filter1->addField($igpage_id)->addField($igppage_name,1)->addField($igptoken_date, 2);

		
		/*
		$moduleInstance->addLink("SIDEBARLINK", "Configurar api", "index.php?module=Facebook&view=Index");

		$moduleInstance->addLink("SIDEBARLINK", "Obtener datos", "index.php?module=Facebook&view=Feed");
		*/

		echo "Ok";

} 


?>
	