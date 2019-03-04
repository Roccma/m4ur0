<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

require_once("config.facebook.php");

class Facebook_RelatedForPost_Action extends Vtiger_Action_Controller {

	public function checkPermission(Vtiger_Request $request) {
		/*$recordPermission = Users_Privileges_Model::isPermitted('Faq', 'EditView');

		if(!$recordPermission) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}*/
	}

	public function process(Vtiger_Request $request) {
		global $log;
		$recordId 	= $request->get('record');		
		$moduleName = $request->getModule();
		$type 		= $request->get('type');
		$page 		= $request->get('page');
		$limit  	= $type == 'Like'? LIKES_PER_PAGE : COMMENTS_PER_PAGE;

		$db 		= PearDatabase::getInstance();
		$recordModel= Vtiger_Record_Model::getInstanceById($recordId,$moduleName);
		$object_id 	= $recordModel->get('fbobject_id');
		$log->debug("Estamos en la paginita::".$page);
		$data 		= array();

		$resultSet = $db->pquery('		SELECT 
										facebookid,
										fbdescription AS message,
										IFNULL(c.firstname,f.fbuser_name) AS sender,
										fbcreated_time as date
										FROM vtiger_facebook f
										LEFT JOIN vtiger_contactdetails c ON c.contactid = f.fbrelated_to
										WHERE fbaction_type = ? AND fbobject_id = ? 
										ORDER BY f.fbcreated_time DESC
										LIMIT ? , ? ',array($type,$object_id,$page*$limit,$limit));
		if( $db->num_rows($resultSet) > 0 ){
			while ($row = $db->fetch_array($resultSet) ){
				$data[] = array(
						'id'		=>	$row['facebookid'],
						'message'	=>	$type == 'Comentario'? $row['message'] : "",
						'date'		=>	$row['date'],
						'sender'	=>	$row['sender']
					);
			} 
			$data = array_reverse($data);
			echo json_encode(array ('success' => true, 'result' => $data));
		}else{
			echo json_encode(array('success' => true, 'result' => $data));
		}

	}
}
