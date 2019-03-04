{**
 * VGS Visual Pipeline Module
 *
 *
 * @package        VGSVisualPipeline Module
 * @author         Curto Francisco - www.vgsglobal.com
 * @license        vTiger Public License.
 * @version        Release: 1.0
 *}

<div style="width: 65%;margin: auto;margin-top: 2em;padding: 2em;">
    <input type="hidden" name="sourcemodule" id="sourcemodule" value="{$SOURCEMODULE}">
    <input type="hidden" name="sourcefieldname" id="sourcefieldname" value="{$SOURCEFIELDNAME}">
    <input type="hidden" name="fieldname1" id="fieldname1" value="{$FIELDNAME1}">
    <input type="hidden" name="fieldname2" id="fieldname2" value="{$FIELDNAME2}">
    <input type="hidden" name="fieldname3" id="fieldname3" value="{$FIELDNAME3}">
    <input type="hidden" name="fieldname4" id="fieldname4" value="{$FIELDNAME4}">
    <input type="hidden" name="vgsid" id="vgsid" value="{$VGSID}">
    <h3 style="padding-bottom: 1em;text-align: center">{vtranslate('LBL_MODULE_NAME', $MODULE)}</h3>
    <div>
        <h4 style="margin-top: 1em;margin-bottom: 0.5em;">{vtranslate('ADD_NEW_PIPELINE', $MODULE)}</h4>
        <p>{vtranslate('ADD_NEW_UPDATE_EXPLAIN', $MODULE)}</p>
        <table class="table table-bordered table-condensed themeTableColor" style="margin-top: 1em;">
            <thead>
                <tr class="blockHeader">
                    <th colspan="4" class="mediumWidthType"><span class="alignMiddle">{vtranslate('ADD_NEW_PIPELINE', $MODULE)}</span></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="50%" colspan="2"><label class="muted pull-right marginRight10px">{vtranslate('SOURCE_MODULE_NAME', $MODULE)}</label></td>
                    <td colspan="2" style="border-left: none;">
                        <select name="module1" id="module1">
                            <option value="-">--</option>
                            {foreach from=$ENTITY_MODULES item=MODULE1}
                                <option value="{$MODULE1}">{vtranslate($MODULE1)}</option>
                            {/foreach}
                        </select>    
                    </td>
                </tr>
                <tr>
                    <td width="50%" colspan="2"><label class="muted pull-right marginRight10px">{vtranslate('SOURCE_FIELD_LABEL', $MODULE)}</label></td>
                    <td colspan="2" style="border-left: none;">
                        <select name="picklist1" id="picklist1">
                            <option value="-">--</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="50%" colspan="2"><label class="muted pull-right marginRight10px">{vtranslate('LBL_CAMPOAMOSTRAR', $MODULE)} 1</label></td>
                    <td colspan="2" style="border-left: none;">
                        <select name="amostrar1" id="amostrar1">
                            <option value="-">--</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="50%" colspan="2"><label class="muted pull-right marginRight10px">{vtranslate('LBL_CAMPOAMOSTRAR', $MODULE)} 2</label></td>
                    <td colspan="2" style="border-left: none;">
                        <select name="amostrar2" id="amostrar2">
                            <option value="-">--</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="50%" colspan="2"><label class="muted pull-right marginRight10px">{vtranslate('LBL_CAMPOAMOSTRAR', $MODULE)} 3</label></td>
                    <td colspan="2" style="border-left: none;">
                        <select name="amostrar3" id="amostrar3">
                            <option value="-">--</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="50%" colspan="2"><label class="muted pull-right marginRight10px">{vtranslate('LBL_CAMPOAMOSTRAR', $MODULE)} 4</label></td>
                    <td colspan="2" style="border-left: none;">
                        <select name="amostrar4" id="amostrar4">
                            <option value="-">--</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
       
        <br><br>
        <button class="btn btn-success pull-right" style="margin-bottom: 0.5em;" id="add_entry">Guardar</button>
        <a class="btn btn-danger pull-right" style="margin-right: 2%;" href="javascript:history.go(-1)">Cancelar</a>
     
    </div>
</div>