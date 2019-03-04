<?php
error_reporting(E_ALL);


require_once("config.instagram.php");

include_once('vtlib/Vtiger/Utils.php');
require_once('includes/Loader.php');
require_once 'includes/runtime/LanguageHandler.php';
require_once('include/database/PearDatabase.php');


$Vtiger_Utils_Log = true;
$VTIGER_BULK_SAVE_MODE = true;

vimport('includes.http.Request');
vimport('includes.runtime.Globals');
vimport('includes.runtime.BaseModel');
vimport('includes.runtime.Controller');


global $adb, $log, $default_timezone;
global $site_URL, $application_unique_key;
global $default_language;
global $current_language;
global $default_theme;


if (!$current_user) //Settea el usuario como admin para poder guardar las crmentity
{
	$current_user = new Users();
	$current_user->id = 1;
	$current_user = $current_user->retrieve_entity_info($current_user->id, "Users");
}


define("DEBUG",false);

/**
Las querys que podemos hacer:

users/self/media/recent/ => trae los ultimos posts realizados

--
MAX_ID	Return media earlier than this max_id.
MIN_ID	Return media later than this min_id.
COUNT	Count of media to return
--	


user/self/media/liked/ => trae los likes echos por la persona

users/self/followed-by/ => quienes me siguen  scope=follower_list 

media/{media-id}	=> 	info de un media scope=public_content

media/{media-id}/comments => comentarios sobre un media

POST media/{media-id}/comments => postear un comentario

media/{media-id}/likes	=>	likes sobre un media	

POST media/{media-id}/likes	=>	postear likes sobre un media

DEL media/{media-id}/likes	=>	remover likes sobre un media

/tags/{tag-name}/media/recent =>	lista por tag


/Params

	iguser_id
	igentityid
	igrelated_to => vtiger
	igaction_type
	igcreated_time
	igobject_id
	iglink
	igdescription
	igverified
	igpage_id

*/

function process(){
	ig_writeLog("Inicio de funcion ".__FUNCTION__);
	global $IMPORT;

	$db = PearDatabase::getInstance();
	$page_ids = array();
	
	$resultSet = $db->pquery("SELECT igpage_id, igpaccess_token FROM vtiger_instagrampage WHERE igpaccess_token IS NOT NULL AND igpactive = 1 ",array());
	
	ig_writeLog("Cantidad de cuentas a importar: ".$db->num_rows($resultSet));

	if($db->num_rows($resultSet) == 0){ 
		$page_ids [] = array('id'	=>	IG_ACCOUNT_ID, 'token'	=>	ACCESS_TOKEN);
	}else{
		while ($row = $db->fetch_array($resultSet)) {
		    $page_ids [] = array( 'id' => $row['igpage_id'], 'token' => $row['igpaccess_token']);
		}
	}

	foreach ($page_ids as $page) {
		$token = $page['token'];
		
		$inicio = microtime(4);
		$ret 	= "";

  		ig_writeLog("Inicio de obtencion de datos ".$page['id']);
  		
  		foreach ($IMPORT as $key => $value) {
  			$function_name = "get".ucfirst($key);
  			if( function_exists($function_name) ){
  				if( $value == true ){
  					$data = $function_name($token,$db);
  					if( $data ){
  						$function_name = "insert".ucfirst($key);
  						if( function_exists($function_name) ){
  							$function_name($data,$db,$page['id']);
  						}
  					}
  				}
  			}else{
  				ig_writeLog("Error: Funcion ".$function_name." no implementada");
  			}
  		}
  		$fin  = microtime(4);
		ig_writeLog("Fin de ejecuccion");
		ig_writeLog("Tiempo total: ".round($fin - $inicio)." seg");
	}
}



function getPosts($access_token, $_){
	ig_writeLog("Inicio de funcion ".__FUNCTION__);
	$endpoint = "users";
	$url = implode( "/",
				array(API_URL.API_VERSION,$endpoint,'self','media','recent')
				);
	$params = array(
			'access_token' => $access_token
			);

	$response = fetch($url,$params,'GET',DEBUG);

	$data = json_decode($response,true);
	if( isset($data['data']) )
		$data = $data['data'];

	ig_writeLog("Cantidad de entidades encontradas: ".count($data));
	ig_writeLog("Fin de funcion ".__FUNCTION__);	
	return $data;
}

function insertPosts($data,$db){
	ig_writeLog("Inicio de funcion ".__FUNCTION__);
	
	//var_dump($data);

	$agregados = 0;

	$action_type = "Posts";	//igaction_type
	
	foreach ($data as $row) {
        ig_writeLog(json_encode($row));	

		$user_id 		= "";
		if( isset($row['user']) )
			$user_id 		= $row['user'][IG_IDENTIFIER]; // iguser_id

		$entity_id 		= $row['id'];	//igentity_id
		
		$object_id 		= $row['id']; //igobject_id
		$link 			= $row['link'];	//iglink
		$description 	= "";
		$created_time	= "";
		if( isset($row['caption']) ){
			$description	= $row['caption']['text']; //igdescription
			$created_time 	= date("Y-m-d H:i",$row['caption']['created_time']);//->format('Y-m-d'); //igcreated_time
		}
		$page_id 		= $user_id; //igpage_id
		$query  = " SELECT 1 
                    FROM vtiger_instagram 
                    WHERE igaction_type = '".$action_type."' AND iguser_id = '".$user_id."' AND igobject_id = '".$object_id."' ";

        $resultSet = $db->query($query);    

        if( $db->num_rows($resultSet) ){
          ig_writeLog("Ya existe el elemento. User id: ". $user_id." Objecto: ".$action_type);
        }else{   
			ig_writeLog("Creando nuevo elemento Instagram. User id ".$user_id." Objecto: ".$object_id." Pagina: ".$page_id);

			$vtiger_user_id = getVtigerUserId($db,$user_id);

			$recordModel = Vtiger_Record_Model::getCleanInstance('Instagram');

			$recordModel->set('iguser_id',$user_id);
			//$recordModel->set('igentityid',$entity_id);
			$recordModel->set('igrelated_to',$vtiger_user_id);
			$recordModel->set('igaction_type',$action_type);
			$recordModel->set('igcreated_time',$created_time);
			$recordModel->set('igobject_id',$object_id);
			$recordModel->set('iglink',$link);
			$recordModel->set('igdescription',$description);
			$recordModel->set('igpage_id',$page_id);
            $recordModel->set('assigned_user_id', 1);	
			$recordModel->set('mode','create');
			$recordModel->save();
			$agregados++;
		}
	}
	ig_writeLog("Fin de funcion ".__FUNCTION__);
	return $agregados;
}


function getComments($access_token,$db){
	return getGeneral($access_token,$db,'comments');
}
function getLikes($access_token,$db){
	return getGeneral($access_token,$db,'likes');
}

function getGeneral($access_token,$db,$type){
	ig_writeLog("Inicio de funcion ".__FUNCTION__);

	$data = array();
		
	$resultSet = $db->pquery("SELECT igobject_id AS id FROM vtiger_instagram WHERE igaction_type = 'Posts' ORDER BY igcreated_time",array()); // traigo x cantidad de posts, y hago queries por cada uno

	ig_writeLog("Queries a realizar: ".$db->num_rows($resultSet) );
	for($x = 0;$x < $db->num_rows($resultSet);$x++){

		$media_id = $db->query_result($resultSet,$x,'id');
		ig_writeLog("Obteniendo ".$type." para el post ".$media_id);

		$endpoint = "media";
		$url = implode( "/",
					array(API_URL.API_VERSION,$endpoint,$media_id,$type)
					);
		$params = array(
				'access_token' => $access_token
				);

		$response = fetch($url,$params,'GET',DEBUG);

		$json = json_decode($response,true);

		if( isset($json['data']) ){
			ig_writeLog("Cantidad de ".$type." ".count($json['data']));
			foreach ($json['data'] as $row) {
				$row['media_id'] = $media_id;
				$data[] = $row;
				/*$data[] = array(
						'iguser_id'	=>	$row['from']['id'],
						'igcreated_time'	=>	$row['created_time'],
						'igobject_id'	=>	$row['id'],//$media_id,
						'iglink'	=>	'',
						'igdescription'	=>	$row['text'],
						);*/
			}
		}
	}
	ig_writeLog("Cantidad de entidades encontradas: ".count($data));
	ig_writeLog("Fin de funcion ".__FUNCTION__);	
	return $data;
}

function insertComments($data,$db,$page_id){
	return insertGlobal($data,$db,$page_id,'comments');
}

function insertLikes($data,$db,$page_id){
	return insertGlobal($data,$db,$page_id,'likes');
}

function insertGlobal($data,$db,$page_id,$type){
	ig_writeLog("Inicio de funcion ".__FUNCTION__);
	
	//var_dump($data);

	$agregados = 0;

	$action_type = ucfirst($type);	//igaction_type
	
	foreach ($data as $row) {
        ig_writeLog(json_encode($row));	
        
        $user_id 		= "";
        $entity_id 		= $row['media_id'];	//igentity_id
        $object_id		= $row['id']; //igobject_id
        $link 			= "";
        $description	= "";
        $created_time	= "";

        if( $type == 'comments' ){
			$user_id 	= $row['from'][IG_IDENTIFIER]; // iguser_id

			//$link 			= $row['link'];	//iglink

			$description	= $row['text']; //igdescription
			$created_time 	= date("Y-m-d H:i",$row['created_time']);//->format('Y-m-d'); //igcreated_time
		}
		else if ( $type == 'likes' ){
			$user_id 	= $row[IG_IDENTIFIER]; // iguser_id
			
			$object_id 		= $row['media_id'].".".$row['id']; // Creo el id con el id del media mas el id del usuario
			//$link 			= $row['link'];	//iglink

			$description	= "Like de ".$row['username']; //igdescription
			//$created_time 	= null;
		}
		
		$query  = " SELECT 1 
                    FROM vtiger_instagram 
                    WHERE igaction_type = '".$action_type."' AND iguser_id = '".$user_id."' AND igobject_id = '".$object_id."' ";

        $resultSet = $db->query($query);    

        if( $db->num_rows($resultSet) ){
          ig_writeLog("Ya existe el elemento. User id: ". $user_id." Objecto: ".$action_type);
        }else{   
			ig_writeLog("Creando nuevo elemento ".$type.". User id".$user_id." Objecto: ".$object_id." Pagina: ".$page_id);

			$vtiger_user_id = getVtigerUserId($db,$user_id);

			$recordModel = Vtiger_Record_Model::getCleanInstance('Instagram');

			$recordModel->set('iguser_id',$user_id);
			//$recordModel->set('igentityid',$entity_id);
			$recordModel->set('igrelated_to',$vtiger_user_id);
			$recordModel->set('igaction_type',$action_type);
			$recordModel->set('igcreated_time',$created_time);
			$recordModel->set('igobject_id',$object_id);
			$recordModel->set('iglink',$link);
			$recordModel->set('igdescription',$description);
			$recordModel->set('igpage_id',$page_id);
            $recordModel->set('assigned_user_id', 1);	
			$recordModel->set('mode','create');
			$recordModel->save();
			$agregados++;
		}
	}
	ig_writeLog("Fin de funcion ".__FUNCTION__);
	return $agregados;
}


function getVtigerUserId($db /* Resoruce */,$user_id /* String | Int */){
	if( FIELDNAME != '' ){
		$resultContact = $db->query("SELECT contactid FROM ".TABLENAME." WHERE ".FIELDNAME. " = ".$user_id);
		return $db->num_rows($resultContact)? $db->query_result($resultContact,0,'contactid') : null;
	}else{
		return 0;
	}
}

function fetch($url,$params = array(), $type='GET',$debug = true){

	$ch = curl_init();

	if( $type == 'GET' && count($params) ){
		$url .= "?".http_build_query($params);
	}

	if( $debug )
		echo "Realizando request a ".$url.$endline;

	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, $type == 'POST' );
	if( $type == 'POST' && count($params)){
		curl_setopt($ch, CURLOPT_POSTFIELDS,
	            http_build_query($params)
	            );
	}

	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE);	//Pongo la verificacion de ssl como falso por prevencion de errores

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);	//Para que retorne en string

	$server_output = curl_exec ($ch);	//Ejecuto el curl

	

	if( curl_errno($ch) ){ //Si ocurre un error en el curl
		if( $debug ){
			ig_writeLog("Ocurrio un error en la ejecucion de la request:");		
			ig_writeLog( curl_error($ch) );
		}
		curl_close($ch);
		return false;
	}else{	//Si no ocurre error 
		if($debug){
			ig_writeLog("Request realizada satisfactoriamente".$endline);
			ig_writeLog($server_output);
		}
		curl_close($ch);
		return $server_output;
	}
}

/*
* Funcion para escribir salida segun el tipo de recurso que se utilize para ejecutar el script
*/
function ig_writeLog($cadena){
    echo $cadena.(isset($_SERVER["REMOTE_ADDR"])? '<br>' : PHP_EOL);
}

process();

?>