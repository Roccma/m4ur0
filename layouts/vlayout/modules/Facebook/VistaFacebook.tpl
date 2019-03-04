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

<style type="text/css">
	.post-date{
		float: left;
	    font-size: 10px;
	    color: grey;
	}
	.btnLoadFb{
		float: right;		
	}
</style>
{if $RECORD->get('fbaction_type') eq "Mensaje"}
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
<input type="hidden" name="" id="isMessage">
<div class="row-fluid">
	<div class="summaryWidgetContainer">
		<div class="modal-content">
		    <div class="modal-header">
			    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			    <h4 class="modal-title">Conversaci&oacute;n</h4>
		    </div>
	  		<div class="modal-body" id="bodyChat" >
	  			<h4 id="messageError"></h4>
	  			<div class="row-fluid">
  					<div class="span12">
  						<button class="btn loadButton"  id="btnLoadMessage" entityid='{$RECORD->get("facebookid")}'>
  							<i class="icon-plus-sign"></i>
  						</button>
  					</div>
  				</div>
  				<hr>  	
  				<div id="divInfo"><h4 id="infoText"></h4></div>			
	  			<div id="tbodyChat">
	  				
	  			</div>
			</div>
			<div class="modal-footer">
				<textarea id="messageText"></textarea>
			  	<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>
			  	<button class="btn btn-primary" id="btnResponse" entityid='{$RECORD->get("facebookid")}'>Responder</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="layouts/vlayout/modules/Facebook/resources/Widget.js"></script>
{else}
<div class="row-fluid">
	<div class="span7">
		<div class="summaryWidgetContainer">
			<div class="widgetContainer_0" data-name="Comentarios">
				<div class="widget_header row-fluid">
					<span class="span12 margin0px">
						<h4>
							<a href="{$RECORD->get('fblink')}" target="_blank">{$RECORD->get('fbuser_name')}
							</a>
						</h4>
					</span>
				<i class="post-date">{$RECORD->get('fbcreated_time')}</i>
				</div>
			</div>
			<div class="widget_contents" id="postContainer">		
				<div class="row-fluid">
					<p id="postText">{$RECORD->get('fbdescription')}</p>
				</div>	
				<div class="row-fluid">
					<img id ="postImage" src="" style="display: none">
				</div>
			</div>
		</div>
	</div>
	<div class="span5">
		<div class="summaryWidgetContainer">
			<div class="widgetContainer_0" data-name="Comentarios">
				<div class="widget_header row-fluid">
					<span class="span8 margin0px"><h4>Comentarios</h4></span>
					<button class="btn btn-info btnLoadFb" id="loadComments"><i class="icon-plus"></i></button>
				</div>
				<div class="widget_contents" id="commentContainer">
				</div>
			</div>
		</div>
		<div class="summaryWidgetContainer">
			<div class="widgetContainer_1" data-name="Likes">
				<div class="widget_header row-fluid">
					<span class="span8 margin0px"><h4>Likes</h4></span>
					<button class="btn btn-info btnLoadFb" id="loadLikes"><i class="icon-plus"></i></button>
				</div>
				<div class="widget_contents" id="likeContainer">
				</div>
			</div>
		</div>
	</div>
</div>
{/if}
{/strip}