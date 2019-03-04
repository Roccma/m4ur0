<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Analisis_Analisis_View extends Vtiger_Index_View {

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

	protected function preProcessTplName(Vtiger_Request $request) {
		return 'AnalisisViewPreProcess.tpl';
	}

	public function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);
		$jsFileNames = array(
			"modules.Analisis.resources.AnalisisView",
			//"~/libraries/pivottable/ext/jquery-1.8.3.min.js",
			"~/libraries/pivottable/ext/jquery-ui-1.9.2.custom.min.js",
			"~/libraries/pivottable/dist/pivot.js",
			'~/libraries/jquery/funciones.js',
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}

	public function getHeaderCss(Vtiger_Request $request) {
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
		// Modo
		$mode = strtolower($request->getMode());

		if ($mode == 'settings')
		{
			return $this->getAnalisisSettings($request);
		}

		// Asignar el usuario
		$viewer 			= $this->getViewer($request);
		$currentUserModel 	= Users_Record_Model::getCurrentUserModel();

		$viewer->assign('CURRENT_USER', $currentUserModel);

		// Referencia a BD
		$adb = PearDatabase::getInstance();

		// Es encargado?
		$m_local = '';

		if ($currentUserModel->roleid == 'H7')
		{
			$m_locales = $currentUserModel->user2local;

			$arr_aux = explode(' |##| ', $m_locales);
			$m_local = "'" . join("','", $arr_aux) . "'";

			/*
			$m_localid = $currentUserModel->local;

			$sql = "SELECT lplcnombre AS local FROM vtiger_local WHERE localid = $m_localid";
			$rlo = $adb->query($sql);

			$m_local = $adb->query_result($rlo, 0, 'local');
			*/
		}

		$query = "" .
		"SELECT
			contactid, destinatario, firstname, lastname,
			mobile, documento AS documento, asunto,
			DATE_FORMAT(fecha_error, '%d/%m/%Y') AS fecha_error,
			localpref AS local
		FROM
			vtiger_lp_errores_correos
			INNER JOIN vtiger_contactdetails ON destinatario = email 
			JOIN vtiger_crmentity ON crmid = contactid
		WHERE
			fecha_error >= DATE_ADD(NOW(), INTERVAL -30 DAY)
			AND deleted = 0";

		if (!empty($m_local))
		{
			$query .= " AND localpref IN ($m_local)";
		}

		// Archivo para debug
		$archdebug = fopen('archdebug.txt', 'a');
		fwrite($archdebug, '********** Mails Rebotados (Analisis)' . PHP_EOL);
		fwrite($archdebug, $query . PHP_EOL);
		fclose($archdebug);

		$result 	= $adb->query($query);
		$no_of_rows	= $adb->num_rows($result);

		// Campos
		$ar[] = array(
			'Correo', 'Nombre', 'Documento', 'Celular',
			'Asunto', 'Local Pref.', 'Fecha', 'Link'
		);
		
		if ($no_of_rows > 0)
		{
			$total = 0;
			 
			while ($row = $adb->fetch_array($result))
			{
		    	$link = "<a href='index.php?module=Contacts&view=Detail&record=".$row["contactid"]."'>Ver</a>";
		    	
		    	$ar[] = array(
		    		$row['destinatario'],
		    		$row['firstname'] . " " . $row['lastname'],
		    		$row['documento'] . "",
		    		$row['mobile'] . "",
		    		$row['asunto'] . "",
		    		$row['local'] . "",
		    		$row['fecha_error'] . "",
		    		$link . ""
		    	);
			}
		}
		
		$viewer->assign('ARR', json_encode($ar));

		$first_day_this_month = date('01-m-Y'); // hard-coded '01' for first day
		$first_day_this_month = date('01-m-Y', strtotime("-1 months"));
		$last_day_this_month  = date('t-m-Y');
		$date_range=$first_day_this_month.",".$last_day_this_month;
		$viewer->assign('date_range', $date_range);

		// Obtengo el usuario actual
		$currentUserModel	= Users_Record_Model::getCurrentUserModel();

		// Es encargado?
		$m_local = '';

		if ($currentUserModel->roleid == 'H7')
		{
			$m_locales = $currentUserModel->user2local;

			$arr_aux = explode(' |##| ', $m_locales);
			$m_local = join(' y ', $arr_aux);

			/*
			$m_localid = $currentUserModel->local;

			$sql = "SELECT lplcnombre AS local FROM vtiger_local WHERE localid = $m_localid";
			$rlo = $adb->query($sql);

			$m_local = $adb->query_result($rlo, 0, 'local');
			*/
		}

		$viewer->assign('local_enc', $m_local);

		$viewer->view('AnalisisView.tpl', $request->getModule());
	}
	
	/*
	 * Function to get the calendar settings view
	 */
	public function getAnalisisSettings(Vtiger_Request $request){
		
		$viewer = $this->getViewer($request);
		$currentUserModel = Users_Record_Model::getCurrentUserModel();
		$module = $request->getModule();
		$detailViewModel = Vtiger_DetailView_Model::getInstance('Users', $currentUserModel->id);
		$userRecordStructure = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($detailViewModel->getRecord(), Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);
		$recordStructure = $userRecordStructure->getStructure();
		$allUsers = Users_Record_Model::getAll(true);
		$sharedUsers = Analisis_Module_Model::getCaledarSharedUsers($currentUserModel->id);
		$sharedType = Analisis_Module_Model::getSharedType($currentUserModel->id);
		$dayStartPicklistValues = Users_Record_Model::getDayStartsPicklistValues($recordStructure);
		
		$viewer->assign('CURRENTUSER_MODEL',$currentUserModel);
		$viewer->assign('SHAREDUSERS', $sharedUsers);
		$viewer->assign("DAY_STARTS", Zend_Json::encode($dayStartPicklistValues));
		$viewer->assign('ALL_USERS',$allUsers);
		$viewer->assign('RECORD_STRUCTURE', $recordStructure);
		$viewer->assign('MODULE',$module);
		$viewer->assign('RECORD', $currentUserModel->id);
		$viewer->assign('SHAREDTYPE', $sharedType);
		
		$viewer->view('AnalisisSettings.tpl', $request->getModule());
	}
	
	
}