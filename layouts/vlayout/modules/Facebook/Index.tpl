{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}
{strip}
<div class="container-fluid">
	<div class="hero-unit">
		<div class="row-fluid">
			<div class="span12">
				<div class="row-fluid">
					<h2>Configurador de api Facebook:</h2>
				</div>
			</div>	
		</div>
		<div class="row-fluid">
			<div id="fb-root">
				<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" data-auth-type="rerequest" data-scope="manage_pages,read_page_mailboxes,publish_pages,pages_show_list,pages_manage_instant_articles" onLogin='Facebook_Index_Js.loadPages()'></div>
				
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<table id="tableFacebook" class="table table-bordered listViewEntriesTable">
				<thead id="headFacebook">
					<tr class="listViewHeaders">
						<th>Id Página</th>
						<th>Nombre</th>
						<th>Categoria</th>
						<th>Acción</th>
					</tr>
				</thead>
				<tbody id="bodyFacebook">
				</tbody>
				<tfoot id="footFacebook">
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td><button id="saveButton" class="btn btn-primary">Guardar</button></td>
					</tr>
				</tfoot>
			</table>
			<!--table id="tableFacebook" class="table table-bordered listViewEntriesTable">
				<thead id="headFacebook">
					<tr class="listViewHeaders">
						<th>Id entidad</th>
						<th>Id usuario</th>
						<th>Relacionado a</th>
						<th>Fecha de creaci&oacute;n</th>
						<th>Link</th>
						<th>Descripci&oacute;n</th>
					</tr>
				</thead>
				<tbody id="bodyFacebook">
					<template id="rowTemplate">
						<tr class="listViewEntries">
							<td class="entity listViewEntryValue medium"></td>
							<td class="user listViewEntryValue medium"></td>
							<td class="related_to listViewEntryValue medium"></td>
							<td class="createdtime listViewEntryValue medium"></td>
							<td class="link listViewEntryValue medium"></td>
							<td class="description listViewEntryValue medium"></td>
						</tr>
					</template>					
				</tbody>
			</table-->
		</div>
	</div>
</div>
{/strip}