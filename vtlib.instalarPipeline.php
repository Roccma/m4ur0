<?php
/******
 * Instalador de Tabla Pivot para Vtiger 6.5
 * @author: Maximiliano Fernández
 * @date: 2016
 ****/

//// Importaciones
$Vtiger_Utils_Log = true;

include_once('vtlib/Vtiger/Menu.php');
include_once('vtlib/Vtiger/Module.php');

Vtiger_Link::addLink($moduleInstance->getId(), 'HEADERSCRIPT', 'VGSVisualPipeline', "layouts/v7/modules/VGSVisualPipeline/resources/VGSVisualPipeline.js", '', 0, '');

vtlib_addSettingsLink("LP Pipeline","index.php?module=VGSVisualPipeline&view=VGSIndexSettings&parent=Settings");

global $adb;

$sql = "CREATE TABLE vtiger_vgsvisualpipeline (
	  		vgsvisualpipelineid int(11) unsigned NOT NULL AUTO_INCREMENT,
	  		sourcefieldname varchar(50) DEFAULT NULL,
	  		sourcemodule varchar(50) DEFAULT NULL,
	  		fieldname1 varchar(50) DEFAULT NULL,
	  		fieldname2 varchar(50) DEFAULT NULL,
	  		fieldname3 varchar(50) DEFAULT NULL,
	  		fieldname4 varchar(50) DEFAULT NULL,
	  		PRIMARY KEY (vgsvisualpipelineid)
		) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8";
$adb->pquery($sql, array());

$sql = "CREATE TABLE vtiger_vgsvisualpipeline_settings (
		  	vgscrmid int(11) NOT NULL,
		  	vgsuserid int(11) NOT NULL,
		  	vgscolor varchar(30) DEFAULT NULL,
		  	PRIMARY KEY (vgscrmid,vgsuserid)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1";
$adb->pquery($sql, array());

$sql = "CREATE TABLE vtiger_vgsvisualsorting (
		  	module varchar(50) DEFAULT NULL,
		  	sorting text
		) ENGINE=InnoDB DEFAULT CHARSET=utf8";
$adb->pquery($sql, array());

$moduleInstance = Vtiger_Module::getInstance("VGSVisualPipeline");

if(!$moduleInstance){		
	$moduleInstance = new Vtiger_Module();
    $moduleInstance->name = "VGSVisualPipeline";
    $moduleInstance->parent = "";
    $moduleInstance->save();
    $moduleInstance->initTables();
}

echo "OK";