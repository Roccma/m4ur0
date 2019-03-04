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
	<form class="form form-vertical" novalidate="novalidate" name="pedidoForm">
			<div class="modal-header">
				<button type="button" class="close" ng-click="cancel()" title="Close">&times;</button>
				<h4 class="modal-title" ng-show="editRecord.id">Editar Solicitud de Reserva - {{editRecord.ticket_title}}</h4>
				<h4 class="modal-title" ng-show="!editRecord.id">{{'Añadir nueva Solicitud de Reserva'|translate}}</h4>
			</div>
			<div class="modal-body" scroll-me="{'height':'615px'}">
				<table style = "width:100%">
					<tr>
						<td style = "padding-right: 2%">
							<b>Contacto *</b><br><br>
							<select class = "form-control" required ng-model = "rescontacto">
								<option ng-repeat = "contact in contactos" value = "{{contact.contactid}}">{{contact.contactname}}</option>
							</select>
						</td>
					
						<td style = "padding-left: 2%">
							<b>Estado</b><br><br>
							<select class = "form-control" ng-model = "resestado">
								<option value = 'Pendiente'>Pendiente</option>
								<option value = 'Confirmada'>Confirmada</option>
							</select>
						</td>
					</tr>
					<tr>
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>Fecha de Comienzo</b><br><br>
							<div class='input-group date'>
			                    <input type='text' class="form-control fcdp" data-ng-datepicker data-ng-options="datepickerOptions" ng-model="resfechacom" id = "fechaComienzo" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
							
						</td>
					
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>Fecha de Fin</b><br><br>
							<div class='input-group date'>
			                    <input type='text' class="form-control fcdp" data-ng-datepicker data-ng-options="datepickerOptions" ng-model="resfechafin" id = "fechaFin" />
			                    <span class="input-group-addon">
			                        <span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                </div>
						</td>
					</tr>
					<tr>
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>Correo electrónico</b><br><br>
							<input type = "email" class = "form-control" ng-model = "rescorreo"/>							
						</td>
					
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>Número de confirmación</b><br><br>
							<input type = "text" class = "form-control" ng-model = "resnroconf"/>
						</td>
					</tr>

					<tr>
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>Cantidad de pasajeros</b><br><br>
							<input type = "number" class = "form-control" ng-model="respasajeros" />							
						</td>
					
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>Pasajero 1</b><br><br>
							<input id = "respasajero1" ng-model = "respasajero1" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
					</tr>
					<tr>
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>Pasajero 2</b><br><br>
							<input id = "respasajero2" ng-model = "respasajero2" type = "text" class = "form-control" disabled = "disabled"/>							
						</td>
					
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>Pasajero 3</b><br><br>
							<input id = "respasajero3" ng-model = "respasajero3" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
					</tr>
					<tr>
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>Pasajero 4</b><br><br>
							<input id = "respasajero4" ng-model = "respasajero4" type = "text" class = "form-control" disabled = "disabled"/>							
						</td>
					
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>Pasajero 5</b><br><br>
							<input id = "respasajero5" ng-model = "respasajero5" type = "text" class = "form-control" disabled = "disabled"/>
						</td>
					</tr>
					<tr>
						<td style = "padding-right: 2%; padding-top: 2%">
							<b>Hotel</b><br><br>
							<select class = "form-control" ng-model = "hotel">
								<option ng-repeat = "hotels in hoteles" value = "{{hotels.hotel}}">{{hotels.hotel}}</option>
							</select>
						</td>
					
						<td style = "padding-left: 2%; padding-top: 2%">
							<b>Comentarios</b><br><br>
							<input type = "text" class = "form-control" ng-model = "rescomentarios"/>
						</td>
					</tr>


				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" ng-click="cancel()" translate="Cancel">Cancel</button>
				<button type="submit" class="btn btn-success" ng-click="save()">Confirmar</button>
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
