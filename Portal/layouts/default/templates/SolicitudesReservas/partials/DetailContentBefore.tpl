{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.2
* ("License.txt"); You may not use this file except in compliance with the License
* The Original Code is: Vtiger CRM Open Source
* The Initial Developer of the Original Code is Vtiger.
* Portions created by Vtiger are Copyright (C) Vtiger.
* All Rights Reserved.
************************************************************************************}

{literal}
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

      {literal}
      <h2 style = "display: block; font-weight: bold; color: #00214d; text-align: center; margin-bottom: 15px;">{{'Reservation Request Detail'|translate}}</h2>{/literal}
         <div style = "width: 100%; display: inline-block; position: relative; left: 2%; margin-bottom: 35px; margin-top: 20.5px">
          <table id = "tableProfile" class = "tableData" style = "width: 100%">
            <tr>
              {literal}<td style = "width: 50%"><span class = "profileTitle">{{'Contact' | translate}}:</span> {{solicitud.contacto}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'State' | translate}}:</span> {{solicitud.resestado | translate}}</td>{/literal}
            </tr>
            <tr>
              {literal}<td style = "width: 50%"><span class = "profileTitle">{{'Start Date' | translate}}:</span> {{solicitud.resfechacom}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'End Date' | translate}}:</span> {{solicitud.resfechafin}}</td>{/literal}
            </tr>
            <tr>
              {literal}<td style = "width: 50%"><span class = "profileTitle">{{'Days Quantity' | translate}}:</span> {{solicitud.resdias}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'Confirmation Number' | translate}}:</span> {{solicitud.resnroconf}}</td>{/literal}
            </tr>
            <tr>
              {literal}<td style = "width: 50%"><span class = "profileTitle">{{'E-mail'  | translate}}:</span> {{solicitud.rescorreo}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'Passengers Quantity' | translate}}:</span> {{solicitud.respasajers}}</td>{/literal}
            </tr>
            <tr>
              {literal}<td style = "width: 50%"><span class = "profileTitle">{{'Passenger 1' | translate}}:</span> {{solicitud.respasajero1}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'Passenger 2' | translate}}:</span> {{solicitud.respasajero2}}</td>{/literal}
            </tr>
            <tr>
              {literal}<td style = "width: 50%"><span class = "profileTitle">{{'Passenger 3' | translate}}:</span> {{solicitud.respasajero3}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'Passenger 4' | translate}}:</span> {{solicitud.respasajero4}}</td>{/literal}
            </tr>
            <tr>
              {literal}<td style = "width: 50%"><span class = "profileTitle">{{'Passenger 5' | translate}}:</span> {{solicitud.respasajero5}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'Hotel' | translate}}:</span> {{solicitud.hotel}}</td>{/literal}
            </tr>
            <tr>
              {literal}<td style = "width: 50%"><span class = "profileTitle">{{'Earned Nights Quantity' | translate}}:</span> {{solicitud.resnochganada}}</td>
              <td style = "width: 50%"><span class = "profileTitle">{{'Comments' | translate}}:</span> {{solicitud.rescomentarios}}</td>{/literal}
            </tr>
          </table>
          
        </div>
      </div>
  {/literal}
