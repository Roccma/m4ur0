<?php

/* +***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * *********************************************************************************** */
error_reporting(E_ERROR);
class Facebook_Detail_View extends Vtiger_Detail_View {
	
	function __construct() {
		parent::__construct();
		$this->exposeMethod('showRelatedRecords');
	}

	function checkPermission(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$recordId = $request->get('record');

		return true;

		$recordPermission = Users_Privileges_Model::isPermitted($moduleName, 'DetailView', $recordId);
		if(!$recordPermission) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}
		return true;
	}
	
	public function process(Vtiger_Request $request){
		$recordId 	= $request->get('record');
		$moduleName = $request->getModule();
		$record 	= Vtiger_Record_Model::getInstanceById($recordId);
		
		$viewer = $this->getViewer($request);
		
		if ($record->get('fbaction_type') == 'Mensaje'){
			$viewer->assign("RECORD",$record);

		}else{
			$recordModel = $this->getData($request);
			$viewer->assign('RECORD', $recordModel);

		}
		echo $viewer->view('VistaFacebook.tpl', $moduleName, true);
	}

	public function getData(Vtiger_Request $request){
		$recordId = $request->get('record');
		$moduleName = $request->getModule();

		$postId 	= $this->getPostIdFromFacebookEvent($request);

		$recordModel = Vtiger_Record_Model::getInstanceById($postId,$moduleName);

		return $recordModel;
	}

	public function getPostIdFromFacebookEvent(Vtiger_Request $request){
		$db 		= PearDatabase::getInstance();
		$recordId 	= $request->get('record');

		$resultSet = $db->pquery("SELECT p.facebookid AS id
				FROM vtiger_facebook i 
				INNER JOIN vtiger_facebook p ON i.fbobject_id = p.fbobject_id AND p.fbaction_type = ? 
				WHERE i.facebookid = ?",array('Post',$recordId) );

		if( $db->num_rows($resultSet) ){
			return $db->query_result($resultSet,0,'id');
		}else{
			return false;
		}
	}
}
