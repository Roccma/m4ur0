<?php 

$actualizarCampos = true;

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("Instagram");

if(!$moduleInstance){		
	$moduleInstance = new Vtiger_Module();
    $moduleInstance->name = "Instagram";
    $moduleInstance->parent = "Analytics";
    $moduleInstance->save();

    // Schema Setup
    $moduleInstance->initTables();
    mkdir("modules/Instagram");
}

if($moduleInstance){
	$blockInstance = Vtiger_Block::getInstance("LBL_Instagram_INFORMATION",$moduleInstance);
	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_Instagram_INFORMATION";
		$moduleInstance->addBlock($blockInstance); 
	}

		$igentityid = Vtiger_Field::getInstance('igentityid', $moduleInstance);
 
		if(!$igentityid) {
			$igentityid = new Vtiger_Field();
			$igentityid->name   = 'igentityid';
			$igentityid->label   = 'igentityid';
			$igentityid->table   = $moduleInstance->basetable;
			$igentityid->column   = 'igentityid';
			$igentityid->columntype  = 'varchar(19)';
			$igentityid->uitype   = 4;/* es un autonumerico que va a ser la clave */
			$igentityid->typeofdata  = 'V~M';
			$blockInstance->addField($igentityid); /* Creates the field and adds to block */
			$moduleInstance->setEntityIdentifier($igentityid);
		}
		
		$iguser_id = Vtiger_Field::getInstance('iguser_id',$moduleInstance); 

		if(!$iguser_id){
			$iguser_id = new Vtiger_Field();
	        $iguser_id->name = 'iguser_id';
	        $iguser_id->label = $iguser_id->name;
	        $iguser_id->uitype = 1; //Tipo Varchar
	        $iguser_id->column = $iguser_id->name;
	        $iguser_id->table = $moduleInstance->basetable;
	        $iguser_id->columntype = 'VARCHAR(50)';
	        $iguser_id->typeofdata = 'V~M';
	        $blockInstance->addField($iguser_id); //Agrega el campo al bloque

		}

		$igrelated_to =  Vtiger_Field::getInstance("igrelated_to",$moduleInstance);
		if(!$igrelated_to){
			$igrelated_to = new Vtiger_Field();
         	$igrelated_to->name = "igrelated_to";
         	$igrelated_to->label = "igrelated_to";
         	$igrelated_to->uitype = 10;
	     	$igrelated_to->typeofdata = "I~O";
	     	$igrelated_to->table = $moduleInstance->basetable;
	     	$igrelated_to->column = "igrelated_to";
	     	$igrelated_to->columntype = "int(19)";
	     	$igrelated_to->quickcreate = 0; 
			$blockInstance->addField($igrelated_to);
 			$igrelated_to->setRelatedModules( Array ("Contacts") );
		}

		$igaction_type =  Vtiger_Field::getInstance("igaction_type",$moduleInstance);
		if($igaction_type && $actualizarCampos) $igaction_type->delete();
		if(!$igaction_type || $actualizarCampos){
			$igaction_type = new Vtiger_Field();
         	$igaction_type->name = "igaction_type";
         	$igaction_type->label = "igaction_type";
         	$igaction_type->uitype = 15;
	     	$igaction_type->typeofdata = "V~O";
	     	$igaction_type->table = $moduleInstance->basetable;
	     	$igaction_type->column = "igaction_type";
	     	$igaction_type->columntype = "varchar(30)";
	     	$igaction_type->quickcreate = 2; 
	     	
	     	$igaction_type->masseditable = 1; 
	     	$igaction_type->displaytype = 1; 
	     	$igaction_type->presence = 2;
			$blockInstance->addField($igaction_type);			
 			$igaction_type->setPicklistValues( Array ("Like","Comentario","Reacci&oacute;n","Post","Mensaje") );
		}

		$igcreated_time =  Vtiger_Field::getInstance("igcreated_time",$moduleInstance);
		if(!$igcreated_time){
			$igcreated_time = new Vtiger_Field();
         	$igcreated_time->name = "igcreated_time";
         	$igcreated_time->label = "igcreated_time";
         	$igcreated_time->uitype = 5;
	     	$igcreated_time->typeofdata = "D~O";
	     	$igcreated_time->table = $moduleInstance->basetable;
	     	$igcreated_time->column = "igcreated_time";
	     	$igcreated_time->columntype = "date";
	     	$igcreated_time->quickcreate = 1; 	     	
	     	$igcreated_time->masseditable = 1; 
	     	$igcreated_time->displaytype = 1; 
	     	$igcreated_time->presence = 2;
			$blockInstance->addField($igcreated_time);
		}

		$igobject_id = Vtiger_Field::getInstance('igobject_id',$moduleInstance); 

		if(!$igobject_id){
			$igobject_id = new Vtiger_Field();
	        $igobject_id->name = 'igobject_id';
	        $igobject_id->label = $igobject_id->name;
	        $igobject_id->uitype = 1; //Tipo Varchar
	        $igobject_id->column = $igobject_id->name;
	        $igobject_id->table = $moduleInstance->basetable;
	        $igobject_id->columntype = 'VARCHAR(50)';
	        $igobject_id->typeofdata = 'V~M';
	        $blockInstance->addField($igobject_id); //Agrega el campo al bloque

		}

		$iglink =  Vtiger_Field::getInstance("iglink",$moduleInstance);
		if(!$iglink){
			$iglink = new Vtiger_Field();
         	$iglink->name = "iglink";
         	$iglink->label = "iglink";
         	$iglink->uitype = 17;
	     	$iglink->typeofdata = "V~O";
	     	$iglink->table = $moduleInstance->basetable;
	     	$iglink->column = "iglink";
	     	$iglink->columntype = "varchar(150)";
	     	$iglink->quickcreate = 2; 
	     	
	     	$iglink->masseditable = 1; 
	     	$iglink->displaytype = 1; 
	     	$iglink->presence = 2;
			$blockInstance->addField($iglink);
		}

		$igdescription =  Vtiger_Field::getInstance("igdescription",$moduleInstance);
		if(!$igdescription){
			$igdescription = new Vtiger_Field();
         	$igdescription->name = "igdescription";
         	$igdescription->label = "igdescription";
         	$igdescription->uitype = 21;
	     	$igdescription->typeofdata = "V~O";
	     	$igdescription->table = $moduleInstance->basetable;
	     	$igdescription->column = "igdescription";
	     	$igdescription->columntype = "varchar(500)";
	     	$igdescription->quickcreate = 2; 
	     	
	     	$igdescription->masseditable = 1; 
	     	$igdescription->displaytype = 1; 
	     	$igdescription->presence = 2;
			$blockInstance->addField($igdescription);
		}

		$igverified =  Vtiger_Field::getInstance("igverified",$moduleInstance);
		
		if(!$igverified){
			$igverified = new Vtiger_Field();
         	$igverified->name = "igverified";
         	$igverified->label = "igverified";
         	$igverified->uitype = 56;
	     	$igverified->typeofdata = "C~O";
	     	$igverified->table = $moduleInstance->basetable;
	     	$igverified->column = "igverified";
	     	$igverified->columntype = "varchar(3)";
	     	$igverified->quickcreate = 1; 
	     	
	     	$igverified->masseditable = 2; 
	     	$igverified->displaytype = 1; 
	     	$igverified->presence = 1;
			$blockInstance->addField($igverified);
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
		$filter1->addField($igcreated_time)->addField($igrelated_to,1)->addField($igaction_type, 2)->addField($iglink, 3)->addField($igdescription, 4);

		echo "Agregando related list de Instagram a Contacts...<br>";

		//Related list con documents
		$moduleContacts = Vtiger_Module::getInstance('Contacts');
		$moduleContacts->unsetRelatedList($moduleInstance);
		// Initialize all the tables required
		$moduleContacts->setRelatedList($moduleInstance, 'Interacciones Instagram', Array('ADD','SELECT'),'get_dependents_list');

		/*
		$moduleInstance->addLink("SIDEBARLINK", "Configurar api", "index.php?module=Instagram&view=Index");

		$moduleInstance->addLink("SIDEBARLINK", "Obtener datos", "index.php?module=Instagram&view=Feed");
		*/

		echo "Ok";

} 


?>
	