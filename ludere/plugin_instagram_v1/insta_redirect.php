<?php

error_reporting(E_ALL);

require_once("config.instagram.php");


$endline = "<br>";

if(isset($_GET['code'])){
	if ( DEBUG ) echo "Tenemos el codigo ".$endline;
	$code = $_GET['code'];



	/*echo $endline."For console : ".$endline;

	echo " curl -F 'client_id=".CLIENT_ID."' \
    -F 'client_secret=".CLIENT_SECRET."' \
    -F 'grant_type=authorization_code' \
    -F 'redirect_uri=".REDIRECT_URI."' \
    -F 'code=".$code."' \
    https://api.instagram.com/oauth/access_token";
	*/
	$data = requestToken($code);
	if( $data ){
		
		include_once('vtlib/Vtiger/Utils.php');
		require_once('includes/Loader.php');
		require_once 'includes/runtime/LanguageHandler.php';
		require_once('include/database/PearDatabase.php');

		$Vtiger_Utils_Log = true;

		vimport('includes.http.Request');
		vimport('includes.runtime.Globals');
		vimport('includes.runtime.BaseModel');
		vimport('includes.runtime.Controller');


		global $adb, $log, $default_timezone;
		global $site_URL, $application_unique_key;
		global $default_language;
		global $current_language;
		global $default_theme;
		global $site_URL;

		
		//$log->debug("En la function".__METHOD__);

		if (!$current_user) //Settea el usuario como admin para poder guardar las crmentity
		{
			
			$current_user = new Users();
			
			$current_user->id = 1;
			$current_user = $current_user->retrieve_entity_info($current_user->id, "Users");
		}

		$access_token 	= $data['access_token'];
		$page_id 		= $data['id'];
		$page_name 		= $data['name'];

		$adb 		= PearDatabase::getInstance(); 
		$rs 		= $adb->pquery('SELECT instagrampageid FROM vtiger_instagrampage WHERE igpage_id = ?', array($page_id) );
		if( $adb->num_rows($rs) == 0 ){ //Si no existe la creo
			

			$recordModel = Vtiger_Record_Model::getCleanInstance('InstagramPage');

			$recordModel->set('igpage_id',$page_id);
			$recordModel->set('igppage_name',$page_name);
			$recordModel->set('igpactive',1);
			$recordModel->set('igptoken_date',date('Y-m-d'));
			$recordModel->set('igpaccess_token',$access_token);

			$recordModel->save();
			
		}else{	//Si ya existe actualizo el token 
			echo "Existe la paginita<br>";
			$log->debug("1");
			$recordId    = $adb->query_result($rs,0,'instagrampageid');
			$recordModel = Vtiger_Record_Model::getInstanceById( $recordId );		
			$recordModel->set('igpactive',1);	
			$recordModel->set('igptoken_date', date('Y-m-d'));
			$recordModel->set('igpaccess_token',$access_token);
			$recordModel->set('mode','edit');
			$recordModel->save();
			echo "Creada papaaa<br>";
		}	
		
		$redirect = $site_URL.'/index.php?module=InstagramPage&view=Edit&record='.$recordModel->getId();
		

		header("Location: $redirect");
		exit();
	}

}else{	
	$params = array(
			'client_id' 	=> CLIENT_ID,
			'redirect_uri' 	=> REDIRECT_URI,
			'response_type' => 'code',
			'scope'			=>	implode ( "+", array('public_content','likes','comments') ),
		);

	$param_string = "";
	foreach ($params as $key => $value) {
		$param_string .= ($param_string == ""?"":"&").$key."=".$value;
	}


	$auth  = API_URL."oauth/authorize/?".$param_string;

	echo $auth;
}


function requestToken($code){
	global $endline;

	$response = array();
	
	$ch = curl_init();

	$params = array(
		'client_id' 	=> CLIENT_ID,
		'client_secret' => CLIENT_SECRET,
		'grant_type'	=> 'authorization_code',
		'redirect_uri'	=> REDIRECT_URI, 
		'code' 			=> $code,		
		);

	curl_setopt($ch, CURLOPT_URL,API_URL."oauth/access_token");
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS,
	            http_build_query($params)
	            );
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);	//Pongo la verificacion de ssl como falso por prevencion de errores

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	//Para que retorne en string

	$server_output = curl_exec ($ch);	//Ejecuto el curl

	if( curl_errno($ch) ){ //Si ocurre un error en el curl
		if ( DEBUG ) echo "Ocurrio un error en la ejecucion de la request:".$endline;
		if ( DEBUG ) echo curl_error($ch).$endline;
		curl_close($ch);

		return false;
	}else{	//Si no ocurre error 
		
		curl_close($ch);

		$data = json_decode($server_output,true); //Obtengo el array de datos de la respuesta
		if ( DEBUG ) var_dump($data);
		if( isset($data['access_token']) ){
			if ( DEBUG ) echo "Request ejecutada correctamente.".$endline;
			if ( DEBUG ) echo "Usuario: ".	$data['user']['username']		.$endline;
			if ( DEBUG ) echo "Nombre: ".	$data['user']['full_name']		.$endline;
			if ( DEBUG ) echo "Token: ".		$data['access_token']			.$endline;
			$response = array(
						'id'			=> $data['user']['id'],
						'name'			=> $data['user']['username'],
						'access_token'	=> $data['access_token']
				);	
			return $response;
		}else{
			if ( DEBUG ) echo "No se encontro access token:".$endline;
			if ( DEBUG ) echo "Respuesta:".$endline;
			if ( DEBUG ) echo $server_output;
			return false;
		}

	}
}



?>

