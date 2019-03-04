<?php 

$actualizarCampos = true;

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("Contacts");

if($moduleInstance){
    // Schema Setup
	$blockInstance = Vtiger_Block::getInstance("LBL_CONTACT_INFORMATION",$moduleInstance);
	

		$fieldInstance = Vtiger_Field::getInstance('secondname', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'secondname';
			$fieldInstance->label   = 'Segundo Nombre';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'secondname';
			$fieldInstance->columntype  = 'varchar(50)';
			$fieldInstance->uitype   = 1;/* es un autonumerico que va a ser la clave */
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('secondlastname', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'secondlastname';
			$fieldInstance->label   = 'Segundo Apellido';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'secondlastname';
			$fieldInstance->columntype  = 'varchar(50)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}
		
		$fieldInstance = Vtiger_Field::getInstance('age', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'age';
			$fieldInstance->label   = 'Edad';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'age';
			$fieldInstance->columntype  = 'int(3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~M~10,0';
			$fieldInstance->displaytype = 2;
			$blockInstance->addField($fieldInstance);

		}

		$fieldInstance = Vtiger_Field::getInstance('tipodoc', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'tipodoc';
			$fieldInstance->label   = 'Tipo de documento';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'tipodoc';
			$fieldInstance->columntype  = 'varchar(50)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("DNI", "Pasaporte"));
		}

		$fieldInstance = Vtiger_Field::getInstance('documento', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'documento';
			$fieldInstance->label   = 'Documento';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'documento';
			$fieldInstance->columntype  = 'varchar(50)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('nacionalidad', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'nacionalidad';
			$fieldInstance->label   = 'Nacionalidad';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'nacionalidad';
			$fieldInstance->columntype  = 'varchar(50)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('idioma', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'idioma';
			$fieldInstance->label   = 'Idioma';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'idioma';
			$fieldInstance->columntype  = 'varchar(50)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("English", "Spanish", "French", "Italian", "German", "Russian", "Other"));
		}

		$fieldInstance = Vtiger_Field::getInstance('origen_contacto', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'origen_contacto';
			$fieldInstance->label   = 'Origen del Contacto';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'origen_contacto';
			$fieldInstance->columntype  = 'varchar(150)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("Navision", "Origos", "Sirenis Passport", "Histórico Navision", "SGP", "Web", "Redes sociales", "Camapañas de Venta", "Otro"));
		}

		$fieldInstance = Vtiger_Field::getInstance('campaniaventa', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'campaniaventa';
			$fieldInstance->label   = 'Campaña de Venta';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'campaniaventa';
			$fieldInstance->columntype  = 'varchar(150)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('otro', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'otro';
			$fieldInstance->label   = 'Otro';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'otro';
			$fieldInstance->columntype  = 'varchar(150)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('tipocontacto', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'tipocontacto';
			$fieldInstance->label   = 'Tipo de Contacto';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'tipocontacto';
			$fieldInstance->columntype  = 'varchar(150)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("Potencial Cliente", "Huesped/Cliente Genérico", "Sirenis Friend", "Socio SPT", "Socio SPT (Clubes externos)", "Ex Socio SPT", "Agente de Viajes", "Contacto Especial"));
		}
		
		$fieldInstance = Vtiger_Field::getInstance('trato', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'trato';
			$fieldInstance->label   = 'Trato';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'trato';
			$fieldInstance->columntype  = 'varchar(150)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("Cliente", "VIP", "Invitado", "Colaborador"));
		}

		$fieldInstance = Vtiger_Field::getInstance('subtrato', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'subtrato';
			$fieldInstance->label   = 'Sub Trato';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'subtrato';
			$fieldInstance->columntype  = 'varchar(150)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("Sirenis Friend", "Sirenis Premium Tavelers", "VIP"));
		}

		$fieldInstance = Vtiger_Field::getInstance('tipopersona', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'tipopersona';
			$fieldInstance->label   = 'Tipo de Persona';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'tipopersona';
			$fieldInstance->columntype  = 'varchar(150)';
			$fieldInstance->uitype   = 33;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("Adulto", "Niño"));
		}

		$fieldInstance = Vtiger_Field::getInstance('subtipopersona', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'subtipopersona';
			$fieldInstance->label   = 'Sub Tipo de Persona';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'subtipopersona';
			$fieldInstance->columntype  = 'varchar(150)';
			$fieldInstance->uitype   = 33;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("Novio/a", "Influencer", "Periodista"));
		}

		$fieldInstance = Vtiger_Field::getInstance('profesion', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'profesion';
			$fieldInstance->label   = 'Profesión';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'profesion';
			$fieldInstance->columntype  = 'varchar(250)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('lugartrabajo', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'lugartrabajo';
			$fieldInstance->label   = 'Lugar de trabajo';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'lugartrabajo';
			$fieldInstance->columntype  = 'varchar(150)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('sexo', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'sexo';
			$fieldInstance->label   = 'Sexo';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'sexo';
			$fieldInstance->columntype  = 'varchar(50)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("Femenino", "Masculino"));
		}

		$fieldInstance = Vtiger_Field::getInstance('facebookid', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'facebookid';
			$fieldInstance->label   = 'Facebook ID';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'facebookid';
			$fieldInstance->columntype  = 'varchar(500)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('instagramid', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'instagramid';
			$fieldInstance->label   = 'Instagram ID';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'instagramid';
			$fieldInstance->columntype  = 'varchar(500)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('linkedinid', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'linkedinid';
			$fieldInstance->label   = 'LinkedIn ID';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'linkedinid';
			$fieldInstance->columntype  = 'varchar(500)';
			$fieldInstance->uitype   = 17;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('clienteactivo', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'clienteactivo';
			$fieldInstance->label   = 'Cliente Activo';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'clienteactivo';
			$fieldInstance->columntype  = 'varchar(5)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("Sí", "No"));
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

		
		echo "Agregando related list de Instagram a Contacts...<br>";

		
		/*
		$moduleInstance->addLink("SIDEBARLINK", "Configurar api", "index.php?module=Instagram&view=Index");

		$moduleInstance->addLink("SIDEBARLINK", "Obtener datos", "index.php?module=Instagram&view=Feed");
		*/

		echo "Ok";

} 


?>
	