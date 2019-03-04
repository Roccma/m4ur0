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
<div class="row-fluid">
	<div class="hero-unit">
		<div class="row-fluid">
			<button id="loadData" class="btn btn-primary pull-right">Cargar Datos</button>			
		</div>
		<hr>
		<div class="row-fluid">
			<textarea id="responseText"></textarea>
		</div>
	</div>
</div>
{literal}
<script type="text/javascript">
	window.onload = function(){

		//Functions for get Data
		function getData(){
			console.log("va click");
			jQuery.ajax({
				method : 'get',
				url : 'importar_elementos_facebook_con_token.php',
				success : function(response){
					console.log(response);
					response = typeof response == 'string'? response : JSON.stringify(response);
					response = response.replace(/<br>/g,"\n");
					document.getElementById('responseText').textContent = response;
				},
				error : function(error){
					console.log(error);
				}
			})
		}

		function registerEventLoadData(){
			document.getElementById('loadData').addEventListener('click', evt => getData() );
		}

		registerEventLoadData();

	}
</script>
{/literal}
{/strip}