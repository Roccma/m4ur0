<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Facebook_RelatedMessages_Action extends Vtiger_Action_Controller {

	public function checkPermission(Vtiger_Request $request) {
		/*$recordPermission = Users_Privileges_Model::isPermitted('Faq', 'EditView');

		if(!$recordPermission) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}*/
	}

	public function process(Vtiger_Request $request) {
		global $log;
		$data = array();

		$moduleName = $request->getModule();
		$recordId 	= $request->get('record');
		$page 		= $request->get('page');//isset($request->get('page'))?  $request->get('page') : 0;
		$limit 		= 5; 

		$result = array();
		if (!empty ($recordId)) {
			$recordModel  	= Vtiger_Record_Model::getInstanceById($recordId,$moduleName);
			$link 			= $recordModel->get('fblink');
			$db = PearDatabase::getInstance();
			$resultSet = $db->pquery('	SELECT 
										facebookid,
										fbdescription AS message,
										IF(fbuser_id = fbpage_id ,"Yo", IFNULL(c.firstname,f.fbuser_name) ) AS sender,
										fbtimestamp as date
										FROM vtiger_facebook f
										LEFT JOIN vtiger_contactdetails c ON c.contactid = f.fbrelated_to
										WHERE fbaction_type = "Mensaje" AND fblink = ? 
										ORDER BY f.fbtimestamp DESC
										LIMIT ? , ? ',array($link,$page*$limit,$limit));
			if( $db->num_rows($resultSet) > 0 ){
				while ($row = $db->fetch_array($resultSet) ){
					$data[] = array(
							'id'		=>	$row['facebookid'],
							'message'	=>	$row['message'],
							'date'		=>	$row['date'],
							'sender'	=>	$row['sender']
						);
				} 
				$data = array_reverse($data);
			}
			echo json_encode( array('success'=>true,'data'=>$data) );
			
		}else{
			echo json_encode( array ('success' => false) );
		}
	}
}
