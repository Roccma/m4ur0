<?php /* Smarty version Smarty-3.1.19, created on 2019-01-09 20:47:31
         compiled from "/var/www/html/Sirenis/Portal/layouts/default/templates/SolicitudesReservas/partials/IndexContentAfter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14602194115c2f41752eb970-19897085%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9780f72fd316ea376b11413a15e317b50036a20' => 
    array (
      0 => '/var/www/html/Sirenis/Portal/layouts/default/templates/SolicitudesReservas/partials/IndexContentAfter.tpl',
      1 => 1547066554,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14602194115c2f41752eb970-19897085',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5c2f41752ef248_04863914',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c2f41752ef248_04863914')) {function content_5c2f41752ef248_04863914($_smarty_tpl) {?>


<script type="text/ng-template" id="editRecordModalSolicitudesReservas.template">
	<form class="form form-vertical" novalidate="novalidate" name="solicitudesReservasForm" id="solicitudesReservasForm">
			<div class="modal-header">
				<button type="button" class="close" ng-click="cancel()" title="Close">&times;</button>
				<h4 class="modal-title" ng-show="editRecord.id">Editar Solicitud de Reserva - {{editRecord.ticket_title}}</h4>
				<h4 class="modal-title" ng-show="!editRecord.id" style = "font-weight: bold; text-align: center; color: white">{{'Add new Reservation Request'|translate}}</h4>
			</div>
			<div class="modal-body" scroll-me="{'height':'615px'}">
				<table style = "width:100%">
					<tr>					
						<td style = "padding-right: 2%">
							<b>{{'State' | translate }}</b><br><br>
							<select class = "form-control" ng-options="item as item.name for item in estados track by item.id" ng-model="resestado">
							</select>
						</td>
						<td style = "padding-left: 2%;">
							<b>{{'Start Date' | translate }}</b><br><br>
							<div class='input-group date'>
			                    <input type='text' class="form-control fcdp" data-ng-datepicker data-ng-options="datepickerOptions" ng-model="resfechacom" id = "fechaComienzo" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
							
						</td>
					</tr>
					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'End Date' | translate }}</b><br><br>
							<div class='input-group date'>
			                    <input type='text' class="form-control fcdp" data-ng-datepicker data-ng-options="datepickerOptions" ng-model="resfechafin" id = "fechaFin" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
						</td>
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>{{'E-mail' | translate }}</b><br><br>
							<input type = "email" class = "form-control" ng-model = "rescorreo"/>							
						</td>
					</tr>
					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Confirmation Number' | translate }}</b><br><br>
							<input type = "text" class = "form-control" ng-model = "resnroconf"/>
						</td>
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>{{'Passengers Quantity' | translate }}</b><br><br>
							<input type = "number" class = "form-control" ng-model="respasajeros" />							
						</td>
					</tr>

					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Passenger 1' | translate }}</b><br><br>
							<input id = "respasajero1" ng-model = "respasajero1" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>{{'Passenger 2' | translate }}</b><br><br>
							<input id = "respasajero2" ng-model = "respasajero2" type = "text" class = "form-control" disabled = "disabled"/>							
						</td>
					</tr>
					<tr>				
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Passenger 3' | translate }}</b><br><br>
							<input id = "respasajero3" ng-model = "respasajero3" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>{{'Passenger 4' | translate }}</b><br><br>
							<input id = "respasajero4" ng-model = "respasajero4" type = "text" class = "form-control" disabled = "disabled"/>							
						</td>
					</tr>
					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Passenger 5' | translate }}</b><br><br>
							<input id = "respasajero5" ng-model = "respasajero5" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>Hotel</b><br><br>
							<select class = "form-control" ng-options="item as item.name for item in hoteles track by item.id" ng-model="hotel">
							</select>
						</td>
					</tr>
					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Comments' | translate }}</b><br><br>
							<input type = "text" class = "form-control" ng-model = "rescomentarios"/>
						</td>
					</tr>


				</table>
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
