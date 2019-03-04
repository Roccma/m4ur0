{strip}
<style type="text/css">
	.message-self{
		background-color: #4080ff;
	}
	.message-other{
		background-color: #fafafa;
	}
	.message-date{
      	float: right;
    	font-size: 10px;
    	color:grey;
	}
	.message{
		color:black;
	}
	.loadButton{
		margin-right: auto;
		margin-left: auto;
		display: block;
		#border-radius: 100%;
		background-color: #d9edf7;
		width : 20%;
		border-color: #d9edf7 #d9edf7 #d9edf7;
	}
	#bodyChat{
		height: 250px;
		overflow: hidden;
		overflow-y: auto;
	}

</style>
<div class="summaryWidgetContainer">
	<div class="widgetContainer_documents" data-url="{$DOCUMENT_WIDGET_MODEL->getUrl()}" data-name="{$DOCUMENT_WIDGET_MODEL->getLabel()}">
		<div class="widget_header row-fluid">
			<input type="hidden" name="relatedModule" value="{$DOCUMENT_WIDGET_MODEL->get('linkName')}" />
			<span class="span9 margin0px"><h4 class="">Respuestas de Facebook</h4></span>
			<span class="pull-right">
				<span class="pull-right">
					<button entityid='{$FACEBOOKID}' id="botonModal" data-toggle="modal" href="#modalChat" class="btn btn-primary" style="font-size: 11px">
						<strong> Ver conversacion</strong>	
					</button>
				</span>
			</span>
		</div>
		<div class="">
			<textarea id="quickMessageText"></textarea>
			<button id="quickBtnResponse" entityid='{$FACEBOOKID}' class="btn btn-primary" quickResponse="true">Responder</button>
		</div>
	</div>
</div>
<div class="modal fade bs-example-modal-lg" id="modalChat" style="width: 80%;margin-left: -40%">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		    <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			    <h4 class="modal-title">Conversaci&oacute;n</h4>
		    </div>
	  		<div class="modal-body" id="bodyChat" >
	  			<h4 id="messageError"></h4>
	  			<div class="row-fluid">
  					<div class="span12">
  						<button class="btn loadButton"  id="btnLoadMessage">
  							<i class="icon-plus-sign"></i>
  						</button>
  					</div>
  				</div>
  				<hr>  	
  				<div id="divInfo"><h4 id="infoText"></h4></div>			
	  			<div id="tbodyChat">
	  				
	  			</div>
			   	<!--table id="tablaChat" class="table table-striped table-hover" width="100%">
						<thead>
							<tr>
								<th>
									De
								</th>
								<th>
									Mensaje
								</th>
							</tr>
						</thead>
						<tbody id="tbodyChat">
							<div id="dashChartLoader" style="text-align:center;">
								<img src="layouts/vlayout/skins/softed/images/loading.gif" border="0" align="absmiddle">
							</div>
						</tbody>
					</table-->
			</div>
			<div class="modal-footer">
				<textarea id="messageText"></textarea>
			  	<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
			  	<button class="btn btn-primary" id="btnResponse" entityid='{$RECORD->get("related_facebook")}'>Responder</button>
			</div>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script type="text/javascript" src="layouts/vlayout/modules/Facebook/resources/Widget.js"></script>
{/strip}