<?php /* Smarty version Smarty-3.1.19, created on 2019-01-09 20:46:45
         compiled from "/var/www/html/Sirenis/Portal/layouts/default/templates/Portal/MyProfile.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1289679725c2f417ae17fe5-66671997%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8cd98eaa63963e4ac2c4ea7dd98089f2fbbe1af8' => 
    array (
      0 => '/var/www/html/Sirenis/Portal/layouts/default/templates/Portal/MyProfile.tpl',
      1 => 1547066554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1289679725c2f417ae17fe5-66671997',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5c2f417ae686b1_88609645',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c2f417ae686b1_88609645')) {function content_5c2f417ae686b1_88609645($_smarty_tpl) {?>

<div class="container-fluid ng-scope" id = "divMyProfile" ng-controller="PortalProfile_DetailView_Component">

	<div class="row" style = "margin-top: 3%">
		<div id = "profileContainer2">

			
			<h2 style = "display: block; font-weight: bold; color: #00214d; text-align: center; margin-bottom: 15px;">{{'Personal Details'|translate}}</h2>
			<div style = "margin-top: 35px;">
				<div style = "width: 25%; display: inline-block; height: 320px; position: relative; top: -40px;">
					<img alt="Contact Picture" style="width:71%; border-radius: 50%; display: block; margin: auto; margin-top: 10%" ng-show='contactDetails.imagedata != null' ng-src="data:{{contactDetails.imagetype}};base64,{{contactDetails.imagedata}}"> 
					<img alt="Contact Picture" ng-show = 'contactDetails.imagedata == null' style = "width: 71%; border-radius: 50%; display: block; margin: auto; margin-top: 10%" ng-src = "https://profiles.utdallas.edu/img/default.png"/>
				</div>
				<div style = "width: 70%; display: inline-block; position: relative; left: 2%; margin-bottom: 35px;">
					<table id = "tableProfile" class = "tableData" style = "width: 100%">
						<tr>
							<td style = "width: 50%"><span class = "profileTitle">{{'Name' | translate}}:</span> {{contactDetails.firstname}}</td>
							<td style = "width: 50%"><span class = "profileTitle">{{'Last Name' | translate}}:</span> {{contactDetails.lastname}}</td>
						</tr>
						<tr>
							<td style = "width: 50%"><span class = "profileTitle">{{'Agency type' | translate}}:</span> {{contactDetails.agency_type}}</td>
							<td style = "width: 50%"><span class = "profileTitle">{{'Agency number' | translate}}:</span> {{contactDetails.agency_number}}</td>
						</tr>
						<tr>
							<td style = "width: 50%"><span class = "profileTitle">{{'Number of employees' | translate}}:</span> {{contactDetails.number_employees}}</td>
							<td style = "width: 50%"><span class = "profileTitle">{{'Number of locations' | translate}}:</span> {{contactDetails.number_locations}}</td>
						</tr>
						<tr>
							<td style = "width: 50%"><span class = "profileTitle">{{'Agency name' | translate}}:</span> {{contactDetails.agency_name}}</td>
							<td style = "width: 50%"><span class = "profileTitle">{{'Number of storefronts' | translate}}:</span> {{contactDetails.number_storefronts}}</td>
						</tr>
						<tr>
							<td style = "width: 50%"><span class = "profileTitle">{{'Country' | translate}}:</span> {{contactDetails.mailingcountry}}</td>
							<td style = "width: 50%"><span class = "profileTitle">{{'Agency kind' | translate}}:</span> {{contactDetails.agency_kind}}</td>
						</tr>
						<tr>
							<td style = "width: 50%"><span class = "profileTitle">{{'City' | translate}}:</span> {{contactDetails.city}}</td>
							<td style = "width: 50%"><span class = "profileTitle">{{'Travel affiliation' | translate}}:</span> {{contactDetails.travel_affiliation}}</td>
						</tr>
						<tr>
							<td style = "width: 50%"><span class = "profileTitle">{{'State' | translate}}:</span> {{contactDetails.state}}</td>
							<td style = "width: 50%"><span class = "profileTitle">{{'Postal code' | translate}}:</span> {{contactDetails.mailingzip}}</td>
						</tr>
						<tr>
							<td style = "width: 50%"><span class = "profileTitle">{{'Address' | translate}}:</span> {{contactDetails.mailingstreet}}</td>
							<td style = "width: 50%"><span class = "profileTitle">{{'Address 2' | translate}}:</span> {{contactDetails.address2}}</td>
						</tr>
						<tr>
							<td style = "width: 50%"><span class = "profileTitle">{{'Phone' | translate}}:</span> {{contactDetails.homephone}}</td>
							<td style = "width: 50%"><span class = "profileTitle">{{'Ext' | translate}}:</span> {{contactDetails.ext}}</td>
						</tr>
						<tr>
							<td style = "width: 50%"><span class = "profileTitle">{{'E-mail' | translate}}:</span> {{contactDetails.email}}</td>
							<td style = "width: 50%"><span class = "profileTitle">{{'Web page' | translate}}:</span> {{contactDetails.web_page}}</td>
						</tr>
						<tr>
							<td style = "width: 50%"><span class = "profileTitle">{{'Top 2 selling destinations' | translate}}:</span> {{contactDetails.top_selling_destinations | replaceSeparatorCharacters}}</td>
							<td style = "width: 50%"><span class = "profileTitle">{{'Top 2 specialities' | translate}}:</span> {{contactDetails.top_specialities | replaceSeparatorCharacters}}</td>
						</tr>
						<tr>
							<td style = "width: 50%"><span class = "profileTitle">{{'Tag line' | translate}}:</span> {{contactDetails.tag_line}}</td>
						</tr>
					</table>
					
				</div>
			</div>
			<!--<div class="row" style = "margin-top: 15px;">
				<div class="col-lg-2 col-md-2">

					<img alt="Contact Picture" style="width:71%; border-radius: 50%; display: block; margin: auto" ng-show='contactDetails.imagedata != null' ng-src="data:{{contactDetails.imagetype}};base64,{{contactDetails.imagedata}}"> 
					<img alt="Contact Picture" ng-show = 'contactDetails.imagedata == null' style = "width: 71%; border-radius: 50%; display: block; margin: auto" ng-src = "https://profiles.utdallas.edu/img/default.png"/>
				</div>
				<div class="col-lg-10 col-md-10" style = "font-size: 14px;">
					

					<div class="row profile-fields">
						<span class="text-muted col-lg-4 col-md-4 col-sm-4 col-xs-4" translate="First Name"></span>
						<span ng-mouseover="hoverEditIn('contactFirstName')" ng-mouseleave="hoverEditLeave('contactFirstName')" class="text-primary col-lg-8 col-md-8 col-sm-8 col-xs-8">{{contactDetails.firstname}}&nbsp;&nbsp;<i ng-show="hoverEdit['contactFirstName']" class="glyphicon glyphicon-pencil" editable-text="contactDetails.firstname" onbeforesave="saveContactDetails($data,'firstname')" onhide="hoverEditLeave('contactFirstName')"></i></span>
					</div>
					<div class="row profile-fields">
						<span class="text-muted col-lg-4 col-md-4 col-sm-4 col-xs-4" translate="Last Name"></span>
						<span ng-mouseover="hoverEditIn('contactLastName')" ng-mouseleave="hoverEditLeave('contactLastName')" class="text-primary col-lg-8 col-md-8 col-sm-8 col-xs-8">{{contactDetails.lastname}}&nbsp;&nbsp;<i ng-show="hoverEdit['contactLastName']" class="glyphicon glyphicon-pencil"  editable-text="contactDetails.lastname" onbeforesave="saveContactDetails($data,'lastname')" onhide="hoverEditLeave('contactLastName')"></i></span>
					</div>
					<div class="row profile-fields">
						<span class="text-muted col-lg-4 col-md-4 col-sm-4 col-xs-4" translate="Primary Email"></span>
						<span ng-mouseover="hoverEditIn('contactPrimaryEmail')" ng-mouseleave="hoverEditLeave('contactPrimaryEmail')" class="text-primary col-lg-8 col-md-8 col-sm-8 col-xs-8">{{contactDetails.email}}&nbsp;&nbsp;<i ng-show="hoverEdit['contactPrimaryEmail']" class="glyphicon glyphicon-pencil" editable-text="contactDetails.email" onbeforesave="saveContactDetails($data,'email','email')" onhide="hoverEditLeave('contactPrimaryEmail')"></i></span>
					</div>
					<div class="row profile-fields">
						<span class="text-muted col-lg-4 col-md-4 col-sm-4 col-xs-4" translate="Secondary Email"></span>
						<span ng-mouseover="hoverEditIn('contactSecondaryEmail')" ng-mouseleave="hoverEditLeave('contactSecondaryEmail')" class="text-primary col-lg-8 col-md-8 col-sm-8 col-xs-8">{{contactDetails.secondaryemail}}&nbsp;&nbsp;<i ng-show="hoverEdit['contactSecondaryEmail']" class="glyphicon glyphicon-pencil" editable-text="contactDetails.secondaryemail" onbeforesave="saveContactDetails($data,'secondaryemail','email')" onhide="hoverEditLeave('contactSecondaryEmail')"></i></span>
					</div>
					<div class="row profile-fields">
						<span class="text-muted col-lg-4 col-md-4 col-sm-4 col-xs-4" translate="Mobile Phone"></span>
						<span ng-mouseover="hoverEditIn('contactMobilePhone')" ng-mouseleave="hoverEditLeave('contactMobilePhone')" class="text-primary col-lg-8 col-md-8 col-sm-8 col-xs-8">{{contactDetails.mobile}}&nbsp;&nbsp;<i ng-show="hoverEdit['contactMobilePhone']" class="glyphicon glyphicon-pencil" editable-text="contactDetails.mobile" onbeforesave="saveContactDetails($data,'mobile')" onhide="hoverEditLeave('contactMobilePhone')"></i></span>
					</div>
					<div class="row profile-fields">
						<span class="text-muted col-lg-4 col-md-4 col-sm-4 col-xs-4" translate="Office Phone"></span>
						<span ng-mouseover="hoverEditIn('contactOfficePhone')" ng-mouseleave="hoverEditLeave('contactOfficePhone')" class="text-primary col-lg-8 col-md-8 col-sm-8 col-xs-8">{{contactDetails.phone}}&nbsp;&nbsp;<i ng-show="hoverEdit['contactOfficePhone']" class="glyphicon glyphicon-pencil"  editable-text="contactDetails.phone" onbeforesave="saveContactDetails($data,'phone')" onhide="hoverEditLeave('contactOfficePhone')"></i></span>
					</div>
					<div class="row profile-fields">
						<span class="text-muted col-lg-4 col-md-4 col-sm-4 col-xs-4" translate="Agency Name"></span>
						<span ng-mouseover="hoverEditIn('agency_name')" ng-mouseleave="hoverEditLeave('agency_name')" class="text-primary col-lg-8 col-md-8 col-sm-8 col-xs-8">{{contactDetails.agency_name}}&nbsp;&nbsp;<i ng-show="hoverEdit['agency_name']" class="glyphicon glyphicon-pencil"  editable-text="contactDetails.agency_name" onbeforesave="saveContactDetails($data,'agency_name')" onhide="hoverEditLeave('agency_name')"></i></span>
					</div>

					
				</div>

			</div>-->

		</div>
	</div>

</div>
<?php }} ?>
