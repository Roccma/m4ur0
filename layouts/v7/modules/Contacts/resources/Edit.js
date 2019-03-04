/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
Vtiger_Edit_Js("Contacts_Edit_Js",{},{
	
	//Will have the mapping of address fields based on the modules
	addressFieldsMapping : {'Accounts' :
									{'mailingstreet' : 'bill_street',  
									'otherstreet' : 'ship_street', 
									'mailingpobox' : 'bill_pobox',
									'otherpobox' : 'ship_pobox',
									'mailingcity' : 'bill_city',
									'othercity' : 'ship_city',
									'mailingstate' : 'bill_state',
									'otherstate' : 'ship_state',
									'mailingzip' : 'bill_code',
									'otherzip' : 'ship_code',
									'mailingcountry' : 'bill_country',
									'othercountry' : 'ship_country'
									}
							},
							
	//Address field mapping within module
	addressFieldsMappingInModule : {
										'otherstreet' : 'mailingstreet',
										'otherpobox' : 'mailingpobox',
										'othercity' : 'mailingcity',
										'otherstate' : 'mailingstate',
										'otherzip' : 'mailingzip',
										'othercountry' : 'mailingcountry'
								},
	
        /* Function which will register event for Reference Fields Selection
        */
	registerReferenceSelectionEvent : function(container) {
            var thisInstance = this;

           jQuery('input[name="account_id"]', container).on(Vtiger_Edit_Js.referenceSelectionEvent,function(e,data){
                thisInstance.referenceSelectionEventHandler(data, container);
            });
	},
		
	/**
	 * Reference Fields Selection Event Handler
	 * On Confirmation It will copy the address details
	 */
	referenceSelectionEventHandler :  function(data, container) {
		var thisInstance = this;
		var message = app.vtranslate('OVERWRITE_EXISTING_MSG1')+app.vtranslate('SINGLE_'+data['source_module'])+' ('+data['selectedName']+') '+app.vtranslate('OVERWRITE_EXISTING_MSG2');
		app.helper.showConfirmationBox({'message' : message}).then(function(e){
			thisInstance.copyAddressDetails(data, container);
		},
		function(error,err){});
	},
	
	/**
	 * Function which will copy the address details - without Confirmation
	 */
	copyAddressDetails : function(data, container) {
		var thisInstance = this;
		var sourceModule = data['source_module'];
		thisInstance.getRecordDetails(data).then(
			function(response){
				thisInstance.mapAddressDetails(thisInstance.addressFieldsMapping[sourceModule], response['data'], container);
			},
			function(error, err){

			});
	},
	
	/**
	 * Function which will map the address details of the selected record
	 */
	mapAddressDetails : function(addressDetails, result, container) {
		for(var key in addressDetails) {
            if(container.find('[name="'+key+'"]').length == 0) {
                var create = container.append("<input type='hidden' name='"+key+"'>");
            }
			container.find('[name="'+key+'"]').val(result[addressDetails[key]]);
			container.find('[name="'+key+'"]').trigger('change');
		}
	},
	
	/**
	 * Function to swap array
	 * @param Array that need to be swapped
	 */ 
	swapObject : function(objectToSwap){
		var swappedArray = {};
		var newKey,newValue;
		for(var key in objectToSwap){
			newKey = objectToSwap[key];
			newValue = key;
			swappedArray[newKey] = newValue;
		}
		return swappedArray;
	},
	
	/**
	 * Function to copy address between fields
	 * @param strings which accepts value as either odd or even
	 */
	copyAddress : function(swapMode, container){
		var thisInstance = this;
		var addressMapping = this.addressFieldsMappingInModule;
		if(swapMode == "false"){
			for(var key in addressMapping) {
				var fromElement = container.find('[name="'+key+'"]');
				var toElement = container.find('[name="'+addressMapping[key]+'"]');
				toElement.val(fromElement.val());
				if((jQuery("#massEditContainer").length) && (toElement.val()!= "") && (typeof(toElement.attr('data-validation-engine')) == "undefined")){
					toElement.attr('data-validation-engine', toElement.data('invalidValidationEngine'));
				}
			}
		} else if(swapMode){
			var swappedArray = thisInstance.swapObject(addressMapping);
			for(var key in swappedArray) {
				var fromElement = container.find('[name="'+key+'"]');
				var toElement = container.find('[name="'+swappedArray[key]+'"]');
				toElement.val(fromElement.val());
				if((jQuery("#massEditContainer").length) && (toElement.val()!= "")  && (typeof(toElement.attr('data-validation-engine')) == "undefined")){
					toElement.attr('data-validation-engine', toElement.data('invalidValidationEngine'));
				}
			}
		}
	},
	
	
	/**
	 * Function to register event for copying address between two fileds
	 */
	registerEventForCopyingAddress : function(container){
		var thisInstance = this;
		var swapMode;
		jQuery('[name="copyAddress"]').on('click',function(e){
			var element = jQuery(e.currentTarget);
			var target = element.data('target');
			if(target == "other"){
				swapMode = "false";
			} else if(target == "mailing"){
				swapMode = "true";
			}
			thisInstance.copyAddress(swapMode, container);
		})
	},

	/**
	 * Function to check for Portal User
	 */
	checkForPortalUser: function (form) {
		var element = jQuery('[name="portal"]', form);
		var response = element.is(':checked');
		var primaryEmailField = jQuery('[name="email"]');
		var primaryEmailValue = primaryEmailField.val();
		if (response) {
			if (primaryEmailField.length == 0) {
				app.helper.showErrorNotification({message: app.vtranslate('JS_PRIMARY_EMAIL_FIELD_DOES_NOT_EXISTS')});
				return false;
			}
			if (primaryEmailValue == "") {
				app.helper.showErrorNotification({message: app.vtranslate('JS_PLEASE_ENTER_PRIMARY_EMAIL_VALUE_TO_ENABLE_PORTAL_USER')});
				return false;
			}
		}
		return true;
	},
	/**
	 * Function to register recordpresave event
	 */
	registerRecordPreSaveEvent: function (form) {
		var thisInstance = this;
		if (typeof form == 'undefined') {
			form = this.getForm();
		}

		app.event.on(Vtiger_Edit_Js.recordPresaveEvent, function (e) {
			if($('#Contacts_editView_fieldName_agent').is(':checked')){
				console.log($('#Contacts_Edit_fieldName_top_specialities').val());
				if($('select[data-fieldname="agency_type"]').val() == ""){
					let messageToShow = "No se ha indicado tipo de agencia";
					app.helper.showErrorNotification({message : messageToShow});
					e.preventDefault();
				}

				if($('#Contacts_editView_fieldName_agency_number').val() == ""){
					let messageToShow = "No se ha indicado número de agencia";
					app.helper.showErrorNotification({message : messageToShow});
					e.preventDefault();
				}

				if($('#Contacts_editView_fieldName_number_employees').val() == ""){
					let messageToShow = "No se ha indicado número de empleados";
					app.helper.showErrorNotification({message : messageToShow});
					e.preventDefault();
				}

				if($('#Contacts_editView_fieldName_agency_number').val() == ""){
					let messageToShow = "No se ha indicado número de agencia";
					app.helper.showErrorNotification({message : messageToShow});
					e.preventDefault();
				}

				if($('select[data-fieldname="agency_kind"]').val() == ""){
					let messageToShow = "No se ha indicado modo de agencia";
					app.helper.showErrorNotification({message : messageToShow});
					e.preventDefault();
				}	

				if($('select[data-fieldname="agency_affiliation"]').val() == ""){
					let messageToShow = "No se ha indicado afiliación de la agencia";
					app.helper.showErrorNotification({message : messageToShow});
					e.preventDefault();
				}	

				if($('#Contacts_Edit_fieldName_top_selling_destinations').val() == null || $('#Contacts_Edit_fieldName_top_selling_destinations').val().length < 2){
					console.log("destinations null");
					let messageToShow = "No se han indicado los dos destinos de venta favoritos";
					app.helper.showErrorNotification({message : messageToShow});
					e.preventDefault();
				}	

				if($('#Contacts_Edit_fieldName_top_specialities').val() == null || $('#Contacts_Edit_fieldName_top_specialities').val().length < 2){
					console.log("destinations null");
					let messageToShow = "No se han indicado las dos especialidades favoritas";
					app.helper.showErrorNotification({message : messageToShow});
					e.preventDefault();
				}	

				if(!$('#Contacts_editView_fieldName_accept_conditions').is(':checked')){
					let messageToShow = "No se han aceptado los términos y condiciones de uso";
					app.helper.showErrorNotification({message : messageToShow});
					e.preventDefault();
				}			

			}
			var result = thisInstance.checkForPortalUser(form);
			if (!result) {
				e.preventDefault();
			}
		});

	},

	registerBasicEvents: function (container) {
		this._super(container);
		this.registerEventForCopyingAddress(container);
		this.registerRecordPreSaveEvent(container);
		this.registerReferenceSelectionEvent(container);

		jQuery(document).ready(function(){
			jQuery('#Contacts_editView_fieldName_campaniaventa').attr('disabled', 'disabled');
			jQuery('#Contacts_editView_fieldName_otro').attr('disabled', 'disabled');

			jQuery('select[data-fieldname="origen_contacto"]').on('change', function(){
				if(jQuery('select[data-fieldname="origen_contacto"]').val() == "Camapañas de Venta"){
					jQuery('#Contacts_editView_fieldName_campaniaventa').attr('disabled', false);
					jQuery('#Contacts_editView_fieldName_otro').attr('disabled', 'disabled');
				}
				else if(jQuery('select[data-fieldname="origen_contacto"]').val() == "Otro"){
					jQuery('#Contacts_editView_fieldName_campaniaventa').attr('disabled', 'disabled');
					jQuery('#Contacts_editView_fieldName_otro').attr('disabled', false);
				}
				else{
					jQuery('#Contacts_editView_fieldName_campaniaventa').attr('disabled', 'disabled');
					jQuery('#Contacts_editView_fieldName_otro').attr('disabled', 'disabled');
				}
			})

			if(!$('#Contacts_editView_fieldName_agent').is(':checked'))
				jQuery('div[data-block="LBL_Agents_INFORMATION"]').hide();

			$('#Contacts_editView_fieldName_agent').on('change', function(){
				if(!$('#Contacts_editView_fieldName_agent').is(':checked'))
					jQuery('div[data-block="LBL_Agents_INFORMATION"]').fadeOut();
				else
					jQuery('div[data-block="LBL_Agents_INFORMATION"]').fadeIn();
			})
		});
	}
})