/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger_Edit_Js("Noticias_Edit_Js",{
   
},{

	camposHTML : Array('notnoticia'),
	CKEditors : Array(),
	registerHTMLconditions : function(container){
		//let campos = this.camposHTML;
		//for(let i = 0; i < campos.length; i++){
			CKEDITOR.disableAutoInline = true;
			CKEDITOR.inline("Noticias_editView_fieldName_notnoticia");
			$("#Noticias_editView_fieldName_notnoticia").siblings("div").
			css("max-height","100px").
			css("max-width",$("Noticias_editView_fieldName_notnoticia").siblings("div").css("width")).
			css("overflow-y", "scroll");
		//}
	},
	configurar_texto_rico : function(container){
		var configuracion_1 = {
            // language: 'es',
            // uiColor: '#1560BD'
        };
        var notnoticia_span_value = $('#Noticias_detailView_fieldName_notnoticia>span.value');
        var notnoticia = "Noticias_editView_fieldName_notnoticia";

        jQuery('#' + notnoticia).ckeditor(configuracion_1);
        notnoticia_span_value.html(CKEDITOR.instances[notnoticia].getData());
	},	
	registerBasicEvents : function(container) {
		this._super(container);
		this.configurar_texto_rico(container);
		/*jQuery(document).on('ready', function(){
			jQuery.ajax({
				url : 'index.php?module=Noticias&action=getLanguages',
				dataType : 'json'
			})
			.done(function(response){
				console.log(response);
				for(var i = 0; i < response.length; i++){
					var opt = new Option(response[i]['idioma'], response[i]['idioma']);
					$(opt).html(response[i]['idioma']);
					$('select[name="notidioma"]').append(opt);
				}
				
				$('select[name="notidioma"]').trigger('liszt:updated');
			})
			.fail(function(error, err, e){
				console.log(e);
			});
		});*/
	}
});
