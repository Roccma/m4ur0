{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.2
* ("License.txt"); You may not use this file except in compliance with the License
* The Original Code is: Vtiger CRM Open Source
* The Initial Developer of the Original Code is Vtiger.
* Portions created by Vtiger are Copyright (C) Vtiger.
* All Rights Reserved.
************************************************************************************}

{literal}
<script type="text/ng-template" id="editRecordModalSolicitudesReservas.template">
	<form class="form form-vertical" novalidate="novalidate" name="editSolicitudReserva" id="editSolicitudReserva">
			<div class="modal-header">
				<button type="button" class="close" ng-click="cancel()" title="Close">&times;</button>
				<h4 class="modal-title" translate = "Edit Reservation Request" style = "font-weight: bold; text-align: center; color: white">Edit Reservation Request</h4>
			</div>
			<div class="modal-body" scroll-me="{'height':'615px'}">
				<table style = "width:100%">
					<tr>					
						<td style = "padding-right: 2%">
							<b>{{'State' | translate}}</b><br><br>
							<select class = "form-control" ng-options="item as item.name for item in estados track by item.id" ng-model="resestado">
							</select>
						</td>
						<td style = "padding-left: 2%">
							<b>{{'Start Date' | translate}}</b><br><br>
							<div class='input-group date'>
			                    <input type='text' class="form-control fcdp" data-ng-datepicker data-ng-options="datepickerOptions" ng-model="solicitud.resfechacom" id = "fechaComienzo" />
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
			                    <input type='text' class="form-control fcdp" data-ng-datepicker data-ng-options="datepickerOptions" ng-model="solicitud.resfechafin" id = "fechaFin" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
						</td>
						<td style = "padding-top: 2%; padding-left: 2%">
							<b>{{'E-mail' | translate}}</b><br><br>
							<input type = "email" class = "form-control" ng-model = "solicitud.rescorreo"/>							
						</td>
					</tr>
					<tr>						
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Confirmation Number' | translate}}</b><br><br>
							<input type = "text" class = "form-control" ng-model = "solicitud.resnroconf"/>
						</td>
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>{{'Passengers Quantity' | translate}}</b><br><br>
							<input type = "number" class = "form-control" ng-model="solicitud.respasajeros" value = "{{solicitud.respasajeros}}"/>							
						</td>
					</tr>

					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Passenger 1' | translate}}</b><br><br>
							<input id = "respasajero1" ng-model = "solicitud.respasajero1" value = "{{solicitud.respasajero1}}" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
						<td style = "padding-top: 2%; padding-left: 2%">
							<b>{{'Passenger 2' | translate}}</b><br><br>
							<input id = "respasajero2" ng-model = "solicitud.respasajero2" value = "{{solicitud.respasajero2}}" type = "text" class = "form-control" disabled = "disabled"/>							
						</td>
					</tr>
					<tr>				
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Passenger 3' | translate}}</b><br><br>
							<input id = "respasajero3" ng-model = "solicitud.respasajero3" value = "{{solicitud.respasajero3}}" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
						<td style = "padding-top: 2%; padding-left: 2%">
							<b>{{'Passenger 4' | translate}}</b><br><br>
							<input id = "respasajero4" ng-model = "solicitud.respasajero4" value = "{{solicitud.respasajero4}}" type = "text" class = "form-control" disabled = "disabled"/>							
						</td>
					</tr>
					<tr>					
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>{{'Passenger 5' | translate}}</b><br><br>
							<input id = "respasajero5" ng-model = "solicitud.respasajero5" value = "{{solicitud.respasajero5}}" type = "text" class = "form-control" disabled = "disabled"/>
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
							<input type = "text" class = "form-control" ng-model = "solicitud.rescomentarios"/>
						</td>
					</tr>


				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" ng-click="cancel()"><i class = "glyphicon glyphicon-remove"></i>&nbsp;&nbsp;&nbsp;<span translate="Cancel"></span></button>
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
{/literal}
