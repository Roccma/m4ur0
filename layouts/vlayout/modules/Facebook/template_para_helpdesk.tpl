{* Esto va para el archivo HelpDesk/SumarryViewWidgets.tpl *}

		{* Summary View Related Facebook Actions Widget*}
		{if $RECORD->get('related_facebook') != ''}			
			{include file='FacebookWidget.tpl'|vtemplate_path:'Facebook'}
		{/if}
		{* Summary View Related Facebook Actions Widget Ends Here*}


		{* Summary View Related Activities Widget*}
			<div id="relatedActivities">
				{$RELATED_ACTIVITIES}
			</div>
		{* Summary View Related Activities Widget Ends Here*}