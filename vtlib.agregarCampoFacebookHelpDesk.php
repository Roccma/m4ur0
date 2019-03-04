<?php 

//Campos para web service
include_once("vtlib/Vtiger/Module.php");

$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("HelpDesk");

if($moduleInstance){
     $blockInstance = Vtiger_Block::getInstance("LBL_TICKET_INFORMATION",$moduleInstance);
     if(!$blockInstance){
          $blockInstance = new Vtiger_Block();
          $blockInstance->label = "LBL_TICKET_INFORMATION";
          $moduleInstance->addBlock($blockInstance); 
     }
     
     $related_facebook = Vtiger_Field::getInstance("related_facebook",$moduleInstance);
     if(!$related_facebook){
          $related_facebook = new Vtiger_Field();
          $related_facebook->name = "related_facebook";
          $related_facebook->label = "Referencia Facebook";
          $related_facebook->uitype = 10;
          $related_facebook->typeofdata = "I~O";
          $related_facebook->table = $moduleInstance->basetable;
          $related_facebook->column = "related_facebook";
          $related_facebook->columntype = "int(19)";
          $related_facebook->quickcreate = 1; 

          $related_facebook->masseditable = 1; 
          $related_facebook->displaytype = 1; 
          $related_facebook->presence = 2;
          $blockInstance->addField($related_facebook);
          $related_facebook->setRelatedmodules( Array ("Facebook") );
     }        
	echo "Ok";
}
?>