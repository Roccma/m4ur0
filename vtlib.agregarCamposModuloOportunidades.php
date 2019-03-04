<?php
include_once 'vtlib/Vtiger/Field.php';
include_once 'vtlib/Vtiger/Block.php';
include_once 'vtlib/Vtiger/Module.php';
include_once 'vtlib/Vtiger/Menu.php';
require_once('include/database/PearDatabase.php');
//obtiene el modulo oportunidades
$module = Vtiger_Module::getInstance('Potentials');
//activa los logs
$Vtiger_Utils_Log = true;
//verifica que exista el módulo
if($module){
	//obtenemos instancia de bd
	global $adb;
    //utilizamos el bloque ticket información
    $block = Vtiger_Block::getInstance('LBL_OPPORTUNITY_INFORMATION', $module);
    //reemplazo de valores del campo tipo de oportunidad
	$campo = Vtiger_Field::getInstance('opportunity_type', $module);
	//verifica exista el campo.
	if ($campo) {
		/*
		* //consulta para borrar picklistvalues
		* $sql = "DELETE FROM vtiger_".$campo->name;
		* //ejecutamos la consulta
		* $adb->pquery($sql);
		*/
		//agregamos los nuevos valores
		$campo->setPicklistValues(array('Recovery', 'Referral', 'UPG MC', 'Lots', 'Real Estate', 'Special Events'));
	}
	//borrar campo se convierte en plomo
	$campo = Vtiger_Field::getInstance('isconvertedfromlead', $module);
	//verifica exista el campo.
	if ($campo) {
		//consulta de modificar la presencia campo se convierte en plomo ya que no se puede borrar
		//al ser un campo por defecto
		$sql='UPDATE vtiger_field SET presence = 1 WHERE fieldid = ?';
		//ejecutamos la cosulta pasando el id del campo
		$adb->pquery($sql, array($campo->id));
	}
	//agregar campo Razón de Solicitud de Cancelación
	$campo = Vtiger_Field::getInstance('oprecovery', $module);
	//verifica no exista el campo
	if (!$campo) {
		$campo = new Vtiger_Field();
		$campo->name = 'oprecovery';
		$campo->label = 'oprecovery';
		$campo->table = $module->basetable;
		$campo->column = 'oprecovery';
		$campo->columntype = 'VARCHAR(75)';
		//campo de seleccion unica
		$campo->uitype = 15;
		$campo->typeofdata = 'V~O';
		$campo->displaytype = 1;
		// incluyo el campo en el bloque
		$block->addField($campo);
		$campo->setPicklistValues(array('Money', 'Credibility', 'Use', 'Need', 'Value', 'Social Media', 'Uncollectable', 'Bad Service', 'Sale Failed', 'Other'));
	}
	//agregar campo Razón de Solicitud de Cancelación
	$campo = Vtiger_Field::getInstance('oprecovery', $module);
	//verifica no exista el campo
	if (!$campo) {
		$campo = new Vtiger_Field();
		$campo->name = 'oprecovery';
		$campo->label = 'oprecovery';
		$campo->table = $module->basetable;
		$campo->column = 'oprecovery';
		$campo->columntype = 'VARCHAR(75)';
		//campo de seleccion unica
		$campo->uitype = 15;
		$campo->typeofdata = 'V~O';
		$campo->displaytype = 1;
		// incluyo el campo en el bloque
		$block->addField($campo);
		$campo->setPicklistValues(array('Money', 'Credibility', 'Use', 'Need', 'Value', 'Social Media', 'Uncollectable', 'Bad Service', 'Sale Failed', 'Other'));
	}
	//agregar campo Razón de Cancelación otros
	$campo = Vtiger_Field::getInstance('oprecoveryother', $module);
	//verifica no exista el campo
	if (!$campo) {
		$campo = new Vtiger_Field();
		$campo->name = 'oprecoveryother';
		$campo->label = 'oprecoveryother';
		$campo->table = $module->basetable;
		$campo->column = 'oprecoveryother';
		$campo->columntype = 'TEXT';
		//campo de texto
		$campo->uitype = 1;
		$campo->typeofdata = 'V~O';
		$campo->displaytype = 1;
		// incluyo el campo en el bloque
		$block->addField($campo);
	}
	//agregar campo Compensacion
	$campo = Vtiger_Field::getInstance('oprecoverycompensation', $module);
	//verifica no exista el campo
	if (!$campo) {
		$campo = new Vtiger_Field();
		$campo->name = 'oprecoverycompensation';
		$campo->label = 'oprecoverycompensation';
		$campo->table = $module->basetable;
		$campo->column = 'oprecoverycompensation';
		$campo->columntype = 'VARCHAR(75)';
		//campo de seleccion unica
		$campo->uitype = 15;
		$campo->typeofdata = 'V~O';
		$campo->displaytype = 1;
		// incluyo el campo en el bloque
		$block->addField($campo);
	}
	//agregar campo Compensacion
	$campo = Vtiger_Field::getInstance('opmotperdida', $module);
	//verifica no exista el campo
	if (!$campo) {
		$campo = new Vtiger_Field();
		$campo->name = 'opmotperdida';
		$campo->label = 'opmotperdida';
		$campo->table = $module->basetable;
		$campo->column = 'opmotperdida';
		$campo->columntype = 'VARCHAR(75)';
		//campo de seleccion unica
		$campo->uitype = 15;
		$campo->typeofdata = 'V~O';
		$campo->displaytype = 1;
		// incluyo el campo en el bloque
		$block->addField($campo);
	}
	//agregar campo Motivo de Perdida Otros
	$campo = Vtiger_Field::getInstance('opmotperdidaotros', $module);
	//verifica no exista el campo
	if (!$campo) {
		$campo = new Vtiger_Field();
		$campo->name = 'opmotperdidaotros';
		$campo->label = 'opmotperdidaotros';
		$campo->table = $module->basetable;
		$campo->column = 'opmotperdidaotros';
		$campo->columntype = 'TEXT';
		//campo de texto
		$campo->uitype = 1;
		$campo->typeofdata = 'V~O';
		$campo->displaytype = 1;
		// incluyo el campo en el bloque
		$block->addField($campo);
	}
	//agrega el campo ultima fecha de gestion
	$campo = Vtiger_Field::getInstance('opfechaultimagestion', $module);
	//verifica no exista el campo
	if (!$campo) {
		$campo = new Vtiger_Field();
		$campo->name = 'opfechaultimagestion';
		$campo->label = 'opfechaultimagestion';
		$campo->table = $module->basetable;
		$campo->column = 'opfechaultimagestion';
		$campo->columntype = 'DATETIME';
		//Date
		$campo->uitype = 5;
		$campo->typeofdata = 'DT~O';
		$campo->displaytype = 2;
		// incluyo el campo en el bloque
		$block->addField($campo);
	}
	//agrega el campo tiempo
	$campo = Vtiger_Field::getInstance('optiempo', $module);
	//verifica no exista el campo
	if (!$campo) {
		$campo = new Vtiger_Field();
		$campo->name = 'optiempo';
		$campo->label = 'optiempo';
		$campo->table = $module->basetable;
		$campo->column = 'optiempo';
		$campo->columntype = 'DECIMAL(25,8)';
		//Date
		$campo->uitype = 1;
		$campo->typeofdata = 'N~O';
		$campo->displaytype = 2;
		// incluyo el campo en el bloque
		$block->addField($campo);
	}
	echo "Listo";
}
?>