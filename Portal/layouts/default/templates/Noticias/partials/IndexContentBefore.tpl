{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.2
* ("License.txt"); You may not use this file except in compliance with the License
* The Original Code is: Vtiger CRM Open Source
* The Initial Developer of the Original Code is Vtiger.
* Portions created by Vtiger are Copyright (C) Vtiger.
* All Rights Reserved.
************************************************************************************}

{literal}
<div class="navigation-controls-row" id = "divNoticias">

</div>
    <div class="row portal-controls-row">
        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
        <div class="panel-title col-md-12 module-title" style = "width: 451px"><i class = "glyphicon glyphicon-file"></i>&nbsp;&nbsp;&nbsp;<span  translate="{{ptitle}}">{{ptitle}}</span></div>
            <!--<div class="btn-group btn-group-justified" ng-if="checkRecordsVisibility(filterPermissions)">
                <div class="btn-group">
                    <button type="button" translate="Mine"
                            ng-class="{'btn btn-default btn-primary':searchQ.onlymine, 'btn btn-default':!searchQ.onlymine}" ng-click="searchQ.onlymine=true">{{'Mine'|translate}}</button>
                </div>
                <div class="btn-group">
                    <button type="button" translate="All"
                            ng-class="{'btn btn-default btn-primary':!searchQ.onlymine, 'btn btn-default':searchQ.onlymine}" ng-click="searchQ.onlymine=false">{{'All'|translate}}</button>
                </div>
            </div>-->
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pagination-holder" style = "margin-top: 0">
            <div class="pull-right">
                <div class="text-center">
                    <pagination
                        total-items="totalPages" max-size="3" ng-model="currentPage" ng-change="pageChanged(currentPage)" boundary-links="true">
                    </pagination>
                </div>
            </div>
        </div>
    </div>
      <input name="visited" type="hidden" ng-init="beforeRefresh='0'" ng-model="beforeRefresh">
{/literal}
