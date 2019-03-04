<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Facebook_getPostData_Action extends Vtiger_Action_Controller {

	public function checkPermission(Vtiger_Request $request) {
		/*$recordPermission = Users_Privileges_Model::isPermitted('Faq', 'EditView');

		if(!$recordPermission) {
			throw new AppException('LBL_PERMISSION_DENIED');
		}*/
	}

	/*
	*	Utilizo la API de facebook para obtener la informacion total de el Post
	*	EN caso de que falle la API retorno los datos que tengo en base  
	**/
	public function process(Vtiger_Request $request) {
		global $log;

		$log->debug("Inicio de funcion ".__METHOD__);

		$recordId 	= $request->get('record');		
		$moduleName = $request->getModule();

		$db 		= PearDatabase::getInstance();
		$recordModel= Vtiger_Record_Model::getInstanceById($recordId,$moduleName);
		$link 	= $recordModel->get('fbobject_id');

		$fbpage 	= $recordModel->get('fbpage_id');

		$resultSet	= $db->pquery("SELECT fbpaccess_token FROM vtiger_facebookpage p WHERE fbpage_id = ? ",array($fbpage));

		$fbtoken 	= $db->query_result($resultSet,0,'fbpaccess_token');	//Obtengo el token de la pagina
			

		require_once("config.facebook.php");
		require_once('includes/facebook/graph-sdk/src/Facebook/autoload.php');

		$fb = new \Facebook\Facebook([
			'app_id' => FB_APP_ID,
			'app_secret' => FB_APP_SECRET,
			'default_graph_version' => 'v2.10',
			//'default_access_token' => $default_token, // optional
		]);
		
		$fb->setDefaultAccessToken( $fbtoken );

		$query 	= $link."?fields=message,full_picture,shares"; // Obtengo los campos que quiero


		$log->debug("Consulta:".$query);

		try {
		
			$response 	= $fb->get($query);
			
			$log->debug("Pimba coso");

			$graphNode 	= $response->getGraphNode();
			$node 		= $graphNode->asArray();

			$log->debug(json_encode($node));
			
			if( !!$node ){
				$data = array( 	'message' 	=> str_replace("\n", "<br>", $node['message']),
								'image'		=> $node['full_picture'],
								'shares'	=> $node['shares']);

				echo json_encode( array('success' =>  true, 'result' => $data )); //Emito la respuestapuesta
			}
			else{
				echo json_encode( array('success' =>  false )); //Emito la res
			}

		} catch(\Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			$log->debug('Graph returned an error: ' . $e->getMessage());
			$this->returnFromLocal($request);
		} catch(\Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			$log->debug('Facebook SDK returned an error: ' . $e->getMessage());
			$this->returnFromLocal($request);
		}

	}

	function returnFromLocal(Vtiger_Request $request){
		$recordId 	= $request->get('record');		
		$moduleName = $request->getModule();

		$db 		= PearDatabase::getInstance();
		$recordModel= Vtiger_Record_Model::getInstanceById($recordId,$moduleName);
		$link 	= $recordModel->get('fbobject_id');


		$resultSet = $db->pquery("SELECT f.fbdescription as message
					FROM vtiger_facebook f WHERE f.fbobject_id = ? AND f.fbaction_type = ? ",array($link,'Post'));

		if( $db->num_rows($resultSet) ){
			$data = array(	'message' 	=> $db->query_result($resultSet,0,'message'),
							'image'		=> "",
							'shares'	=> ""
							);
			echo json_encode(array("success" => true,"result" => $data));
		}else{
			return json_encode(array("success" => false));
		}
	}
}
