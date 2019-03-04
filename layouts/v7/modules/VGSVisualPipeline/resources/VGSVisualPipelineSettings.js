/**
 * VGS Visual Pipeline Module
 *
 *
 * @package        VGSVisualPipeline Module
 * @author         Curto Francisco - www.vgsglobal.com
 * @license        vTiger Public License.
 * @version        Release: 1.0
 */

jQuery.Class("VGSVisualPipelineSetting_Js", {}, {
    SourceModuleUpdate: function () {
        jQuery('#module1').on('change', function (e) {
            let module1 = jQuery(this).val();
            jQuery("#amostrar1, #amostrar2, #amostrar3, #amostrar4").find('option[value!="-"]').remove().val('--').trigger('liszt:updated');

            jQuery(".notice").hide();
            let loadingMessage = "Cargando valores...";

            let progressIndicatorElement = jQuery.progressIndicator({
                'message': loadingMessage,
                'position': 'html',
                'blockInfo': {
                    'enabled': true
                }
            });

            let params = {
                module: "VGSVisualPipeline",
                action: "VGSGetPicklistFields",
                source_module: module1
            };

            AppConnector.request(params).then(
                function (data) {
                    if (data.success) {
                        var result = data.result;
                        if (result.result == 'ok') {
                            jQuery.each(result.options, function (i, item) {
                                let o = '<option value="'+i+'">'+item.label+'</option>';
                                if(~~item.picklist)
                                    jQuery("#picklist1").append(o);
                                jQuery("#amostrar1, #amostrar2, #amostrar3, #amostrar4").append(o);
                            });
                            if(typeof jQuery("#sourcefieldname").val() != "undefined"){
                                jQuery("#picklist1").val(jQuery("#sourcefieldname").val());
                                jQuery("#amostrar1").val(jQuery("#fieldname1").val());
                                jQuery("#amostrar2").val(jQuery("#fieldname2").val());
                                jQuery("#amostrar3").val(jQuery("#fieldname3").val());
                                jQuery("#amostrar4").val(jQuery("#fieldname4").val());
                            }
                            jQuery("#picklist1, #amostrar1, #amostrar2, #amostrar3, #amostrar4").trigger('liszt:updated');
                        } else {
                            Vtiger_Helper_Js.showPnotify("Error cargando campos");
                        }
                    }
                },
                function (error, err) {
                }
            );
            progressIndicatorElement.progressIndicator({
                'mode': 'hide'
            });

        });
    },
    saveEntry: function () {
        jQuery('#add_entry').on('click', function (e) {

            jQuery(".notices").hide();
            var loadingMessage = jQuery('.listViewLoadingMsg').text();

            if(jQuery("#module1").val() == "-"){
                var params = {
                    message : "Debe seleccionar un Módulo",
                    type: 'error'
                }
                Vtiger_Helper_Js.showPnotify(params);
                return;
            }

            if(jQuery("#picklist1").val() == "-"){
                var params = {
                    message : "Debe seleccionar un campo para segmentar",
                    type: 'error'
                }
                Vtiger_Helper_Js.showPnotify(params);
                return;
            }

            if(jQuery("#amostrar1").val() && jQuery("#amostrar1").val() != "-" && (jQuery("#amostrar1").val() == jQuery("#amostrar2").val() || jQuery("#amostrar1").val() == jQuery("#amostrar3").val() || jQuery("#amostrar1").val() == jQuery("#amostrar4").val())){
                var params = {
                    message : "Debe seleccionar campos distintos para mostrar",
                    type: 'error'
                }
                Vtiger_Helper_Js.showPnotify(params);
                return;
            }

            if(jQuery("#amostrar2").val() && jQuery("#amostrar2").val() != "-" && (jQuery("#amostrar2").val() == jQuery("#amostrar1").val() || jQuery("#amostrar2").val() == jQuery("#amostrar3").val() || jQuery("#amostrar2").val() == jQuery("#amostrar4").val())){
                var params = {
                    message : "Debe seleccionar campos distintos para mostrar",
                    type: 'error'
                }
                Vtiger_Helper_Js.showPnotify(params);
                return;
            }

            if(jQuery("#amostrar3").val() && jQuery("#amostrar3").val() != "-" && (jQuery("#amostrar3").val() == jQuery("#amostrar1").val() || jQuery("#amostrar3").val() == jQuery("#amostrar2").val() || jQuery("#amostrar3").val() == jQuery("#amostrar4").val())){
                var params = {
                    message : "Debe seleccionar campos distintos para mostrar",
                    type: 'error'
                }
                Vtiger_Helper_Js.showPnotify(params);
                return;
            }

            if(jQuery("#amostrar4").val() && jQuery("#amostrar4").val() != "-" && (jQuery("#amostrar4").val() == jQuery("#amostrar1").val() || jQuery("#amostrar4").val() == jQuery("#amostrar2").val() || jQuery("#amostrar4").val() == jQuery("#amostra34").val())){
                var params = {
                    message : "Debe seleccionar campos distintos para mostrar",
                    type: 'error'
                }
                Vtiger_Helper_Js.showPnotify(params);
                return;
            }

            if(jQuery("#amostrar1").val() == "-" && jQuery("#amostrar2").val() == "-" && jQuery("#amostrar3").val() == "-" && jQuery("#amostrar4").val() == "-"){
                var params = {
                    message : "Debe seleccionar algun campo a mostrar",
                    type: 'error'
                }
                Vtiger_Helper_Js.showPnotify(params);
                return;
            }

            var progressIndicatorElement = jQuery.progressIndicator({
                'message': loadingMessage,
                'position': 'html',
                'blockInfo': {
                    'enabled': true
                }
            });

            var params = {
                module: 'VGSVisualPipeline',
                action: 'VGSsave',
                mode: 'addEntry',
                module1: jQuery("#module1").val(),
                picklist1: jQuery("#picklist1").val(),
                amostrar1: jQuery("#amostrar1").val(),
                amostrar2: jQuery("#amostrar2").val(),
                amostrar3: jQuery("#amostrar3").val(),
                amostrar4: jQuery("#amostrar4").val(),
                vgsid: jQuery("#vgsid").val(),
            };

            AppConnector.request(params).then(
                    function (data) {
                        if (data.success) {
                            var response = data.result;

                            if (response.result == 'ok')
                                   window.location = 'index.php?module=VGSVisualPipeline&view=VGSIndexSettings&parent=Settings';
                            else{
                                var params = {
                                    message : response.message,
                                    type: 'error'
                                }
                                Vtiger_Helper_Js.showPnotify(params);
                            }
                        }
                        progressIndicatorElement.progressIndicator({
                            'mode': 'hide'
                        });
                    },
                    function (error, err) {
                        progressIndicatorElement.progressIndicator({
                            'mode': 'hide'
                        });
                    }
            );
        });
    },
    deleteEntry: function () {
        jQuery('.deleteRecordButton').on('click', function (e) {

            jQuery(".notices").hide();
            var loadingMessage = jQuery('.listViewLoadingMsg').text();

            var progressIndicatorElement = jQuery.progressIndicator({
                'message': loadingMessage,
                'position': 'html',
                'blockInfo': {
                    'enabled': true
                }
            });

            var params = {
                module: 'VGSVisualPipeline',
                action: 'VGSsave',
                mode: 'deleteRecord',
                module1: jQuery(this).data('sourcemodule'),
                record_id: jQuery(this).attr('id')
            };
            
            var line = jQuery(this).closest('tr');

            AppConnector.request(params).then(
                    function (data) {
                        if (data.success) {
                            var response = data.result;
                            if (response.result == 'ok')
                                line.hide('slow');
                            else{ 
                                var params = {
                                    message : "Eror al eliminar",
                                    type: 'error'
                                }
                                Vtiger_Helper_Js.showPnotify(params);
                            }
                        }
                        progressIndicatorElement.progressIndicator({
                            'mode': 'hide'
                        });
                    },
                    function (error, err) {
                        progressIndicatorElement.progressIndicator({
                            'mode': 'hide'
                        });
                    }
            );
        });
    },
    editEntry: function () {
        jQuery('.editRecordButton').on('click', function (e) {
        });
    },
    checkEdit: function (){
        if(jQuery("#sourcemodule").val() != ""){
            jQuery('#module1').val(jQuery("#sourcemodule").val()).trigger('liszt:updated').trigger("change");
        }
    },
    toSelect2: function (){
        jQuery("#module1, #picklist1, #amostrar1, #amostrar2, #amostrar3, #amostrar4").select2({width: "75%"});
    },
    registerEvents: function () {
        this.toSelect2();
        this.SourceModuleUpdate();
        this.saveEntry();
        this.deleteEntry();
        this.editEntry();
        this.checkEdit();
    }
    
});

jQuery(document).ready(function () {
    var instance = new VGSVisualPipelineSetting_Js();
    instance.registerEvents();
});