<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
//error_reporting(E_ALL);
class Facebook_PostMessages_Action extends Vtiger_Action_Controller {

	public function checkPermission(Vtiger_Request $request) {
		/*$recordPermission = Users_Privileges_Model::isPermitted('Faq', 'EditView');

		if(!$recordPermission) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}*/
	}

	public function process(Vtiger_Request $request) {
		global $log;

		$log->debug("INICIO DE LA FUNCION ".__METHOD__);

		$data = array();

		$moduleName = $request->getModule();
		$recordId 	= $request->get('record');
		$message	= $request->get('message');

		$log->debug("0");

		$result = array();
		if (!empty ($recordId)) {
			$recordModel  		= Vtiger_Record_Model::getInstanceById($recordId,$moduleName);
			$link 				= $recordModel->get('fbmessage_id');
			$fbpage 			= $recordModel->get('fbpage_id');
			$log->debug("1");

			$db 				= PearDatabase::getInstance();
			$resultSet 			= $db->pquery("SELECT fbpaccess_token FROM vtiger_facebookpage p WHERE fbpage_id = ? ",array($fbpage));

			$fbtoken 			= $db->query_result($resultSet,0,'fbpaccess_token');	//Obtengo el token de la pagina
			
			$log->debug("2");
			$log->debug("ESTAMOS ACA MI ÑERY");

			require_once("config.facebook.php");
			require_once('includes/facebook/graph-sdk/src/Facebook/autoload.php');

			$log->debug("ESTAMOS ACA MI ÑERY");

			$fb = new \Facebook\Facebook([
				'app_id' => FB_APP_ID,
				'app_secret' => FB_APP_SECRET,
				'default_graph_version' => 'v2.10',
				//'default_access_token' => $default_token, // optional
			]);
			
			$fb->setDefaultAccessToken( $fbtoken );

			$query 	= $link."/messages";
			$params = array('message' => $message);

			$log->debug("Consulta:".$query.":".json_encode($params));

			try {
			
				$response 	= $fb->post($query,$params);
				
				$log->debug("Pimba coso");

				$graphNode 	= $response->getGraphNode();
				$node 		= $graphNode->asArray();

				$log->debug(json_encode($node));
				
				if(!!$node && $node['id']){

					$responseModel = $this->saveMessage($fb,$node['id'],$recordModel);
					if ( $responseModel)
						echo json_encode( array('success' =>  true, 'result' => $responseModel )); //Emito la respuesta
					else
						echo json_encode( array('success' =>  false )); //Emito la respuesta
				}

			} catch(\Facebook\Exceptions\FacebookResponseException $e) {
				// When Graph returns an error
				$log->debug('Graph returned an error: ' . $e->getMessage());
				exit;
			} catch(\Facebook\Exceptions\FacebookSDKException $e) {
				// When validation fails or other local issues
				$log->debug('Facebook SDK returned an error: ' . $e->getMessage());
				exit;
			}
			

		}else{

		$log->debug("0000");
			echo json_encode( array ('success' => false) );
		}

			
	}

	public function saveMessage($fb,$uuid,$parentRecordModel){
		global $log;
		$log->debug("Inicio de funcion ".__METHOD__);

		$db 	= PearDatabase::getInstance();

		try {

			//Obtengo los parametros heredados del otro model
			$link 		= $parentRecordModel->get('fblink');
			$fbentityid	= $parentRecordModel->get('fbmessage_id');
			
			$query 		= $uuid."?fields=message,from,created_time";

			$response 	= $fb->get($query);

			$graphNode 	= $response->getGraphNode();
			$message	= $graphNode->asArray();

			$log->debug(json_encode($message));

			$fbuser_id 	 	= isset($message['from'])? $message['from']['id'] : "";	
			$user_name 		= isset($message['from'])? $message['from']['name'] : "";	
			$created_time 	= isset($message['created_time'])? $message['created_time']->format('Y-m-d') : "";
	        $vtcreatedtime	= isset($message['created_time'])? $message['created_time']->format('Y-m-d H:i:s') : "";
	        $description  	= isset($message['message'])? $message['message'] : ""; 
	        
			
			$resultContact = $db->query("SELECT contactid FROM ".TABLENAME." WHERE ".FIELDNAME. " = ".$user_id);
			$verified      = $db->num_rows($resultContact)? 'yes' : 'no';

			$vt_user_id    = $db->num_rows($resultContact)? $db->query_result($resultContact,0,'contactid') : null;

			$log->debug("Saveee");

			//Guardo el mensaje
			$recordModel = Vtiger_Record_Model::getCleanInstance("Facebook");
			$recordModel->set('fbuser_id', $fbuser_id);
			$recordModel->set('fbaction_type', 'Mensaje');
			$recordModel->set('fbrelated_to', $vt_user_id);
			$recordModel->set('fbcreated_time', $created_time);                
			$recordModel->set('fbobject_id', $uuid);
			$recordModel->set('fblink', $link);
			$recordModel->set('fbdescription', $description);
			$recordModel->set('fbpage_id', $fbuser_id);
			$recordModel->set('fbverified',  $verified);
			$recordModel->set('fbuser_name',  $user_name);
			$recordModel->set('fbmessage_id',  $fbentityid);

			$recordModel->set('fbtimestamp', $vtcreatedtime);
			$recordModel->set('assigned_user_id', 1);
			$recordModel->set('mode', 'create');
			$recordModel->save();

			$log->debug("Fin de funcion ".__METHOD__);

			return	array(
						'id'		=>	$recordModel->getId(),
						'message'	=>	$description,
						'date'		=>	$vtcreatedtime,
						'sender'	=>	"Yo"
				 );	//Retorno Array de respuesta

		} catch(\Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			$log->debug('Graph returned an error: ' . $e->getMessage());
			return false;
		} catch(\Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			$log->debug('Facebook SDK returned an error: ' . $e->getMessage());
			return false;
		}
	}


}
