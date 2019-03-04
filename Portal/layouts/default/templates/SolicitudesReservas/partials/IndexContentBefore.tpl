{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.2
* ("License.txt"); You may not use this file except in compliance with the License
* The Original Code is: Vtiger CRM Open Source
* The Initial Developer of the Original Code is Vtiger.
* Portions created by Vtiger are Copyright (C) Vtiger.
* All Rights Reserved.
************************************************************************************}

{literal}
<div class="navigation-controls-row" id = "divSolicitudesReservas">
<div ng-if="checkRecordsVisibility(filterPermissions)" class="panel-title col-md-12 module-title">{{ptitle}}
</div>
</div>
    <div class="row portal-controls-row">
        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
        <div ng-if="!checkRecordsVisibility(filterPermissions)" class="panel-title col-md-12 module-title" style = "width: 451px;"><i class = "glyphicon glyphicon-check"></i>&nbsp;&nbsp;&nbsp;<span translate="{{ptitle}}">{{ptitle}}</span></div>
            <div class="btn-group btn-group-justified" ng-if="checkRecordsVisibility(filterPermissions)">
                <div class="btn-group">
                    <button type="button" translate="Mine"
                            ng-class="{'btn btn-default btn-primary':searchQ.onlymine, 'btn btn-default':!searchQ.onlymine}" ng-click="searchQ.onlymine=true">{{'Mine'|translate}}</button>
                </div>
                <div class="btn-group">
                    <button type="button" translate="All"
                            ng-class="{'btn btn-default btn-primary':!searchQ.onlymine, 'btn btn-default':searchQ.onlymine}" ng-click="searchQ.onlymine=false">{{'All'|translate}}</button>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pagination-holder">

            <div class="pull-right">
                <div class="text-center">
                    <pagination
                        total-items="totalPages" max-size="3" ng-model="currentPage" ng-change="pageChanged(currentPage)" boundary-links="true">
                    </pagination>
                </div>
            </div>
            <div class = "pull-right" style = "margin-right: 25px; margin-top: 5px;">
                <button type="button" class="btn btn-primary" ng-click="create()"><i class = "glyphicon glyphicon-plus"></i>&nbsp;&nbsp;&nbsp;<span translate="New Ticket"></span></button>
            </div>
        </div>
    </div>
      <input name="visited" type="hidden" ng-init="beforeRefresh='0'" ng-model="beforeRefresh">
{/literal}
