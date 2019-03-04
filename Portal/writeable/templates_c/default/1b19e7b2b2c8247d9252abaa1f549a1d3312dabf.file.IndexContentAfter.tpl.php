<?php /* Smarty version Smarty-3.1.19, created on 2019-01-09 20:45:35
         compiled from "/var/www/html/Sirenis/Portal/layouts/default/templates/RedimirDias/partials/IndexContentAfter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6334469195c2f41a7aee314-14114199%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b19e7b2b2c8247d9252abaa1f549a1d3312dabf' => 
    array (
      0 => '/var/www/html/Sirenis/Portal/layouts/default/templates/RedimirDias/partials/IndexContentAfter.tpl',
      1 => 1547066554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6334469195c2f41a7aee314-14114199',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5c2f41a7af2357_04535230',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c2f41a7af2357_04535230')) {function content_5c2f41a7af2357_04535230($_smarty_tpl) {?>


<script type="text/ng-template" id="editRecordModalRedimirDias.template">
	<form class="form form-vertical" novalidate="novalidate" name="redimirDiasForm" id="redimirDiasForm">
			<div class="modal-header">
				<button type="button" class="close" ng-click="cancel()" title="Close">&times;</button>
				<h4 class="modal-title" ng-show="!editRecord.id" style = "font-weight: bold; text-align: center; color: white">{{'Add new Days Request'|translate}}</h4>
			</div>
			<div class="modal-body" scroll-me="{'height':'690px'}">
				<table style = "width:100%">
					<tr>					
						<td style = "padding-right: 2%">
							<b>{{'State' | translate}}</b><br><br>
							<select class = "form-control" ng-options="item as item.name for item in estados track by item.id" ng-model="redestado">
							</select>
						</td>
						<td style = "padding-left: 2%;">
							<b>{{'Start Date' | translate}}</b><br><br>
							<div class='input-group date'>
			                    <input type='text' class="form-control fcdp" data-ng-datepicker data-ng-options="datepickerOptions" ng-model="redfechacom" id = "fechaComienzo" />
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
			                    <input type='text' class="form-control fcdp" data-ng-datepicker data-ng-options="datepickerOptions" ng-model="redfechafin" id = "fechaFin" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
						</td>
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>{{'E-mail' | translate}}</b><br><br>
							<input type = "email" class = "form-control" ng-model = "redcorreo"/>							
						</td>
					</tr>
					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Confirmation Number' | translate}}</b><br><br>
							<input type = "text" class = "form-control" ng-model = "rednroconf"/>
						</td>
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>{{'Passengers Quantity' | translate}}</b><br><br>
							<input type = "number" class = "form-control" ng-model="redpasajeros" />							
						</td>
					</tr>

					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Passenger 1' | translate}}</b><br><br>
							<input id = "redpasajero1" ng-model = "redpasajero1" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>{{'Passenger 2' | translate}}</b><br><br>
							<input id = "redpasajero2" ng-model = "redpasajero2" type = "text" class = "form-control" disabled = "disabled"/>							
						</td>
					</tr>
					<tr>				
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Passenger 3' | translate}}</b><br><br>
							<input id = "redpasajero3" ng-model = "redpasajero3" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>{{'Passenger 4' | translate}}</b><br><br>
							<input id = "redpasajero4" ng-model = "redpasajero4" type = "text" class = "form-control" disabled = "disabled"/>							
						</td>
					</tr>
					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Passenger 5' | translate}}</b><br><br>
							<input id = "redpasajero5" ng-model = "redpasajero5" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>Hotel</b><br><br>
							<select class = "form-control" ng-options="item as item.name for item in hoteles track by item.id" ng-model="hotel">
							</select>
						</td>
					</tr>
					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Comments' | translate}}</b><br><br>
							<input type = "text" class = "form-control" ng-model = "redcomentarios"/>
						</td>
					</tr>
				</table>
				<br>
				<div class = "alert alert-danger" style = "margin-top: 10px; margin-bottom: 0px" ng-show = "errorSolicitudDia">
					<center><strong><i class = "glyphicon glyphicon-warning-sign"></i>&nbsp;&nbsp;&nbsp;ERROR: </strong><span translate = "no_available_days">No se cuenta con la cantidad de días solicitados</span></center>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" ng-click="cancel()"><i class = "glyphicon glyphicon-remove"></i>&nbsp;&nbsp;&nbsp;<span translate="Cancel">Cancelar</span></button>
				<button type="submit" class="btn btn-success" ng-click="save(false)"><i class = "glyphicon glyphicon-floppy-saved"></i>&nbsp;&nbsp;&nbsp;{{'Save'|translate}}</button>
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
