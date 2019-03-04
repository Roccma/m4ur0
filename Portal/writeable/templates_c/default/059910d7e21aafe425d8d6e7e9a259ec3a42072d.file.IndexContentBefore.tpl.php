<?php /* Smarty version Smarty-3.1.19, created on 2019-01-09 20:47:31
         compiled from "/var/www/html/Sirenis/Portal/layouts/default/templates/SolicitudesReservas/partials/IndexContentBefore.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14525872955c2f41752905f4-21465985%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '059910d7e21aafe425d8d6e7e9a259ec3a42072d' => 
    array (
      0 => '/var/www/html/Sirenis/Portal/layouts/default/templates/SolicitudesReservas/partials/IndexContentBefore.tpl',
      1 => 1547066554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14525872955c2f41752905f4-21465985',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5c2f4175293ed1_39030983',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c2f4175293ed1_39030983')) {function content_5c2f4175293ed1_39030983($_smarty_tpl) {?>


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

<?php }} ?>
