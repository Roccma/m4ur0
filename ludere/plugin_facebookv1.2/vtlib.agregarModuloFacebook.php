<?php 

$actualizarCampos = false;

include_once("vtlib/Vtiger/Module.php");
require_once('modules/Settings/MenuEditor/models/Module.php');

$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("Facebook");

if(!$moduleInstance){		
	$moduleInstance = new Vtiger_Module();
    $moduleInstance->name = "Facebook";
    $moduleInstance->parent = "Tools";
    $moduleInstance->save();

    // Schema Setup
    $moduleInstance->initTables();
    mkdir("modules/Facebook");
    Settings_MenuEditor_Module_Model::addModuleToApp($moduleInstance->id,'Tools');
}


if($moduleInstance){
	$blockInstance = Vtiger_Block::getInstance("LBL_Facebook_INFORMATION",$moduleInstance);
	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_Facebook_INFORMATION";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fbentityid = Vtiger_Field::getInstance('fbentityid', $moduleInstance);
 
		if(!$fbentityid) {
			$fbentityid = new Vtiger_Field();
			$fbentityid->name   = 'fbentityid';
			$fbentityid->label   = 'fbentityid';
			$fbentityid->table   = $moduleInstance->basetable;
			$fbentityid->column   = 'fbentityid';
			$fbentityid->columntype  = 'varchar(19)';
			$fbentityid->uitype   = 4;/* es un autonumerico que va a ser la clave */
			$fbentityid->typeofdata  = 'V~M';
			$blockInstance->addField($fbentityid); /* Creates the field and adds to block */
			$moduleInstance->setEntityIdentifier($fbentityid);
		}
		
		$fbuser_id = Vtiger_Field::getInstance('fbuser_id',$moduleInstance); 

		if(!$fbuser_id){
			$fbuser_id = new Vtiger_Field();
	        $fbuser_id->name = 'fbuser_id';
	        $fbuser_id->label = $fbuser_id->name;
	        $fbuser_id->uitype = 1; //Tipo Varchar
	        $fbuser_id->column = $fbuser_id->name;
	        $fbuser_id->table = $moduleInstance->basetable;
	        $fbuser_id->columntype = 'VARCHAR(50)';
	        $fbuser_id->typeofdata = 'V~M';
	        $blockInstance->addField($fbuser_id); //Agrega el campo al bloque

		}

		$fbrelated_to =  Vtiger_Field::getInstance("fbrelated_to",$moduleInstance);
		if(!$fbrelated_to){
			$fbrelated_to = new Vtiger_Field();
         	$fbrelated_to->name = "fbrelated_to";
         	$fbrelated_to->label = "fbrelated_to";
         	$fbrelated_to->uitype = 10;
	     	$fbrelated_to->typeofdata = "I~O";
	     	$fbrelated_to->table = $moduleInstance->basetable;
	     	$fbrelated_to->column = "fbrelated_to";
	     	$fbrelated_to->columntype = "int(19)";
	     	$fbrelated_to->quickcreate = 0; 
			$blockInstance->addField($fbrelated_to);
 			$fbrelated_to->setRelatedModules( Array ("Contacts") );
		}

		$fbaction_type =  Vtiger_Field::getInstance("fbaction_type",$moduleInstance);
		if($fbaction_type && $actualizarCampos) $fbaction_type->delete();
		if(!$fbaction_type || $actualizarCampos){
			$fbaction_type = new Vtiger_Field();
         	$fbaction_type->name = "fbaction_type";
         	$fbaction_type->label = "fbaction_type";
         	$fbaction_type->uitype = 15;
	     	$fbaction_type->typeofdata = "V~O";
	     	$fbaction_type->table = $moduleInstance->basetable;
	     	$fbaction_type->column = "fbaction_type";
	     	$fbaction_type->columntype = "varchar(30)";
	     	$fbaction_type->quickcreate = 2; 
	     	
	     	$fbaction_type->masseditable = 1; 
	     	$fbaction_type->displaytype = 1; 
	     	$fbaction_type->presence = 2;
			$blockInstance->addField($fbaction_type);			
 			$fbaction_type->setPicklistValues( Array ("Like","Comentario","Reacci&oacute;n","Post","Mensaje") );
		}

		$fbcreated_time =  Vtiger_Field::getInstance("fbcreated_time",$moduleInstance);
		if(!$fbcreated_time){
			$fbcreated_time = new Vtiger_Field();
         	$fbcreated_time->name = "fbcreated_time";
         	$fbcreated_time->label = "fbcreated_time";
         	$fbcreated_time->uitype = 5;
	     	$fbcreated_time->typeofdata = "D~O";
	     	$fbcreated_time->table = $moduleInstance->basetable;
	     	$fbcreated_time->column = "fbcreated_time";
	     	$fbcreated_time->columntype = "date";
	     	$fbcreated_time->quickcreate = 1; 	     	
	     	$fbcreated_time->masseditable = 1; 
	     	$fbcreated_time->displaytype = 1; 
	     	$fbcreated_time->presence = 2;
			$blockInstance->addField($fbcreated_time);
		}

		$fbobject_id = Vtiger_Field::getInstance('fbobject_id',$moduleInstance); 

		if(!$fbobject_id){
			$fbobject_id = new Vtiger_Field();
	        $fbobject_id->name = 'fbobject_id';
	        $fbobject_id->label = $fbobject_id->name;
	        $fbobject_id->uitype = 1; //Tipo Varchar
	        $fbobject_id->column = $fbobject_id->name;
	        $fbobject_id->table = $moduleInstance->basetable;
	        $fbobject_id->columntype = 'VARCHAR(50)';
	        $fbobject_id->typeofdata = 'V~M';
	        $blockInstance->addField($fbobject_id); //Agrega el campo al bloque

		}

		$fblink =  Vtiger_Field::getInstance("fblink",$moduleInstance);
		if(!$fblink){
			$fblink = new Vtiger_Field();
         	$fblink->name = "fblink";
         	$fblink->label = "fblink";
         	$fblink->uitype = 17;
	     	$fblink->typeofdata = "V~O";
	     	$fblink->table = $moduleInstance->basetable;
	     	$fblink->column = "fblink";
	     	$fblink->columntype = "varchar(150)";
	     	$fblink->quickcreate = 2; 
	     	
	     	$fblink->masseditable = 1; 
	     	$fblink->displaytype = 1; 
	     	$fblink->presence = 2;
			$blockInstance->addField($fblink);
		}

		$fbdescription =  Vtiger_Field::getInstance("fbdescription",$moduleInstance);
		if(!$fbdescription){
			$fbdescription = new Vtiger_Field();
         	$fbdescription->name = "fbdescription";
         	$fbdescription->label = "fbdescription";
         	$fbdescription->uitype = 21;
	     	$fbdescription->typeofdata = "V~O";
	     	$fbdescription->table = $moduleInstance->basetable;
	     	$fbdescription->column = "fbdescription";
	     	$fbdescription->columntype = "varchar(500)";
	     	$fbdescription->quickcreate = 2; 
	     	
	     	$fbdescription->masseditable = 1; 
	     	$fbdescription->displaytype = 1; 
	     	$fbdescription->presence = 2;
			$blockInstance->addField($fbdescription);
		}

		$fbverified =  Vtiger_Field::getInstance("fbverified",$moduleInstance);
		
		if(!$fbverified){
			$fbverified = new Vtiger_Field();
         	$fbverified->name = "fbverified";
         	$fbverified->label = "fbverified";
         	$fbverified->uitype = 56;
	     	$fbverified->typeofdata = "C~O";
	     	$fbverified->table = $moduleInstance->basetable;
	     	$fbverified->column = "fbverified";
	     	$fbverified->columntype = "varchar(3)";
	     	$fbverified->quickcreate = 1; 
	     	
	     	$fbverified->masseditable = 2; 
	     	$fbverified->displaytype = 1; 
	     	$fbverified->presence = 1;
			$blockInstance->addField($fbverified);
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

		$fbuser_name = Vtiger_Field::getInstance('fbuser_name',$moduleInstance);

		if(!$fbuser_name){
			$fbuser_name = new Vtiger_Field();
	        $fbuser_name->name = 'fbuser_name';
	        $fbuser_name->label = $fbuser_name->name;
	        $fbuser_name->uitype = 1; //Tipo Varchar
	        $fbuser_name->column = $fbuser_name->name;
	        $fbuser_name->table = $moduleInstance->basetable;
	        $fbuser_name->columntype = 'VARCHAR(200)';
	        $fbuser_name->typeofdata = 'V~M';
	        $blockInstance->addField($fbuser_name); //Agrega el campo al bloque
		}

		$fbmessage_id = Vtiger_Field::getInstance('fbmessage_id',$moduleInstance);

		if(!$fbmessage_id){
			$fbmessage_id = new Vtiger_Field();
	        $fbmessage_id->name = 'fbmessage_id';
	        $fbmessage_id->label = $fbmessage_id->name;
	        $fbmessage_id->uitype = 1; //Tipo Varchar
	        $fbmessage_id->column = $fbmessage_id->name;
	        $fbmessage_id->table = $moduleInstance->basetable;
	        $fbmessage_id->columntype = 'VARCHAR(100)';
	        $fbmessage_id->typeofdata = 'V~O';
	        $blockInstance->addField($fbmessage_id); //Agrega el campo al bloque
		}

		$fbtimestamp =  Vtiger_Field::getInstance("fbtimestamp",$moduleInstance);
		if(!$fbtimestamp){
			$fbtimestamp = new Vtiger_Field();
         	$fbtimestamp->name = "fbtimestamp";
         	$fbtimestamp->label = "fbtimestamp";
         	$fbtimestamp->uitype = 70;
	     	$fbtimestamp->typeofdata = "T~O";
	     	$fbtimestamp->table = $moduleInstance->basetable;
	     	$fbtimestamp->column = "fbtimestamp";
	     	$fbtimestamp->columntype = "datetime";
	     	$fbtimestamp->quickcreate = 1; 	     	
	     	$fbtimestamp->masseditable = 1; 
	     	$fbtimestamp->displaytype = 1; 
	     	$fbtimestamp->presence = 2;
			$blockInstance->addField($fbtimestamp);
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
		$filter1->addField($fbcreated_time)->addField($fbrelated_to,1)->addField($fbaction_type, 2)->addField($fblink, 3)->addField($fbdescription, 4);

		echo "Agregando related list de Facebook a Contacts...<br>";

		//Related list con documents
		$moduleContacts = Vtiger_Module::getInstance('Contacts');
		$moduleContacts->unsetRelatedList($moduleInstance);
		// Initialize all the tables required
		$moduleContacts->setRelatedList($moduleInstance, 'Interacciones Facebook', Array('ADD','SELECT'),'get_dependents_list');

		/*
		$moduleInstance->addLink("SIDEBARLINK", "Configurar api", "index.php?module=Facebook&view=Index");

		$moduleInstance->addLink("SIDEBARLINK", "Obtener datos", "index.php?module=Facebook&view=Feed");
		*/

		echo "Ok";

} 


?>
	