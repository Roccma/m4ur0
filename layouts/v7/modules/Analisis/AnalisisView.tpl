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
{literal}
<style type="text/css">
.pvtAxisLabel,.pvtRowLabel,.pvtTotalLabel {
    color: #000;
}
</style>
<script type="text/javascript">
var arr;

function MailsRebotados ()
{
    jQuery.ajax({
        async: false,
        data: {},
        url:  'index.php?module=Analisis&view=MailsRebotados&mode=data',
        dataType:"json",

        success: function(data)
        {
            arr=data;
            jQuery("#dashChartLoader2").hide();    
        },

        error: function (xhr, ajaxOptions, thrownError)
        {
            console.log(thrownError);
        }
    });
}

function actualizar ()
{
    var dateRangeVal = jQuery('.dateRange').val();
    
    //If not value exists for date field then dont send the value
    if (dateRangeVal.length <= 0)
    {
        return true;
    }

    var dateRangeValComponents = dateRangeVal.split(',');
    var createdtime = {};
    createdtime.start = dateRangeValComponents[0];
    createdtime.end = dateRangeValComponents[1];

    jQuery.ajax({
        async: false,
        data: {'createdtime':createdtime},
        url:  'index.php?module=Analisis&view=MailsRebotados&mode=Ajax',
        dataType:"json",

        success: function (data)
        {
            arr = data;
            graficar();
            
        },

        error: function (xhr, ajaxOptions, thrownError)
        {
          console.log(thrownError);
        }
    });
}

function graficar ()
{
    var derivers= $.pivotUtilities.derivers,
        tpl     = $.pivotUtilities.aggregatorTemplates;
    
    jQuery('#output').remove();
    jQuery('#details').append('<div id="output"></div>');

    $("#output").pivotUI(
        arr, 
        { 
            aggregators: {
                "Cantidad de Emails": function ()
                {
                    return tpl.count()();
                }
            },
            rows: [
                "Correo", "Nombre", "Documento", "Celular",
                "Asunto", "Local Pref.", "Fecha", "Link"],
            cols: [],
            exportCSV: true
        }
    );
}

jQuery(document).ready(function ()
{
    actualizar();
    graficar();

    var dateRangeElement = jQuery('.dateRange');
    var dateChanged = false;

    if (dateRangeElement.length <= 0)
    {
        return;
    }

    var customParams = {
        calendars: 3,
        mode: 'range',
        className : 'rangeCalendar',
        onChange: function(formated) {
            dateChanged = true;
            var element = jQuery(this).data('datepicker').el;
            jQuery(element).val(formated);
        },
        onHide : function() {
            if (dateChanged)
            {
                actualizar();
                dateChanged = false;
            }
        },
        onBeforeShow : function(elem) {
        jQuery(elem).css('z-index','3');
        }
    }
    dateRangeElement.addClass('dateField').attr('data-date-format',"dd-mm-yyyy");
    app.registerEventForDatePickerFields(dateRangeElement,false,customParams);
    $(".dateRange").keydown(function (e)
    {
        e.preventDefault();
    });
});
</script>
{/literal}
<div class="detailViewContainer">
  <div class="row-fluid detailViewTitle">
    <span class="recordLabel font-x-x-large textOverflowEllipsis span pushDown" title="gika">
        <span class="">
            Mails rebotados
            {if $local_enc != ''}
            de {$local_enc}
            {/if}
        </span></span>
  </div>
  <div class="row-fluid detailViewTitle"><span class="row-fluid"><span class="muted">¿Cuáles son los correos rebotados? De dónde vienen? Quién puede corregirlos?
</span></span></div>
  <div class="detailViewInfo row-fluid">
    <div class="row-fluid" style="margin-top:10px;">
      <span class="span3">
        <span class="pull-left" style="padding-left:10px;padding-top:5px;">
          <label for="createdtime">
        Fecha de Envío entre:
          </label>
        </span>
      </span>
      <span class="span3">
        <input type="text" name="createdtime" id="createdtime" value="{$date_range}" class="dateRange widgetFilter dateField" data-date-format="dd-mm-yyyy">
      </span>
    </div>
    <div class=" details">
      <div id="details" class="row-fluid" style="margin: 5px;">
        <div id="output" style="margin: 10px;"></div>
      </div>
      <div class="row-fluid" style="margin-top:15px;">
        <div class="span8" style="margin-left:5px;">
             <a class="btn addButton" href="#" style="padding:4px 6px;float:left;font-weight:bold;margin-right:5px;font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;" onclick="tableToExcel('pvtRendererArea','Correos Rebotados',true);">  Exportar a Excel  </a>
            <button style="float:left;" class="btn addButton" onclick="saveExcel('results','output','Correos Rebotados');"><i class="icon-download icon-white"></i>&nbsp;<strong>Guardar para Análisis de Datos</strong></button>
            <button id="resultsView" style="float:left;display:none;margin-left:10px;"class="btn addButton" onclick=""><i class="icon-signal icon-white"></i>&nbsp;<strong>  Ver Análisis</strong></button>
            <div id="resultsLoader" style="text-align:center;display:none;"><img src="layouts/vlayout/skins/softed/images/loading.gif" border="0" align="absmiddle"></div>
        </div>
        <form action="download.php" method="post" target="_blank" id="FormularioExportacion">
            <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
            <input type="hidden" id="nombre_a_enviar" name="nombre_a_enviar" />
            <input type="hidden" id="is_submited" name="is_submited" />
          </form>
    </div>
    </div>

    