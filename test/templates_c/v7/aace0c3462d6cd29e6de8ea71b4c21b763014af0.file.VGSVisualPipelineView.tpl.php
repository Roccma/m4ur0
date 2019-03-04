<?php /* Smarty version Smarty-3.1.7, created on 2019-01-11 08:03:23
         compiled from "/var/www/html/Sirenis/includes/runtime/../../layouts/v7/modules/VGSVisualPipeline/VGSVisualPipelineView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20361836345c384dcb736088-85570683%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aace0c3462d6cd29e6de8ea71b4c21b763014af0' => 
    array (
      0 => '/var/www/html/Sirenis/includes/runtime/../../layouts/v7/modules/VGSVisualPipeline/VGSVisualPipelineView.tpl',
      1 => 1542884364,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20361836345c384dcb736088-85570683',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'COLUMNA' => 0,
    'MODULENAME' => 0,
    'PUEDECREAR' => 0,
    'RECORDS_ARRAY' => 0,
    'RECORDS' => 0,
    'llave' => 0,
    'FILTERFIELDLABEL' => 0,
    'otro' => 0,
    'RECORD_INFO' => 0,
    'RECORDS_SETTINGS' => 0,
    'FIELD_MODEL' => 0,
    'indexActual' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5c384dcb858d3',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c384dcb858d3')) {function content_5c384dcb858d3($_smarty_tpl) {?>
<style>.tilt.right {transform: rotate(3deg);-moz-transform: rotate(3deg);-webkit-transform: rotate(3deg);}.tilt.left {transform: rotate(-3deg);-moz-transform: rotate(-3deg);-webkit-transform: rotate(-3deg);}body {min-width: 520px;}.vgs-visual-pipeline{width: 100%;margin: 0 auto;height: 500px;min-height: 500px;white-space: nowrap;overflow-x: scroll;overflow-y: hidden;}.columnTitle{text-align: center;margin-bottom: 5%;word-wrap: break-word;}.vgs-visual-pipeline .column {width: 250px;padding-bottom: 100px;display: inline-block;height: 500px;margin-right: 5.7px;}.vgs-visual-pipeline .column-list {overflow-y: scroll;width: 250px;padding-bottom: 100px;display: inline-block;height: 80%;margin-right: 5.7px;}.vgs-visual-pipeline .quickLinksDiv p.selectedQuickLink a:after{border-bottom: 20px solid rgba(0, 0, 0, 0);}.vgs-visual-pipeline .quickLinksDiv {margin: 10px auto 10px 1%;width: 90%;}.vgs-visual-pipeline  .quickLinksDiv p {font-size: 1em;padding: 5% 0 0 2%;}.vgs-visual-pipeline .table th, .table td {padding: 3%;font-size: 80%;word-wrap: break-word;white-space: normal;}.vgs-visual-pipeline .table {}.portlet {margin: 0 1em 0.5em 0;padding: 0.1em;}.portlet:hover {cursor: default;}.portlet-header {padding: 0.2em 0.3em;margin-bottom: 0.5em;position: relative;border-bottom: 1px solid #acacac;color: rgb(68, 68, 68);overflow: hidden;}.portlet-header a {display: block;overflow: hidden;width: 85%;}.portlet-toggle {position: absolute;top: 50%;right: 0;margin-top: -8px;display: block;}.portlet-settings {position: absolute;top: 50%;right: 16px;margin-top: -8px;display: block;}.portlet-content {padding: 0.4em;}.portlet-placeholder {border: 1px dotted black;margin: 0 1em 1em 0;height: 50px;}.portlet.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all{height: auto;}.ui-widget-content {border-radius: 1px;border-color: #ffffff;box-shadow: 0 0 3px -1px inset;margin-top: 2px;margin-left: 5px;height: 12px;}#tablaajustes>tbody>tr>td{text-align: center;padding: 10px;}#tablaajustes>tbody>tr>td.nombreprop{font-size: 15px;font-weight: bold;}#tablaajustes>tbody>tr>td.aclaracionprop{font-size: 10px;}.colorpicker.dropdown-menu.colorpicker-with-alpha.colorpicker-right.colorpicker-visible{z-index: 10000 !important;}#divcoloreador{height: 18px;}#icoloreador{border: 1px solid black;display: inline-block;width: 32px;height: 16px;}div.portlet-content > div{white-space: normal;}div.ultimos{width: 72%;display: inline-block;}div.imagen{width: 26%;display: inline-block;}div.imagen > img{border-radius: 50%;height: auto;max-width: 50px;}</style><div id="modalSettings" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><input type="hidden" id="idregistro" value=""><div class="modal-header"><div class="titleHolder" style="text-align: center;"><h3>Ajuste el registro a su gusto</h3></div></div><div class="modal-body"><table id="tablaajustes" class="table table-bordered equalSplit detailview-table"><tbody><tr><td class="nombreprop">Color</td><td class="aclaracionprop">(Dejar en blanco o en negro para eliminar color)</td><td><div id="divcoloreador" class="input-group colorpicker-component colorpicker-element"><i id="icoloreador" class="input-group-addon"></i></div></td></tr></tbody></table></div><div class="modal-footer"><button id="saveSettings" class="btn btn-success">Guardar</button><button id="closeSettings" class="btn btn-danger" style="float: left;">Cerrar</button></div></div></div></div><input type="hidden" id="columna_filtro" value="<?php echo $_smarty_tpl->tpl_vars['COLUMNA']->value;?>
"><input type="hidden" id="modulo" value="<?php echo $_smarty_tpl->tpl_vars['MODULENAME']->value;?>
"><?php $_smarty_tpl->tpl_vars['NOMBREMODULO'] = new Smarty_variable(('SINGLE_').($_smarty_tpl->tpl_vars['MODULENAME']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['PUEDECREAR']->value){?><div class="listViewActionsDiv row-fluid"><span class="btn-toolbar span4"><span class="btn-group listViewMassActions"><span class="btn-group"><button id="alterarToggle" type="button" class="btn btn-default" data-actual="contraer">Contraer tareas</button></span></span></span></div><?php }?><div class="vgs-visual-pipeline"><?php  $_smarty_tpl->tpl_vars['RECORDS'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RECORDS']->_loop = false;
 $_smarty_tpl->tpl_vars['order'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORDS_ARRAY']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RECORDS']->key => $_smarty_tpl->tpl_vars['RECORDS']->value){
$_smarty_tpl->tpl_vars['RECORDS']->_loop = true;
 $_smarty_tpl->tpl_vars['order']->value = $_smarty_tpl->tpl_vars['RECORDS']->key;
?><?php  $_smarty_tpl->tpl_vars['otro'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['otro']->_loop = false;
 $_smarty_tpl->tpl_vars['llave'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORDS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['otro']->key => $_smarty_tpl->tpl_vars['otro']->value){
$_smarty_tpl->tpl_vars['otro']->_loop = true;
 $_smarty_tpl->tpl_vars['llave']->value = $_smarty_tpl->tpl_vars['otro']->key;
?><div class="column"><?php if ($_smarty_tpl->tpl_vars['llave']->value!=''){?><div class="quickLinksDiv"><p class="columnTitle selectedQuickLink "><a class="quickLinks"><strong><?php echo vtranslate($_smarty_tpl->tpl_vars['llave']->value,$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
</strong></a></p></div><?php }else{ ?><div class="quickLinksDiv"><p class="columnTitle selectedQuickLink "><a class="quickLinks"><strong>Sin <?php echo $_smarty_tpl->tpl_vars['FILTERFIELDLABEL']->value;?>
</strong></a></p></div><?php }?><div class="column-list" id="<?php echo $_smarty_tpl->tpl_vars['llave']->value;?>
"><?php if (count($_smarty_tpl->tpl_vars['otro']->value)>0){?><?php  $_smarty_tpl->tpl_vars['RECORD_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RECORD_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['otro']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RECORD_INFO']->key => $_smarty_tpl->tpl_vars['RECORD_INFO']->value){
$_smarty_tpl->tpl_vars['RECORD_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['RECORD_INFO']->key;
?><div class="portlet" id="<?php echo $_smarty_tpl->tpl_vars['RECORD_INFO']->value['RECORD'];?>
" data-key="<?php echo $_smarty_tpl->tpl_vars['llave']->value;?>
" style="border: 2px ridge #00000052;<?php if (!!$_smarty_tpl->tpl_vars['RECORDS_SETTINGS']->value[$_smarty_tpl->tpl_vars['RECORD_INFO']->value['RECORD']]){?>border-left: 10px solid <?php echo $_smarty_tpl->tpl_vars['RECORDS_SETTINGS']->value[$_smarty_tpl->tpl_vars['RECORD_INFO']->value['RECORD']];?>
<?php }?>"><div class="portlet-header" style="border: none;"><a href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['MODULENAME']->value;?>
&record=<?php echo $_smarty_tpl->tpl_vars['RECORD_INFO']->value['RECORD'];?>
&view=Detail" target="_blank" title="<?php echo $_smarty_tpl->tpl_vars['RECORD_INFO']->value['RECORD_LABEL'];?>
"><?php echo $_smarty_tpl->tpl_vars['RECORD_INFO']->value['RECORD_LABEL'];?>
</a></div><div class="portlet-content"><div><?php  $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['RECORD_INFO']->value['TOOLTIP_FIELDS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fieldsCount']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['FIELD_MODEL']->key => $_smarty_tpl->tpl_vars['FIELD_MODEL']->value){
$_smarty_tpl->tpl_vars['FIELD_MODEL']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['fieldsCount']['index']++;
?><div class="row-fluid<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['fieldsCount']['index']<count($_smarty_tpl->tpl_vars['RECORD_INFO']->value['TOOLTIP_FIELDS'])-2){?>" title="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
" ><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['RECORD_INFO']->value['RECORD_MODEL']->get($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name')),$_smarty_tpl->tpl_vars['RECORD_INFO']->value['RECORD']);?>
<?php }else{ ?><?php echo " ";?>
ultimos"><?php $_smarty_tpl->tpl_vars['indexActual'] = new Smarty_variable(count($_smarty_tpl->tpl_vars['RECORD_INFO']->value['TOOLTIP_FIELDS'])-2, null, 0);?><div title="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['RECORD_INFO']->value['RECORD_MODEL']->get($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name')),$_smarty_tpl->tpl_vars['RECORD_INFO']->value['RECORD']);?>
</div><?php if (count($_smarty_tpl->tpl_vars['RECORD_INFO']->value['TOOLTIP_FIELDS'])!=1){?><?php $_smarty_tpl->tpl_vars['indexActual'] = new Smarty_variable($_smarty_tpl->tpl_vars['indexActual']->value+1, null, 0);?><?php $_smarty_tpl->tpl_vars['FIELD_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_INFO']->value['TOOLTIP_FIELDS'][$_smarty_tpl->tpl_vars['indexActual']->value], null, 0);?><div title="<?php echo vtranslate($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('label'),$_smarty_tpl->tpl_vars['MODULENAME']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['FIELD_MODEL']->value->getDisplayValue($_smarty_tpl->tpl_vars['RECORD_INFO']->value['RECORD_MODEL']->get($_smarty_tpl->tpl_vars['FIELD_MODEL']->value->get('name')),$_smarty_tpl->tpl_vars['RECORD_INFO']->value['RECORD']);?>
</div><?php }?><?php }?></div><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['fieldsCount']['index']>=count($_smarty_tpl->tpl_vars['RECORD_INFO']->value['TOOLTIP_FIELDS'])-2){?><div class="value imagen"><img src="<?php echo $_smarty_tpl->tpl_vars['RECORD_INFO']->value['PATHIMAGEN'];?>
" class="pull-right"></div><?php break 1?><?php }?><?php } ?></div></div></div><?php } ?><?php }?></div></div><?php } ?><?php } ?></div><script>
        jQuery(document).ready(function() {
            jQuery('.vgs-visual-pipeline').height(jQuery(window).height()-jQuery('.navbar-fixed-top').height())
        });

    </script><?php }} ?>