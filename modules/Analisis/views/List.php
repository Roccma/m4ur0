<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Analisis_List_View extends Vtiger_Index_View
{

	public function preProcess(Vtiger_Request $request, $display = true) {
		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE_NAME', $request->getModule());

		$currentUserModel = Users_Record_Model::getCurrentUserModel();
		$viewer->assign('CURRENT_USER', $currentUserModel);

		parent::preProcess($request, false);
		if($display) {
			$this->preProcessDisplay($request);
		}
	}

	protected function preProcessTplName (Vtiger_Request $request)
	{
		return 'AnalisisViewPreProcess.tpl';
	}

	public function getHeaderScripts (Vtiger_Request $request)
	{
		$headerScriptInstances = parent::getHeaderScripts($request);
		$jsFileNames = array(
			'~/libraries/jquery/funciones.js'
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}

	public function getHeaderCss (Vtiger_Request $request)
	{
		$headerCssInstances = parent::getHeaderCss($request);

		$cssFileNames = array(
			'~/libraries/fullcalendar/fullcalendar.css',
			'~/libraries/fullcalendar/fullcalendar-bootstrap.css',
			'~/libraries/pivottable/dist/pivot.css'
		);
		$cssInstances = $this->checkAndConvertCssStyles($cssFileNames);
		$headerCssInstances = array_merge($headerCssInstances, $cssInstances);

		return $headerCssInstances;
	}

	public function process (Vtiger_Request $request)
	{
		$viewer = $this->getViewer($request);
		$viewer->view('ListView.tpl', $request->getModule());
	}
	
	
}