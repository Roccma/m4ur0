<?php /* Smarty version Smarty-3.1.19, created on 2019-01-09 20:45:35
         compiled from "/var/www/html/Sirenis/Portal/layouts/default/templates/RedimirDias/partials/IndexContentBefore.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20933303315c2f41a7aa12d1-25422658%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cc293aaaf275570b6998e376894935a5d9b24721' => 
    array (
      0 => '/var/www/html/Sirenis/Portal/layouts/default/templates/RedimirDias/partials/IndexContentBefore.tpl',
      1 => 1547066554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20933303315c2f41a7aa12d1-25422658',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5c2f41a7ae77d9_95023077',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c2f41a7ae77d9_95023077')) {function content_5c2f41a7ae77d9_95023077($_smarty_tpl) {?>


<div class="navigation-controls-row" id = "divRedimirDias">
<div ng-if="checkRecordsVisibility(filterPermissions)" translate="{{ptitle}}" class="panel-title col-md-12 module-title">{{ptitle}}
</div>
</div>
    <div class="row portal-controls-row">
        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
        <div ng-if="!checkRecordsVisibility(filterPermissions)" class="panel-title col-md-12 module-title"><i class = "glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;&nbsp;<span translate="{{ptitle}}">{{ptitle}}</span></div>
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
                <button type="button" class="btn btn-primary" ng-click="create()"><i class = "glyphicon glyphicon-plus"></i>&nbsp;&nbsp;&nbsp;<span translate= "New Days Request"></span></button>
            </div>
                
        </div>
    </div>
      <input name="visited" type="hidden" ng-init="beforeRefresh='0'" ng-model="beforeRefresh">

<?php }} ?>
