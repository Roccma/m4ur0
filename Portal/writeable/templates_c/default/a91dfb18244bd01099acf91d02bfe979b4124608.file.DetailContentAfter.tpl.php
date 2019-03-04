<?php /* Smarty version Smarty-3.1.19, created on 2019-01-09 20:47:22
         compiled from "/var/www/html/Sirenis/Portal/layouts/default/templates/RedimirDias/partials/DetailContentAfter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20687463825c365ddab27232-56590951%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a91dfb18244bd01099acf91d02bfe979b4124608' => 
    array (
      0 => '/var/www/html/Sirenis/Portal/layouts/default/templates/RedimirDias/partials/DetailContentAfter.tpl',
      1 => 1547066554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20687463825c365ddab27232-56590951',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5c365ddab2ce06_73464300',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c365ddab2ce06_73464300')) {function content_5c365ddab2ce06_73464300($_smarty_tpl) {?>


<script type="text/ng-template" id="editRecordModalRedimirDias.template">
	<form class="form form-vertical" novalidate="novalidate" name="editRedimirDias" id = "editRedimirDias">
			<div class="modal-header">
				<button type="button" class="close" ng-click="cancel()" title="Close">&times;</button>
				<h4 class="modal-title" translate = "Edit Days Request" style = "font-weight: bold; text-align: center; color: white">Edit Days Request</h4>
			</div>
			<div class="modal-body" scroll-me="{'height':'690px'}">
				<table style = "width:100%">
					<tr>					
						<td style = "padding-right: 2%">
							<b>{{'State' | translate}}</b><br><br>
							<select class = "form-control" ng-options="item as item.name for item in estados track by item.id" ng-model="redestado">
							</select>
						</td>
						<td style = "padding-left: 2%">
							<b>{{'Start Date' | translate}}</b><br><br>
							<div class='input-group date'>
			                    <input type='text' class="form-control fcdp" data-ng-datepicker data-ng-options="datepickerOptions" ng-model="solicitud.redfechacom" id = "fechaComienzo" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
							
						</td>
					</tr>
					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'End Date' | translate}}</b><br><br>
							<div class='input-group date'>
			                    <input type='text' class="form-control fcdp" data-ng-datepicker data-ng-options="datepickerOptions" ng-model="solicitud.redfechafin" id = "fechaFin" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
						</td>
						<td style = "padding-top: 2%; padding-left: 2%">
							<b>{{'E-mail' | translate}}</b><br><br>
							<input type = "email" class = "form-control" ng-model = "solicitud.redcorreo"/>							
						</td>
					</tr>
					<tr>						
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Confirmation Number' | translate}}</b><br><br>
							<input type = "text" class = "form-control" ng-model = "solicitud.rednroconf"/>
						</td>
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>{{'Passengers Quantity' | translate}}</b><br><br>
							<input type = "number" class = "form-control" ng-model="solicitud.redpasajeros" value = "{{solicitud.redpasajeros}}"/>							
						</td>
					</tr>

					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Passenger 1' | translate}}</b><br><br>
							<input id = "redpasajero1" ng-model = "solicitud.redpasajero1" value = "{{solicitud.redpasajero1}}" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
						<td style = "padding-top: 2%; padding-left: 2%">
							<b>{{'Passenger 2' | translate}}</b><br><br>
							<input id = "redpasajero2" ng-model = "solicitud.redpasajero2" value = "{{solicitud.redpasajero2}}" type = "text" class = "form-control" disabled = "disabled"/>							
						</td>
					</tr>
					<tr>				
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Passenger 3' | translate}}</b><br><br>
							<input id = "redpasajero3" ng-model = "solicitud.redpasajero3" value = "{{solicitud.redpasajero3}}" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
						<td style = "padding-top: 2%; padding-left: 2%">
							<b>{{'Passenger 4' | translate}}</b><br><br>
							<input id = "redpasajero4" ng-model = "solicitud.redpasajero4" value = "{{solicitud.redpasajero4}}" type = "text" class = "form-control" disabled = "disabled"/>							
						</td>
					</tr>
					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Passenger 5' | translate}}</b><br><br>
							<input id = "redpasajero5" ng-model = "solicitud.redpasajero5" value = "{{solicitud.redpasajero5}}" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
						<td style = "padding-top: 2%; padding-left: 2%">
							<b>Hotel</b><br><br>
							<select class = "form-control" ng-options="item as item.name for item in hoteles track by item.id" ng-model="hotel">
							</select>
						</td>
					</tr>
					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Comments' | translate}}</b><br><br>
							<input type = "text" class = "form-control" ng-model = "solicitud.redcomentarios"/>
						</td>
					</tr>


				</table>
				<div class = "alert alert-danger" style = "margin-top: 10px; margin-bottom: 0px" ng-show = "errorSolicitudDia">
					<center><strong><i class = "glyphicon glyphicon-warning-sign"></i>&nbsp;&nbsp;&nbsp;ERROR: </strong><span translate = "no_available_days">No se cuenta con la cantidad de días solicitados</span></center>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" ng-click="cancel()"><i class = "glyphicon glyphicon-remove"></i>&nbsp;&nbsp;&nbsp;<span translate="Cancel">Cancelar</span></button>
				<button type="submit" class="btn btn-success" ng-click="save(true)"><i class = "glyphicon glyphicon-ok"></i>&nbsp;&nbsp;&nbsp;{{'Confirm'|translate}}</button>
			</div>
		</form>
		</script>

		<style type="text/css">
			.fcdp > input{
				padding: 6px 8px;
				width: 100%;
				border: none;
			}
			.fcdp{
				padding: 0 !important;
			}
		</style>

<?php }} ?>
