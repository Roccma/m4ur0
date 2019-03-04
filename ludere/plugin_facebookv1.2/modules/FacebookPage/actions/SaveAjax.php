<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class FacebookPage_SaveAjax_Action extends Vtiger_SaveAjax_Action {

	public function checkPermission(Vtiger_Request $request){

	}

	/*
	* Save ajax de FacebookPage
	* Si en los datos de request se pasa el parametro detcanjeid con un valor entonces 
	* la entidad se busca en la base de datos para actualizar, caso contrario se crea una nueva entidad
	*/
	public function process(Vtiger_Request $request) {
		global $log;
		$log->debug("EN LA FUNCION SAVEAJAX FacebookPage");
		$data = $request->get('datos'); // Obtengo los datos
		//Obtengo el token de larga duracion
		$log->debug("aca");
		$page_id 	= $data['id'];//Checkeo la existencia de dicha pagina en el servidor
		$page_name  = $data['name'];
		$access_token = $data['access_token'];
		$token_date = date('Y-m-d');
		$log->debug("aca");
		$log->debug(json_encode($data));
		$log->debug($access_token);

		$longLifeToken = $this->getLongLifeToken($access_token);

		$adb 		= PearDatabase::getInstance(); 
		$rs 		= $adb->pquery('SELECT facebookpageid FROM vtiger_facebookpage WHERE fbpage_id = ?', array($page_id) );
		$log->debug("aca");
		if( $adb->num_rows($rs) == 0 ){ //Si no existe la creo
			$log->debug("nuevo");
			$recordModel = Vtiger_Record_Model::getCleanInstance('FacebookPage');
			$log->debug("insta");
			$recordModel->set('fbpage_id',$page_id);
			$recordModel->set('fbppage_name',$page_name);
			$recordModel->set('fbpactive',1);
			$recordModel->set('fbptoken_date',$token_date);
			$recordModel->set('fbpaccess_token',$longLifeToken);
			$log->debug("aca");
			$recordModel->save();
			$log->debug("aca");
		}else{	//Si ya existe actualizo el token 
			$log->debug("vieji");
			$recordId    = $adb->query_result($rs,0,'facebookpageid');
			$recordModel = Vtiger_Record_Model::getInstanceById( $recordId );		
			$recordModel->set('fbpactive',1);			
			$recordModel->set('fbptoken_date',$token_date);
			$recordModel->set('fbpaccess_token',$longLifeToken);
			$recordModel->set('mode','edit');
			$recordModel->save();
		}		
		$log->debug("salimooo");
		echo json_encode(array('success'=>true,'data'=>$data));
	}

	public function getLongLifeToken( $token /* String */){
		global $log;

		require_once("config.facebook.php");
		require_once('includes/facebook/graph-sdk/src/Facebook/autoload.php');

		$fb = new \Facebook\Facebook([
		'app_id' => FB_APP_ID,
		'app_secret' => FB_APP_SECRET,
		'default_graph_version' => 'v2.10',
		//'default_access_token' => $default_token, // optional
		]);

		/*try {
		  // Get the \Facebook\GraphNodes\GraphUser object for the current user.
		  // If you provided a 'default_access_token', the '{access-token}' is optional.
		  $response = $fb->get('/'.$page); // Obtengo quien es la entidad sobre la cual se realizaran las acciones
		} catch(\Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  writeLog('Graph returned an error: ' . $e->getMessage());
		  exit;
		} catch(\Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  writeLog('Facebook SDK returned an error: ' . $e->getMessage());
		  exit;
		}
		*/

		$fb->setDefaultAccessToken( $token );


		$query = '/oauth/access_token?grant_type=fb_exchange_token&client_id='.FB_APP_ID.'&client_secret='.FB_APP_SECRET.'&fb_exchange_token='.$token;

		$log->debug("Consulta:".$query);

		$response 	= $fb->get($query);
		$log->debug("Pimba coso");
		$log->debug(json_encode($response));
		$graphNode 	= $response->getGraphNode();
		$node 		= $graphNode->asArray();

		$log->debug(json_encode($node));

		if(isset($node['access_token']))	
			return $node['access_token'];
		else
			return null;
	}

}
