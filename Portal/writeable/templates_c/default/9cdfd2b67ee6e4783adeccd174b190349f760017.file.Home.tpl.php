<?php /* Smarty version Smarty-3.1.19, created on 2019-01-09 20:45:09
         compiled from "/var/www/html/Sirenis/Portal/layouts/default/templates/Portal/Home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8007468185c2f39f929a220-29739182%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9cdfd2b67ee6e4783adeccd174b190349f760017' => 
    array (
      0 => '/var/www/html/Sirenis/Portal/layouts/default/templates/Portal/Home.tpl',
      1 => 1547066554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8007468185c2f39f929a220-29739182',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5c2f39f92b4440_60943228',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c2f39f92b4440_60943228')) {function content_5c2f39f92b4440_60943228($_smarty_tpl) {?>


    <div ng-controller="Home_Component" class="container-fluid main-container" id = "divHome">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-sm-12" ng-if="profileFetched" style = "margin-bottom: 10px;">
                        <h1 title="{{org}}" class="portal-welcome">{{'Welcome to' | translate}} <strong>SIRENIS</strong></h1>
                    </div>
                    <div ng-if="supportNotification" class="pull-right col-md-3 col-lg-3 col-sm-3 col-xs-3">
                        <div class="alert alert-danger alert-dismissible portal-alert" role="alert">
                            <button type="button" class="close support-notification-close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong class="support-notification">{{'Your support ends on' | translate}}&nbsp;{{notification}}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div ng-if="announcementExists" class="alert alert-warning portal-announcement">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p ng-bind-html="announcement">  {{announcement}}</p>
                </div>
                <div class="row charts-container">
                    <div ng-repeat="(name,value) in enabledCharts" ng-if="name!='language' && name!='count'">
                        <ng-switch on="value.type">
                            <div ng-class="applyChartClass($index)">
                                <div ng-switch-when="spline"><div class="panel panel-default"><div class="panel-heading separator"> <div class="panel-title" translate="{{name}}">{{name}}</div></div>
                                        <cp-line items="value.data"></cp-line></div></div>
                                <div ng-switch-when="pie"><div class="panel panel-default"><div class="panel-heading separator"> <div class="panel-title" translate="{{name}}">{{name}}</div></div>
                                        <cp-pie items="value.data"></cp-pie></div></div>
                            </div>

                    </div>

                </div>
                <div class="row tickets-panel-container" ng-if="activateRecentTickets">
                    <div class="panel-heading separator"><div class="tickets panel-title">{{'Recent'|translate}} {{ticketsUiLabel}}</div></div>
                    <div ng-repeat="recentTicket in recentTickets" ng-if="recentTickets.length>0">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default tickets-panel-content">
                                <div class="tickets-panel-heading separator">
                                    <div class="ticket-panel-title" ng-class='{"first-ticket-panel-title":$index==0}'><a ng-click="loadRecentRecord('HelpDesk',recentTicket.id)">{{recentTicket.label}}</a>


                                          <strong class="text-primary pull-right"><span class="label" ng-class="determineStatus(recentTicket.status)">{{recentTicket.statuslabel}}</span></strong>

                                    </div>
                                </div>
                                <div class="panel-body tickets-panel-body" ng-if="recentTicket.description">
                                    <p style="white-space: pre-line;">{{recentTicket.description}}</p>
                                </div>
                                <hr ng-show="!$last">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row tickets-panel-container" id = "widget-Noticias">
                    <div class="panel-heading separator">
                        <div class="tickets panel-title title-widget" translate="Recents News">Recents News</div>
                    </div>
                    <div ng-show = "noticias.length == 0" style = "width: 100%; text-align: center; font-size: 18px; margin-top: 10px; margin-bottom: 15px" translate="There are no news to show">There are no news to show</div>
                    <ul  ng-if="noticias.length>0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <li ng-repeat="noticia in noticias" class="list-group-item item-widget i-widget" ng-click="loadRecentRecord('Noticias',noticia.noticiasid)">
                            <div>
                                <p>{{noticia.notcreatedtime}}</p>
                                <p style = "font-size: 18px"><strong>{{noticia.notresumen}}</strong></p>
                            </div>
                            <br>
                            <div id = "{{noticia.noticiasid}}">
                                {{noticia.notnoticia}}    
                            </div>
                       </li> 
                    </ul>
                </div>
                <br>
                <div class="row tickets-panel-container" id = "widget-SolicitudesReservas">
                    <div class="panel-heading separator">
                        <div class="tickets panel-title title-widget" translate="Recents Reservation Requests">Recents Reservation Requests</div>
                    </div>
                    <ul ng-if="recentSolicitudesReservas.length>0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <li ng-repeat="recentSolicitud in recentSolicitudesReservas" class="list-group-item item-widget i-widget" ng-click="loadRecentRecord('SolicitudesReservas',recentSolicitud.id)">
                            <div>
                                <!--<a ng-click="loadRecentRecord('SolicitudesReservas',recentSolicitud.id)">{{recentSolicitud.hotel}}</a>-->
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <span translate="Created time" style = "font-weight: bold"><b>Created time:</b></span> {{recentSolicitud.rescreatedtime}}
                                <strong class="pull-right {{recentSolicitud.status}}" translate="{{recentSolicitud.status}}">{{recentSolicitud.status}}</strong>
                            </div>
                            <br>
                            <div>
                                <small>
                                    <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> <span translate = "From">From</span> {{recentSolicitud.resfechacom}} <span translate = "to">to</span> {{recentSolicitud.resfechafin}} ({{recentSolicitud.resdias}} <span ng-show = "recentSolicitud.resdias != 1" translate="days">days</span><span ng-show = "recentSolicitud.resdias == 1" translate="day">day</span>)                                
                                </small>
                                <div class="pull-right">
                                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span> <b>Hotel:</b> {{recentSolicitud.hotel}}
                                </div>    
                            </div>
                       </li> 
                    </ul>
                    <div ng-if="recentSolicitudesReservas == null" translate="no_solicitudesreservas" style = "width: 100%; text-align: center; font-size: 18px; margin-top: 10px; margin-bottom: 15px">no_solicitudesreservas</div>
               </div>
                <br>
                <div class="row tickets-panel-container" id = "widget-RedimirDias">
                    <div class="panel-heading separator">
                        <div class="tickets panel-title title-widget" translate="Recents Requests for Days">Recents Requests for Days</div>
                    </div>
                    <ul ng-if="recentRedimirDias.length>0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <li ng-repeat="recentSolicitud in recentRedimirDias" class="list-group-item item-widget i-widget" ng-click="loadRecentRecord('RedimirDias',recentSolicitud.id)">
                            <div>
                                <!--<a ng-click="loadRecentRecord('SolicitudesReservas',recentSolicitud.id)">{{recentSolicitud.hotel}}</a>-->
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <span translate="Created time" style = "font-weight: bold"><b>Created time:</b></span> {{recentSolicitud.redcreatedtime}}
                                <strong class="pull-right {{recentSolicitud.status}}" translate="{{recentSolicitud.status}}">{{recentSolicitud.status}}</strong>
                            </div>
                            <br>
                            <div>
                                <small>
                                    <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> <span translate = "From">From</span>  {{recentSolicitud.redfechacom}} <span translate = "to">to</span> {{recentSolicitud.redfechafin}} ({{recentSolicitud.reddias}} <span ng-show = "recentSolicitud.reddias != 1" translate="days">days</span><span ng-show = "recentSolicitud.reddias == 1" translate="day">day</span>)                                
                                </small>
                                <div class="pull-right">
                                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span> <b>Hotel:</b> {{recentSolicitud.hotel}}
                                </div>    
                            </div>
                       </li> 
                    </ul>
                    <div ng-if="recentRedimirDias == null" translate="no_redimirdias" style = "width: 100%; text-align: center; font-size: 18px; margin-top: 10px; margin-bottom: 15px">no_redimirdias</div>
                </div>
                <br><br>
                
        </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 shortcut-container">
                <div class="row tickets-panel-container" id = "widget-Saldo">
                    <div class="panel-heading separator">
                        <div class="tickets panel-title title-widget" translate="Balance of Days">Balance of Days</div>
                    </div>
                    <ul class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <li class="list-group-item item-widget i1" style = "background: #fff3cd; color: #856404; font-size: 14px">
                            <span style = "font-weight: bold" translate="Earned days"><b>Earned days:</b></span> {{saldo.dias_generados}} <span ng-show = "saldo.dias_generados != 1" translate="days">days</span><span ng-show = "saldo.dias_generados == 1" translate="day">day</span> ({{saldo.dias_reservas}} <span translate = "reservations">reservations</span>)
                        </li>
                        <li class="list-group-item item-widget i2" style = "background: #f8d7da; color: #721c24; font-size: 14px">
                            <span style = "font-weight: bold" translate="Used days"><b>Used days:</b></span> {{saldo.dias_utilizados}} <span ng-show = "saldo.dias_utilizados != 1" translate="days">days</span><span ng-show = "saldo.dias_utilizados == 1" translate="day">day</span>
                        </li>
                        <li class="list-group-item item-widget i3" style = "background: #d4edda; color: #155724; font-size: 14px">
                            <span style = "font-weight: bold" translate="Available days"><b>Available days:</b></span> {{saldo.dias_saldo}} <span ng-show = "saldo.dias_saldo != 1" translate="days">days</span><span ng-show = "saldo.dias_saldo == 1" translate="day">day</span>
                        </li>
                    </ul>
                    <!--<ul ng-if="recentSolicitudesReservas.length>0" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                       <li ng-repeat="recentSolicitud in recentSolicitudesReservas" class="list-group-item item-widget" ng-click="loadRecentRecord('SolicitudesReservas',recentSolicitud.id)">
                            <div>
                                <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Fecha y hora de registro: {{recentSolicitud.rescreatedtime}}
                                <strong class="pull-right {{recentSolicitud.status}}">{{recentSolicitud.status}}</strong>
                            </div>
                            <br>
                            <div>
                                <small>
                                    <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Desde el {{recentSolicitud.resfechacom}} hasta {{recentSolicitud.resfechafin}} ({{recentSolicitud.resdias}} días)                                
                                </small>
                                <strong class="pull-right">
                                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Hotel: {{recentSolicitud.hotel}}
                                </strong>    
                            </div>
                       </li> 
                    </ul>-->
                </div>
                <div class="panel panel-default" ng-if="showShortcuts">
                    <div class="panel-heading separator">
                        <div class="panel-title">{{'What would you like to do ?' | translate}}

                        </div>
                    </div>
                    <div class="support panel-body">
                        <div class="row">
                            <div ng-repeat="(module,actions) in shortcuts" class="col-lg-12 shortcut-done">
                                <h5>{{module}}</h5>
                                <div class="col-lg-12 shortcut-button"   ng-class-even="'even-button'" ng-repeat="action in actions" >
                                    <button  translate="{{action}}" ng-click="openShortcut(module,action)" class="btn btn-default">{{action}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--
                <div class="panel panel-default" ng-repeat="(module,values) in recentRecords" ng-if="ifNotTickets(module) && isObj(values)">
                    <div class="panel-heading separator">
                        <div class="panel-title" >{{'Recent'|translate}} {{module|translate}}
                        </div>
                    </div>
                    <div class="shortcut panel-body" >
                        <div class="row" >
                            <div class="col-lg-12 recent-list">

                                <ul class="nav">
                                    <li ng-repeat="value in values"><a ng-if="module!=='Faq'" ng-click="loadRecentRecord(module,value.id)">{{value.label}}</a></li>
                                    <li ng-repeat="value in values"><a ng-if="module==='Faq'" ng-click="loadRecentRecord(module,value.id)">{{value.label}}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    
    <script type="text/javascript" src="<?php echo portal_componentjs_file('HelpDesk');?>
"></script>
    <?php echo $_smarty_tpl->getSubTemplate (portal_template_resolve('HelpDesk',"partials/IndexContentAfter.tpl"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <script type="text/javascript" src="<?php echo portal_componentjs_file('Documents');?>
"></script>
    <?php echo $_smarty_tpl->getSubTemplate (portal_template_resolve('Documents',"partials/IndexContentAfter.tpl"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>
<?php }} ?>
