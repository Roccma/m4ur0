/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger_Edit_Js("SolicitudesReservas_Edit_Js",{
   
},{
	registerBasicEvents : function(container) {
		this._super(container);
		jQuery(document).on('ready', function(){
			//alert("aca");
			//jQuery('input[name="respasajero1"] < div').parent().css({"display" : "none"});

			/*jQuery('input[name="respasajero1"]').on('change', function(){
				alert("change!");
			});

			jQuery('input[name="respasajero1"]').parent().css('display', 'none');*/
			jQuery('#respasajero1_display').attr('disabled', 'disabled');
			jQuery('#respasajero1_display').siblings('.relatedPopup').css({"pointer-events":"none"});
			jQuery('#SolicitudesReservas_editView_fieldName_respasajero1_create').parent().css({"pointer-events":"none"});

			jQuery('#respasajero2_display').attr('disabled', 'disabled');
			jQuery('#respasajero2_display').siblings('.relatedPopup').css({"pointer-events":"none"});
			jQuery('#SolicitudesReservas_editView_fieldName_respasajero2_create').parent().css({"pointer-events":"none"});

			jQuery('#respasajero3_display').attr('disabled', 'disabled');
			jQuery('#respasajero3_display').siblings('.relatedPopup').css({"pointer-events":"none"});
			jQuery('#SolicitudesReservas_editView_fieldName_respasajero3_create').parent().css({"pointer-events":"none"});

			jQuery('#respasajero4_display').attr('disabled', 'disabled');
			jQuery('#respasajero4_display').siblings('.relatedPopup').css({"pointer-events":"none"});
			jQuery('#SolicitudesReservas_editView_fieldName_respasajero4_create').parent().css({"pointer-events":"none"});

			jQuery('#respasajero5_display').attr('disabled', 'disabled');
			jQuery('#respasajero5_display').siblings('.relatedPopup').css({"pointer-events":"none"});
			jQuery('#SolicitudesReservas_editView_fieldName_respasajero5_create').parent().css({"pointer-events":"none"});

			jQuery('#SolicitudesReservas_editView_fieldName_respasajeros').on('change', function(){
				if(jQuery('#SolicitudesReservas_editView_fieldName_respasajeros').val() < 1){
					jQuery('#respasajero1_display').attr('disabled', 'disabled');
					jQuery('#respasajero1_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero1_create').parent().css({"pointer-events":"none"});

					jQuery('#respasajero2_display').attr('disabled', 'disabled');
					jQuery('#respasajero2_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero2_create').parent().css({"pointer-events":"none"});

					jQuery('#respasajero3_display').attr('disabled', 'disabled');
					jQuery('#respasajero3_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero3_create').parent().css({"pointer-events":"none"});

					jQuery('#respasajero4_display').attr('disabled', 'disabled');
					jQuery('#respasajero4_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero4_create').parent().css({"pointer-events":"none"});

					jQuery('#respasajero5_display').attr('disabled', 'disabled');
					jQuery('#respasajero5_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero5_create').parent().css({"pointer-events":"none"});
				}
				else if(jQuery('#SolicitudesReservas_editView_fieldName_respasajeros').val() == 1){
					jQuery('#respasajero1_display').attr('disabled', false);
					jQuery('#respasajero1_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero1_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero2_display').attr('disabled', 'disabled');
					jQuery('#respasajero2_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero2_create').parent().css({"pointer-events":"none"});

					jQuery('#respasajero3_display').attr('disabled', 'disabled');
					jQuery('#respasajero3_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero3_create').parent().css({"pointer-events":"none"});

					jQuery('#respasajero4_display').attr('disabled', 'disabled');
					jQuery('#respasajero4_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero4_create').parent().css({"pointer-events":"none"});

					jQuery('#respasajero5_display').attr('disabled', 'disabled');
					jQuery('#respasajero5_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero5_create').parent().css({"pointer-events":"none"});
				}
				else if(jQuery('#SolicitudesReservas_editView_fieldName_respasajeros').val() == 2){
					jQuery('#respasajero1_display').attr('disabled', false);
					jQuery('#respasajero1_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero1_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero2_display').attr('disabled', false);
					jQuery('#respasajero2_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero2_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero3_display').attr('disabled', 'disabled');
					jQuery('#respasajero3_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero3_create').parent().css({"pointer-events":"none"});

					jQuery('#respasajero4_display').attr('disabled', 'disabled');
					jQuery('#respasajero4_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero4_create').parent().css({"pointer-events":"none"});

					jQuery('#respasajero5_display').attr('disabled', 'disabled');
					jQuery('#respasajero5_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero5_create').parent().css({"pointer-events":"none"});
				}
				else if(jQuery('#SolicitudesReservas_editView_fieldName_respasajeros').val() == 3){
					jQuery('#respasajero1_display').attr('disabled', false);
					jQuery('#respasajero1_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero1_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero2_display').attr('disabled', false);
					jQuery('#respasajero2_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero2_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero3_display').attr('disabled', false);
					jQuery('#respasajero3_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero3_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero4_display').attr('disabled', 'disabled');
					jQuery('#respasajero4_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero4_create').parent().css({"pointer-events":"none"});

					jQuery('#respasajero5_display').attr('disabled', 'disabled');
					jQuery('#respasajero5_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero5_create').parent().css({"pointer-events":"none"});
				}
				else if(jQuery('#SolicitudesReservas_editView_fieldName_respasajeros').val() == 4){
					jQuery('#respasajero1_display').attr('disabled', false);
					jQuery('#respasajero1_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero1_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero2_display').attr('disabled', false);
					jQuery('#respasajero2_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero2_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero3_display').attr('disabled', false);
					jQuery('#respasajero3_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero3_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero4_display').attr('disabled', false);
					jQuery('#respasajero4_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero4_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero5_display').attr('disabled', 'disabled');
					jQuery('#respasajero5_display').siblings('.relatedPopup').css({"pointer-events":"none"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero5_create').parent().css({"pointer-events":"none"});
				}
				else if(jQuery('#SolicitudesReservas_editView_fieldName_respasajeros').val() >= 5){
					jQuery('#respasajero1_display').attr('disabled', false);
					jQuery('#respasajero1_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero1_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero2_display').attr('disabled', false);
					jQuery('#respasajero2_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero2_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero3_display').attr('disabled', false);
					jQuery('#respasajero3_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero3_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero4_display').attr('disabled', false);
					jQuery('#respasajero4_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero4_create').parent().css({"pointer-events":"auto"});

					jQuery('#respasajero5_display').attr('disabled', false);
					jQuery('#respasajero5_display').siblings('.relatedPopup').css({"pointer-events":"auto"});
					jQuery('#SolicitudesReservas_editView_fieldName_respasajero5_create').parent().css({"pointer-events":"auto"});
				}
			});
		});
	}
});