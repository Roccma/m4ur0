<?php /* Smarty version Smarty-3.1.19, created on 2019-01-09 20:45:24
         compiled from "/var/www/html/Sirenis/Portal/layouts/default/templates/SolicitudesReservas/partials/DetailContentBefore.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1114063365c365d647f3971-51731516%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'beeee1ff4cf656006203259a72c2763139b6f2d4' => 
    array (
      0 => '/var/www/html/Sirenis/Portal/layouts/default/templates/SolicitudesReservas/partials/DetailContentBefore.tpl',
      1 => 1547066554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1114063365c365d647f3971-51731516',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5c365d64817ca7_04975003',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c365d64817ca7_04975003')) {function content_5c365d64817ca7_04975003($_smarty_tpl) {?>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ticket-detail-header-row " id = "editSolicitudReservaHeader">
  <h3 class="fsmall">
    <div style = "position: relative; top: 4px; display: inline-block;">
      <detail-navigator>
        <span>
          <a ng-click="navigateBack(module)" translate="{{ptitle}}" style="font-size:small;">{{ptitle}}</a>
        </span>
      </detail-navigator>    
      <span translate = "Request ID">Request ID</span> {{idSolicitud}}
    </div>
    <button ng-if="(closeButtonDisabled && HelpDeskIsStatusEditable && isEditable)" translate="Mark as closed" class="btn btn-success close-ticket" ng-click="close();"></button>
    <button ng-if="closeButtonDisabled && documentsEnabled" translate="Attach document to this ticket" class="btn btn-primary attach-files-ticket" ng-click="attachDocument('Documents','LBL_ADD_DOCUMENT')"></button>
    <button ng-show="solicitud.resestado != 'Confirmada'" class="btn btn-primary attach-files-ticket" ng-click="edit(module,id)"><i class = "glyphicon glyphicon-pencil"></i>&nbsp;&nbsp;&nbsp;<span translate="Edit Ticket"></span></button>
  </h3>
</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div id = "solicitudesReservasContainer" style = "margin-top: 50px;">

      
      <h2 style = "display: block; font-weight: bold; color: #00214d; text-align: center; margin-bottom: 15px;">{{'Reservation Request Detail'|translate}}</h2>
         <div style = "width: 100%; display: inline-block; position: relative; left: 2%; margin-bottom: 35px; margin-top: 20.5px">
          <table id = "tableProfile" class = "tableData" style = "width: 100%">
            <tr>
              <td style = "width: 50%"><span class = "profileTitle">{{'Contact' | translate}}:</span> {{solicitud.contacto}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'State' | translate}}:</span> {{solicitud.resestado | translate}}</td>
            </tr>
            <tr>
              <td style = "width: 50%"><span class = "profileTitle">{{'Start Date' | translate}}:</span> {{solicitud.resfechacom}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'End Date' | translate}}:</span> {{solicitud.resfechafin}}</td>
            </tr>
            <tr>
              <td style = "width: 50%"><span class = "profileTitle">{{'Days Quantity' | translate}}:</span> {{solicitud.resdias}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'Confirmation Number' | translate}}:</span> {{solicitud.resnroconf}}</td>
            </tr>
            <tr>
              <td style = "width: 50%"><span class = "profileTitle">{{'E-mail'  | translate}}:</span> {{solicitud.rescorreo}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'Passengers Quantity' | translate}}:</span> {{solicitud.respasajers}}</td>
            </tr>
            <tr>
              <td style = "width: 50%"><span class = "profileTitle">{{'Passenger 1' | translate}}:</span> {{solicitud.respasajero1}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'Passenger 2' | translate}}:</span> {{solicitud.respasajero2}}</td>
            </tr>
            <tr>
              <td style = "width: 50%"><span class = "profileTitle">{{'Passenger 3' | translate}}:</span> {{solicitud.respasajero3}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'Passenger 4' | translate}}:</span> {{solicitud.respasajero4}}</td>
            </tr>
            <tr>
              <td style = "width: 50%"><span class = "profileTitle">{{'Passenger 5' | translate}}:</span> {{solicitud.respasajero5}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'Hotel' | translate}}:</span> {{solicitud.hotel}}</td>
            </tr>
            <tr>
              <td style = "width: 50%"><span class = "profileTitle">{{'Earned Nights Quantity' | translate}}:</span> {{solicitud.resnochganada}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'Comments' | translate}}:</span> {{solicitud.rescomentarios}}</td>
            </tr>
          </table>
          
        </div>
      </div>
  
<?php }} ?>
