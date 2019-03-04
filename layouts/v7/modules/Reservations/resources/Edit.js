/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger_Edit_Js("Reservations_Edit_Js",{
   
},{
	registerBasicEvents : function(container) {
		this._super(container);
		jQuery(document).on('ready', function(){			
			jQuery('#Reservations_editView_fieldName_anio').attr('maxlength', 4);
			jQuery('#Reservations_editView_fieldName_reserva').attr('maxlength', 10);
			jQuery('#Reservations_editView_fieldName_desglose').attr('maxlength', 3);
			jQuery.ajax({
				url : 'index.php?module=Contacts&action=getContacts',
				dataType : 'json'
			})
			.done(function(response){
				console.log(response);
				for(let i = 0; i < response.length; i++){
					let option = new Option(response[i], response[i]);					
					jQuery('#Reservations_Edit_fieldName_contactos').append(option);
				}

				jQuery('#Reservations_Edit_fieldName_contactos').trigger('liszt:updated');
			});
		});
	}
});