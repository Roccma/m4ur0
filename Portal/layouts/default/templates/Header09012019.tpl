{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.2
* ("License.txt"); You may not use this file except in compliance with the License
* The Original Code is: Vtiger CRM Open Source
* The Initial Developer of the Original Code is Vtiger.
* Portions created by Vtiger are Copyright (C) Vtiger.
* All Rights Reserved.
************************************************************************************}

<!doctype>
<html ng-app="portalapp">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="libraries/bootstrap/css/bootstrap.min.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="libraries/jqueryaddons/selectric/selectric.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="libraries/angularjsaddons/ngProgress/ngProgress.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="libraries/angularuiaddons/ui-select-master/src/select.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="layouts/{portal_layout()}/resources/application.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="layouts/{portal_layout()}/skins/default/styles.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="libraries/angularjsaddons/angular-xeditable/css/xeditable.css">
		
		<script type="text/javascript" src="libraries/jquery/jquery.min.js"></script>
		<script type="text/javascript" src="libraries/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="libraries/jqueryaddons/purl.js"></script>
		<script type="text/javascript" src="libraries/jqueryaddons/selectric/jquery.selectric.min.js"></script>
		<script type="text/javascript" src="libraries/jqueryaddons/slimscroll/jquery.slimscroll.min.js"></script>
		<script type="text/javascript" src="libraries/angularjs/angular.min.js"></script>
		<script type="text/javascript" src="libraries/angularjs/angular-sanitize.min.js"></script>
		<script type="text/javascript" src="libraries/angularui/ui-utils.min.js"></script>
		<script type="text/javascript" src="libraries/angularui/ui-bootstrap-tpls-0.12.0.min.js"></script>
		<script type="text/javascript" src="libraries/angularui/ui-tinymce.js"></script>
		<script type="text/javascript" src="libraries/angularuiaddons/ui-select-master/src/select.js"></script>
		<script type="text/javascript" src="libraries/angularjsaddons/elastic/elastic.js"></script>
		<script type="text/javascript" src="libraries/angularjsaddons/ngProgress/ngProgress.min.js"></script>
		<script type="text/javascript" src="libraries/angularuiaddons/timepicker/timepicker.js"></script>
		<script type="text/javascript" src="libraries/angularjsaddons/angularjs-translate/angular-translate.js"></script>
		<script type="text/javascript" src="libraries/angularjs/directives/modelOptions/ngModelOptions.min.js"></script>
		<script type="text/javascript" src="libraries/angularjsaddons/angular-translate-loader-partial/angular-translate-loader-partial.js"></script>
		<script type="text/javascript" src="libraries/angularjsaddons/ngCsv/ng-csv.js"></script>
		<script type="text/javascript" src="libraries/angularjsaddons/angular-xeditable/js/xeditable.min.js"></script>
		<script type="text/javascript" src="layouts/{portal_layout()}/resources/application.js"></script>
		<script type="text/javascript" src="layouts/{portal_layout()}/resources/components/main.js"></script>
		<script type="text/javascript" src="layouts/{portal_layout()}/resources/components/home.js"></script>
		<script type="text/javascript" src="layouts/{portal_layout()}/resources/components/Portal.js"></script>
		<script type="text/javascript" src="{portal_componentjs_file($MODULE)}"></script>
		<script src = "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>		
		<link rel="stylesheet" href="libraries/angular-bootstrap-datepicker/angular-bootstrap-datepicker.css"></script>
		<script type="text/javascript" src="libraries/angular-bootstrap-datepicker/angular-bootstrap-datepicker.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-local-storage/0.7.1/angular-local-storage.min.js"></script>

		<style type="text/css">
			{
				literal
			}
			
			[ng\:cloak],
			[ng-cloak],
			[data-ng-cloak],
			[x-ng-cloak],
			.ng-cloak,
			.x-ng-cloak {
				display: none !important;
			}
			
			{
				/literal
			}

		</style>
		<style>
			html, body{
				font-family: 'Lato', sans-serif !important;
				overflow: hidden;
			}
			#tableDetailSolicitudesReservas{
				width: 75%;
				border-collapse: collapse;
				margin: 0 auto;
				margin-top: 35px;
			}
			#tableDetailSolicitudesReservas tr td{
				padding: 20px 11px;
				font-size: 18px;
				width: 25%;
				background: #f4f4f4;
			}

			#tableDetailSolicitudesReservas tr{
				border-top: 2px solid #DEDEDE;
				border-bottom: 2px solid #DEDEDE;
			}

			.tdTitulo{
				font-weight: bold;
				background: #eee !important; 
			}

			.Confirmada{
				background: green;
			    padding: 2px 10px;
			    border-radius: 5px;
			    color: white;
			}

			.Pendiente{
				background: #ecc505;
			    padding: 2px 10px;
			    border-radius: 5px;
			    color: white;				
			}

			.i-widget{
				padding-top: 21px !important;
				padding-bottom: 21px !important;
			}

			.i-widget:hover{
				cursor: pointer;
				background: #ddd;
			}

			#widget-SolicitudesReservas{
				width: 55%;
				-webkit-box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				-moz-box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				display: inline-block;
			}

			#widget-RedimirDias{
				width: 55%;
				-webkit-box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				-moz-box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				display: inline-block;
				margin-top: 45px;
			}

			#widget-Saldo{
				-webkit-box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				-moz-box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				margin-top: 45px;
			}

			#widget-Noticias{
				width: 43%;
				float: right;
				display: inline-block;
				margin-top: 40px;
				-webkit-box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				-moz-box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
			}

			.panel-heading.separator:after{
				display: none;
			}

			.title-widget{
				font-weight: bold;
				display: block;
				text-align: center;
				font-size: 24px;
			}

			#tableDetailSolicitudesReservas ~ div{
				display: none;
			}

			.navbar{
				height: 59px;
				background: #00214d;
				position: fixed;
				left: 0;
				right: 0;
			}

			.menu li, .menu li a{
				height: 59px !important;
				font-size: 14px !important;
				color: white !important;
			}

			.menu > li > a{
				padding-top: 19px !important;
			}

			.search-container, .search-icon{
				padding-top: 3px !important;
				padding-left: 5px !important;
			}

			.menu li a:hover, #profileContainer:hover{
				background-color: #5f88c0 !important;
				color: white !important;
				box-shadow: inset 0 -3px 0 0 #ecc505 !important;
				transition: background-color .5s, color .5s, box-shadow .5s !important;
				opacity: 1 !important;
			}

			#profileContainer{
				height: 59px !important;
			}

			#profileContainer:selected{
				background-color: #5f88c0 !important;
				color: white !important;
				box-shadow: inset 0 -3px 0 0 #ecc505 !important;
				transition: background-color .5s, color .5s, box-shadow .5s !important;
				opacity: 1 !important;
			}

			#profileMenu{
				width: 200px;
			}

			#profileMenu, #profileMenu li{
				background: #5f88c0 !important;
			}

			#profileMenu > li > a{
				background: #5f88c0 !important;
				color: white !important;
			}

			#profileMenu > li > a:hover{
				color: #ecc505 !important;
			}

			.portalnavbar .dropdown-menu>li>a{
				background: #5f88c0 !important;
				color: white !important;
				opacity: 1;
				font-size: 14px;
				padding: 10px;
			}

			.dropdown-menu{
				border-radius: 0px !important;
				border: 1px solid #5f88c0 !important;
			}

			.navbar-inverse .navbar-nav>.open>a{
				background: #5f88c0 !important;
				box-shadow: inset 0 -3px 0 0 #ecc505 !important;
				color: white !important;
				opacity: 1 !important;
			}

			.modal-dialog{
		        width: 355px;
		    }

		    .modal{
		        overflow: hidden;
		    }

			.modal-header .close{
		      font-size: 25px !important;
		      outline: 0 !important;
		    }

		    .text-danger{
		        font-weight: bold;
		        text-align: center;
		        display: block;
    			margin-top: 15px;
		    }

		    #divHome{
		    	position: fixed;
		    	top: 59px;
		    	bottom: 0px;
		    	left: 0px;
		    	right: 0px;
		        background : url('layouts/default/resources/images/sirenis2.jpg') no-repeat;
		        background-size: cover;
		        background-attachment: fixed;
		        overflow-y: auto;
		    }

		    #divMyProfile{
		    	position: fixed;
		    	top: 59px;
		    	bottom: 0px;
		    	left: 0px;
		    	right: 0px;
		        background : #EEE;
		        overflow-y: auto;
		    }

		    #widget-SolicitudesReservas, #widget-RedimirDias, #widget-Noticias, #widget-Saldo{
	            
        		background: rgba(255, 255, 255, .8);
        		border: 0px solid white;
	        	border-radius: 5px;
	        }

	        #widget-SolicitudesReservas .panel-title, #widget-RedimirDias .panel-title, #widget-Noticias .panel-title, #widget-Saldo{
	            font-weight: bold;
	            color: #00214d;
	        }

	        #widget-SolicitudesReservas ul li, #widget-RedimirDias ul li, #widget-Noticias ul li{
	        	background: rgba(255, 255, 255, .3);
	        }

	        #widget-SolicitudesReservas ul li:hover, #widget-RedimirDias ul li:hover, #widget-Noticias ul li:hover{
	        	background: rgba(255, 255, 255, .9);
	        }

	        .navigation-controls-row{
	        	background: white !important;
	        }

	        .portal-welcome{
	        	display: block; 
	        	text-align: center; 
	        	color: white; 
	        	position: relative; 
	        	top: 14px; 
	        	font-size: 52px !important; 
	        	/*text-shadow: 2px 2px 5px rgb(0, 33, 77) !important;*/
	        	text-shadow: 3px 4px 8px rgb(0, 33, 77) !important;
	        }

	        #profileContainer2{
	        	margin: 0 auto; 
	        	box-sizing: border-box; 
	        	background: white;
	        	-webkit-box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				-moz-box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
				border-radius: 5px;
				height: auto !important;
	        }
		</style>
		<title ng-controller="MainController">{literal}{{companyTitle}} - {{'Portal'|translate}}{/literal}</title>
	</head>

	<body ng-controller="MainController" ng-cloak id = "bodyHeader">
		<nav class="navbar navbar-inverse navbar-static-top" >
			{literal}
			<div class="search-wrapper" ng-controller="globalSearchController">

				<form class="search-container">
					<div class="search-results-container hidden-lg hidden-md">
						<input id="search-box" type="text" class="search-box" name="q" ng-model="search" typeahead="record as record.value for record in searchRecords($viewValue)|filter:{value:$viewValue}" typeahead-min-length="3" typeahead-wait-ms="400" typeahead-editable="false"
						placeholder="{{'Type 3 characters'|translate}}" typeahead-template-url="searchResults.tpl" ng-trim="false">
						<label for="search-box">
							<span class="glyphicon glyphicon-search search-icon"></span>
						</label>
				</form>
				</div>
			</div>
			{/literal}
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			{literal}
			<div class="collapse navbar-collapse" role="navigation" style = "margin-right: 25px;">
				{/literal}
				<div class="col-lg-9 col-md-9" title="logo.png">
					<a class="logo-left" href="index.php">
						<img style = "width: 205px; height: auto; position: relative; top: -7px" src="{get_logo()}">
					</a>
				{literal}
					<div ng-if="loginUser">
						<ul class=" nav navbar-nav headerLinks menu" ng-show="modules" style = "margin: auto">
							<li ng-class="{'active':isActive('Home')}">
								<a href="index.php"><i class = "glyphicon glyphicon-home"></i>&nbsp;&nbsp;&nbsp;<span  translate="Home">Home</span></a>
							</li>

							<li class="hidden-md hidden-sm hidden-lg" ng-repeat="module in modules|orderBy:'order'" ng-if="module!=='language' && module.name!=='ProjectTask' && module.name!=='ProjectMilestone'" ng-class="{'active':isActive(module.name)}">
								<a translate="{{module.uiLabel}}" href="index.php?module={{module.name}}">
	                                    {{module.uiLabel}}
	                                </a>
							</li>
							<li class="hidden-xs hidden-sm" ng-repeat="module in modules|orderModulesBy:'order'" ng-if="module!=='language' && module.name!=='ProjectTask' && module.name!=='ProjectMilestone'" ng-class="{'active':isActive(module.name)}">
								<a ng-if="$index <=1" href="index.php?module={{module.name}} "><i ng-if = "module.name == 'SolicitudesReservas'" class = "glyphicon glyphicon-check"></i><i ng-if = "module.name == 'RedimirDias'" class = "glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;&nbsp;<span translate="{{module.uiLabel}}">{{module.uiLabel}}</span></a>
							</li>
							<li class="hidden-xs hidden-sm hidden-md visible-lg" ng-repeat="module in modules|orderModulesBy:'order'" ng-if="module!=='language' && module.name!=='ProjectTask' && module.name!=='ProjectMilestone'" ng-class="{'active':isActive(module.name)}">
								<a ng-if="$index >1  && $index <=4" href="index.php?module={{module.name}}"><i class = "glyphicon glyphicon-file"></i>&nbsp;&nbsp;&nbsp;<span translate="{{module.uiLabel}}">{{module.uiLabel}}</span></a>
							</li>
							<!--<li><a translate="Holaaa" href="index.php"></a></li>-->
							<li class="hidden-xs navbartoggle" ng-if="modulesCount > 5">
								<a href="#" class="dropdown-toggle " data-toggle="dropdown">{{'More' | translate}}<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li class="hidden-md hidden-lg" ng-repeat="module in modules|orderModulesBy:'order'" ng-if="module!=='language' && module.uiLabel!==undefined && module.name!=='ProjectTask' && module.name!=='ProjectMilestone'" ng-class="{'active':isActive(module.name)}">
										<a ng-if="$index>-1 && $index<=1" translate="{{module.uiLabel}}" href="index.php?module={{module.name}}">{{module.uiLabel}}</a>
									</li>
									<li class="hidden-lg" ng-repeat="module in modules|orderModulesBy:'order'" ng-if="module!=='language' && module.name!=='ProjectTask' && module.name!=='ProjectMilestone'" ng-class="{'active':isActive(module.name)}">
										<a ng-if="$index >1  && $index <=4" translate="{{module.uiLabel}}" href="index.php?module={{module.name}}">{{module.uiLabel}}</a>
									</li>
									<li ng-repeat="module in modules|orderModulesBy:'order'" ng-if="module!=='language' && module.name!=='ProjectTask' && module.name!=='ProjectMilestone'" ng-class="{'active':isActive(module.name)}">
										<a ng-if="$index > 4" translate="{{module.uiLabel}}" href="index.php?module={{module.name}}">{{module.uiLabel}}</a>
									</li>
								</ul>
							</li>
							<li>
								<!--<div class="search-wrapper hidden-sm hidden-xs" ng-controller="globalSearchController">

									<form class="search-container">
										<div class="search-results-container">
											<input id="search-box" type="text" class="search-box" name="q" ng-model="search" typeahead="record as record.value for record in searchRecords($viewValue)|filter:{value:$viewValue}" typeahead-min-length="3" typeahead-wait-ms="400" placeholder="{{'Type 3 characters'|translate}}"
											typeahead-editable="false" typeahead-template-url="searchResults.tpl" typeahead-on-select="search=''" ng-trim="false">
											<label for="search-box">
												<span class="glyphicon glyphicon-search search-icon"></span>
											</label>
									</form>
									</div>-->

							</li>
						</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 portalnavbar" ng-if="loginUser">
						<ul class="nav navbar-nav navbar-right headerLinks">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" id = "profileContainer">

									{literal}
									<span style = "color: white; position: relative;; top: -5px; right: 5px;">{{contact_name}}</span>
									<img alt="Contact Picture" style="width: 40px; height: 40px; border-radius: 50px; position: relative; top: -7px;" ng-if= 'contactDetails.imagedata != null' ng-src="data:{{contactDetails.imagetype}};base64,{{contactDetails.imagedata}}" alt="User image">{/literal} 
									<img alt="Contact Picture" ng-if = 'contactDetails.imagedata == null' style = "width: 40px; height: 40px; border-radius: 50px; position: relative; top: -7px;" ng-src = "https://profiles.utdallas.edu/img/default.png" alt="User image"/>
									<!--<img src="layouts/default/resources/images/user.png" style="heigth:20px;" alt="User image">-->
									<span class="caret" style = "color: white; position: relative; top: -5px; left: 5px;"></span>
								</a>
								<ul class="dropdown-menu" role="menu" id = "profileMenu">
									<li>
										<a href="index.php?module=PortalProfile&view=MyProfile">
                                            <i class = "glyphicon glyphicon-user"></i>&nbsp;&nbsp;&nbsp;<span translate="Profile">Profile</span>
                                        </a>
									</li>
									<li>
										<a href="#" ng-click="changePassword()">
                                            <i class = "glyphicon glyphicon-lock"></i>&nbsp;&nbsp;&nbsp;<span translate="Change Password">Change Password</span>
                                        </a>
									</li>
									<li>
										<a ng-click="logout()">
                                            <i class = "glyphicon glyphicon-log-out"></i>&nbsp;&nbsp;&nbsp;<span translate="Logout">Logout</span>
                                        </a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>

				<script type="text/ng-template" id="changePassword.template">
					<div class="modal-header" style = "background: #5f88c0; border-radius: 5px 5px 0 0">
						<button type="button" class="close" ng-click="cancel()" title="Close">&times;</button>
						<h4 class="modal-title" style = "font-weight: bold; text-align: center; color: white">{{'Change Password'|translate}}</h4>
					</div>
					<form class="form-horizontal" role="form">
						<div class="modal-body">
							<br>
							<div class="form-group">
								<div class="col-sm-12">
									<input ng-model="data.oldPassword" type="password" placeholder = "{{'Current Password'|translate}}" required class="form-control"></input>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<input ng-model="data.newPassword" placeholder = "{{'New Password'|translate}}" type="password" required class="form-control"></input>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<input ng-model="data.confirmPassword" placeholder = "{{'Confirm Password'|translate}}" type="password" required class="form-control"></input>
									<span class="text-danger" ng-if="data.oldPassword.length && data.newPassword.length && data.confirmPassword.length && (data.newPassword!==data.confirmPassword) && (data.newPassword!==data.oldPassword)"><i class = "glyphicon glyphicon-warning-sign"></i>&nbsp;&nbsp;{{'reconfirm_password' | translate}}</span>
									<span class="text-danger" ng-if="data.oldPassword.length && data.newPassword.length && (data.newPassword==data.oldPassword)"><i class = "glyphicon glyphicon-warning-sign"></i>&nbsp;&nbsp;{{'same_password' | translate}}</span>
								</div>
							</div>
							<button disabled = "disabled" id = "btnChangePassword" style = "width: 100%" class="btn btn-success" type="submit" ng-click="save()"><i class = "glyphicon glyphicon-	glyphicon glyphicon-floppy-saved"></i>&nbsp;&nbsp;{{'Save'|translate}}</button>
							<br>
						</div>
					</form>
				</script>
				<script id="template/pagination/pagination.html" type="text/ng-template">
					<ul class="pagination">
						<li ng-if="boundaryLinks && totalPages>'10'" ng-class="{disabled: noPrevious()}" title="First Page"><a href ng-click="selectPage(1)">&laquo;</a></li>
						<li ng-if="directionLinks" ng-class="{disabled: noPrevious()}" title="Previous Page">
							<a href class="page-left" ng-click="selectPage(page - 1)"></a>
						</li>
						<li ng-repeat="page in pages track by $index" ng-class="{active: page.active}"><a href ng-click="selectPage(page.number)">{{page.text}}</a></li>
						<li ng-if="directionLinks" ng-class="{disabled: noNext()}" title="Next Page">
							<a href class="page-right" ng-click="selectPage(page + 1)"></a>
						</li>
						<li ng-if="boundaryLinks && totalPages>'10'" ng-class="{disabled: noNext()}" title="Last Page"><a href ng-click="selectPage(totalPages)">&raquo;</a></li>
					</ul>
				</script>
				<script id="template/timepicker/popup.html" type="text/ng-template">
					<ul class="dropdown-menu" ng-style="{display: (isOpen && 'block') || 'none', top: position.top+'px', left: position.left+'px'}">
						<li ng-transclude></li>
					</ul>
				</script>
				<script id="template/timepicker/timepicker.html" type="text/ng-template">
					<table>
						<tbody>
							<tr class="text-center">
								<td>
									<a ng-click="incrementHours()" class="btn btn-link">
										<span class="glyphicon glyphicon-chevron-up"></span>
									</a>
								</td>
								<td>&nbsp;</td>
								<td>
									<a ng-click="incrementMinutes()" class="btn btn-link">
										<span class="glyphicon glyphicon-chevron-up"></span>
									</a>
								</td>
								<td ng-show="showMeridian"></td>
							</tr>
							<tr>
								<td style="width:50px;" class="form-group" ng-class="{'has-error': invalidHours}">
									<input type="text" ng-model="hours" ng-change="updateHours()" class="form-control text-center" ng-mousewheel="incrementHours()" ng-readonly="readonlyInput" maxlength="2">
								</td>
								<td>:</td>
								<td style="width:50px;" class="form-group" ng-class="{'has-error': invalidMinutes}">
									<input type="text" ng-model="minutes" ng-change="updateMinutes()" class="form-control text-center" ng-readonly="readonlyInput" maxlength="2">
								</td>
								<td ng-show="showMeridian">
									<button type="button" class="btn btn-default text-center" ng-click="toggleMeridian()">{{meridian}}</button>
								</td>
							</tr>
							<tr class="text-center">
								<td>
									<a ng-click="decrementHours()" class="btn btn-link">
										<span class="glyphicon glyphicon-chevron-down"></span>
									</a>
								</td>
								<td>&nbsp;</td>
								<td>
									<a ng-click="decrementMinutes()" class="btn btn-link">
										<span class="glyphicon glyphicon-chevron-down"></span>
									</a>
								</td>
								<td ng-show="showMeridian"></td>
							</tr>
						</tbody>
					</table>
				</script>
				<script type="text/ng-template" id="searchResults.tpl">
					<a tabindex="-1" ng-controller="globalSearchController">
						<!-- <pre>{{match}} -- {{query}}</pre> -->
						<i ng-click="searchItemSelected(match)" bind-html-unsafe="match.model.module.uiLabel" ng-class="getModuleLabelClass(match.model.module)"></i>
						<span ng-click="searchItemSelected(match)">{{match.model.value|limitTo:30}}</span>
					</a>
				</script>
				{/literal}

		</nav>
		<div class="webapp-page" style = "position: fixed; top: 59px; left: 0; bottom: 0; right: 0">
