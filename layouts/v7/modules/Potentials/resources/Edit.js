/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger_Edit_Js("Potentials_Edit_Js",{
   
},{
	registerEvents: function(container){
		//seleccionamos los campos
		var selectOpType = $("select[name='opportunity_type']");
		var selectOpRecovery = $("select[name='oprecovery']");
		var inputOpRecOther = $("input[name='oprecoveryother']");
		var selectOpCompensation = $("select[name='oprecoverycompensation']");
		var selectOpPerdida = $("select[name='opmotperdida']");
		var inputOpPerOther = $("input[name='opmotperdidaotros']");
		//deshabilitamos algunos campos
		selectOpRecovery.attr('disabled','true');
		inputOpRecOther.attr('disabled','true');
		selectOpCompensation.attr('disabled','true');
		inputOpPerOther.attr('disabled','true');
		//agregamos onchange al select
		selectOpType.click(function(e) {
			//dependiendo de la opcion habilitamos o deshabilitamos los campos y los vaciamos
			if(selectOpType.val() == 'Recovery'){
				selectOpRecovery.removeAttr('disabled');
				selectOpCompensation.removeAttr('disabled');
			}else{
				selectOpRecovery.attr('disabled','true');
				selectOpRecovery.prev().children().first().children().first().text(selectOpRecovery.children().first().text());
				selectOpCompensation.attr('disabled','true');
				selectOpCompensation.prev().children().first().children().first().text(selectOpCompensation.children().first().text());
				inputOpRecOther.attr('disabled','true');
				selectOpRecovery.val('');
				inputOpRecOther.val('');
			}
		});
		//agregamos onchange al select
		selectOpRecovery.click(function(e) {
			//dependiendo de la opcion habilitamos o deshabilitamos los campos y los vaciamos
			if(selectOpRecovery.val() === 'Other'){
				inputOpRecOther.removeAttr('disabled');
			}else{
				inputOpRecOther.attr('disabled','true');
				inputOpRecOther.val('');
			}
		});
		//agregamos onchange al select
		selectOpRecovery.click(function(e) {
			//dependiendo de la opcion habilitamos o deshabilitamos los campos y los vaciamos
			if(selectOpRecovery.val() === 'Other'){
				inputOpPerOther.removeAttr('disabled');
			}else{
				inputOpPerOther.attr('disabled','true');
				inputOpPerOther.val('');
			}
		});
	},
	registerBasicEvents : function(container) {
		this._super(container);
	}
});