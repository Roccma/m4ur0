<?php /* Smarty version Smarty-3.1.19, created on 2019-01-09 20:45:46
         compiled from "/var/www/html/Sirenis/Portal/layouts/default/templates/Noticias/partials/IndexContentBefore.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8923905715c2f47893416b3-28934307%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0661e645f6f45bdbee45989f8832dabba74e1a23' => 
    array (
      0 => '/var/www/html/Sirenis/Portal/layouts/default/templates/Noticias/partials/IndexContentBefore.tpl',
      1 => 1547066554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8923905715c2f47893416b3-28934307',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5c2f47893a0d90_01252633',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c2f47893a0d90_01252633')) {function content_5c2f47893a0d90_01252633($_smarty_tpl) {?>


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

<?php }} ?>
