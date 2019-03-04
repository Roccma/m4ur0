/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger_Edit_Js("RedimirDias_Edit_Js",{
   
},{
	registerRecordPreSaveEvent: function (form) {
		var thisInstance = this;
		if (typeof form == 'undefined') {
			form = this.getForm();
		}

		app.event.on(Vtiger_Edit_Js.recordPresaveEvent, function (e) {
			let url = location.href;
			let urlSplit = url.split('&');
			var record = "";
			for(let i = 0; i < urlSplit.length; i++){
				let paramsSplit = urlSplit[i].split('=');
				if(paramsSplit[0] == 'record')
					record = paramsSplit[1];
			}
			//alert(record);
			jQuery.ajax({
				url : 'index.php?module=RedimirDias&action=getDiasDisponibles',
				async : false,
				dataType : 'JSON',
				data : {'contacto' : jQuery('input[name="redcontacto"]').val(),
						'fechaDesde' : jQuery('#RedimirDias_editView_fieldName_redfechacom').val(),
						'fechaHasta' : jQuery('#RedimirDias_editView_fieldName_redfechafin').val(),
						'record' : record}
			})
			.done(function(response){
				if(response['result'] == false){
					let messageToShow = response['message'] == 'no_dates' ? "No se han especificado fechas de inicio y/o fin" : "No se cuenta con la cantidad de días solicitados disponibles";
					app.helper.showErrorNotification({message : messageToShow});
					e.preventDefault();
					/*var params = {
                        text : response['message'] == 'no_dates' ? "No se han especificado fechas de inicio y/o fin" : "No se cuenta con la cantidad de días solicitados disponibles",
                        title : "ERROR"
                    }
                    Vtiger_Helper_Js.showPnotify(params);*/
				}
			})
			.fail(function(error, err, er){
				alert(er);
			});
			//e.preventDefault();
			//var result = thisInstance.checkForPortalUser(form);
			/*if (!result) {
				e.preventDefault();
			}*/
		});

	},

	registerBasicEvents : function(container) {
		this._super(container);
		this.registerRecordPreSaveEvent(container);
		jQuery(document).on('ready', function(){

			//alert("aca");
			jQuery('#RedimirDias_editView_fieldName_redpasajero1').attr('disabled', 'disabled');
			jQuery('#RedimirDias_editView_fieldName_redpasajero2').attr('disabled', 'disabled');
			jQuery('#RedimirDias_editView_fieldName_redpasajero3').attr('disabled', 'disabled');
			jQuery('#RedimirDias_editView_fieldName_redpasajero4').attr('disabled', 'disabled');
			jQuery('#RedimirDias_editView_fieldName_redpasajero5').attr('disabled', 'disabled');

			jQuery('#RedimirDias_editView_fieldName_redpasajeros').on('change', function(){
				if(jQuery('#RedimirDias_editView_fieldName_redpasajeros').val() < 1){
					jQuery('#RedimirDias_editView_fieldName_redpasajero1').attr('disabled', 'disabled');
					jQuery('#RedimirDias_editView_fieldName_redpasajero2').attr('disabled', 'disabled');
					jQuery('#RedimirDias_editView_fieldName_redpasajero3').attr('disabled', 'disabled');
					jQuery('#RedimirDias_editView_fieldName_redpasajero4').attr('disabled', 'disabled');
					jQuery('#RedimirDias_editView_fieldName_redpasajero5').attr('disabled', 'disabled');
				}
				else if(jQuery('#RedimirDias_editView_fieldName_redpasajeros').val() == 1){
					jQuery('#RedimirDias_editView_fieldName_redpasajero1').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero2').attr('disabled', 'disabled');
					jQuery('#RedimirDias_editView_fieldName_redpasajero3').attr('disabled', 'disabled');
					jQuery('#RedimirDias_editView_fieldName_redpasajero4').attr('disabled', 'disabled');
					jQuery('#RedimirDias_editView_fieldName_redpasajero5').attr('disabled', 'disabled');
				}
				else if(jQuery('#RedimirDias_editView_fieldName_redpasajeros').val() == 2){
					jQuery('#RedimirDias_editView_fieldName_redpasajero1').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero2').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero3').attr('disabled', 'disabled');
					jQuery('#RedimirDias_editView_fieldName_redpasajero4').attr('disabled', 'disabled');
					jQuery('#RedimirDias_editView_fieldName_redpasajero5').attr('disabled', 'disabled');
				}
				else if(jQuery('#RedimirDias_editView_fieldName_redpasajeros').val() == 3){
					jQuery('#RedimirDias_editView_fieldName_redpasajero1').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero2').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero3').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero4').attr('disabled', 'disabled');
					jQuery('#RedimirDias_editView_fieldName_redpasajero5').attr('disabled', 'disabled');
				}
				else if(jQuery('#RedimirDias_editView_fieldName_redpasajeros').val() == 4){
					jQuery('#RedimirDias_editView_fieldName_redpasajero1').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero2').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero3').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero4').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero5').attr('disabled', 'disabled');
				}
				else if(jQuery('#RedimirDias_editView_fieldName_redpasajeros').val() >= 5){
					jQuery('#RedimirDias_editView_fieldName_redpasajero1').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero2').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero3').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero4').attr('disabled', false);
					jQuery('#RedimirDias_editView_fieldName_redpasajero5').attr('disabled', false);
				}
			});
			
		});
	}
});