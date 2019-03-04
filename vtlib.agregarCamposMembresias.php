<?php

include_once("vtlib/Vtiger/Module.php");
$Vtiger_Utils_Log = true;

$moduleInstance = Vtiger_Module::getInstance("Accounts");

if($moduleInstance){
    // Schema Setup
	$blockInstance = Vtiger_Block::getInstance("LBL_ACCOUNT_INFORMATION",$moduleInstance);
	

		$fieldInstance = Vtiger_Field::getInstance('account_no', $moduleInstance);
 
		if($fieldInstance) $fieldInstance->delete();

		$fieldInstance = Vtiger_Field::getInstance('account_number', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'account_number';
			$fieldInstance->label   = 'Número de Cuenta';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'account_number';
			$fieldInstance->columntype  = 'varchar(100)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acguid', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acguid';
			$fieldInstance->label   = 'GUID';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acguid';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acsalesid', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acsalesid';
			$fieldInstance->label   = 'Sales ID';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acsalesid';
			$fieldInstance->columntype  = 'varchar(100)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('aclocation', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'aclocation';
			$fieldInstance->label   = 'Locación';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'aclocation';
			$fieldInstance->columntype  = 'varchar(100)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acfechaventa', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acfechaventa';
			$fieldInstance->label   = 'Fecha de Venta';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acfechaventa';
			$fieldInstance->columntype  = 'date';
			$fieldInstance->uitype   = 5;
			$fieldInstance->typeofdata  = 'D~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acvalidez', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acvalidez';
			$fieldInstance->label   = 'Validez';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acvalidez';
			$fieldInstance->columntype  = 'varchar(100)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("1"));
		}

		$fieldInstance = Vtiger_Field::getInstance('acnoches', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acnoches';
			$fieldInstance->label   = 'Noches';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acnoches';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acdiscovery', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acdiscovery';
			$fieldInstance->label   = 'Discovery';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acdiscovery';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acnochesprem', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acnochesprem';
			$fieldInstance->label   = 'Noches Premium';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acnochesprem';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acagencia', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acagencia';
			$fieldInstance->label   = 'Agencia';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acagencia';
			$fieldInstance->columntype  = 'varchar(100)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("1"));
		}

		$fieldInstance = Vtiger_Field::getInstance('actipoventa', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'actipoventa';
			$fieldInstance->label   = 'Tipo de Venta';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'actipoventa';
			$fieldInstance->columntype  = 'varchar(100)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("1"));
		}

		$fieldInstance = Vtiger_Field::getInstance('acmemant', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acmemant';
			$fieldInstance->label   = 'Membresía Referencia';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acmemant';
			$fieldInstance->columntype  = 'varchar(100)';
			$fieldInstance->uitype   = 10;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setRelatedModules(Array("Accounts"));
		}

		$fieldInstance = Vtiger_Field::getInstance('acsalaorig', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acsalaorig';
			$fieldInstance->label   = 'Sala de Ventas Original';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acsalaorig';
			$fieldInstance->columntype  = 'varchar(100)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acsala', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acsala';
			$fieldInstance->label   = 'Sala de Ventas';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acsala';
			$fieldInstance->columntype  = 'varchar(100)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acsalastats', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acsalastats';
			$fieldInstance->label   = 'Sala de Ventas Stats';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acsalastats';
			$fieldInstance->columntype  = 'varchar(100)';
			$fieldInstance->uitype   = 1;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acstatus', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acstatus';
			$fieldInstance->label   = 'Estado de la Membresía';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acstatus';
			$fieldInstance->columntype  = 'varchar(100)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("Cancelado", "Host"));
		}

		$fieldInstance = Vtiger_Field::getInstance('actipo', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'actipo';
			$fieldInstance->label   = 'Tipo de Membresía';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'actipo';
			$fieldInstance->columntype  = 'varchar(100)';
			$fieldInstance->uitype   = 15;
			$fieldInstance->typeofdata  = 'V~O';
			$blockInstance->addField($fieldInstance);
			$fieldInstance->setPicklistValues(Array("1"));
		}

	$blockInstance = Vtiger_Block::getInstance("LBL_COMMISIONS_PAID",$moduleInstance);

	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_COMMISIONS_PAID";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('accom_paga', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'accom_paga';
			$fieldInstance->label   = 'Comisión Paga';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'accom_paga';
			$fieldInstance->columntype  = 'boolean';
			$fieldInstance->uitype   = 56;
			$fieldInstance->typeofdata  = 'C~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('accom_lock', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'accom_lock';
			$fieldInstance->label   = 'Comisión Lock';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'accom_lock';
			$fieldInstance->columntype  = 'boolean';
			$fieldInstance->uitype   = 56;
			$fieldInstance->typeofdata  = 'C~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('accom_cc', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'accom_cc';
			$fieldInstance->label   = 'CxC';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'accom_cc';
			$fieldInstance->columntype  = 'boolean';
			$fieldInstance->uitype   = 56;
			$fieldInstance->typeofdata  = 'C~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('accom_q', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'accom_q';
			$fieldInstance->label   = 'Q';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'accom_q';
			$fieldInstance->columntype  = 'boolean';
			$fieldInstance->uitype   = 56;
			$fieldInstance->typeofdata  = 'C~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('accom_cashout', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'accom_cashout';
			$fieldInstance->label   = 'Cash Out';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'accom_cashout';
			$fieldInstance->columntype  = 'boolean';
			$fieldInstance->uitype   = 56;
			$fieldInstance->typeofdata  = 'C~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('accom_withdebt', $moduleInstance);

		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'accom_withdebt';
			$fieldInstance->label   = 'With Debt';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'accom_withdebt';
			$fieldInstance->columntype  = 'boolean';
			$fieldInstance->uitype   = 56;
			$fieldInstance->typeofdata  = 'C~O';
			$blockInstance->addField($fieldInstance);
		}

	$blockInstance = Vtiger_Block::getInstance("LBL_FINANCIAL_INFORMATION",$moduleInstance);

	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_FINANCIAL_INFORMATION";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('acfin_totventa', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acfin_totventa';
			$fieldInstance->label   = 'Precio Total de Venta';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acfin_totventa';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acfin_rakerate', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acfin_rakerate';
			$fieldInstance->label   = 'Rack Rate';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acfin_rakerate';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acfin_moneycoup', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acfin_moneycoup';
			$fieldInstance->label   = 'Money Coupons Amount';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acfin_moneycoup';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acfin_prevision', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acfin_prevision';
			$fieldInstance->label   = 'Std. Previsions Amount';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acfin_prevision';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acfin_prevotros', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acfin_prevotros';
			$fieldInstance->label   = 'Other Previsions Amount';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acfin_prevotros';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acfin_pack', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acfin_pack';
			$fieldInstance->label   = 'Pack';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acfin_pack';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acfin_adjustment', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acfin_adjustment';
			$fieldInstance->label   = 'Adjustment';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acfin_adjustment';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acfin_subtot', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acfin_subtot';
			$fieldInstance->label   = 'Sub-Total';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acfin_subtot';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acfin_tax', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acfin_tax';
			$fieldInstance->label   = 'Tax %';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acfin_tax';
			$fieldInstance->columntype  = 'double';
			$fieldInstance->uitype   = 9;
			$fieldInstance->typeofdata  = 'NN~O~2~2';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acfin_totaantesimpuestos', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acfin_totaantesimpuestos';
			$fieldInstance->label   = 'Total Before Tax';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acfin_totaantesimpuestos';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

	$blockInstance = Vtiger_Block::getInstance("LBL_PAYMENT_FOR_CONTRACTS",$moduleInstance);

	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_PAYMENT_FOR_CONTRACTS";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('acpago_totporc', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acpago_totporc';
			$fieldInstance->label   = 'Total %';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acpago_totporc';
			$fieldInstance->columntype  = 'double';
			$fieldInstance->uitype   = 9;
			$fieldInstance->typeofdata  = 'NN~O~2~2';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acpago_totmonto', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acpago_totmonto';
			$fieldInstance->label   = 'Total Monto';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acpago_totmonto';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acpago_equityporc', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acpago_equityporc';
			$fieldInstance->label   = 'Equity %';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acpago_equityporc';
			$fieldInstance->columntype  = 'double';
			$fieldInstance->uitype   = 9;
			$fieldInstance->typeofdata  = 'NN~O~2~2';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acpago_equitymonto', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acpago_equitymonto';
			$fieldInstance->label   = 'Equity';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acpago_equitymonto';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acpago_initialporc', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acpago_initialporc';
			$fieldInstance->label   = 'Inicial %';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acpago_initialporc';
			$fieldInstance->columntype  = 'double';
			$fieldInstance->uitype   = 9;
			$fieldInstance->typeofdata  = 'NN~O~2~2';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acpago_initialmonto', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acpago_initialmonto';
			$fieldInstance->label   = 'Inicial';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acpago_initialmonto';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acpago_adicporc', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acpago_adicporc';
			$fieldInstance->label   = 'Adicional %';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acpago_adicporc';
			$fieldInstance->columntype  = 'double';
			$fieldInstance->uitype   = 9;
			$fieldInstance->typeofdata  = 'NN~O~2~2';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acpago_adicmonto', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acpago_adicmonto';
			$fieldInstance->label   = 'Adicional';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acpago_adicmonto';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acpago_pago', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acpago_pago';
			$fieldInstance->label   = 'Pagado';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acpago_pago';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acpago_restante', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acpago_restante';
			$fieldInstance->label   = 'Restante';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acpago_restante';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acpago_volume', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acpago_volume';
			$fieldInstance->label   = 'Statical Volume';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acpago_volume';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

	$blockInstance = Vtiger_Block::getInstance("LBL_CLOSING_COST",$moduleInstance);

	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_CLOSING_COST";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('acclo_costo', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acclo_costo';
			$fieldInstance->label   = 'Costo de Cierre';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acclo_costo';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acclo_pagado', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acclo_pagado';
			$fieldInstance->label   = 'Pagado';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acclo_pagado';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acclo_restante', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acclo_restante';
			$fieldInstance->label   = 'Restante';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acclo_restante';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

	$blockInstance = Vtiger_Block::getInstance("LBL_TOTALS",$moduleInstance);

	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_TOTALS";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('actot_pago', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'actot_pago';
			$fieldInstance->label   = 'Pago Total';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'actot_pago';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('actot_financiado', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'actot_financiado';
			$fieldInstance->label   = 'Monto Financiado';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'actot_financiado';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('actot_cantpagos', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'actot_cantpagos';
			$fieldInstance->label   = 'Pago Mensual #';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'actot_cantpagos';
			$fieldInstance->columntype  = 'int';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~10,0';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('actot_interes', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'actot_interes';
			$fieldInstance->label   = 'Interés %';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'actot_interes';
			$fieldInstance->columntype  = 'double';
			$fieldInstance->uitype   = 9;
			$fieldInstance->typeofdata  = 'NN~O~2~2';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('actot_pagomensual', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'actot_pagomensual';
			$fieldInstance->label   = 'Pago Mensual $';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'actot_pagomensual';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('actot_fechaprimero', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'actot_fechaprimero';
			$fieldInstance->label   = 'Fecha Primer Pago';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'actot_fechaprimero';
			$fieldInstance->columntype  = 'date';
			$fieldInstance->uitype   = 5;
			$fieldInstance->typeofdata  = 'D~O';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('actot_totalfinanciado', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'actot_totalfinanciado';
			$fieldInstance->label   = 'Total Financiado';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'actot_totalfinanciado';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

	$blockInstance = Vtiger_Block::getInstance("LBL_PREVIOUS_BALANCE", $moduleInstance);

	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_PREVIOUS_BALANCE";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('acpb_balance', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acpb_balance';
			$fieldInstance->label   = 'Balance Previo';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acpb_balance';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acpb_balance2', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acpb_balance2';
			$fieldInstance->label   = 'Prev. Balance paid w/ADPs';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acpb_balance2';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

	$blockInstance = Vtiger_Block::getInstance("LBL_PAYMENT_FOR_COMMISSIONS", $moduleInstance);

	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_PAYMENT_FOR_COMMISSIONS";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('accom_totalporc', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'accom_totalporc';
			$fieldInstance->label   = 'Total %';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'accom_totalporc';
			$fieldInstance->columntype  = 'double';
			$fieldInstance->uitype   = 9;
			$fieldInstance->typeofdata  = 'NN~O~2~2';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('accom_total', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'accom_total';
			$fieldInstance->label   = 'Total';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'accom_total';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('accom_pagoporc', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'accom_pagoporc';
			$fieldInstance->label   = 'Pagado %';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'accom_pagoporc';
			$fieldInstance->columntype  = 'double';
			$fieldInstance->uitype   = 9;
			$fieldInstance->typeofdata  = 'NN~O~2~2';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('accom_pago', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'accom_pago';
			$fieldInstance->label   = 'Pagado';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'accom_pago';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('accom_restante', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'accom_restante';
			$fieldInstance->label   = 'Restante';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'accom_restante';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

	$blockInstance = Vtiger_Block::getInstance("LBL_ORIGINAL_AMOUNT", $moduleInstance);

	if(!$blockInstance){
		$blockInstance = new Vtiger_Block();
		$blockInstance->label = "LBL_ORIGINAL_AMOUNT";
		$moduleInstance->addBlock($blockInstance); 
	}

		$fieldInstance = Vtiger_Field::getInstance('acor_montooriginal', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acor_montooriginal';
			$fieldInstance->label   = 'Monto Original';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acor_montooriginal';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		$fieldInstance = Vtiger_Field::getInstance('acor_montoactual', $moduleInstance);
 
		if(!$fieldInstance) {
			$fieldInstance = new Vtiger_Field();
			$fieldInstance->name   = 'acor_montoactual';
			$fieldInstance->label   = 'Value Amount';
			$fieldInstance->table   = $moduleInstance->basetable;
			$fieldInstance->column   = 'acor_montoactual';
			$fieldInstance->columntype  = 'decimal(11,3)';
			$fieldInstance->uitype   = 7;
			$fieldInstance->typeofdata  = 'NN~O~7,3';
			$blockInstance->addField($fieldInstance);
		}

		echo "Ok";

} 
	

//LBL_ACCOUNT_INFORMATION
?>