{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.2
* ("License.txt"); You may not use this file except in compliance with the License
* The Original Code is: Vtiger CRM Open Source
* The Initial Developer of the Original Code is Vtiger.
* Portions created by Vtiger are Copyright (C) Vtiger.
* All Rights Reserved.
************************************************************************************}

{literal}
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

      {literal}
      <h2 style = "display: block; font-weight: bold; color: #00214d; text-align: center; margin-bottom: 15px;">{{'News Detail'|translate}}</h2>{/literal}
         <div style = "width: 100%; display: inline-block; position: relative; left: 2%; margin-bottom: 35px; margin-top: 20.5px">
          <table id = "tableProfile" class = "tableData" style = "width: 100%">
            <tr>
              {literal}<td colspan = "2"><span class = "profileTitle">{{'Abstract' | translate}}:</span> {{noticia.notresumen}}</td>{/literal}
            </tr>
            <tr style = "padding-top: 35px">
              {literal}<td colspan = "2"><span class = "profileTitle"><br>{{'Report' | translate}}:</span></td>{/literal}
            </tr>
            <tr>
              {literal}<td colspan="2" id = "tdNoticia">{{noticia.notnoticia}}</td>{/literal}
            </tr>
            <tr style = "padding-top: 35px">
              {literal}<td style = "width: 50%"><span class = "profileTitle"><br>{{'From' | translate}}:</span> {{noticia.notdesde}}</td>
              <td style = "width: 50%"><span class = "profileTitle"><br>{{'To' | translate}}:</span> {{noticia.nothasta}}</td>{/literal}
            </tr>
          </table>
          
        </div>
      </div>
  {/literal}
