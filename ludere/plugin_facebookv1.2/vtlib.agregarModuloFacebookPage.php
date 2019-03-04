<?php 

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("FacebookPage");

if(!$moduleInstance){		
	$moduleInstance = new Vtiger_Module();
    $moduleInstance->name = "FacebookPage";
    $moduleInstance->parent = "Analytics";
    $moduleInstance->save();

    // Schema Setup
    $moduleInstance->initTables();
    mkdir("modules/FacebookPage");
}

if($moduleInstance){
	$blockInstance = Vtiger_Block::getInstance("LBL_FacebookPage_INFORMATION",$moduleInstance);
	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_FacebookPage_INFORMATION";
		$moduleInstance->addBlock($blockInstance); 
	}
	
		$fbpid = Vtiger_Field::getInstance('fbpid', $moduleInstance);
 
		if(!$fbpid) {
			$fbpid = new Vtiger_Field();
			$fbpid->name   = 'fbpid';
			$fbpid->label   = 'fbpid';
			$fbpid->table   = $moduleInstance->basetable;
			$fbpid->column   = 'fbpid';
			$fbpid->columntype  = 'varchar(19)';
			$fbpid->uitype   = 4;/* es un autonumerico que va a ser la clave */
			$fbpid->typeofdata  = 'V~M';
			$blockInstance->addField($fbpid); /* Creates the field and adds to block */
			$moduleInstance->setEntityIdentifier($fbpid);
		}

		$fbpage_id = Vtiger_Field::getInstance('fbpage_id',$moduleInstance); 

		if(!$fbpage_id){
			$fbpage_id = new Vtiger_Field();
	        $fbpage_id->name = 'fbpage_id';
	        $fbpage_id->label = $fbpage_id->name;
	        $fbpage_id->uitype = 1; //Tipo Varchar
	        $fbpage_id->column = $fbpage_id->name;
	        $fbpage_id->table = $moduleInstance->basetable;
	        $fbpage_id->columntype = 'VARCHAR(50)';
	        $fbpage_id->typeofdata = 'V~M';
	        $blockInstance->addField($fbpage_id); //Agrega el campo al bloque

		}

		$fbppage_name = Vtiger_Field::getInstance('fbppage_name',$moduleInstance); 

		if(!$fbppage_name){
			$fbppage_name = new Vtiger_Field();
	        $fbppage_name->name = 'fbppage_name';
	        $fbppage_name->label = $fbppage_name->name;
	        $fbppage_name->uitype = 1; //Tipo Varchar
	        $fbppage_name->column = $fbppage_name->name;
	        $fbppage_name->table = $moduleInstance->basetable;
	        $fbppage_name->columntype = 'VARCHAR(100)';
	        $fbppage_name->typeofdata = 'V~M';
	        $blockInstance->addField($fbppage_name); //Agrega el campo al bloque

		}

		$fbptoken_date =  Vtiger_Field::getInstance("fbptoken_date",$moduleInstance);
		if(!$fbptoken_date){
			$fbptoken_date = new Vtiger_Field();
         	$fbptoken_date->name = "fbptoken_date";
         	$fbptoken_date->label = "fbptoken_date";
         	$fbptoken_date->uitype = 5;
	     	$fbptoken_date->typeofdata = "D~O";
	     	$fbptoken_date->table = $moduleInstance->basetable;
	     	$fbptoken_date->column = "fbptoken_date";
	     	$fbptoken_date->columntype = "date";
	     	$fbptoken_date->quickcreate = 1; 	     	
	     	$fbptoken_date->masseditable = 1; 
	     	$fbptoken_date->displaytype = 1; 
	     	$fbptoken_date->presence = 2;
			$blockInstance->addField($fbptoken_date);
		}

		$fbpaccess_token = Vtiger_Field::getInstance('fbpaccess_token',$moduleInstance); 

		if(!$fbpaccess_token){
			$fbpaccess_token = new Vtiger_Field();
	        $fbpaccess_token->name = 'fbpaccess_token';
	        $fbpaccess_token->label = $fbpaccess_token->name;
	        $fbpaccess_token->uitype = 1; //Tipo Varchar
	        $fbpaccess_token->column = $fbpaccess_token->name;
	        $fbpaccess_token->table = $moduleInstance->basetable;
	        $fbpaccess_token->columntype = 'VARCHAR(200)';
	        $fbpaccess_token->typeofdata = 'V~M';
	        $blockInstance->addField($fbpaccess_token); //Agrega el campo al bloque

		}

		$fbpactive =  Vtiger_Field::getInstance("fbpactive",$moduleInstance);
		
		if(!$fbpactive){
			$fbpactive = new Vtiger_Field();
         	$fbpactive->name = "fbpactive";
         	$fbpactive->label = "fbpactive";
         	$fbpactive->uitype = 56;
	     	$fbpactive->typeofdata = "C~O";
	     	$fbpactive->table = $moduleInstance->basetable;
	     	$fbpactive->column = "fbpactive";
	     	$fbpactive->columntype = "varchar(3)";
	     	$fbpactive->quickcreate = 1; 
	     	
	     	$fbpactive->masseditable = 2; 
	     	$fbpactive->displaytype = 1; 
	     	$fbpactive->presence = 1;
			$blockInstance->addField($fbpactive);
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
		$filter1->addField($fbpage_id)->addField($fbppage_name,1)->addField($fbptoken_date, 2);

		
		/*
		$moduleInstance->addLink("SIDEBARLINK", "Configurar api", "index.php?module=Facebook&view=Index");

		$moduleInstance->addLink("SIDEBARLINK", "Obtener datos", "index.php?module=Facebook&view=Feed");
		*/

		echo "Ok";

} 


?>
	