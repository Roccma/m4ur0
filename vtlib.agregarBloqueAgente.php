<?php 

$actualizarCampos = true;

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("Contacts");

if($moduleInstance){
    // Schema Setup
	$blockInstance = Vtiger_Block::getInstance("LBL_CONTACT_INFORMATION",$moduleInstance);
	
	/*$fieldInstance = Vtiger_Field::getInstance('email', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'email';
		$fieldInstance->label   = 'email';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'email';
		$fieldInstance->columntype  = 'varchar(50)';
		$fieldInstance->uitype   = 13;
		$fieldInstance->typeofdata  = 'E~O';
		$blockInstance->addField($fieldInstance);
	}*/

	$fieldInstance = Vtiger_Field::getInstance('web_page', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'web_page';
		$fieldInstance->label   = 'web_page';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'web_page';
		$fieldInstance->columntype  = 'varchar(100)';
		$fieldInstance->uitype   = 17;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('fax', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'fax';
		$fieldInstance->label   = 'fax';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'fax';
		$fieldInstance->columntype  = 'varchar(100)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('agent', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'agent';
		$fieldInstance->label   = 'Es Agente?';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'agent';
		$fieldInstance->columntype  = 'boolean';
		$fieldInstance->uitype   = 56;
		$fieldInstance->typeofdata  = 'C~O';
		$blockInstance->addField($fieldInstance);
	}

	$blockInstance = Vtiger_Block::getInstance("LBL_Agents_INFORMATION",$moduleInstance);
	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_Agents_INFORMATION";
		$moduleInstance->addBlock($blockInstance); 
	}

	$fieldInstance = Vtiger_Field::getInstance('agency_type', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'agency_type';
		$fieldInstance->label   = 'agency_type';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'agency_type';
		$fieldInstance->columntype  = 'varchar(10)';
		$fieldInstance->uitype   = 15;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
		$fieldInstance->setPicklistValues(Array("ABTA", "ARC", "CLIA", "IATAN", "Other"));
	}

	$fieldInstance = Vtiger_Field::getInstance('agency_number', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'agency_number';
		$fieldInstance->label   = 'agency_number';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'agency_number';
		$fieldInstance->columntype  = 'varchar(50)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('number_employees', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'number_employees';
		$fieldInstance->label   = 'number_employees';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'number_employees';
		$fieldInstance->columntype  = 'int';
		$fieldInstance->uitype   = 7;
		$fieldInstance->typeofdata  = 'NN~O~10,0';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('number_locations', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'number_locations';
		$fieldInstance->label   = 'number_locations';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'number_locations';
		$fieldInstance->columntype  = 'int';
		$fieldInstance->uitype   = 7;
		$fieldInstance->typeofdata  = 'NN~O~10,0';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('agency_name', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'agency_name';
		$fieldInstance->label   = 'agency_name';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'agency_name';
		$fieldInstance->columntype  = 'varchar(50)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('number_storefronts', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'number_storefronts';
		$fieldInstance->label   = 'number_storefronts';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'number_storefronts';
		$fieldInstance->columntype  = 'varchar(5)';
		$fieldInstance->uitype   = 15;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
		$fieldInstance->setPicklistValues(Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "+25"));
	}

	/*$fieldInstance = Vtiger_Field::getInstance('country', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'country';
		$fieldInstance->label   = 'country';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'country';
		$fieldInstance->columntype  = 'varchar(150)';
		$fieldInstance->uitype   = 15;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
		$fieldInstance->setPicklistValues(Array("USA"));
	}
	else{
		$fieldInstance->delete();
	}*/

	$fieldInstance = Vtiger_Field::getInstance('agency_kind', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'agency_kind';
		$fieldInstance->label   = 'agency_kind';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'agency_kind';
		$fieldInstance->columntype  = 'varchar(150)';
		$fieldInstance->uitype   = 15;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
		$fieldInstance->setPicklistValues(Array("Storefront", "Homebased", "Online", "Offline"));
	}

	$fieldInstance = Vtiger_Field::getInstance('city', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'city';
		$fieldInstance->label   = 'city';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'city';
		$fieldInstance->columntype  = 'varchar(100)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}
	/*else{
		$fieldInstance->delete();
	}*/

	$fieldInstance = Vtiger_Field::getInstance('travel_affiliation', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'travel_affiliation';
		$fieldInstance->label   = 'travel_affiliation';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'travel_affiliation';
		$fieldInstance->columntype  = 'varchar(150)';
		$fieldInstance->uitype   = 15;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
		$fieldInstance->setPicklistValues(Array("AAA", "Advantage", "AMEX", "Barrhead Travel", "Co-Operate Travel", "CWT", "ENSEMBLE", "Etravco", "Global Travel Group", "Hays Travel", "JOURNEY", "MAST", "OTHER", "Other Independient", "SIGNATURE", "Travel Counselors", "Travel House", "TRAVELSAVERS", "TUI Specialist Division", "VACATIONS.COM", "VIRTUOSO"));
	}

	$fieldInstance = Vtiger_Field::getInstance('state', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'state';
		$fieldInstance->label   = 'state';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'state';
		$fieldInstance->columntype  = 'varchar(500)';
		$fieldInstance->uitype   = 15;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
		$fieldInstance->setPicklistValues(Array("Alaska", 
                "Alabama", 
                "Arkansas", 
                "American Samoa", 
                "Arizona", 
                "California", 
                "Colorado", 
                "Connecticut", 
                "District of Columbia", 
                "Delaware", 
                "Florida", 
                "Georgia", 
                "Guam", 
                "Hawaii", 
                "Iowa", 
                "Idaho", 
                "Illinois", 
                "Indiana", 
                "Kansas", 
                "Kentucky", 
                "Louisiana", 
                "Massachusetts", 
                "Maryland", 
                "Maine", 
                "Michigan", 
                "Minnesota", 
                "Missouri", 
                "Mississippi", 
                "Montana", 
                "North Carolina", 
                "North Dakota", 
                "Nebraska", 
                "New Hampshire", 
                "New Jersey", 
                "New Mexico", 
                "Nevada", 
                "New York", 
                "Ohio", 
                "Oklahoma", 
                "Oregon", 
                "Pennsylvania", 
                "Puerto Rico", 
                "Rhode Island", 
                "South Carolina", 
                "South Dakota", 
                "Tennessee", 
                "Texas", 
                "Utah", 
                "Virginia", 
                "Virgin Islands", 
                "Vermont", 
                "Washington", 
                "Wisconsin", 
                "West Virginia", 
                "Wyoming"));
	}

	/*$fieldInstance = Vtiger_Field::getInstance('postal_code', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'postal_code';
		$fieldInstance->label   = 'postal_code';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'postal_code';
		$fieldInstance->columntype  = 'varchar(100)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}
	else{
		$fieldInstance->delete();
	}

	$fieldInstance = Vtiger_Field::getInstance('address', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'address';
		$fieldInstance->label   = 'address';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'address';
		$fieldInstance->columntype  = 'varchar(750)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}
	else{
		$fieldInstance->delete();
	}*/

	$fieldInstance = Vtiger_Field::getInstance('address2', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'address2';
		$fieldInstance->label   = 'address2';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'address2';
		$fieldInstance->columntype  = 'varchar(750)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	$fieldInstance = Vtiger_Field::getInstance('phone', $moduleInstance);
 
	/*if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'phone';
		$fieldInstance->label   = 'phone';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'phone';
		$fieldInstance->columntype  = 'varchar(30)';
		$fieldInstance->uitype   = 11;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}
	else{
		$fieldInstance->delete();
	}*/

	$fieldInstance = Vtiger_Field::getInstance('ext', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'ext';
		$fieldInstance->label   = 'ext';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'ext';
		$fieldInstance->columntype  = 'int';
		$fieldInstance->uitype   = 7;
		$fieldInstance->typeofdata  = 'NN~O~10,0';
		$blockInstance->addField($fieldInstance);
	}
	/*else{
		$fieldInstance->delete();
	}

	$fieldInstance = Vtiger_Field::getInstance('email', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'email';
		$fieldInstance->label   = 'email';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'email';
		$fieldInstance->columntype  = 'varchar(50)';
		$fieldInstance->uitype   = 13;
		$fieldInstance->typeofdata  = 'E~O';
		$blockInstance->addField($fieldInstance);
	}
	else{
		$fieldInstance->delete();
	}

	$fieldInstance = Vtiger_Field::getInstance('web_page', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'web_page';
		$fieldInstance->label   = 'web_page';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'web_page';
		$fieldInstance->columntype  = 'varchar(100)';
		$fieldInstance->uitype   = 17;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}
	else{
		$fieldInstance->delete();
	}*/

	$fieldInstance = Vtiger_Field::getInstance('top_selling_destinations', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'top_selling_destinations';
		$fieldInstance->label   = 'top_selling_destinations';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'top_selling_destinations';
		$fieldInstance->columntype  = 'varchar(1000)';
		$fieldInstance->uitype   = 33;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
		$fieldInstance->setPicklistValues(Array("Cancún", "Caribbean", "Disney", "Europe", "Hawaii", "Las Vegas", "Other Mexico", "Rivera Maya Mexico", "Punta Cana, Dominican Republic"));
	}

	$fieldInstance = Vtiger_Field::getInstance('top_specialities', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'top_specialities';
		$fieldInstance->label   = 'top_specialities';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'top_specialities';
		$fieldInstance->columntype  = 'varchar(1000)';
		$fieldInstance->uitype   = 33;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
		$fieldInstance->setPicklistValues(Array("Adult Only", "Destination Weddings", "Family", "Groups", "Honey Moons & Anniversaries", "Romance"));
	}

	$fieldInstance = Vtiger_Field::getInstance('tag_line', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'tag_line';
		$fieldInstance->label   = 'tag_line';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'tag_line';
		$fieldInstance->columntype  = 'varchar(1000)';
		$fieldInstance->uitype   = 1;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}

	/*$fieldInstance = Vtiger_Field::getInstance('company_logo', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'company_logo';
		$fieldInstance->label   = 'company_logo';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'company_logo';
		$fieldInstance->columntype  = 'varchar(1000)';
		$fieldInstance->uitype   = 69;
		$fieldInstance->typeofdata  = 'V~O';
		$blockInstance->addField($fieldInstance);
	}
	else{
		$fieldInstance->delete();
	}*/

	$fieldInstance = Vtiger_Field::getInstance('accept_conditions', $moduleInstance);
 
	if(!$fieldInstance) {
		$fieldInstance = new Vtiger_Field();
		$fieldInstance->name   = 'accept_conditions';
		$fieldInstance->label   = 'accept_conditions';
		$fieldInstance->table   = $moduleInstance->basetable;
		$fieldInstance->column   = 'accept_conditions';
		$fieldInstance->columntype  = 'boolean';
		$fieldInstance->uitype   = 56;
		$fieldInstance->typeofdata  = 'C~O';
		$blockInstance->addField($fieldInstance);
	}
}


echo "Ok";


?>