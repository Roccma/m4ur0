<?php /* Smarty version Smarty-3.1.19, created on 2019-01-09 20:52:41
         compiled from "/var/www/html/Sirenis/Portal/layouts/default/templates/Noticias/partials/DetailContentBefore.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8901595955c2f3a058afe33-79288028%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0a444c9ffc5db9ac80e6902776e9ff47fc496ee' => 
    array (
      0 => '/var/www/html/Sirenis/Portal/layouts/default/templates/Noticias/partials/DetailContentBefore.tpl',
      1 => 1547066554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8901595955c2f3a058afe33-79288028',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5c2f3a058b3313_79502297',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c2f3a058b3313_79502297')) {function content_5c2f3a058b3313_79502297($_smarty_tpl) {?>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ticket-detail-header-row " id = "editNoticiaHeader">
  <h3 class="fsmall">
    <detail-navigator>
      <span>
        <a ng-click="navigateBack(module)" translate="{{ptitle}}" style="font-size:small;">{{ptitle}}</a>
      </span>
    </detail-navigator>    
      <span translate = "Report ID">Report ID</span> {{idSolicitud}}
  </h3>
</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div id = "solicitudesReservasContainer" style = "margin-top: 50px;">

      
      <h2 style = "display: block; font-weight: bold; color: #00214d; text-align: center; margin-bottom: 15px;">{{'News Detail'|translate}}</h2>
         <div style = "width: 100%; display: inline-block; position: relative; left: 2%; margin-bottom: 35px; margin-top: 20.5px">
          <table id = "tableProfile" class = "tableData" style = "width: 100%">
            <tr>
              <td colspan = "2"><span class = "profileTitle">{{'Abstract' | translate}}:</span> {{noticia.notresumen}}</td>
            </tr>
            <tr style = "padding-top: 35px">
              <td colspan = "2"><span class = "profileTitle"><br>{{'Report' | translate}}:</span></td>
            </tr>
            <tr>
              <td colspan="2" id = "tdNoticia">{{noticia.notnoticia}}</td>
            </tr>
            <tr style = "padding-top: 35px">
              <td style = "width: 50%"><span class = "profileTitle"><br>{{'From' | translate}}:</span> {{noticia.notdesde}}</td>
              <td style = "width: 50%"><span class = "profileTitle"><br>{{'To' | translate}}:</span> {{noticia.nothasta}}</td>
            </tr>
          </table>
          
        </div>
      </div>
  
<?php }} ?>
