/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Vtiger_Detail_Js("Noticias_Detail_Js",{
   
},{
	camposHTML: Array(
		"notnoticia"
	),

	cambiarHTMLCondiciones: function(container){
		$("#Noticias_detailView_fieldValue_notnoticia>span.value").html($("#Noticias_detailView_fieldValue_notnoticia>span.value").text());
	},
	configurar_texto_rico : function(container){
		var configuracion_1 = {
            // language: 'es',
            // uiColor: '#1560BD'
        };
        var notnoticia_span_value = $('#Noticias_detailView_fieldValue_notnoticia>span.value');
        //var notnoticia = 'Noticias_detailView_fieldValue_notnoticia>span.value';
        //var notnoticia = "textarea[name='notnoticia']";

        //jQuery(notnoticia).ckeditor(configuracion_1);
        notnoticia_span_value.html('<p>' + notnoticia_span_value.html().replace('<', '&lt;').replace('>', '&gt;') + '</p>');
	},	
	registerEventForRelatedTabClick : function(container){
		//this.cambiarHTMLCondiciones(container);
		//alert("aca");
		$("#Noticias_detailView_fieldValue_notnoticia>span.value").html($("#Noticias_detailView_fieldValue_notnoticia>span.value").text());
		$('.editAction').css('display', 'none');
	},
	registerBasicEvents : function(container) {
		this._super(container);
		//this.cambiarHTMLCondiciones(container);
		//alert("aca");
		//$('.editAction').css('display', 'none');
	}
});


