<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

Class Noticias_Edit_View extends Vtiger_Edit_View {

    public function getHeaderScripts(Vtiger_Request $request) {

		$headerScriptInstances = parent::getHeaderScripts($request);
		$moduleName = $request->getModule();
        $moduleDetailFile = 'modules.'.$moduleName.'.resources.Edit';
        
        unset($headerScriptInstances[$moduleDetailFile]);

		$jsFileNames = array(
            "modules.Users.resources.Edit",
            "libraries.jquery.ckeditor.ckeditor",
			"libraries.jquery.ckeditor.adapters.jquery",
			'modules.Vtiger.resources.CkEditor',
            'modules.'.$moduleName.'.resources.Edit'
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		
		return $headerScriptInstances;
	
	}

}