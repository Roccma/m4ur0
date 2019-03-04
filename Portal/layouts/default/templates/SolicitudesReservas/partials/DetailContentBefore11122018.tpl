{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.2
* ("License.txt"); You may not use this file except in compliance with the License
* The Original Code is: Vtiger CRM Open Source
* The Initial Developer of the Original Code is Vtiger.
* Portions created by Vtiger are Copyright (C) Vtiger.
* All Rights Reserved.
************************************************************************************}

{literal}
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ticket-detail-header-row ">
  <h3 class="fsmall">
    <detail-navigator>
      <span>
        <a ng-click="navigateBack(module)" style="font-size:small;">{{ptitle}}</a>
      </span>
    </detail-navigator>    
      Solicitud ID {{idSolicitud}}
    <button ng-if="(closeButtonDisabled && HelpDeskIsStatusEditable && isEditable)" translate="Mark as closed" class="btn btn-success close-ticket" ng-click="close();"></button>
    <button ng-if="closeButtonDisabled && documentsEnabled" translate="Attach document to this ticket" class="btn btn-primary attach-files-ticket" ng-click="attachDocument('Documents','LBL_ADD_DOCUMENT')"></button>
    <button translate="Edit Ticket" class="btn btn-primary attach-files-ticket" ng-if="isEditable" ng-click="edit(module,id)"></button>
  </h3>
</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <table id = "tableDetailSolicitudesReservas">
    <tr>
      <td class = "tdTitulo">Contacto</td>
      <td>{{solicitud.contacto}}</td>
      <td class = "tdTitulo">Estado</td>
      <td>{{solicitud.resestado}}</td>
    </tr>
    <tr>
      <td class = "tdTitulo">Fecha de Comiezo</td>
      <td>{{solicitud.resfechacom}}</td>
      <td class = "tdTitulo">Fecha de Fin</td>
      <td>{{solicitud.resfechafin}}</td>
    </tr>
    <tr>
      <td class = "tdTitulo" class = "tdTitulo">Cantidad de Días</td>
      <td>{{solicitud.resdias}}</td>
      <td class = "tdTitulo">Número de Confirmación</td>
      <td>{{solicitud.resnroconf}}</td>
    </tr>
    <tr>
      <td class = "tdTitulo">Correo electrónico</td>
      <td>{{solicitud.rescorreo}}</td>
      <td class = "tdTitulo">Cantidad de Pasajeros</td>
      <td>{{solicitud.respasajeros}}</td>
    </tr>
    <tr>
      <td class = "tdTitulo">Pasajero 1</td>
      <td>{{solicitud.respasajero1}}</td>
      <td class = "tdTitulo">Pasajero 2</td>
      <td>{{solicitud.respasajero2}}</td>
    </tr>
    <tr>
      <td class = "tdTitulo">Pasajero 3</td>
      <td>{{solicitud.respasajero3}}</td>
      <td class = "tdTitulo">Pasajero 4</td>
      <td>{{solicitud.respasajero4}}</td>
    </tr>
    <tr>
      <td class = "tdTitulo">Pasajero 5</td>
      <td>{{solicitud.respasajero5}}</td>
      <td class = "tdTitulo">Hotel</td>
      <td>{{solicitud.hotel}}</td>
    </tr>
    <tr>
      <td class = "tdTitulo">Cantidad de noches ganadas</td>
      <td>{{solicitud.resnochganada}}</td>
      <td class = "tdTitulo">Comentarios</td>
      <td>{{solicitud.rescomentarios}}</td>
    </tr>
    <tr>      
      <td class = "tdTitulo">Asignado a</td>
      <td>{{solicitud.smownername}}</td>
      <td class = "tdTitulo"></td>
      <td></td>
    </tr>
  </table>
  {/literal}
